<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\WorkshopEnrollment;
use App\Workshop;
use App\User;
use App\Card;
use App\Participant;
use App\Facilitator;
use Auth;
use App\Events\NewUser;
use App\Workshop_session;

class ParticipantController extends UserController
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isParticipant');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = $this->getAuthedUser()->id;
        $user= Participant::findById($id)->user; 
        $enrollments = WorkshopEnrollment::findEnrollmentsByParticipantId($id);
        return view('participant.home')
        ->with('user',$user->UserDataFilter())
        ->with('enrollments',$enrollments);
    }

    public function showUpdate(){
        $id =  $this->getAuthedUser()->id;
        $user=Participant::findById($id)->user;
        return view('participant.view')->with('user',$user->UserDataFilter());
        
    }
    public function update(UpdateUser $request)
    {
     
        $result = $request->validated();
        $user = $this->getAuthedUser();
        
        if(array_key_exists( 'Fname', $result )) $user->Fname = $result['Fname'];
        if(array_key_exists( 'Lname', $result )) $user->Lname = $result['Lname'];
        if(array_key_exists( 'password', $result )) $user->password=Hash::make(trim($result['password']));

        if(array_key_exists( 'profile', $result )){   // Handle File Upload
            // Get filename with the extension
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.auth()->user()->id.'.'.$extension;
            // Upload Image
            $path = $request->file('profile')->storeAs('public/img/profile', $fileNameToStore);
            $user->photo_link = $fileNameToStore;
        } 

        $user->saveUser();
          return redirect('/home')->with('success', 'Profile Updated Successfully');
    }

    public function joinWorkshop(Request $request)
    {

        $key = $request->input('key');

        if(!$key)
        return "key expired or no longer exists"; 

        $workshop=Workshop::findWorkshopByKey($key); 

        if(!$workshop) return "404 workshop not found"; //TODO Create a 404 page  

        $workshopEnrolls=WorkshopEnrollment::findEnrollmentsByWorkshopId($workshop->id);

        $participants=$workshopEnrolls->count();

        $already_participant=WorkshopEnrollment::isParticipantEnrolled($workshop->id,$this->getAuthedUser()->id);


        if($workshop->has_ended)
        return Redirect::back()->withErrors("Workshop Ended ".$workshop->updated_at->diffForHumans());
            
        if($already_participant)
        return Redirect::back()->withErrors("Already enrolled in this workshop");

        if($workshop->is_closed)
        return Redirect::back()->withErrors("Sorry you can't join, Workshop Closed");

        if($participants>=$workshop->required_participants)
        return Redirect::back()->withErrors("Workshop reached full capacity");
        
        WorkshopEnrollment::addWorkshopEnrollment([
            'participant_id'=>$this->getAuthedUser()->id,
            'workshop_id'=>$workshop->id,
            ]);

            $user = $this->getAuthedUser();

        broadcast(new NewUser($user->id, $user->Fname." ".$user->Lname, $workshop->key));

        return redirect('workshop/'.$workshop->key);
    }

    public function showWorkshop($key)
    {
        $workshop=Workshop::findWorkshopByKey($key); 
        
        if(!$workshop)
            return "404 workshop not found"; //TODO Create a 404 page  

     $workshopEnrolls=WorkshopEnrollment::findEnrollmentsByWorkshopId($workshop->id);

  
     $is_participant=WorkshopEnrollment::isParticipantEnrolled($workshop->id,$this->getAuthedUser()->id);

     if(!$is_participant)
            return "Failed, please join workshop using its key";

        return view('participant.workshop')
            ->with('workshop',$workshop)
            ->with('facilitator', Facilitator::findById($workshop->facilitator_id)->user);
            
    }

    public function submitCard(Request $request, $key){
        $workshop=Workshop::findWorkshopByKey($key);
        //TODO validate if participant belongs to workshop
        Card::createCard($workshop->id,auth()->user()->id);
        Workshop_session::incrementSession($workshop->id);
        broadcast(new SubmitCard(auth()->user()->id,'',$key));
        return 1;
    }
    
    public function getAuthedUser(){
        return Auth::user();
    }
    
}
 
?>
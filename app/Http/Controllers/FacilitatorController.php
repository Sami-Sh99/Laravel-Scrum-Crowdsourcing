<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\CreateWorkshop;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Workshop;
use App\WorkshopEnrollment;
use App\Facilitator;
use App\Participant;
use App\Card;
use App\Score;
use App\Workshop_session;
use App\Events\LaunchWorkshop;
use Auth;

class FacilitatorController extends UserController
{

       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isFacilitator');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = $this->getAuthedUser()->id;
        $user= Facilitator::findById($id)->user;
        $workshops = Workshop::findAllWorkshopsByFacilitatorId($id);
        return view('facilitator.home')
        ->with('user',$user->UserDataFilter())
        ->with('workshops',$workshops);
    }
    public function showUpdate(){
        $id =  $this->getAuthedUser()->id;
        $user=Facilitator::findById($id)->user;
        return view('facilitator.view')->with('user',$user->userDataFilter());
    }

    public function update(UpdateUser $request)
    {

        $result = $request->validated();
        $user = $this->getAuthedUser();
        if(array_key_exists( 'Fname', $result )) $user->Fname = $result['Fname'];
        if(array_key_exists( 'Lname', $result )) $user->Lname = $result['Lname'];
        if(array_key_exists( 'password', $result )) $user->password=Hash::make(trim($result['password']));

        if(array_key_exists( 'profile', $result)){   // Handle File Upload
            // Get filename with the extension
            dd($request->file('profile'));
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.$this->getAuthedUser()->id.'.'.$extension;
            // Upload Image
            $path = $request->file('profile')->storeAs('public/img/profile', $fileNameToStore);
            $user->photo_link = $fileNameToStore;
        } 
        $user->saveUser();
        return redirect('/home')->with('success', 'Profile Updated Successfully');
    }

    //Remove
    public function showCreateWorkshop()
    {
        return view('workshop.create');
    }

    public function createWorkshop(CreateWorkshop $request)
    {    
        $result = $request->validated();
        $workshop = Workshop::createWorkshop([
            'key'=>$this->generateKey(),
            'title'=>$result['title'],
            'description'=>$result['description'],
            'required_participants'=>$result['required_participants'],
            'facilitator_id'=>$this->getAuthedUser()->id,
        ]);

        $response=array(
            'success'=>'Workshop Created',
            'key'=>$workshop->key,
        );

        return redirect('/facilitator/workshop/'.$workshop->key);
    }

    public function showWorkshop($key)
    {
        $workshop=Workshop::findWorkshopByKey($key); 
        if(!$workshop)
            return "404 workshop not found"; //TODO Create a 404 page  

        $workshopEnrolls=WorkshopEnrollment::findEnrollmentsByWorkshopId($workshop->id);

        if($workshop->facilitator_id != $this->getAuthedUser()->id)
            return "Permission Denied, you did not create this workshop";

        $participants=$workshopEnrolls->map(function($x){
            $user=Participant::findById($x->participant_id)->user;
            return $user->UserDataFilter();
        });

        return view('facilitator.workshop')
            ->with('workshop',$workshop)
            ->with('participants',$participants->toArray());
    }

    public function closeWorkshop($key){
        $workshop = Workshop::findWorkshopByKey($key);
        if(!$workshop) return '0';
        $workshop->updateWorkshop(['is_closed'=>true]);
        return '1';
    }

    public function endWorkshop($key){
        $workshop = Workshop::findWorkshopByKey($key);
        if(!$workshop) return '0';
        $workshop->updateWorkshop(['has_ended'=>true]);
        return '1';
    }

    private function generateKey() 
    {
        $key = Str::random(7);
    
        // recursive call if the key exists already
        if (Workshop::where('key',$key)->exists()) {
            return generateKey();
        }
        return $key;
    }

    public function launchWorkshop($key){
        $workshop=Workshop::findWorkshopByKey($key);
        $user=$this->getAuthedUser();
        if($workshop->facilitator_id != $user->id )
            return "Not permitted to Launch this Workshop -- you are not the workshop owner";
        $workshop->is_closed=true;
        $workshop->save();
        $session=Workshop_session::CreateSession($workshop->id);
        broadcast(new LaunchWorkshop($user->id, $user->Fname." ".$user->Lname, $workshop->key));
        return 1;
    }
    
    public function getAuthedUser(){
        return Auth::user();
    }

    public function generateScoringSystem($key){
        $workshop=Workshop::findWorkshopByKey($key);
        //TODO Check variables not null
        $workshopEnrolls=WorkshopEnrollment::findEnrollmentsByWorkshopId($workshop->id);
        $participants=$workshopEnrolls->map(function($x){
            $user=Participant::findById($x->participant_id)->user;
            return $user->UserDataFilter();
        });
        $participants_count=$workshopEnrolls->count();
        $Cards=Card::getCardsByWorkdshopInRandom($workshop->id);
        $Scores=array();
        $globalAssign=$Cards->pluck('id')->all();
        $globalAssign= array_flip($globalAssign);
        $globalAssign = array_fill_keys(array_keys($globalAssign), 0);
        foreach ($participants as $participant) { 
            $assigned=array();
            $reservedCards=$this->getReservedCards($globalAssign);
            $CardsNotReserver=$Cards->whereNotIn('id',$reservedCards);
            for ($j=0; $j < env('ROUNDS',5) ; $j++) { 
                if($participant['id'] != $this->getAuthedUser()->id){
                    $notAssignedCard=$CardsNotReserver->whereNotIn('id',$assigned)->first();
                    array_push($assigned,$notAssignedCard['id']);
                    array_push($Scores,[
                        'participant_id'=>$participant['id'],
                        'workshop_id'=>$workshop->id,
                        'card_id'=>$notAssignedCard['id'],
                        'score'=>'-1',
                    ]);
                }
            }
        }
        Score::insert($Scores);
        return $Scores;
    }

    private function getReservedCards($globalAssign){
        $x=array();
        foreach ($globalAssign as $key => $value) {
            if($value==5)
                array_push($x,value);
        }
        return $x;
    }

}
 
?>
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
use Session;
use App\Events\NewUser;
use App\Events\SubmitCard;
use App\Workshop_session;
use App\Score;

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
        $workshopEnrollsCount=WorkshopEnrollment::countParticipantsEnrolled($workshop->id);
        //TODO validate if participant belongs to workshop
        Card::createCard($workshop->id,auth()->user()->id, $request->all()['content']);
        broadcast(new SubmitCard(getAuthedUser()->id,$key));
        if(Card::countCards($workshop->id) == $workshopEnrollsCount )
            FacilitatorController::generateScoringSystem($workshop->id);
        return 1;
    }

    public function showScore($key){
        $workshop=Workshop::findWorkshopByKey($key);
        //TODO validate that this user submitted a card && workshop exists
        $score=Score::getNonScoredCardById($workshop->id,$this->getAuthedUser()->id);
        $card=Card::getCardById($score->card_id);
        if($card == null){
            return 'all cards scored';
        }
        return view('participant.score')->with('workshop',$workshop)->with('card',$card)->with('score_id',$score->id);
    }

    public function setScore(Request $request,$key,$score_id){
        //TODO Validate workshop not null && score between 1 and 5
        $workshop=Workshop::findWorkshopByKey($key);
        $workshopEnrollsCount=WorkshopEnrollment::countParticipantsEnrolled($workshop->id);
        $score=Score::getNonScoredCardById($workshop->id,$this->getAuthedUser()->id);
        // dd(Score::countHowManyScored($workshop->id,$this->getAuthedUser()->id));
        if(Score::countHowManyScored($workshop->id,$this->getAuthedUser()->id) != Workshop_session::getRound($workshop->id)){
            return "Not Current Round";//TODO redirect to please wait page with flash message of ' not current round'
        }
        // dd($request->input('score'));
        $score_value=$request->input('score');
        if($score_value>5 or $score_value<0)
            return "Score out of scope";
        Score::setScore($score_id ,$score_value);
        $scores_done=Workshop_session::incrementSession($workshop->id);
        if($scores_done == $workshopEnrollsCount){
            Workshop_session::resetDone($workshop->id);
            $round=Session::get('round');
            Session::put('round', $round+1);
            //broadcast new Round
            Session::save();
            return "New scoring";// redirect to a new scoring screen
        }
        return "please wait";// redirect to a please wait that waits for a pusher to broadcast, in order to redirect to new scoring screen

    }
    
    public function getAuthedUser(){
        return Auth::user();
    }
    
}
 
?>
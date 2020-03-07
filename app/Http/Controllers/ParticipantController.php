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
use App\Events\NextRound;
use App\Events\FinishRounds;
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
            $fileNameToStore= auth()->user()->id.'_'.$filename.'.'.$extension;
            // Upload Image
            $request->file('profile')->move(public_path('images'), $fileNameToStore);
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

        if(!$workshop) return "404 workshop not found"; 

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
            return "404 workshop not found";  

     $workshopEnrolls=WorkshopEnrollment::findEnrollmentsByWorkshopId($workshop->id);
     $session=Workshop_session::getSession($workshop->id);
     $is_participant=WorkshopEnrollment::isParticipantEnrolled($workshop->id,$this->getAuthedUser()->id);

    if(!$is_participant)
            return "Failed, please join workshop using its key";
        $hasCard=Card::getCard($workshop->id,$this->getAuthedUser()->id);
        // dd($hasCard);
    if(!$workshop->is_closed)
        return view('participant.workshop')
        ->with('workshop',$workshop)
        ->with('facilitator', Facilitator::findById($workshop->facilitator_id)->user)
        ->with('continue','')
        ->with('wait',true);

    if(!$hasCard)
        return view('participant.workshop')
        ->with('workshop',$workshop)
        ->with('facilitator', Facilitator::findById($workshop->facilitator_id)->user)
        ->with('continue','')
        ->with('wait',false);

    if($session->round > 5)
        return 'workshop finished scoring';

    if($hasCard)
        return redirect('/workshop/'.$key.'/wait');
            
    }

    public function submitCard(Request $request, $key){
        $workshop=Workshop::findWorkshopByKey($key);
        if(!$workshop)
            return "404 Workshop does not exist";
        $workshopEnrollsCount=WorkshopEnrollment::countParticipantsEnrolled($workshop->id);
        if(!WorkshopEnrollment::isParticipantEnrolled($workshop->id,auth()->user()->id))
            return "Error user not enrolled in this workshop";
        Card::createCard($workshop->id,auth()->user()->id, $request->input('content'));
        broadcast(new SubmitCard($this->getAuthedUser()->id,$key));
        Session::put('round', 1);
        Session::save();
        if(Card::countCards($workshop->id) == $workshopEnrollsCount){
            $this->generateScoringSystem($workshop->id);
            Workshop_session::resetDone($workshop->id);
            broadcast(new NextRound($key));
            return redirect('/workshop/'.$key.'/scoring');
        }
        return redirect('/workshop/'.$key.'/wait');
    }

    public function showScore($key){
        $workshop=Workshop::findWorkshopByKey($key);
        if(!$workshop)
            return "404 Workshop does not exist";
        if(!Card::getCard($workshop->id,auth()->user()->id))
            return "Can not score if card was not submitted";
        $score=Score::getNonScoredCardById($workshop->id,$this->getAuthedUser()->id);
        $session=Workshop_session::getSession($workshop->id);
        // dd($score);
        if($score == null and !$session->shuffled)
            return redirect('/workshop/'.$key.'/wait');

        if($score == null and $session->shuffled)
            return 'All Cards SCOREED!';

        $card=Card::getCardById($score->card_id);
        if($card == null){
            return 'all cards scored';
        }
        return view('participant.score')->with('workshop',$workshop)->with('card',$card)->with('score_id',$score->id)->with('round',Workshop_session::getRound($workshop->id));
    }

    public function setScore(Request $request,$key,$score_id){
        $workshop=Workshop::findWorkshopByKey($key);
        $workshopEnrollsCount=WorkshopEnrollment::countParticipantsEnrolled($workshop->id);
        $score=Score::getNonScoredCardById($workshop->id,$this->getAuthedUser()->id);
        $userCountScored=Score::countHowManyScored($workshop->id,$this->getAuthedUser()->id);
        $current_round=Workshop_session::getRound($workshop->id);
        if( $userCountScored != $current_round - 1  ){
            return "Not Current Round";
        }
        $score_value=$request->input('score');
        if($score_value>5 or $score_value<0)
            return "Score out of scope";
        Score::setScore($score_id ,$score_value);
        $scores_done=Workshop_session::incrementSession($workshop->id);
        $round=Session::get('round');
        Session::put('round', $round+1);
        Session::save();
        if($scores_done == $workshopEnrollsCount){
            $nextRound=Workshop_session::resetDone($workshop->id);
            if($nextRound>5){
                broadcast(new FinishRounds($key));
                return 'Grouping Screen';
            }
            broadcast(new NextRound($key));
            return redirect('/workshop/'.$key.'/scoring')->with('success', 'Next Round Started');
        }
        return redirect('/workshop/'.$key.'/wait');
    }
    
    public function showWait($key){
        $workshop=Workshop::findWorkshopByKey($key);
        $saved_round=Session::get('round');
        // dd($saved_round);
        $current_round=Workshop_session::getRound($workshop->id);

        if($saved_round==$current_round)
            // dd($current_round);
            return redirect('/workshop/'.$key.'/scoring');
        return view('participant.workshopWait')->with('workshop',$workshop);
    }
    
    public function getAuthedUser(){
        return Auth::user();
    }

    private function ScoringSystem($workshop_id){
        $workshopEnrolls=WorkshopEnrollment::findEnrollmentsByWorkshopId($workshop_id);
        if(!$workshopEnrolls or count($workshopEnrolls)==0)
            return "404 Enrollments not found";
        $participants=$workshopEnrolls->map(function($x){
            $user=Participant::findById($x->participant_id)->user;
            return $user->UserDataFilter();
        });
        $participants_count=$workshopEnrolls->count();
        $Cards=Card::getCardsByWorkdshopInRandom($workshop_id);
        $Scores=array();
        $globalAssign = $Cards->pluck('id')->all();
        $globalAssign = array_flip($globalAssign);
        $globalAssign = array_fill_keys(array_keys($globalAssign), 0);
        $table=array();
        foreach($participants as $participant){
            $ColumnCard=array();
            foreach($Cards as $card)
                if($card['participant_id']!=$participant['id'])
                    array_push($ColumnCard,$card['id']);
            $table[$participant['id']]=$ColumnCard;
        }
        for ($i=0; $i < 5; $i++) { 
            foreach ($table as $participant => $assignableCard) {
                $chooseCardIndex=array_rand($assignableCard);
                $chooseCard=$assignableCard[$chooseCardIndex];
                unset($table[$participant][$chooseCardIndex]);
                $globalAssign[$chooseCard]++;
                if($globalAssign[$chooseCard]==5){
                    unset($globalAssign[$chooseCard]);
                    foreach($table as $p2 => $c2){
                        $index=array_search($chooseCard,$c2);
                        if($index)
                        unset($table[$participant][$index]);
                    }
                }
                array_push($Scores,[
                    'participant_id'=>$participant,
                    'workshop_id'=>$workshop_id,
                    'card_id'=>$chooseCard,
                    'score'=>'-1',
                ]);
            }
        }
        Score::insert($Scores);
        $session=Workshop_session::ShuffleReady($workshop_id);
        return $Scores;
    }


    public function generateScoringSystem($workshopID){
        $this->ScoringSystem($workshopID);
    }

}
?>
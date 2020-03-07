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
            return "404 workshop not found";

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

    public function displayResults($key){
        $workshop=Workshop::findWorkshopByKey($key);
        $cards=Card::getCardsByWorkdshop($workshop->id);
        $results=array();

        foreach ($cards as  $card) {
            $avgScore=Score::getAvgScore($workshop->id,$card['id']);
            array_push($results,[
                'id'=>$card['id'],
                'description'=>$card['content'],
                'owner'=>User::getByID($card['participant_id'])->toArray(),
                'average score'=>$avgScore,
            ]);
        }
        usort($results, function($x,$y){
            if ($x['average score'] == $y['average score']) {
                return 0;
            }
            return ($x['average score'] > $y['average score']) ? -1 : 1;
        });
        return view('facilitator.workshopResult')->with('results',$results)->with('workshop',$workshop);
    }
    
    public function getAuthedUser() {
        return Auth::user();
    }
}
 
?>
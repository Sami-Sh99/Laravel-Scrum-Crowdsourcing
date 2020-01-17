<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Hash;
use App\WorkshopEnrollment;
use App\Workshop;
use App\User;

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
        $user=User::findOrFail(auth()->user()->id);
        return view('participant.home')->with('user',$user->UserDataFilter());
    }

    public function showUpdate(){
        $user=User::findOrFail(auth()->user()->id);
        return view('participant.view')->with('user',$user->UserDataFilter());
        
    }
    public function update(UpdateUser $request)
    {
     
        $result = $request->validated();
        $user = auth()->user();
        
        if($result['Fname']) $user->Fname = $result['Fname'];
        if($result['Lname']) $user->Lname = $result['Lname'];
        if($result['password']) $user->password=Hash::make(trim($result['password']));

        if($request->hasFile('profile')){   // Handle File Upload
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

        $user->save();
          return redirect('/home')->with('success', 'Profile Updated Successfully');
    }

    public function joinWorkshop($key)
    {
        $workshop=Workshop::where('key',$key) -> first();
        if(!$workshop)
            return "404 workshop not found"; //TODO Create a 404 page

        $workshopEnrolls=WorkshopEnrollment::where('workshop_id',$workshop->id);
        $participants=$workshopEnrolls->count();
        $already_participant=$workshopEnrolls->where('participant_id',auth()->user()->id)->first();

        if($workshop->has_ended)
            return "Workshop Ended ".$workshop->updated_at->diffForHumans();
            
        if($already_participant)
            return "Already enrolled in this workshop";

        if($workshop->is_closed)
            return "Workshop Closed";

        if($participants>=$workshop->required_participants)
            return "Workshop reached full capacity";

        WorkshopEnrollment::create([
            'participant_id'=>auth()->user()->id,
            'workshop_id'=>$workshop->id,
            ]);

        //TODO Broadcast to facilitator a new participant has joined the wokrshop


        return 'successfully joined workshop '.$key;
    }
    
}
 
?>
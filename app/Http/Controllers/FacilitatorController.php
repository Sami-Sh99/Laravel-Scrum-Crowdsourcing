<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWorkshop;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Workshop;
use App\WorkshopEnrollment;
use App\Facilitator;
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
        return view('facilitator.home')->with('user',$user->UserDataFilter());
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
        if($result['Fname']) $user->Fname = $result['Fname'];
        if($result['Lname']) $user->Lname = $result['Lname'];
        if($result['password']) $user->password=Hash::make(trim($result['password']));

        if($result['profile']){   // Handle File Upload
            // Get filename with the extension
            dd($request->file('profile'));
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

    public function showCreateWorkshop()
    {
        return view('workshop.create');
    }

    public function createWorkshop(CreateWorkshop $request)
    {    
        $result = $request->validated();
        $workshop=Workshop::Create([
            'key'=>$this->generateKey(),
            'title'=>$result['title'],
            'description'=>$result['description'],
            'required_participants'=>$result['required_participants'],
            'facilitator_id'=>auth()->user()->id,
        ]);
        $workshop->save();
        $response=array(
            'success'=>'Workshop Created',
            'key'=>$workshop->key,
        );
        return redirect('/facilitator/workshop/'.$workshop->id);
    }

    public function showWorkshop($id)
    {
        $workshop=Workshop::where('id',$id) -> first(); 
        if(!$workshop)
            return "404 workshop not found"; //TODO Create a 404 page  
        
        $workshopEnrolls=WorkshopEnrollment::where('workshop_id',$workshop->id)->get();
        
        if($workshop->facilitator_id != auth()->user()->id)
            return "Permission Denied, you did not create this workshop";

        $participants=$workshopEnrolls->map(function($x){
            $user=User::find($x->participant_id)->UserDataFilter();
            return $user;
        });

        return view('facilitator.workshop')
            ->with('workshop',$workshop)
            ->with('participants',$participants->toArray());
    }

    public function closeWorkshop($id){
        
        if(!Workshop::where('id',$id)->exists())
            return '0';
        Workshop::where('id',$id)->update(['is_closed'=>true]);
        return '1';
    }

    public function endWorkshop($id){
        if(!Workshop::where('id',$id)->exists())
            return '0';
        Workshop::where('id',$id)->update(['has_ended'=>true]);
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
    
    public function getAuthedUser(){
        return Auth::user();
    }

}
 
?>
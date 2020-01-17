<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWorkshop;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Workshop;
use App\WorkshopEnrollment;
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
        $user=User::findOrFail(auth()->user()->id);
        return view('facilitator.home')->with('user',$user->UserDataFilter());
    }
    public function showUpdate(){
        $user=User::findOrFail(auth()->user()->id);
        return view('facilitator.view')->with('user',$user->userDataFilter());
    }

    public function update(UpdateUser $request)
    {

        $result = $request->validated();
        $user = auth()->user();
        
        if($result['Fname']) $user->Fname = $result['Fname'];
        if($result['Lname']) $user->Lname = $result['Lname'];
        if($result['password']) $user->password=Hash::make(trim($result['password']));

        dd($result);
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
        $user->save();
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
        return redirect('/facilitator/home')->with('key',$workshop->key)->with('success', 'Workshop Created');
    }

    private function generateKey() {
        $key = Str::random(7);
    
        // recursive call if the key exists already
        if (Workshop::where('key',$key)->exists()) {
            return generateKey();
        }
        return $key;
    }
}
 
?>
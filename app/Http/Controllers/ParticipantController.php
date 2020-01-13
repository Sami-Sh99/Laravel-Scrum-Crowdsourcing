<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Hash;
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
        return view('participant.update')->with('user',$user->UserDataFilter());
        
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
    
}
 
?>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('notAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with('user',$this->UserDataFilter());
    }

    public function showUpdate(){
        $user=User::findOrFail(auth()->user()->id);
        return view('user.update')->with('user',$this->UserDataFilter($user));
        
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'profile' => 'nullable|max:1999',
            'Fname'=>'nullable|max:190',
            'Lname'=>'nullable|max:190',
            'new password'=>'nullable|confirmed|min:8|max:190',
          ]);

        $user = auth()->user();

        if($request->has('Fname'))
            $user->Fname=$request->input('Fname');
        if($request->has('Lname'))
            $user->Lname=$request->input('Lname');
        if($request->has('password') && strlen($request->input('password'))>0)
            if(bcrypt($request->input('old password'))!=$user->password)
                return 'Password does not match';
            $user->password=bcrypt($request->input('new password'));
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
        // else
        // {
        //     $fileNameToStore = 'unknown.png';
        // }

        $user->save();
          
          return redirect('/home')->with('success', 'Profile Updated Successfully');
    }

    private function UserDataFilter(){
        $x=auth()->user();
        return [
            "id" => $x->id,
            "email" => $x->email,
            "Fname" => $x->Fname,
            "Lname" => $x->Lname,
            "role" => $x->role,
            "photo_link" => $x->photo_link,
            "is_verified" => $x->is_verified,
            "created_at" => $x->created_at->diffForHumans(),
        ];
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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

<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){}

    public function index(){}
    
    public function test(){}

    public function deactivate(){
        auth()->user()->is_deactivated=true;
        auth()->user()->save();
        Auth::logout();
        return redirect('/');
    }
}

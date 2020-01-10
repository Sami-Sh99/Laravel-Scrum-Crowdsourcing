<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        return view('facilitator.home');
    }
    
}
 
?>
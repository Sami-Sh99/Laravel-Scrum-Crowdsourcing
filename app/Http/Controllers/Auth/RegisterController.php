<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Participant;
use App\Facilitator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration if they try 
     * to go to /register while already being logged in
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'Fname' => 'required|string|max:255',
            'Lname' => 'required|string|max:255',
            'role'=>'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $is_verified=DB::table('admins')->where('id',1)->get()[0]->auto_verify;
        
        $user = User::create([
            'Fname' => $data['Fname'],
            'Lname' => $data['Lname'],
            'role'  => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make(trim($data['password'])),
            'is_verified'=>$is_verified,
        ]);
        if($data['role']=='P'){
            Participant::create([
                'id'=>$user->id,
            ]);
        }
        else{
            Facilitator::create([
                'id'=>$user->id,
            ]);
        }
        return $user;
    }
}

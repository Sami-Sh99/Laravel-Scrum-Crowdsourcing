<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);
 
        $credentials = $request->only('email', 'password');
        $model = User::where('email', $credentials['email'])->firstOrFail();

        //if user deactivated the redirect without attempting to login
        if($model->is_deactivated)
            return Redirect::to("login")->withFail('Account deactivated, please contact admin to reactivate account');
            
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            switch (auth()->user()->role) {
                case 'A':
                    return redirect()->intended('/admin');
                    break;
                case 'F':
                    return redirect()->intended('/home');
                    break;
                case 'P':
                    return redirect()->intended('/home');
                    break;
                default:
                    return redirect()->intended('/');
            }
        }
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
}

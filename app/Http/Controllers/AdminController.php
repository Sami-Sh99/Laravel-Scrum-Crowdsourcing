<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    protected $redirectTo = '/admin/login';
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        return view('auth.admin.home');
    }

    public function showAdminLoginForm()
    {
        $this->middleware('auth');
        return view('auth.admin.login')->with('url','admin');
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required|max:255',
            'password' => 'required|min:4'
        ]);
            // dd('In post login !');
        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {
            
            return redirect()->intended('/admin');
        }
        // dd(auth());
        return back()->withInput($request->only('username', 'remember'));
    }
}

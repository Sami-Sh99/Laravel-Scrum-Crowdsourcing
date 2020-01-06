<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $users = DB::table('users')->paginate(15);
        // $users->withPath('custom/url');
        // dd($users);
        return view('auth.admin.home')->with('users',$users);
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
    public function verify(Request $request){
        $id = $request->query('id');
        DB::table('users')
            ->where('id', $id)
            ->update(['is_verified' => 1]);
        return redirect()->intended('/admin');
    }
}

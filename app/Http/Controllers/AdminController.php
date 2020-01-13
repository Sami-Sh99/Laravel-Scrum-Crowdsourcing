<?php

namespace App\Http\Controllers;

use Auth;
use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

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
        $admin =DB::table('admins')->where('id',auth()->user()->id)->get()[0];
        return view('auth.admin.home')->with('users',$users)->with('admin',$admin);
    }

    public function verify(Request $request){
        $id = $request->query('id');
        DB::table('users')
            ->where('id', $id)
            ->update(['is_verified' => 1]);
        return redirect()->intended('/admin');
    }

    public function toggleAutoVerify(){
        $task = Admin::findOrFail(1);
        $task->auto_verify=!$task->auto_verify;
        $task->save();
        return 1;
    }

    public function toggleActive($id){
        $task = User::findOrFail($id);
        $task->is_deactivated=!$task->is_deactivated;
        $task->save();
        return 1;
    }
}

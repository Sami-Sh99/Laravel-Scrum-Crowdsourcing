<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Events\NewCard;

Route::pattern('id', '[0-9]+'); //executed if {id} is numeric

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register');;

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Admin
Route::get('admin', 'AdminController@index');
Route::get('admin/verify', 'AdminController@verify')->name('verify');
Route::get('admin/autoverify', 'AdminController@toggleAutoVerify')->name('auto verify');
Route::get('admin/toggleActive/{id}', 'AdminController@toggleActive')->name('activation');;


//Users Home page
Route::get('home', function(){
    $user = Auth::user();
    if($user){
        if($user->role == 'P')
        return redirect('participant/home');
        else if($user->role === 'F')
        return redirect('facilitator/home');
        else if($user->role === 'A')
        return redirect('admin');
    }
    else 
   return redirect('/');
});

//Users View page
Route::get('view', function(){
    $user = Auth::user();
    if($user){
        if($user->role == 'P')
        return redirect('participant/view');
        else if($user->role === 'F')
        return redirect('facilitator/view');
    }
    else 
   return redirect('/');
});


//Facilitator
Route::get('facilitator/home', 'FacilitatorController@index');
Route::get('facilitator/view', 'FacilitatorController@showUpdate')->name('user update');
Route::post('facilitator/update', 'FacilitatorController@update')->name('user update');
Route::post('facilitator/deactivate', 'FacilitatorController@deactivate')->name('user deactivate');
Route::get('facilitator/workshop/create', 'FacilitatorController@showCreateWorkshop');
Route::post('facilitator/workshop/create', 'FacilitatorController@createWorkshop');

//Participant
Route::get('participant/home', 'ParticipantController@index');
Route::post('participant/update', 'ParticipantController@update')->name('user update');
Route::get('participant/view', 'ParticipantController@showUpdate');
Route::get('participant/workshop/join/{key}', 'ParticipantController@joinWorkshop');

// TEST ROUTE 
Route::get('participant/test', function(){
    event(new NewCard('hello world'));
    return 'even has been sent';
});
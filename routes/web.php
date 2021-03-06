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



Route::pattern('id', '[0-9]+'); //executed if {id} is numeric

Route::get('/', function () {
    return view('welcome');
});
Route::get('/404', function () {
    return view('errors.404');
});
Route::get('/403', function () {
    return view('errors.403')->with('message',Session::get('message'));
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
Route::get('facilitator/workshop/close/{key}','FacilitatorController@closeWorkshop');
Route::get('facilitator/workshop/end/{key}','FacilitatorController@endWorkshop');
Route::get('facilitator/workshop/{key}','FacilitatorController@showWorkshop');
Route::get('facilitator/workshop/{key}/launch','FacilitatorController@launchWorkshop');
Route::get('facilitator/workshop/{key}/results','FacilitatorController@displayResults');
Route::post('facilitator/workshop/{id}/createGroups','FacilitatorController@createGroups');

//Participant
Route::get('participant/home', 'ParticipantController@index');
Route::post('participant/update', 'ParticipantController@update')->name('user update');
Route::get('participant/view', 'ParticipantController@showUpdate');

//Workshop
Route::get('/workshop', 'ParticipantController@joinWorkshop');
Route::get('/workshop/{key}', 'ParticipantController@showWorkshop');
Route::get('/workshop/{key}/submitCard', 'ParticipantController@submitCard');
Route::get('/workshop/{key}/card/submit','ParticipantController@submitCard');
Route::get('/workshop/{key}/scoring','ParticipantController@showScore');
Route::get('/workshop/{key}/score/{score_id}','ParticipantController@setScore');
Route::get('/workshop/{key}/wait','ParticipantController@showWait');

//Group
Route::get('workshop/{key}/group','ParticipantController@showGroups');
Route::get('workshop/{key}/group/wait','ParticipantController@showWaitGroups');
Route::get('workshop/{key}/group/{id}','ParticipantController@showGroup');
Route::get('workshop/{key}/group/join/{id}','ParticipantController@joinGroup');
Route::get('workshop/{key}/group/leave/{id}','ParticipantController@leaveGroup');
Route::get('/facilitator/workshop/{id}/groupAdmin','FacilitatorController@showGroup');
Route::get('/facilitator/workshop/{wid}/{gid}/kick/{pid}','FacilitatorController@kickGroup');




// Testing methods
// Route::get('/test/{id}','ParticipantController@generateScoringSystem');
// Route::get('/sami','ParticipantController@sami');
// Route::get('haha',function(){broadcast(new App\Events\FinishRounds('FVOhILL'));});
Route::get('haha',function(){
    return App\Score::fillMissing(1);
});
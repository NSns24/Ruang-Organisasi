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

Route::get('/', function () {
    return view('landingPage.index');
});

Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
Route::resource('user', 'UserController');

Route::group(['middleware' => ['login']], function() {
    Route::resource('project', 'ProjectController');
});

Route::post('project/update_progress', 'ProjectController@updateProgress');
Route::post('project/new_member', 'ProjectController@newMember');

Route::get('chat', function () {
    return view('chat.index');
});

Route::get('meeting', function () {
    return view('meeting.index');
});

Route::get('calender', function () {
    return view('calender.index');
});

Route::get('/jobs', function () {
    return view('jobs.index');
});

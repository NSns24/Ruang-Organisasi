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

Route::get('/', function() {
    return view('landingPage.index');
});

Route::get('about-us', function() {
    return view('layout.aboutus');
});

Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
Route::post('user', 'UserController@store');

Route::group(['middleware' => 'login'], function() {
	Route::get('meeting', function() {
		return view('meeting.index');
	});
	Route::resource('project', 'ProjectController');
	Route::post('project/update_progress', 'ProjectController@updateProgress');
	Route::post('project/new_member', 'ProjectController@newMember');
	Route::post('project/invitation', 'ProjectController@invitation');
	Route::post('project/delete_invitation', 'ProjectController@deleteInvitation');
	Route::get('chat/{id}', 'ChatController@index');
	Route::post('chat/send_message_group', 'ChatController@sendMessageGroup');
	Route::post('chat/get_message_personal', 'ChatController@getMessagePersonal');
	Route::post('chat/send_message_personal', 'ChatController@sendMessagePersonal');
	Route::get('jobs/{id}', 'JobController@index');
	Route::post('jobs/store', 'JobController@store');
	Route::post('jobs/change_schedule', 'JobController@changeSchedule');
	Route::post('jobs/delete_job', 'JobController@deleteJob');
	Route::get('project/delete_project/{id}', 'ProjectController@deleteProject');
});

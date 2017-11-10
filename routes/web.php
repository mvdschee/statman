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
	$title = 'Home';

	if(!session('check')){
		$message = '';
	}
	else{
		$message = session('check');
	}
    return view('home', compact('message', 'title'));
});

Route::get('/home', function () {
	return redirect('/');
});

Route::get('/privacy', function () {
	$title = 'Privacy';
	return view('privacy', compact('title'));
});

Route::get('/dashboard/{project_id}/get-page', 'DashboardController@getSocialMedia');
Route::post('/dashboard/delete-page', 'DashboardController@deleteProject');
Route::post('/dashboard/{project_id}/save-story', 'DashboardController@saveStory');

Route::get('/create-story', 'CreateStoryController@index')->middleware('auth')->name('create-story');
Route::post('/create-story', 'CreateStoryController@store')->middleware('auth')->name('create-story');

Route::get('/story-list', 'ListStoriesController@index')->middleware('auth')->name('story-list');
Route::post('/story-list', 'ListStoriesController@options')->middleware('auth')->name('story-list');
Route::post('/story-list/favorite', 'ListStoriesController@favoriteProject')->middleware('auth')->name('favoriteProject');

Route::get('/add-user', 'AddUserController@index')->middleware('auth')->name('add-user');
Route::post('/add-user', 'AddUserController@sendInvite')->middleware('auth')->name('add-user');

Route::get('/dashboard', 'DashboardController@noArgument')->middleware('auth')->name('dashboard');
Route::get('/dashboard/{project_id}', 'DashboardController@index')->middleware('auth')->name('dashboard');

Route::get('/invited/{token}', 'InvitedController@index')->middleware('auth')->name('invited');

Route::get('/add-service/{project_id}/', 'AddServiceController@index')->middleware('auth')->name('add-service');
Route::post('/add-service/save-page', 'AddServiceController@savePage')->middleware('auth')->name('add-service');

Route::get('/settings', 'SettingsController@index')->middleware('auth')->name('settings');
Route::post('/settings', 'SettingsController@updateProfile')->middleware('auth')->name('settings');

Auth::routes();

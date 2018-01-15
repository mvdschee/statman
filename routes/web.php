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
	return view('frontpages.home', compact('message', 'title'));
});

Route::get('/home', function () {
	return redirect('/');
});

Route::get('/privacy', function () {
	$title = 'Privacy';
	return view('frontpages.privacy', compact('title'));
});

Route::get('/dashboard/{project_id}/get-page', 'DashboardController@getSocialMedia')->middleware('auth', 'verified')->name('get-social-media');
Route::post('/dashboard/delete-page', 'DashboardController@deleteProject')->middleware('auth', 'verified')->name('delete-page');
Route::post('/dashboard/{project_id}/save-story', 'DashboardController@saveStory')->middleware('auth', 'verified')->name('save-story');
Route::get('/dashboard/{project_id}/instagram', 'InstagramController@getPosts')->middleware('auth', 'verified')->name('get-posts-instagram');

Route::get('/create-story', 'CreateStoryController@index')->middleware('auth', 'verified')->name('create-story');
Route::post('/create-story', 'CreateStoryController@store')->middleware('auth', 'verified')->name('create-story');

Route::get('/story-list', 'ListStoriesController@index')->middleware('auth', 'verified')->name('story-list');
Route::post('/story-list', 'ListStoriesController@options')->middleware('auth', 'verified')->name('story-list');
Route::post('/story-list/favorite', 'ListStoriesController@favoriteProject')->middleware('auth', 'verified')->name('favoriteProject');

Route::get('/{project}/instagram', 'InstagramController@index')->middleware('auth', 'verified')->name('story-list');
Route::get('/code', 'InstagramController@home')->middleware('auth', 'verified')->name('story-list');
Route::get('/token/{code}', 'InstagramController@token')->middleware('auth', 'verified')->name('story-list');


Route::post('/delete-service', 'Dashboards\ProjectsController@deleteService')->middleware('auth', 'verified')->name('story-list');


Route::get('/add-user', 'AddUserController@index')->middleware('auth', 'verified')->name('add-user');
Route::post('/add-user', 'AddUserController@sendInvite')->middleware('auth', 'verified')->name('add-user');

Route::get('/dashboard', 'DashboardController@noArgument')->middleware('auth', 'verified')->name('dashboard');
Route::get('/dashboard/{project_id}', 'DashboardController@index')->middleware('auth', 'verified')->name('dashboard');

Route::get('/invited/{token}', 'InvitedController@index')->middleware('auth', 'verified')->name('invited');

Route::get('/add-service/{project_id}/', 'AddServiceController@index')->middleware('auth', 'verified')->name('add-service');
Route::post('/add-service/save-page', 'AddServiceController@savePage')->middleware('auth', 'verified')->name('add-service');

Route::get('/settings', 'SettingsController@index')->middleware('auth', 'verified')->name('settings');
Route::post('/settings', 'SettingsController@updateProfile')->middleware('auth', 'verified')->name('settings');

Route::get('/storysettings/{id}', 'Dashboards\ProjectsController@SettingsIndex')->middleware('auth', 'verified')->name('settings');
Route::post('/delete-from-project', 'Dashboards\ProjectsController@DeleteUserFromProject')->middleware('auth', 'verified')->name('settings');



Route::get('/verify', 'VerifyController@index')->middleware('auth')->name('verify');
Route::post('/verify', 'VerifyController@verify')->middleware('auth')->name('verify');
Route::get('/getnewtoken', 'VerifyController@NewToken')->middleware('auth')->name('NewToken');

Auth::routes();

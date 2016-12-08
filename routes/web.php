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
    return view('home');
    
});

Route::get('/home', function () {
    return view('home'); 
});

Auth::routes();

Route::get('/create-project', 'CreateProjectController@index');
Route::get('/dashboard', 'DashboardController@index');

/*

Route::get('/create-project', function () {
    return view('/create-project'); 
});
Route::get('admin',function(){
	echo 'You have acces';
})->middleware('admin');

Route::get('customer/{id}', function($id) {
	//$customer = App\Customer::first();
	$customer = App\Customer::find($id);
	echo $customer->name;

});
*/





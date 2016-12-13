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

Route::get('/chartjs', function () {
    return view('chartjs');
});

Auth::routes();

Route::get('/create-project', 'CreateProjectController@index')->name('create-project');
Route::post('/create-project', 'CreateProjectController@store');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/options', 'DashboardController@options');

Route::get('/feed/{param}','FacebookController@index');
Route::get('/feed','FacebookController@index');


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





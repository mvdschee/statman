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
Route::post('/create-project', 'CreateProjectController@store');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/options', 'DashboardController@options');

<<<<<<< HEAD
Route::get('/feed/{param}','Facebook@index');
Route::get('/feed','Facebook@index');

Route::get('/chartjs', function () {
    return view('chartjs');
});
=======
>>>>>>> 2adf3dc6667cddce0c4feda6279a9e55f021d182

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





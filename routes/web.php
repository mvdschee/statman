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
//Route::get('/home', 'HomeController@index');

Route::get('/home', function () {
    return view('home');

    
});

Route::get('admin',function(){
	echo 'You have acces';
})->middleware('admin');

Route::get('customer/{id}', function($id) {
	//$customer = App\Customer::first();
	$customer = App\Customer::find($id);
	echo $customer->name;

});

/*Route::get('customer/{$id}', function($id) {
	$customer = App\Customer::find($id);
	//$customer = App\Customer::find($id);
	echo $customer->id;
	echo $customer->name;

	echo '<ul>';
	foreach($customer->orders as $order){
		echo '<li>' . $order->name . '</li>';
	}
	echo '</ul>';
});
*/

//Route::get('customer/{$id}', 'CustomerController@customer');

Route::get('customer_name', function() {
	$customer = App\Customer::where('name', '=', 'jeffrey')->first();
	echo $customer->id;
	echo $customer->name;
});

Route::get('orders', function() {
	$orders = App\Order::all();
	foreach($orders as $order){
		//$customer = App\Customer::find($order->customer_id);
		echo $order->name .' Belongs to ' . $order->customer->name . '<br>';
	}
});

Route::get('mypage', function() {
	$data = array(
		'title' => 'Home',
		'subtitle' => 'Yeahh',
		'food' => 'hamburger',
		'orders' => App\Order::all()
	);

	return view('mypage', $data);
});

Auth::routes();



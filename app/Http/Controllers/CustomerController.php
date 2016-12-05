<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
	//In de controller schrijf je al je php code: Pagina functies etc. 
	public function($id){
	    $customer = Customer::find($id);
		//return view('customer', array ('customer'=> $customer));
		return view('customer', compact('customer'));
	}
}

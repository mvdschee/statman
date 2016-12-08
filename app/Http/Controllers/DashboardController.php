<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index(){
    	return view('dashboard');
    }

    public function options(){
    	return view('options');
    }
}

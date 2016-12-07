<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateProjectController extends Controller
{
        public function index(){
    	return view('create-project');
    }
}

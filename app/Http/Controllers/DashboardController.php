<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
    	$id = Auth::id();
        if ($id) {
            $project = DB::table('projects')->where('user_id', $id)->first();
            if (!$project) {
                return view('create-project');
            }
            else{
                return view('dashboard');
            }
        }
    	else{
            return view('auth.login');
        }
    }

    public function options(){
    	return view('options');
    }
}

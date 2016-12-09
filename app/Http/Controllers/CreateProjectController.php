<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CreateProjectController extends Controller
{
    public function index(){
    	$id = Auth::id();
    	if ($id) {
    		$project = DB::table('projects')->where('user_id', $id)->first();
	    	if (!$project) {
	    		return view('create-project');
	    	}
	    	else{
	    		return redirect('dashboard');
	    	}
    	}
    	else{
    		return redirect('home');
    	}
    	
    }

    public function store(Request $request){
    	$project = new Project;
	    $project->name = $request->name;
	    $project->sm_id = "1";
	    $project->user_id = Auth::id();
	    $project->save(); 
	    return redirect('/dashboard');
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Project;
use App\UserAccess;
use App\Story;
use Auth;

class CreateStoryController extends Controller
{
	public function index()
	{
		return view('dashboards.create-story');
	}

	public function store(Request $request)
	{
		$name = encrypt($request->name);
		$user = Auth::user();
		$user_id = Auth::user()->id;

		$story = new Story;
		$story->story = null;
		$story->save();

		$project = new Project;
		$project->project_name = $name;
		$project->story_id = $story->id;
		$project->save();

		$project = Project::where('project_name', $name)->first();
		$project_id = $project->id;

		$useraccess = new UserAccess;
		$useraccess->user_id = $user_id;
		$useraccess->role_index_id = 1;
		$useraccess->project_id = $project_id;
		$useraccess->save();

		if(!$user->favorite){
			$user->favorite = $project->id;
		}

		return redirect('/dashboard/'.$project->id);
	}
}

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
		return view('create-story');
	}

	public function store(Request $request)
	{
		$user = Auth::user();
		$user_id = Auth::user()->id;

		$story = new Story;
		$story->story = null;
		$story->save();

		$name = encrypt($request->name);
		$project = new Project;
		$project->project_name = $name;
		$project->story_id = $story->id;
		$project->save();

		$project = Project::where('project_name', $name)->first();
		$project_id = $project->id;

		$userAccess = new UserAccess;
		$userAccess->new(array('user_id' => $user_id,'role_index_id' =>  0,'project_id' =>  $project_id));

		if(!$user->favorite){
			$user->favorite = $project->id;
		}

		return redirect('/dashboard/'.$project->id);
	}
}

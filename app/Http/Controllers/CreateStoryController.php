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
		$name = encrypt($request->name);
		$user = Auth::user();
		$user_id = Auth::user()->id;

		$story = new Story;
		$story->setStoryData($story);

		$project = new Project;
		$project = $project->setProjectData($project, $name, $story->id);
		$project = Project::where('project_name', $name)->first();

		$useraccess = new UserAccess;
		$useraccess = $useraccess->setUserAccessData($useraccess, $user_id, 1, $project->id);

		return redirect('/dashboard/'.$project->id);
	}
}
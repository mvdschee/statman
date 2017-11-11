<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Service;
use App\UserAccess;
use App\InviteToken;
use App\Story;
use Auth;

class DashboardController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index($project_id)
    {
        if ($project_id == 'null') {
            $message = 'You must first create or join a story.';
            return redirect('/story-list')->with('check', $message);
        }
        else{
            //looks up the story from the url in the database
            $project = Project::where('id', $project_id)->first();

            //if the story does not exist, return to story list and give error
            if ($project == null) {
                $message = 'You have no access to this story or it does not exist.';
                return redirect('/story-list')->with('check', $message);
            }

            //Gets all the services with the project id from the previous query
            $pages = Service::where('project_id', $project->id)->get();

            //decrypt the story name
            $project->project_name = decrypt($project->project_name);

            //looks up user in database
            $user = Auth::user();

            //checks if the user has access to the story, returns to story list if not
            $access = UserAccess::where([
                        ['project_id', '=', $project_id],
                        ['user_id', '=', $user->id]
                    ])->first();

            if ($access == null) {
                $message = 'You have no access to this story or it does not exist.';
                return redirect('/story-list')->with('check', $message);
            }

            $pageData = array();

            foreach ($pages as $page) {
              array_push ($pageData, decrypt($page['service_page_name']));
            }

            $token = $this->getToken($project_id);
            $message = '';

            return view('dashboard', compact('project', 'access', 'pageData', 'token', 'message'));
        }
    }

    public function getToken($project_id)
    {
        $token = "";
        $service = Service::where('project_id', $project_id)->first();
        if ($service) {
            $token = decrypt($service->service_token);
        }
        return $token;
    }

    public function getSocialMedia($project_id)
    {
        $user = Auth::id();
        $access = UserAccess::where([
                ['project_id', '=', $project_id],
                ['user_id', '=', $user]
            ])->first();

        if ($access == null) {
            $token = '';
            $name = '';
        }
        else{
            $token = "";
            $service = Service::where('project_id', $project_id)->first();
            if ($service) {
                $token = decrypt($service->service_token);
                $name = decrypt($service->service_page_name);
            }
            $project = Project::where('id', $project_id)->first();
            $story = Story::where('id', $project->story_id)->first();
            $story_world = $story->story;
        }

        return response()->json(['token' => $token, 'name' => $name, 'story' => $story_world]);
    }

    public function saveStory(Request $request)
    {
        $project = Project::where('id', $request->project)->first();
        $story = Story::where('id', $project->story_id)->first();
        $story->story = $request->storyJSON;
        $story->save();

        return response()->json(['message' => "success"]);
    }

    //deletes selected project and all connected accesses and services
    public function deleteProject(Request $request)
    {
        $project = $request->project;
        $user = Auth::user();

        $services = Service::where('project_id', $project)->get();
        foreach ($services as $service) {
            $service->delete();
        }

        $invites = InviteToken::where('project_id', $project)->get();
        foreach ($invites as $invite) {
            $invite->delete();
        }

        if($user->favorite == $project){
            $user->favorite = null;
            $user->save();
        }

        $access = UserAccess::where('project_id', $project)->get();
        foreach ($access as $access) {
            $access->delete();
        }

        $project_id = $project;
        $project = Project::where('id', $project_id)->first();
        $project->delete();

        $check = 'Your story has been deleted.';
        return redirect('/story-list')->with('check', $check);
    }

    public function noArgument()
    {
        return redirect('/dashboard/null');
    }
}

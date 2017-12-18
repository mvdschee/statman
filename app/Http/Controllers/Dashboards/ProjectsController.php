<?php

namespace App\Http\Controllers\Dashboards;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use Auth;
use App\User;
use App\InviteToken;
use App\UserAccess;
use App\Service;
use Illuminate\Support\Facades\Crypt;

class ProjectsController extends Controller
{
    public function SettingsIndex($project_id = '')
    {
      //Get the user info, name and decrypts it
		$user = Auth::user();

      //Gets the access of the user on different prjoects and his/her role
		$userAccess = UserAccess::where('user_id', $user->id)->get();

      //Gets the full name of the user
		$user->fullname = decrypt($user->name);

      //Gets the projects data
      $project = Project::where('story_id', $project_id)->get();

      //Finds all users connected to the project
      $users = UserAccess::where('project_id', $project_id)->get();


      $i = 0;
      $invites = InviteToken::where('project_id', $project_id)->get();
      $data['project'] = $project;
      $i = 0;

      //assigns all the users in an array
      foreach($users as $useraccess){
         $data['access'][$i] = $useraccess;
         $i++;
      }

      $i = 0;
      foreach($users as $projectusers){
         $userdata = User::where('id', $projectusers->user_id)->first();
         $data['access'][$i]['name'] = decrypt($userdata->name);
         $i++;
      }
      foreach($users as $projectusers){
      }

      //Finds all connected social media services
      $pages = Service::where('project_id', $project_id)->get();

      $data['pages'] = $pages;
      $data['invites'] = $invites;
      $data['project_id'] = $project_id;
      return view('dashboards/project-settings')->with('data', $data)->with('user', $user);
    }

    public function DeleteUserFromProject(Request $request){
      $project = $request->option;
      $user = Auth::user();
      $access = UserAccess::where('user_id', $user->id)->where('project_id', $project)->first();
      // dd($access);
      $deleted_user = UserAccess::where('user_id', $request->user)->where('project_id', $project)->first();
      $deleted_user_data = User::where('id', $request->user)->first();
      $count_users_on_project = UserAccess::where('project_id', $project)->count();
      if($access->role_index_id == 1){
         if($count_users_on_project <=1){
            return "you are the last user on this project. If this project ended, please delete it.";
         }
         if($user->id == $deleted_user->id){
            return "you cannot delete yourself dickhead.";
         } else {
            $deleted_user->delete();
            return "Deleted " . decrypt($deleted_user_data->name);
         }
      } else {
         return "fuck off m8 you shouldn't have that option, stop trying to break my shit";
      }
   }
}

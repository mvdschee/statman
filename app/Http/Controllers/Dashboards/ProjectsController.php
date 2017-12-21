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
      $user->name = $user->name;

      //Gets the access of the user on different projects and his/her role
		$userAccess = UserAccess::where('user_id', $user->id)->get();
      $continue = false;
      foreach($userAccess as $access){
         if($access->project_id == $project_id){
            $continue = true;
         } elseif($access->project_id !== $project_id && $continue == false){
            return redirect(env('APP_URL') . '/story-list')->withErrors(['You do not have access to this project']);
         }
      }

      //Gets the full name of the user
		$user->fullname = decrypt($user->name);

      //Gets the projects data
      $project = Project::where('story_id', $project_id)->first();

      //Finds all users connected to the project
      $users = UserAccess::where('project_id', $project_id)->get();


      $i = 0;
      $invites = InviteToken::where('project_id', $project_id)->get();
      $data['project'] = $project;
      $data['project']['project_name'] = decrypt($project['project_name']);
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

      //Finds all connected social media services
      $pages = Service::where('project_id', $project_id)->get();
      $i = 0;
      foreach($pages as $page){
         $page->service_page_name = decrypt($page->service_page_name);
         $pages[$i] = $page;
         $i++;
      }

      $data['pages'] = $pages;
      $data['invites'] = $invites;
      $i = 0;
      foreach($invites as $invite){
         $email = $invite['invited_email'];
         $checkuser = User::where('email', $email)->first();
         if(!empty($checkuser['id'])){
            $data['invites'][$i]['status'] = 1;
         } else {
            $data['invites'][$i]['status'] = 0;
         }
         $i++;
      }
      $data['project_id'] = $project_id;
      return view('dashboards/project-settings')->with('data', $data)->with('user', $user);
    }

    public function DeleteUserFromProject(Request $request){
      $project = $request->option;
      $user = Auth::user();
      $access = UserAccess::where('user_id', $user->id)->where('project_id', $project)->first();
      $deleted_user = UserAccess::where('user_id', $request->user)->where('project_id', $project)->first();
      $deleted_user_data = User::where('id', $request->user)->first();
      $count_users_on_project = UserAccess::where('project_id', $project)->count();
      if($access->role_index_id == 1){
         if($count_users_on_project <=1){
            return redirect()->back()->withErrors(['you are the last user on this project. If this project ended, please delete it.']);
         } else {
            $deleted_user->delete();
            return redirect()->back()->withErrors(['Deleted: '. decrypt($deleted_user_data->name)]);
         }
      } else {
         return redirect()->back()->withErrors(['You have no access to this function.']);
      }
   }

   public function deleteService(Request $request){
      $data['project'] = $request->option;
      $data['id'] = $request->id;

      $user = Auth::user();
      $access = UserAccess::where('user_id', $user->id)->where('project_id', $data['project'])->first();

      if(!empty($user) && !empty($access)){
         if($access->role_index_id == 1){
            $service = Service::where('id', $data['id'])->where('project_id', $data['project'])->first();
            $service->delete();
            return redirect()->back()->withErrors(['Deleted service.']);
         } else {
            return redirect()->back()->withErrors(['You do not have access to this function']);
         }
         return redirect()->back()->withErrors(['Something went wrong.']);
      }
   }
}

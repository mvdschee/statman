<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\User;
use App\Project;
use App\Service;
use App\UserAccess;
use App\InviteToken;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ListStoriesController extends Controller
{

	//Gets all user info, user projects and invites and sends it to the view
	public function index()
	{
		//Get the user info, name and decrypts it
		$user = Auth::user();
		$userAccess = UserAccess::where('user_id', $user->id)->get();
		$user->fullname = decrypt($user->name);
		$data = $this->getProjects($userAccess, $user);
		$invites = $this->getInvites($user);

		// dd($data);
		//shows the view
		return view('story-list', compact('user', 'data', 'invites'));

	}

	public function getProjects($userAccess, $user)
	{
		//creates arrays to use in the table
		$data = array();
		$project_users = array();
		//gets all user projects and puts into array
		$i = 0;
		foreach ($userAccess as $access) {
			$project = Project::all();
			// dd($project[$i]);
			//decrypts project name
			$project->project_name = decrypt($project[$i]->project_name);

			//gets all project users
			$ii = 0;
			$project_users_index = UserAccess::where('project_id', $access->project_id)->get();
			foreach ($project_users_index as $project_user) {
				//gets individual users
				$single_user = User::where('id', $project_user->user_id)->get();
				$single_user = $single_user[0];

				//gets and decrypts user name
				$username = decrypt($single_user->name);

				//puts it all in an array
				$project_users[$ii] = array(
					'user_id' => $project_user->user_id,
					'user_name' => $username,
					'project_id' => $access->project_id
				);
				$ii++;

			}

			//translates role id to name of role
			switch ($access->role_index_id) {
				case '1':
					$user->role_index_id = 'Owner';
					break;

				case '2':
					$user->role_index_id = 'Writer';
					break;

				case '3':
					$user->role_index_id = 'Reader';
					break;

				default:
					$user->role_index_id = 'None';
					break;
			}

			//puts all data in array to use in view
			$data[$i] = array(
				'project_name' => $project->project_name,
				'project_id' => $access->project_id,
				'role' => $user->role_index_id,
				'users' => $project_users
			);
			// dd($project->project_name);
			$i++;
		}
		return $data;
	}

	//gets all invites to the current user
	public function getInvites($user)
	{
		$invites = InviteToken::where('invited_email', $user->email)->get();
		$invite_list = array();
		$invite_row = array();

		foreach ($invites as $invite) {
			$project = Project::where('id', $invite->project_id)->first();
			$project_name = decrypt($project->project_name);
			$invite_row['project_name'] = $project_name;
			$invite_row['token'] = $invite->token;
			array_push($invite_list, $invite_row);
		}

		return $invite_list;
	}

	public function options(Request $request)
	{
		$project = $request->option;

		//looks up user in database
        $user = Auth::user();

        //checks if the user has access to the story, returns to story list if not
        $access = UserAccess::where([
                    ['project_id', '=', $project],
                    ['user_id', '=', $user->id]
                ])->first();

		if ($access) {
			return view('add-user', compact('project'));
		}else{
			$message = 'You do not have the rights to invite someone to this story.';
            return redirect('/story-list')->with('check', $message);
		}

	}

	//puts the project id in the favorite field in the database
	public function favoriteProject(Request $request)
	{
		$user = Auth::user();

		if ($user->favorite == $request->project) {
			$user->favorite = null;
			$user->save();
		}
		else{
			$user->favorite = $request->project;
			$user->save();
		}

    	return redirect('/story-list');
	}
}

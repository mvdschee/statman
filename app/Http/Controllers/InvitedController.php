<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InviteToken;
use App\UserAccess;
use Auth;

class InvitedController extends Controller
{
    public function index($token)
    {
    	//takes the current user
    	$user = Auth::user();

    	//checks the token for the info it contains
      $token_check = $this->tokenCheck($token, $user);

    	//requests the useraccess to see the users of the project
    	$user_accounts = UserAccess::where('project_id', $token_check->project_id)->get();

    	//adds all current users of the project to an easy-to-use array
		$project_users = array();
    	foreach ($user_accounts as $access) {
    		array_push($project_users, $access['user_id']);
    	}

    	//checks if the current user is already added to the project
    	//if so, they can't be added, if not, they will be added
    	$user_check = in_array($user->id, $project_users);
    	if ($user_check) {
            $token_check->delete();

            $check = 'You have already joined this project.';
    		return redirect('/story-list')->with('check', $check);
    	}
    	else{
         // add user to useraccess
    		$this->saveUser($token_check, $user);
            $token_check->delete();

            $check = 'You have successfully been added.';
    		return redirect('/story-list')->with('check', $check);
    	}
    }

    public function tokenCheck($token, $user){
      //   Checks token
     $token_check = InviteToken::where([
                        ['token', '=', $token],
                        ['invited_email', '=', $user->email]
                    ])->first();

   //   token may not be empty
     if ($token_check == null) {
         $check = 'This invite is not valid for you.';
         return redirect('/story-list')->with('check', $check);
     }

   //   token must have a project id attached
     if ($token_check->project_id == null) {
         $check = 'It looks like something went wrong. Please try again later.';
         return redirect('/story-list')->with('check', $check);
     }

     return $token_check;
   }

    public function saveUser($token_check, $user){
        $access = New UserAccess($user->id, $token_check->role_index_id, $token_check->project_id);
    }
}

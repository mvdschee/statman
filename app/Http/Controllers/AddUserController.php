<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\Project;
use App\InviteToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class AddUserController extends Controller
{

    public function index()
    {
    	return view('dashboards.add-user');
    }

    public function sendInvite(Request $request)
    {
		$user = Auth::user();
		$user->send_email = $request->email;
		$user->project_id = $request->project;
		$user->project_name = '';

		$project = Project::where('id', $user->project_id)->get();
		$project = $project['0'];

		$user->project_name = decrypt($project->project_name);
		$user->invite_token = str_random(64);

		$user->role_name = $this->getRoleById($user->role_id);

		Mail::send('emails.invite', ['user' => $user], function ($m) use ($user) {
            $m->from(env('MAIL_FROM'), env('MAIL_NAME'));
            $m->to($user->send_email, $user->firstname)->subject('Je bent uitgenodigd voor '.$user->project_name.'!');
        });

        $token = New InviteToken;
        $token->token = $user->invite_token;
        $token->role_index_id = $request->role;
        $token->project_id = $user->project_id;
        $token->invited_email = hash('sha256', $user->send_email);
        $token->save();

        $data = '';

        return redirect('/story-list');
    }

    public function getRoleById($id)
    {
    	switch ($id) {
			case '1':
				$role_name = 'Owner';
				break;

			case '2':
				$role_name = 'Writer';
				break;

			case '3':
				$role_name = 'Reader';
				break;

			default:
				$role_name = 'None';
				break;
		}
    	return $role_name;
    }
}

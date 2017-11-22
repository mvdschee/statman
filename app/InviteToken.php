<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InviteToken extends Model
{
    protected $table = 'invite_tokens';

    /**
    * primary id to select assets.
    *
    * @var object
    */
    public $primarykey = 'id';

    protected function addInviteTokenData(InviteToken $token, User $user, $role) {
    	$token->token = $user->invite_token;
        $token->project_id = $user->project_id;
        $token->invited_email = hash('sha256', $user->send_email);

        $token->role_index_id = $role;
        $token->save();

        return $token;
    }
}

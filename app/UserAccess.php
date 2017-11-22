<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    protected $table = 'users_access';

    /**
    * primary id to select assets.
    *
    * @var object
    */
    public $primarykey = 'id';

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $fillable = [
        'user_id', 'role_index_id', 'project_id',
    ];

    public function setUserAccessData(UserAccess $useraccess, $user_id, $role_index_id, $project_id) {
        $useraccess->user_id = $user_id;
        $useraccess->role_index_id = $role_index_id;
        $useraccess->project_id = $project_id;
        $useraccess->save();

        return $useraccess;
    }
}

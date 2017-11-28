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
    public $primarykey;
    public $user_id;
    public $role_index_id;
    public $project_id;
    public function new(array $attributes)
    {
      $newAccess = new UserAccess;
      if(!empty($attributes['user_id'])){
         $newAccess->user_id = $attributes['user_id'];
      } else {
         return 'No user id defined, contact a developer to report this issue';
         ;
      }
      if(!empty($attributes['role_index_id'])){
         $newAccess->role_index_id = $attributes['role_index_id'];
      } else {
         // if no role index is defined, user role index = 1
         $newAccess->role_index_id = 9;
      }
      if(!empty($attributes['project_id'])){
         $newAccess->project_id = $attributes['project_id'];
      } else {
         dd("undefined project_id");
      }
      // dd($attributes);
      return UserAccess::create(['user_id' => $newAccess->user_id, 'role_index_id' => $newAccess->role_index_id, 'project_id' => $newAccess->project_id,]);
    }

    public function setUserId($id)
    {
      if(!empty($id)){
         $this->user_id = $id;
         $this->save();
      } else {
         return false;
      }
    }

    public function setRoleIndexId($index)
    {
      if(!empty($index)){
         $this->role_index_id = $index;
         $this->save();
      } else {
         return false;
      }
    }

    public function setProjectId($project_id)
    {

      if(!empty($project_id)){
         $this->project_id = $project_id;
         $this->save();
      } else {
         return false;
      }
    }

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $fillable = [
        'user_id', 'role_index_id', 'project_id',
    ];
}

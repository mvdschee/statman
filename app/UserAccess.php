<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\Story;


class UserAccess extends Model
{
    protected $table = 'users_access';

    /**
    * primary id to select assets.
    *
    * @var object
    */
    public $primarykey;
    private $user_id;
    private $role_index_id;
    private $project_id;

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
         $newAccess->role_index_id = 1;
      }
      if(!empty($attributes['project_id'])){
         $newAccess->project_id = $attributes['project_id'];
      } else {
         dd("undefined project_id");
      }
      // dd($attributes);
      return UserAccess::create(['user_id' => $newAccess->user_id, 'role_index_id' => $newAccess->role_index_id, 'project_id' => $newAccess->project_id,]);
    }

    public function getProjectId(UserAccess $access){
      $access = UserAccess::find($access->id);
      $project_id = $access->project_id;

      return $access;
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

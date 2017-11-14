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
    public $user_id;
    public $role_index_id;
    public $project_id;

    public function __construct($id, $index, $project_id)
    {
      if(!empty($id)){
         $this->user_id = $id;
      }
      if(!empty($index)){
         $this->role_index_id = $index;
      }
      if(!empty($project_id)){
         $this->project_id = $project_id;
      }
      $this->save();
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

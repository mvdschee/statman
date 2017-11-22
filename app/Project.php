<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    /**
    * primary id to select assets.
    *
    * @var object
    */
    public $primarykey = 'id';

    public function setProjectData(Project $project, $project_name, $story_id) {
		$project->project_name = $project_name;
		$project->story_id = $story_id;

		$project->save();

		return $project;
	}	
}
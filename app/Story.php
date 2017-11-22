<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
	public function setStoryData(Story $story) {
		$story->story = null;
		$story->save();

		return $story;
	}
}

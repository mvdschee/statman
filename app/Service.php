<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

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
        'service_index', 'project_id', 'service_token', 'service_page_name',
    ];
}

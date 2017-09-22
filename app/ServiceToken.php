<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceToken extends Model
{
    protected $table = 'service_token';

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
        'service_token',
    ];
}

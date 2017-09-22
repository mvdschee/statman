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
}

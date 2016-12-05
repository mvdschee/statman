<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer(){
    	return $this->BelongsTo('App\Customer');
    }
}

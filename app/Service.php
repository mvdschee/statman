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

    //set service data, returns service
    public function setService(Service $service, $requestData) {
        $service->service_index = $requestData->service_index;
        $service->project_id = $requestData->project_id;
        $service->service_token = encrypt($requestData->service_token);
        $service->service_page_name = encrypt($requestData->name);
        $service->save();

        return $service;
    }
}

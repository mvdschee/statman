<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class AddServiceController extends Controller
{
    public function index($project_id)
    {
    	return view('add-service', compact('project_id'));
    }

    public function savePage(Request $request)
    {
    	//Make new service
        $service = New Service;

        //set and save project_id, project_index, service_token and service_page_name
        $service = $service->setService($service, $request);

    	$check = 'You have successfully added page '.$service->service_page_name.' to your story.';
    	return redirect('/dashboard/'.$service->project_id)->with('message', $check);
    }
}
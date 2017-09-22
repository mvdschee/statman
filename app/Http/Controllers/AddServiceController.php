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
    	$service = New Service;
    	$service->service_index = $request->service_index;
    	$service->project_id = $request->project_id;
    	$service->service_token = encrypt($request->service_token);
    	$service->service_page_name = encrypt($request->name);
    	$service->save();

    	$check = 'You have successfully added page '.$request->name.' to your story.';
    	return redirect('/dashboard/'.$request->project_id)->with('message', $check);
    }
}

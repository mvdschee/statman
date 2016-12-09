<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;

use SammyK\FacebookQueryBuilder\FQB;

class Facebook extends Controller
{

	public function __construct(){
		$this->fqb = new FQB;
		//Dit is de oude token, verrschil is dat alleen can_like is true
		//$this->access_token = 'EAACryEAoP3cBALZBLIEh1fnTIi1S96aKbTC3vySm7rtF1BSKTwdV5wEu5q6BZBtMfeq7bYhImzkQnrlxH3xfzK4mbpKm88u0sxN3WYZCsEaLqLGImtwwJFHKagXAxztI3R10dCAn1JvTQZBKXNg946TwNEtocfG6VnqTj78OqgZDZD';

		//188876558188407|ZzgQEzF3SaFI9tyBYiN6RlZ9u1g
		$this->access_token = 'EAACryEAoP3cBAHZBxVqz1a4CdDF1OzcrBLkzKK37CaNp9Fe8WDqienuG8hu6b7mCgJ0E4Xj3ZAzFVh6Qfwbni09jzZAj2L8u4S8nnOtjEtZAaPXVfy1CNnB06ASy6WlPZCV7UyJHhdqGhGLJRfKGMurY2gjvwqjMZD';
		$this->node = '1775886599336178';
	}

	public function index($param = false){
		if(method_exists($this, $param)){
			$data = $this->$param();
			return view('facebook/' . $param, $data);
		}else{
			$data = $this->feed();
			return view('facebook/feed', $data);
		}
	}

	public function feed(){
	    $request = $this->fqb->node("$this->node/feed")
	    			->fields("name,message,shares,comments.summary(true),likes.summary(true)")
	               	->accessToken($this->access_token)
	               	->graphVersion('v2.8');
		$context 	= stream_context_create(['http' => ['ignore_errors' => true]]);
		$response 	= file_get_contents((string) $request, null, $context);
		$data 		= json_decode($response, true);

		return $data;
	}

	public function insights(){
	    $request = $this->fqb->node("$this->node/insights/page_impressions")
	               	->accessToken($this->access_token)
	               	->graphVersion('v2.8')
	               	->modifiers(array('since' => '2016-10-24', 'period' => 'day'));
		$context 	= stream_context_create(['http' => ['ignore_errors' => true]]);
		$response 	= file_get_contents((string) $request, null, $context);
		$data 		= json_decode($response, true);

		return $data;
	}

	public function likes(){
		//get data
	    $request = $this->fqb->node("$this->node/feed")
	    			->fields("likes.summary(true)")
	               	->accessToken($this->access_token)
	               	->graphVersion('v2.8');
		$context 	= stream_context_create(['http' => ['ignore_errors' => true]]);
		$response 	= file_get_contents((string) $request, null, $context);
		$data 		= json_decode($response, true);

        //send data
		return $data;
	}

}
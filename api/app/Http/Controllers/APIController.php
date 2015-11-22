<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as Controller;

class APIController extends BaseController
{
    public function requestHandler($request){
    	$response = array("success" => 1, 
    					  "request" => $request);
    	return Response::json($response);
    }

    public function index($request_name){
    	return response()->view('api')->with($request_name);
    }
}

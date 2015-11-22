<?php

namespace App\Http\APIController;

use Illuminate\Routing\Controller as BaseController;

abstract class APIController extends BaseController
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

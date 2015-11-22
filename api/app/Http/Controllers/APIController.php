<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

abstract class APIController extends BaseController
{
    public function requestHandler($request_name){
    	$response = array("success" => 1, 
    					  "request" => $request_name);
    	return Response::json($response);
    }
    public function index($request_name){
    	return response()->view('api')->with($request_name);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

abstract class APIController extends BaseController
{
    public function requestHandler($request_name){
    	$response = array("success" => 1, 
    					  "request" => "hi");
    	return json_encode($response);
    }
}

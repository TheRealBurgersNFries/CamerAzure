<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

abstract class APIController extends BaseController
{
    public function requestHandler($request_name){
    	return response()->json([
    								"success" => 1,
    								"request" => $request_name
    								]);
    }
}

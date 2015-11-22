<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use Session;
use Illuminate\Support\Facades\Redirect;
use View;
use Nfreear\Cloudsight\Cloudsight_Http_Client;


class API_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestHandler ($request = "")
    {
    	$response = array("success" => 1, 
    					  "request" => $request);
    	return Response::json($response);
    }

    public function image_form_create(){
	return view('image_analysis');
    }

    public function image_form_post(){
	   // getting all of the post data
 	   $file = array('image' => Input::file('image_request'));
	   $rules = array('image' => 'required',);
	   $validator = Validator::make($file, $rules);
	   if ($validator->fails()) {
		   // send back to the page with the input data and errors
		   return Redirect::to('upload')->withInput()->withErrors($validator);
	   }
	   else {
		   // checking file is valid.
		   if (Input::file('image_request')->isValid()) {
			   $destinationPath = 'uploads'; // upload path
			   $extension = Input::file('image_request')->getClientOriginalExtension(); // getting image extension
			   $fileName = rand(11111,99999).'.'.$extension; // renameing image
			   Input::file('image_request')->move($destinationPath, $fileName); // uploading file to given path
			   // sending back with message
			   $api_key = "QjfN3AYDZsxYRgOSx9ldWQ";
			   $image_url = 'http://40.121.87.42/'.$destinationPath.'/'.$fileName;
			   $client = new CloudSight_Http_Client($api_key);

			   $request = $client->postImageRequests($image_url);

			   while (1) {

				   sleep(1);

				   $result = $client->getImageResponses($request->token);

				   // Check if analysis is complete.
				   if ($client->isComplete()) {
					   break;
				   }
			   }

			   $result = array("success" => 1, "description" => $result->name);

				return response()->json($result);		   
}
		   else {
			   // sending back with error message.
			   Session::flash('error', 'uploaded file is not valid');
			   return View::make('welcome');
		   }
	   }
    }
	

    public function beats_post(){
        $results = array();
        $colors = array("black", "blue", "gold", "green", "pink", "red");
       // getting all of the post data
       $file = array('image' => Input::file('image_request'));
       $rules = array('image' => 'required',);
       $validator = Validator::make($file, $rules);
       if ($validator->fails()) {
           // send back to the page with the input data and errors
           return Redirect::to('upload')->withInput()->withErrors($validator);
       }
       else {
           // checking file is valid.
           if (Input::file('image_request')->isValid()) {
               $destinationPath = 'uploads'; // upload path
               $extension = Input::file('image_request')->getClientOriginalExtension(); // getting image extension
               $fileName = rand(11111,99999).'.'.$extension; // renameing image
               Input::file('image_request')->move($destinationPath, $fileName); // uploading file to given path
               // sending back with message
               $api_key = "QjfN3AYDZsxYRgOSx9ldWQ";
               $image_url = 'http://40.121.87.42/'.$destinationPath.'/'.$fileName;
               $client = new CloudSight_Http_Client($api_key);

               $request = $client->postImageRequests($image_url);

               while (1) {

                   sleep(1);

                   $result = $client->getImageResponses($request->token);

                   // Check if analysis is complete.
                   if ($client->isComplete()) {
                       break;
                   }
               }
               
                foreach ($colors as $color){
                    if(strpos($result->name, $color)){
                        array_push($results, $color);
                    }
                }
                $returnarray = array("results" => $results, "search_result" => $result->name);
                return View::make('beats')->with("returnarray", $returnarray);
                          
}
           else {
               // sending back with error message.
               Session::flash('error', 'uploaded file is not valid');
               return View::make('welcome');
           }
       }
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

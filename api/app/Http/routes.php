<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('demo', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('beats', function () {
    return view('welcome');
});

Route::get('api/{request?}', 'API_Controller@requestHandler');

Route::get('image_form_create', 'API_Controller@image_form_create');

Route::post('image_form_post', 'API_Controller@image_form_post');


Route::post('beat_post', 'API_Controller@beats_post');


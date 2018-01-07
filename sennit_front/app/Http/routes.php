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

Route::get('/', function () {

    $password = 'mudar123';
    
    $email = 'fandrade@gmail.com.br';

    $response = \Unirest\Request::get("http://localhost/sennit/sennit_api/public/auth/login?password=$password&email=$email");

    return view('index', ['token' => $response->body->access_token]);
});


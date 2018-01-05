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

#https://rafaell-lycan.com/2016/construindo-restful-api-laravel-parte-3/

Route::get('/', function () {
    return view('index');
});

Route::get('cep/search', 'Cep@listAllCep');
Route::get('cep/search/{cep}', 'Cep@search');
Route::delete('cep/search/{cep}', 'Cep@destroy');


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

Route::get('auth/login', 'AuthController@authenticate');

Route::group(['middleware' => ['auth.token']], function () {
    
    Route::get('cep/search', 'Cep@listAllCep');
    Route::get('cep/search/{cep}', 'Cep@search');
    Route::delete('cep/search/{cep}', 'Cep@destroy');
    
});

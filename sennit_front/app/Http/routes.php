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

Route::get('/', 'Index@home');
Route::get('/cep', 'Index@home');
Route::get('/company', 'Index@company');
Route::get('/logout', 'Auth@logout');
Route::get('/login', 'Auth@login');
Route::get('/authenticate', 'Auth@authenticate');




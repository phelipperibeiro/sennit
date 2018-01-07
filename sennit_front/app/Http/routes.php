<?php

use Illuminate\Http\Request;
use App\Http\Requests;

if (!isset($_SESSION)) {
    session_start();
}

Route::get('/', function (Request $request) {

//    if (!isset($_SESSION['token'])) {
//
//        $dados = $request->only('email', 'password');
//
//        if (empty($dados['password']) && empty($dados['email'])) {
//            echo 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss';
//            return view('login');
//        }
//
//        $email = $dados['email'];
//        $password = $dados['password'];
//
//        $response = \Unirest\Request::get("http://localhost/sennit/sennit_api/public/auth/login?password=$password&email=$email");
//
//
//        if ($response->code != 200) {
//            echo 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk';
//            return view('login');
//        }
//
//        return $_SESSION['token'] = $response->body->access_token;
//    }


    $email = 'fandrade@gmail.com.br';
    $password = 'mudar123';

    $response = \Unirest\Request::get("http://localhost/sennit/sennit_api/public/auth/login?password=$password&email=$email");


    return view('index', ['token' => $response->body->access_token]);
});


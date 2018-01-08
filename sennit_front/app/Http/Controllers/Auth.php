<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Cep as Cep_Model;

class Auth extends Controller
{

    public function setTokenSession($dados)
    {

        if (session()->get('token')) {
            session()->flush();
        }
                
        session()->put('token', $dados->access_token);
        session()->put('session_data', $dados->expires_in);
    }
    
     public function getSession()
    {
         return response()->json(session()->get('token'));
    }

    public function authenticate(Request $request)
    {
        $dados = $request->only('email', 'password');

        if (empty($dados['password']) && empty($dados['email'])) {
            return response()->json(['status' => 'error']);
        }

        $response = \Unirest\Request::get("http://localhost/sennit/sennit_api/public/auth/login?password={$dados['password']}&email={$dados['email']}");
        
        if ($response->code != 200) {
            return response()->json(['status' => 'error']);
        }

        $this->setTokenSession($response->body);

        return response()->json(['status' => 'success', 'token' => session()->get('token')]);
    }

    public function logout()
    {
        session()->flush();
        
        return redirect('login');
    }

    public function login()
    {
        return view('login');
    }

}

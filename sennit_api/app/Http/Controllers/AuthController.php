<?php

# app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Token;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function authenticate(Request $request)
    {
        // Get only email and password from request
        $credentials = $request->only('email', 'password');
        $credentials['password'] = md5($credentials['password']);

        // Get user by email
        $company = Company::hasCompany($credentials['email']);
        
        // Validate Company
        if (!$company) {
            return response()->json([
                        'error' => 'Invalid credentials'
                            ], 401);
        }

        // Validate Password
        if (!Company::checkPassword($credentials['password'], $company['password'])) {
            return response()->json([
                        'error' => 'Invalid credentials'
                            ], 401);
        }

        $array_to_object = function ($array) {
            $obj = new \stdClass;
            foreach ($array as $k => $v) {
                if (strlen($k)) {
                    if (is_array($v)) {
                        $obj->{$k} = $array_to_object($v); //RECURSION
                    } else {
                        $obj->{$k} = $v;
                    }
                }
            }
            return $obj;
        };


        // Generate Token
        $token = JWTAuth::fromUser($array_to_object($company));

        $objectToken = JWTAuth::setToken($token);

        // Get expiration time
        $expiration = JWTAuth::decode($objectToken->getToken())->get('exp');

        $token = [
            'access_token' => $token,
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'token_type' => 'bearer',
            'expires_in' => $expiration,
        ];

        Token::createTokenDataBase($token);

        return response()->json($token);
    }

}

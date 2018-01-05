<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Token;

class AuthenticateToken
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $validator = $this->companyValidator($request);
        

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validation Failed',
                        'errors' => $validator->errors()
                            ], 422);
        }

        if (!Token::isValidToken($request->input('token'))) {
            return response()->json([
                        'message' => 'Validation Failed',
                        'errors' => 'Token Invalid'
                            ], 422);
        };


        return $next($request);
    }

    protected function companyValidator($request)
    {
        $validator = \Validator::make($request->all(), [
                    'token' => 'required',
        ]);

        return $validator;
    }

    public function checkToken($request)
    {

        //dd($validator->fails());
        //dd($request->all());
    }

}

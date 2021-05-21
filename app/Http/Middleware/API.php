<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Http;

use Closure;

class API
{
    private $login;
    private $public;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if https request token success
        // then next
        // else get error'
        $response = Http::get('https://app.centraltest.com/customer/REST/connect/json', [
            'login' => 'user@Webservice',
            'password' => 'UnitedCon$ultWS2021'
        ]);

        if($token=$response['token'] ){
            //get session token
            // echo $response['token'];
            session(['token' => $token]);
            return $next($request->merge(["token"=>$response['token']]));
        }
        else return abort(422, 'Token not found');

    }
}

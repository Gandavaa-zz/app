<?php

use Illuminate\Support\Facades\Http;

define('API_LOGIN', 'user@Webservice');
define('API_PASSWORD', 'UnitedCon$ultWS2021');

if (! function_exists('getBreadcrumb'))
{
    function getBreadcrumb($key)
    {
        if(is_numeric($key))
        {
            return $key;

        }else
        {
            $breadcrumbs = config('app.breadcrumbs');

            if (array_key_exists($key, $breadcrumbs))

                return $breadcrumbs[$key];

            else return null;
        }

    }
}


if( ! function_exists('getToken')){
    function getToken($login, $password){
        $response = Http::get('https://app.centraltest.com/customer/REST/connect/json', [
            'login' => $login,
            'password' => $password
        ]);

        if ($response['token']){
            return $response['token'];
        }
        else {
            abort(404, 'TOKEN is not accessed');
        }
    }
}

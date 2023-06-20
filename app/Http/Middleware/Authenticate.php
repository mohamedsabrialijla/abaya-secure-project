<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request,$guards=['system_admin'])
    {

        if($request->is('api/*') || $guards[0]=="api" )
        {
            $array=['status'=>false,'response_message'=>__('api_texts.unauthorized_request')];
            throw new HttpResponseException(response()->json($array,401));
//            throw new HttpResponseException(new Response("Unauthorized Request",401));
        }
        if (! $request->expectsJson()) {
            $guard = Arr::get($guards, 0);
            switch ($guard) {
                case 'system_admin':
                    $login = 'system_admin.login';
                    break;
                case 'web':
                    $login = 'login';
                    break;

                default:
                    $login = 'login';
                    break;
            }
            return route($login);
        }


    }
}

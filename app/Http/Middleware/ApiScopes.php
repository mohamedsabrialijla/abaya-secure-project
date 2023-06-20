<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class ApiScopes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,...$scopes)
    {
//        return $next($request);

        if (! $request->user() || ! $request->user()->token()) {
            throw new AuthenticationException;
        }
        foreach ($scopes as $scope) {
            if($request->header('Authorization')){
                $token=explode(' ',$request->header("Authorization"));
                if($token){
                    $this->token=$token[1];
                    if($request->user($scope)->withAccessToken($this->token)){
                        return $next($request);
                    }
                }
            }
        }
        return response()->json(["message" => "Unauthorized Request" ],403);
    }
}

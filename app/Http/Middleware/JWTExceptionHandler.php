<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTExceptionHandler
{
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Throwable $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this->returnError("Token is Invalid",401);
            }
            else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->returnError("Token is Expired",403);
            }
            else{
                 return $this->returnError("Authorization Token not found",401);
            }
        }
        return $next($request);
    }
    public function returnError($errors = false, $code)
    {
        return response([
            'success' => false,
            'message' => 'Error',
            'error' => $errors
        ], $code);
    }
}

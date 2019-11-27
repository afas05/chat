<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(
                [
                    'status' => 301,
                    'message' => 'Authorization Token not found'
                ]
            );
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(
                [
                    'status' => 301,
                    'message' => 'Token expired'
                ]
            );
        }

        return $next($request);
    }
}

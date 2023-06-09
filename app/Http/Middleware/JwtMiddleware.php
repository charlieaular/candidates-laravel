<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Src\Shared\Domain\Exceptions\BadJWTTokenException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                throw new BadJWTTokenException("Token invalid");
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                throw new BadJWTTokenException("Token expired");
            } else {
                throw new BadJWTTokenException("Authorization Token not found");
            }
        }
        return $next($request);
    }
}

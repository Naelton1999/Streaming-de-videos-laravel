<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class JWTMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Não autorizado. Token inválido ou expirado.'], 401);
        }

        return $next($request);
    }
}


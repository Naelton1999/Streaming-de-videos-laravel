<?PHP

use Tymon\JWTAuth\Facades\JWTAuth;
use Closure;

 function handle($request, Closure $next, ...$guards)
{
    try {
        $user = JWTAuth::parseToken()->authenticate();
    } catch (\Exception $e) {
        return response()->json(['error' => 'Token inválido'], 401);
    }

    return $next($request);
}


<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if($token === config('auth.token')) {
            return $next($request);
        }

        return \response()->json(['message' => 'Error auth', 'code' => Response::HTTP_FORBIDDEN], Response::HTTP_FORBIDDEN);
    }
}

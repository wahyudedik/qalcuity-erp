<?php

namespace App\Http\Middleware\Modul\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DevAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // For API, use token authentication
        if ($request->bearerToken()) {
            // This will be handled by the Sanctum middleware
            // We just need to check usertype here
            if (!Auth::guard('sanctum')->check() || Auth::guard('sanctum')->user()->usertype !== 'dev') {
                return response()->json(['message' => 'Unauthorized.'], 403);
            }
            return $next($request);
        }
        
        // For web, check session
        if (!Auth::check() || Auth::user()->usertype !== 'dev') {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 403);
            }
            return redirect()->route('login');
        }

        return $next($request);
    }
}
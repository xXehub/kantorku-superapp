<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FlexibleAuth
{
    /**
     * Handle an incoming request.
     * 
     * Middleware ini mendukung:
     * - Session-based auth untuk browser (cookie)
     * - Token-based auth untuk API (Bearer token)
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah sudah authenticated via session (web guard)
        if (Auth::guard('web')->check()) {
            // User sudah login via session
            return $next($request);
        }

        // Cek apakah ada Bearer token dan valid (sanctum guard)
        if ($request->bearerToken()) {
            // Cek auth via sanctum
            if (Auth::guard('sanctum')->check()) {
                return $next($request);
            }
        }

        // Tidak authenticated sama sekali
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => false,
                'message' => 'Belum terautentikasi. Tolong login terlebih dahulu.',
                'data' => null
            ], 401);
        }

        // Redirect ke login untuk web requests
        return redirect()->route('login');
    }
}

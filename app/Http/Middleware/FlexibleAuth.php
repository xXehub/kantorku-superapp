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
        $authenticated = false;
        $user = null;

        // 1. Cek authentication via Bearer token (Sanctum)
        if ($request->bearerToken()) {
            try {
                if (Auth::guard('sanctum')->check()) {
                    $user = Auth::guard('sanctum')->user();
                    $authenticated = true;
                    
                    // Set authenticated user to default auth
                    Auth::setUser($user);
                }
            } catch (\Exception $e) {
                \Log::warning('Sanctum auth failed', ['error' => $e->getMessage()]);
            }
        }

        // 2. Fallback ke session-based auth (Web guard)
        if (!$authenticated && Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $authenticated = true;
        }

        // 3. Jika tetap tidak authenticated
        if (!$authenticated || !$user) {
            return $this->unauthenticatedResponse($request);
        }

        // Set user untuk request
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }

    /**
     * Handle unauthenticated response
     */
    private function unauthenticatedResponse(Request $request): Response
    {
        // Untuk API requests, return JSON error
        if ($request->expectsJson() || $request->is('api/*') || $request->wantsJson()) {
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

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\ModalAlert;

class HasPanelAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            // For API requests, return JSON error
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Authentication required'
                ], 401);
            }
            return redirect()->route('login');
        }

        $user = auth()->user();

        if (!$user->hasNonDefaultPermissions()) {
            // For API requests, return JSON error
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied. Panel access required.'
                ], 403);
            }

            ModalAlert::error(
                'Akses Ditolak',
                'Anda tidak memiliki akses ke panel manajemen. Silakan hubungi administrator untuk mendapatkan izin akses.',
                'Mengerti'
            );

            return redirect()->route('client');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAppAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $appId = null): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Super admin has access to all apps
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // If no specific app ID is provided, check if user has access to any app
        if (!$appId) {
            if ($user->apps()->count() > 0) {
                return $next($request);
            }
        } else {
            // Check if user has access to specific app
            if ($user->hasAppAccess($appId)) {
                return $next($request);
            }
        }

        abort(403, 'You do not have access to this application.');
    }
}

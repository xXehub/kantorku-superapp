<?php

namespace App\Http\Middleware;

use App\Models\RoleAkses;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInstansiPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission, $instansiId = null): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Super admin has all permissions
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Get instansi ID from route parameter if not provided
        if (!$instansiId) {
            $instansiId = $request->route('instansi') ?? $request->route('instansi_id');
        }

        if (!$instansiId) {
            abort(400, 'Instansi ID is required.');
        }

        // Check permission through user's role
        if ($user->hasInstansiPermission($instansiId, $permission)) {
            return $next($request);
        }

        abort(403, "You do not have {$permission} permission for this instansi.");
    }
}

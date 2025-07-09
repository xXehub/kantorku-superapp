<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Panel\PermissionController;
use App\Http\Controllers\Api\Panel\RoleController;
use App\Http\Controllers\Api\Panel\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ============================================================================
// PUBLIC API ROUTES (No Authentication Required)
// ============================================================================

/**
 * Authentication Routes
 */
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/csrf-cookie', [AuthController::class, 'csrfCookie']);
    Route::get('/check', [AuthController::class, 'checkAuth']);
});

/**
 * Sanctum CSRF Cookie Route (for SPA)
 */
Route::get('/sanctum/csrf-cookie', function () {
    return response()->json([
        'success' => true,
        'message' => 'CSRF cookie has been set',
        'csrf_token' => csrf_token()
    ]);
});

/**
 * Public Info Routes
 */
Route::prefix('info')->group(function () {
    Route::get('/app', function () {
        return response()->json([
            'success' => true,
            'data' => [
                'name' => config('app.name'),
                'version' => '1.0.0',
                'environment' => config('app.env'),
                'timezone' => config('app.timezone'),
                'locale' => config('app.locale'),
                'debug' => config('app.debug'),
            ]
        ]);
    });

    Route::get('/stats', function () {
        return response()->json([
            'success' => true,
            'data' => [
                'users_count' => \App\Models\User::count(),
                'permissions_count' => \App\Models\Permission::count(),
                'roles_count' => \App\Models\Role::count(),
                'instansi_count' => \App\Models\Instansi::count(),
                'apps_count' => \App\Models\MasterApp::count(),
            ]
        ]);
    });
});

// ============================================================================
// PROTECTED API ROUTES (Flexible Authentication - Session or Token)
// ============================================================================

Route::middleware('flexible.auth')->group(function () {

    /**
     * Authentication routes (authenticated users only)
     */
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/logout-all', [AuthController::class, 'logoutAll']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::put('/profile', [AuthController::class, 'updateProfile']);

        Route::get('/tokens', function (Request $request) {
            $user = $request->user();
            
            // Only show tokens if authenticated via token (not session)
            if (!$request->bearerToken()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This endpoint requires token authentication'
                ], 403);
            }
            
            return response()->json([
                'success' => true,
                'data' => $user->tokens->map(function ($token) {
                    return [
                        'id' => $token->id,
                        'name' => $token->name,
                        'abilities' => $token->abilities,
                        'last_used_at' => $token->last_used_at,
                        'created_at' => $token->created_at,
                    ];
                })
            ]);
        });
    });

    /**
     * Legacy Sanctum User Endpoint (supports both auth methods)
     */
    Route::get('/user', function (Request $request) {
        $user = $request->user();
        $authMethod = $request->bearerToken() ? 'token' : 'session';
        
        return response()->json([
            'success' => true,
            'data' => $user,
            'auth_method' => $authMethod,
        ]);
    });

    /**
     * Panel Management Routes (requires super admin + flexible auth)
     */
    Route::middleware('has.panel.access')->prefix('panel')->name('api.panel.')->group(function () {

        // Users API
        Route::apiResource('users', UserController::class);

        // Roles API
        Route::apiResource('roles', RoleController::class);
        Route::get('roles/{role}/permissions', [RoleController::class, 'permissions'])->name('roles.permissions');
        Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');

        // Permissions API
        Route::apiResource('permissions', PermissionController::class);

        // Dashboard/Stats endpoint for panel
        Route::get('dashboard', function () {
            return response()->json([
                'success' => true,
                'data' => [
                    'users' => [
                        'total' => \App\Models\User::count(),
                        'superadmins' => \App\Models\User::where('is_superadmin', true)->count(),
                        'recent' => \App\Models\User::latest()->limit(5)->get(['id', 'name', 'email', 'created_at'])
                    ],
                    'roles' => [
                        'total' => \App\Models\Role::count(),
                        'with_users' => \App\Models\Role::has('users')->count(),
                        'recent' => \App\Models\Role::latest()->limit(5)->get(['id', 'name', 'created_at'])
                    ],
                    'permissions' => [
                        'total' => \App\Models\Permission::count(),
                        'groups' => \App\Models\Permission::selectRaw('`group`, COUNT(*) as count')->groupBy('group')->get(),
                        'recent' => \App\Models\Permission::latest()->limit(5)->get(['id', 'name', 'group', 'created_at'])
                    ],
                    'instansi' => [
                        'total' => \App\Models\Instansi::count(),
                        'with_users' => \App\Models\Instansi::has('users')->count()
                    ],
                    'apps' => [
                        'total' => \App\Models\MasterApp::count(),
                        'active' => \App\Models\MasterApp::where('is_active', true)->count()
                    ]
                ]
            ]);
        });

    });

});

// ============================================================================
// DEBUG ROUTES (Remove in production)
// ============================================================================

Route::prefix('debug')->group(function () {

    // Test flexible authentication
    Route::middleware('flexible.auth')->get('/auth-test', function (Request $request) {
        $user = $request->user();
        $authMethod = $request->bearerToken() ? 'token' : 'session';
        
        return response()->json([
            'success' => true,
            'message' => 'Flexible authentication working',
            'data' => [
                'user' => $user->only(['id', 'name', 'email']),
                'is_super_admin' => $user->isSuperAdmin(),
                'auth_method' => $authMethod,
                'bearer_token_present' => $request->bearerToken() ? true : false,
                'session_exists' => $request->hasSession() && $request->session()->has('login_web_*'),
                'current_guard' => config('auth.defaults.guard'),
                'server_time' => now(),
            ]
        ]);
    });

    // Test token authentication only
    Route::middleware('auth:sanctum')->get('/token-auth', function (Request $request) {
        return response()->json([
            'success' => true,
            'message' => 'Token authentication working',
            'data' => [
                'user' => $request->user()->only(['id', 'name', 'email']),
                'is_super_admin' => $request->user()->isSuperAdmin(),
                'token_name' => optional($request->user()->currentAccessToken())->name,
                'token_id' => optional($request->user()->currentAccessToken())->id,
                'auth_guard' => 'sanctum',
                'server_time' => now(),
            ]
        ]);
    });

    // Test session authentication only
    Route::middleware('auth:web')->get('/session-auth', function (Request $request) {
        return response()->json([
            'success' => true,
            'message' => 'Session authentication working',
            'data' => [
                'user' => $request->user()->only(['id', 'name', 'email']),
                'is_super_admin' => $request->user()->isSuperAdmin(),
                'session_id' => $request->session()->getId(),
                'auth_guard' => 'web',
                'server_time' => now(),
            ]
        ]);
    });

    // Test database connections
    Route::get('/database', function () {
        try {
            \DB::connection()->getPdo();
            return response()->json([
                'success' => true,
                'message' => 'Database connection working',
                'data' => [
                    'driver' => config('database.default'),
                    'database' => config('database.connections.' . config('database.default') . '.database'),
                    'tables_count' => count(\DB::select('SHOW TABLES')),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database connection failed',
                'error' => $e->getMessage()
            ], 500);
        }
    });

    // Health check
    Route::get('/health', function () {
        return response()->json([
            'success' => true,
            'message' => 'API is healthy',
            'data' => [
                'timestamp' => now(),
                'environment' => app()->environment(),
                'laravel_version' => app()->version(),
                'php_version' => PHP_VERSION,
                'memory_usage' => round(memory_get_usage(true) / 1024 / 1024, 2) . ' MB',
                'sanctum_installed' => class_exists('Laravel\Sanctum\Sanctum'),
                'cors_configured' => config('cors.paths') !== null,
            ]
        ]);
    });

});
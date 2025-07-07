<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\MasterApp;
use App\Models\Instansi;
use App\Models\User;
use App\Models\UserApp;
use Illuminate\Http\Request;

class AppDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display app-specific dashboard
     */
    public function index($instansiSlug, $appSlug)
    {
        $user = auth()->user();
        
        // Find instansi by slug or name
        $instansi = Instansi::where('kode_instansi', $instansiSlug)
            ->orWhere('nama_istansi', 'like', '%' . str_replace('-', ' ', $instansiSlug) . '%')
            ->firstOrFail();
            
        // Find app by slug or name
        $app = MasterApp::where('nama_app', 'like', '%' . str_replace('-', ' ', $appSlug) . '%')
            ->firstOrFail();
            
        // Check if user has access to this app in this instansi
        if (!$user->isSuperAdmin()) {
            // Check if user is admin for this specific app or admin for the instansi
            $hasAccess = false;
            
            if ($user->role && $user->role->nama_role === 'Administrator') {
                // Admin can access if they manage this specific app OR if app belongs to their instansi
                $hasAccess = ($user->app_id == $app->id) || ($user->instansi_id == $app->instansi_id);
            } else {
                // Regular users can access apps in their instansi
                $hasAccess = ($user->instansi_id == $app->instansi_id);
            }
                
            if (!$hasAccess) {
                abort(403, 'You do not have access to this application in this instansi.');
            }
        }

        // Get user's role for this app
        $userRole = $user->isSuperAdmin() ? 'superadmin' : $user->getAppRole($app->id);
        
        // App-specific stats
        $stats = [
            'total_users_in_app' => User::where('app_id', $app->id)->count(), // Admin users managing this app
            'total_users_in_instansi' => User::where('instansi_id', $app->instansi_id)->count(), // All users in app's instansi
            'active_sessions' => 0, // This would need to be implemented based on your session tracking
            'app_version' => $app->version ?? '1.0.0',
        ];

        return view('app.dashboard.index', compact('instansi', 'app', 'userRole', 'stats'));
    }
}

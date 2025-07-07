<?php

namespace App\Http\Controllers;

use App\Models\MasterApp;
use App\Models\Instansi;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the main dashboard
     */
    public function index()
    {
        $user = auth()->user();
        
        // Show all active apps and instansi to everyone, but access control for edit
        $userApps = MasterApp::where('is_active', true)->with(['instansi'])->get();
        $userInstansi = Instansi::where('is_active', true)->with(['masterApps' => function($query) {
            $query->where('is_active', true);
        }])->get();
        
        // Get comprehensive stats for all roles
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalApps = MasterApp::count();
        $totalInstansi = Instansi::count();
        $totalActiveApps = MasterApp::where('is_active', true)->count();
        $totalActiveInstansi = Instansi::where('is_active', true)->count();
        
        // Role-specific stats for context
        if ($user->is_superadmin) {
            $contextUsers = $totalUsers;
            $contextApps = $totalApps;
            $contextInstansi = $totalInstansi;
        } elseif ($user->role && $user->role->nama_role === 'Administrator') {
            $contextUsers = User::where('instansi_id', $user->instansi_id)->count();
            $contextApps = MasterApp::where('instansi_id', $user->instansi_id)->count();
            $contextInstansi = 1; // Admin only manages their own instansi
        } else {
            $contextUsers = 1; // Just themselves
            $contextApps = 0;
            $contextInstansi = 0;
        }

        // Get stats for dashboard
        $stats = [
            'total_apps' => $totalApps,
            'total_active_apps' => $totalActiveApps,
            'total_instansi' => $totalInstansi,
            'total_active_instansi' => $totalActiveInstansi,
            'total_users' => $totalUsers,
            'total_roles' => $totalRoles,
            'context_users' => $contextUsers,
            'context_apps' => $contextApps,
            'context_instansi' => $contextInstansi,
            'user_role' => $user->role ? $user->role->nama_role : ($user->is_superadmin ? 'Super Administrator' : 'Belum ada role'),
            'user_instansi' => $user->instansi ? $user->instansi->nama_instansi : ($user->is_superadmin ? 'Semua Instansi' : 'Belum ditugaskan'),
            'can_manage' => $user->is_superadmin || ($user->role && $user->role->nama_role === 'Administrator'),
            'can_edit_instansi' => $user->is_superadmin,
            'can_edit_apps' => $user->is_superadmin || ($user->role && $user->role->nama_role === 'Administrator'),
            'managed_app_id' => $user->app_id, // For admin's managed app
            'user_instansi_id' => $user->instansi_id, // For admin's managed instansi
        ];

        return view('dashboard.index', compact('userApps', 'userInstansi', 'stats'));
    }

}

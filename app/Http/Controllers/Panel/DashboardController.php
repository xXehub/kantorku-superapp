<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MasterApp;
use App\Models\Instansi;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the dashboard with dynamic data based on user permissions
     */
    public function index()
    {
        $user = auth()->user();

        return view('panel.dashboard', [
            'stats' => $this->getStats($user),
            'topApps' => $this->getTopApplications($user),
            'instansiData' => $this->getInstansiData($user)
        ]);
    }

    /**
     * Get statistics based on user's access level
     */
    private function getStats($user)
    {
        if ($user->isSuperAdmin()) {
            return [
                'total_users' => User::count(),
                'total_apps' => MasterApp::count(),
                'total_instansi' => Instansi::count(),
                'total_roles' => Role::count(),
            ];
        }

        if ($user->isAdmin() && $user->instansi_id) {
            return [
                'total_users' => User::where('instansi_id', $user->instansi_id)->count(),
                'total_apps' => MasterApp::where('instansi_id', $user->instansi_id)->count(),
                'total_instansi' => 1, // Admin hanya melihat instansinya sendiri
                'total_roles' => Role::count(),
            ];
        }

        // User biasa - statistik minimal
        return [
            'total_users' => 0,
            'total_apps' => $user->app_id ? 1 : 0,
            'total_instansi' => $user->instansi_id ? 1 : 0,
            'total_roles' => 0,
        ];
    }

    /**
     * Get top applications by user count with progress percentage
     */
    private function getTopApplications($user)
    {
        $query = MasterApp::withCount([
            'users' => function ($query) {
                $query->whereNotNull('app_id');
            }
        ])->orderBy('users_count', 'desc')->take(8);

        // Filter berdasarkan level user
        if (!$user->isSuperAdmin() && $user->isAdmin() && $user->instansi_id) {
            $query->where('instansi_id', $user->instansi_id);
        } elseif (!$user->isSuperAdmin() && !$user->isAdmin()) {
            return collect(); // User biasa tidak melihat data aplikasi
        }

        $topApps = $query->get();

        // Hitung persentase untuk progress bar
        if ($topApps->count() > 0) {
            $maxUserCount = $topApps->first()->users_count;
            
            $topApps->transform(function ($app) use ($maxUserCount) {
                $app->percentage = $maxUserCount > 0 
                    ? round(($app->users_count / $maxUserCount) * 100, 2) 
                    : 0;
                return $app;
            });
        }

        return $topApps;
    }

    /**
     * Get instansi data with user and app counts
     */
    private function getInstansiData($user)
    {
        $query = Instansi::withCount(['users', 'apps']);

        // Filter berdasarkan level user
        if (!$user->isSuperAdmin()) {
            if ($user->isAdmin() && $user->instansi_id) {
                $query->where('id', $user->instansi_id);
            } else {
                return collect(); // User biasa tidak melihat data instansi
            }
        }

        return $query->get();
    }
}

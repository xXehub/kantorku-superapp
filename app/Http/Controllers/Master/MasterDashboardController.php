<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MasterApp;
use App\Models\Instansi;
use App\Models\User;
use App\Models\Role;
use App\Models\UserApp;
use Illuminate\Http\Request;

class MasterDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->is_superadmin) {
                abort(403, 'Access denied. Super Administrator only.');
            }
            return $next($request);
        });
    }

    /**
     * Display the master dashboard
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalApps = MasterApp::count();
        $totalInstansi = Instansi::count();
        $totalRoles = Role::count();

        // Recent activities
        $recentUsers = User::with(['role', 'instansi'])
            ->latest()
            ->take(5)
            ->get();
        
        // Apps distribution by instansi
        $appsByInstansi = Instansi::withCount('apps')
            ->having('apps_count', '>', 0)
            ->get();

        // Users without instansi assignment
        $usersNeedingAssignment = User::whereNull('instansi_id')
            ->where('is_superadmin', false)
            ->count();

        return view('master.dashboard', compact(
            'totalUsers', 
            'totalApps', 
            'totalInstansi', 
            'totalRoles',
            'recentUsers',
            'appsByInstansi',
            'usersNeedingAssignment'
        ));
    }
}

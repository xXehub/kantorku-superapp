<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MasterApp;
use App\Models\Instansi;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Panel access middleware sudah ditangani di routes
    }

    /**
     * Display the unified panel dashboard with dynamic permissions
     */
    public function index()
    {
        $user = auth()->user();

        // Get user's permissions for dynamic access control
        $permissions = $this->getUserPermissions($user);

        // Get statistics based on user's access level
        $stats = $this->getUserStats($user);

        // Get recent activities based on permissions
        $recentData = $this->getRecentData($user, $permissions);

        // Get management sections available for this user based on permissions
        $availableSections = $this->getAvailableSections($user, $permissions);

        // Get top applications by user count
        $topApps = $this->getTopApplications($user);

        // Get instansi with user counts for table
        $instansiData = $this->getInstansiData($user);

        return view('panel.dashboard', compact(
            'permissions',
            'stats',
            'recentData',
            'availableSections',
            'topApps',
            'instansiData'
        ));
    }

    /**
     * Get user permissions dynamically from database
     */
    private function getUserPermissions($user)
    {
        if ($user->isSuperAdmin()) {
            // Superadmin bypasses all permission checks and has full access
            return ['*']; // Wildcard for full access
        }

        if (!$user->role) {
            return []; // No permissions if no role assigned
        }

        // Get permissions from role
        return $user->role->permissions->pluck('name')->toArray();
    }

    /**
     * Get statistics based on user's access level with scoped data
     */
    private function getUserStats($user)
    {
        $stats = [];

        if ($user->isSuperAdmin()) {
            // Superadmin can see all statistics
            $stats = [
                'total_users' => User::count(),
                'total_apps' => MasterApp::count(),
                'total_instansi' => Instansi::count(),
                'total_roles' => Role::count(),
                'total_permissions' => Permission::count(),
                'active_apps' => MasterApp::where('is_active', true)->count(),
                'active_instansi' => Instansi::where('is_active', true)->count(),
                'pending_users' => User::whereNull('role_id')->count(),
            ];
        } elseif ($user->isAdmin() && $user->instansi_id) {
            // Admin can only see statistics for their instansi
            $stats = [
                'instansi_users' => User::where('instansi_id', $user->instansi_id)->count(),
                'instansi_apps' => MasterApp::where('instansi_id', $user->instansi_id)->count(),
                'active_instansi_apps' => MasterApp::where('instansi_id', $user->instansi_id)
                    ->where('is_active', true)->count(),
                'pending_instansi_users' => User::where('instansi_id', $user->instansi_id)
                    ->whereNull('role_id')->count(),
            ];
        } else {
            // Other roles get limited statistics based on their assignments
            $stats = [
                'my_apps' => $user->app_id ? 1 : 0,
                'my_instansi' => $user->instansi_id ? 1 : 0,
            ];
        }

        return $stats;
    }

    /**
     * Get recent data based on user permissions and scope
     */
    private function getRecentData($user, $permissions)
    {
        $data = [];

        if ($user->isSuperAdmin()) {
            // Superadmin can see all recent data
            $data['recent_users'] = User::latest()->take(5)->get();
            $data['recent_apps'] = MasterApp::latest()->take(5)->get();
            $data['recent_instansi'] = Instansi::latest()->take(5)->get();
        } elseif ($user->isAdmin() && $user->instansi_id) {
            // Admin can only see recent data for their instansi
            $data['recent_users'] = User::where('instansi_id', $user->instansi_id)
                ->latest()->take(5)->get();
            $data['recent_apps'] = MasterApp::where('instansi_id', $user->instansi_id)
                ->latest()->take(5)->get();
        }
        // Other roles don't get recent data unless specific permissions allow it

        return $data;
    }

    /**
     * Get available management sections based on dynamic permissions
     */
    private function getAvailableSections($user, $permissions)
    {
        $sections = [];

        if ($user->isSuperAdmin()) {
            // Superadmin has access to all sections
            $sections = [
                'users' => [
                    'title' => 'Manajemen Users',
                    'icon' => 'fas fa-users',
                    'route' => 'panel.users.index',
                    'description' => 'Kelola semua pengguna sistem'
                ],
                'roles' => [
                    'title' => 'Manajemen Roles',
                    'icon' => 'fas fa-user-tag',
                    'route' => 'panel.roles.index',
                    'description' => 'Kelola role dan permission'
                ],
                'apps' => [
                    'title' => 'Manajemen Aplikasi',
                    'icon' => 'fas fa-mobile-alt',
                    'route' => 'panel.apps.index',
                    'description' => 'Kelola aplikasi master'
                ],
                'instansi' => [
                    'title' => 'Manajemen Instansi',
                    'icon' => 'fas fa-building',
                    'route' => 'panel.instansi.index',
                    'description' => 'Kelola data instansi'
                ],
                'permissions' => [
                    'title' => 'Manajemen Permission',
                    'icon' => 'fas fa-key',
                    'route' => 'panel.permissions.index',
                    'description' => 'Kelola hak akses sistem'
                ]
            ];
        } else {
            // For non-superadmin users, check specific permissions dynamically

            // Check if user can manage users
            if (in_array('manage_users', $permissions) || ($user->isAdmin() && $user->instansi_id)) {
                $sections['users'] = [
                    'title' => $user->isAdmin() ? 'Manajemen Users Instansi' : 'Manajemen Users',
                    'icon' => 'fas fa-users',
                    'route' => 'panel.users.index',
                    'description' => $user->isAdmin() ? 'Kelola pengguna di instansi Anda' : 'Kelola pengguna'
                ];
            }

            // Check if user can manage roles
            if (in_array('manage_roles', $permissions)) {
                $sections['roles'] = [
                    'title' => 'Manajemen Roles',
                    'icon' => 'fas fa-user-tag',
                    'route' => 'panel.roles.index',
                    'description' => 'Kelola role dan permission'
                ];
            }

            // Check if user can manage apps
            if (in_array('manage_apps', $permissions) || ($user->isAdmin() && $user->instansi_id) || $user->app_id) {
                $sections['apps'] = [
                    'title' => $user->isAdmin() ? 'Manajemen Aplikasi Instansi' : 'Manajemen Aplikasi',
                    'icon' => 'fas fa-mobile-alt',
                    'route' => 'panel.apps.index',
                    'description' => $user->isAdmin() ? 'Kelola aplikasi instansi' : 'Kelola aplikasi yang ditugaskan'
                ];
            }

            // Check if user can manage instansi (usually only superadmin, but check permission)
            if (in_array('manage_instansi', $permissions)) {
                $sections['instansi'] = [
                    'title' => 'Manajemen Instansi',
                    'icon' => 'fas fa-building',
                    'route' => 'panel.instansi.index',
                    'description' => 'Kelola data instansi'
                ];
            }

            // Check if user can manage permissions
            if (in_array('manage_permissions', $permissions)) {
                $sections['permissions'] = [
                    'title' => 'Manajemen Permission',
                    'icon' => 'fas fa-key',
                    'route' => 'panel.permissions.index',
                    'description' => 'Kelola hak akses sistem'
                ];
            }
        }

        return $sections;
    }

    /**
     * Get top applications by user count
     */
    private function getTopApplications($user)
    {
        if ($user->isSuperAdmin()) {
            // Get top applications by user count (users with app_id)
            $topApps = MasterApp::withCount([
                'users' => function ($query) {
                    $query->whereNotNull('app_id');
                }
            ])
                ->orderBy('users_count', 'desc')
                ->take(8)
                ->get();
        } elseif ($user->isAdmin() && $user->instansi_id) {
            // Admin can only see apps from their instansi
            $topApps = MasterApp::where('instansi_id', $user->instansi_id)
                ->withCount([
                    'users' => function ($query) {
                        $query->whereNotNull('app_id');
                    }
                ])
                ->orderBy('users_count', 'desc')
                ->take(8)
                ->get();
        } else {
            // Other users see limited data
            return collect();
        }

        // Calculate percentage for progress bar based on the highest user count
        if ($topApps->count() > 0) {
            $maxUserCount = $topApps->first()->users_count;

            $topApps->transform(function ($app) use ($maxUserCount) {
                if ($maxUserCount > 0) {
                    $app->percentage = round(($app->users_count / $maxUserCount) * 100, 2);
                } else {
                    $app->percentage = 0;
                }
                return $app;
            });
        }

        return $topApps;
    }

    /**
     * Get instansi data with user counts for dashboard table
     */
    private function getInstansiData($user)
    {
        if ($user->isSuperAdmin()) {
            // Get all instansi with user counts and app counts
            return Instansi::withCount([
                'users',
                'apps'
            ])->get();
        } elseif ($user->isAdmin() && $user->instansi_id) {
            // Admin can only see their own instansi
            return Instansi::where('id', $user->instansi_id)
                ->withCount([
                    'users',
                    'apps'
                ])->get();
        }

        // Other users see no instansi data
        return collect();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\MasterApp;
use App\Models\Instansi;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalApps = MasterApp::count();
        $totalInstansi = Instansi::count();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalRoles', 'totalApps', 'totalInstansi', 'recentUsers'));
    }
}

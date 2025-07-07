<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\MasterApp;
use App\Models\Instansi;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the universal client landing page for all users
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get all active apps and instansi for public viewing
        $apps = MasterApp::where('is_active', true)
            ->with(['instansi'])
            ->latest()
            ->take(8)
            ->get();
            
        $instansi = Instansi::where('is_active', true)
            ->withCount(['apps' => function($query) {
                $query->where('is_active', true);
            }])
            ->latest()
            ->paginate(8);
        
        // Check if user has panel access
        $hasPanelAccess = $user->hasNonDefaultPermissions();
        
        // Get user's instansi info
        $userInstansi = $user->instansi;
        
        // Get user's managed app (if any)
        $managedApp = $user->managedApp;
        
        return view('client.index', compact(
            'apps', 
            'instansi', 
            'hasPanelAccess', 
            'userInstansi', 
            'managedApp'
        ));
    }
    
    /**
     * Show detailed instansi page with all its apps
     */
    public function showInstansi($id)
    {
        $user = auth()->user();
        
        $instansi = Instansi::where('is_active', true)
            ->with(['apps' => function($query) {
                $query->where('is_active', true)->orderBy('nama_app');
            }])
            ->findOrFail($id);
            
        // Check if user has management access to this instansi
        $hasManagementAccess = $user->hasNonDefaultPermissions() && 
                              ($user->is_superadmin || $user->instansi_id == $instansi->id);
        
        return view('client.instansi', compact('instansi', 'hasManagementAccess'));
    }
}

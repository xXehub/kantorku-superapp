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
            ->take(6)
            ->get();
        
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
}

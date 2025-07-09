<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\MasterApp;
use App\Models\Instansi;
use App\Models\KategoriApp;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function __construct()
    {
        // Only require auth for specific methods that need authentication
        $this->middleware('auth')->only(['aplikasi', 'showInstansi']);
    }

    /**
     * Display the universal client landing page for all users (including guests)
     */
    public function index()
    {
        $user = auth()->user(); // This can be null for guests
        
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
        
        // Check if user has panel access (null-safe for guests)
        $hasPanelAccess = $user ? $user->hasNonDefaultPermissions() : false;
        
        // Get user's instansi info (null for guests)
        $userInstansi = $user ? $user->instansi : null;
        
        // Get user's managed app (null for guests)
        $managedApp = $user ? $user->managedApp : null;
        
        return view('beranda', compact(
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
    public function showInstansi(Request $request, $id)
    {
        $user = auth()->user();
        
        $instansi = Instansi::where('is_active', true)
            ->findOrFail($id);
            
        // Get all active categories for filter
        $categories = KategoriApp::active()->ordered()->get();
        
        // Build query for apps
        $appsQuery = MasterApp::where('is_active', true)
            ->where('instansi_id', $instansi->id)
            ->with(['kategori']);
            
        // Apply category filter if provided
        if ($request->filled('kategori') && $request->kategori !== 'tampilkan-semua') {
            $appsQuery->whereHas('kategori', function($query) use ($request) {
                $query->where('slug', $request->kategori);
            });
        }
        
        // Apply search filter if provided
        if ($request->filled('search')) {
            $appsQuery->where(function($query) use ($request) {
                $query->where('nama_app', 'like', '%' . $request->search . '%')
                      ->orWhere('deskripsi_app', 'like', '%' . $request->search . '%');
            });
        }
        
        // Get paginated apps
        $apps = $appsQuery->orderBy('nama_app')->paginate(8);
        
        // Preserve query parameters in pagination
        $apps->appends($request->query());
            
        // Check if user has management access to this instansi
        $hasManagementAccess = $user->hasNonDefaultPermissions() && 
                              ($user->is_superadmin || $user->instansi_id == $instansi->id);
        
        return view('client.instansi', compact('instansi', 'apps', 'categories', 'hasManagementAccess'));
    }
    
    /**
     * Show all applications across all instansi
     */
    public function aplikasi(Request $request)
    {
        $user = auth()->user();
        
        // Get all active categories for filter
        $categories = KategoriApp::active()->ordered()->get();
        
        // Build query for all apps
        $appsQuery = MasterApp::where('is_active', true)
            ->with(['kategori', 'instansi']);
            
        // Apply category filter if provided
        if ($request->filled('kategori') && $request->kategori !== 'tampilkan-semua') {
            $appsQuery->whereHas('kategori', function($query) use ($request) {
                $query->where('slug', $request->kategori);
            });
        }
        
        // Apply search filter if provided
        if ($request->filled('search')) {
            $appsQuery->where(function($query) use ($request) {
                $query->where('nama_app', 'like', '%' . $request->search . '%')
                      ->orWhere('deskripsi_app', 'like', '%' . $request->search . '%')
                      ->orWhereHas('instansi', function($q) use ($request) {
                          $q->where('nama_instansi', 'like', '%' . $request->search . '%');
                      });
            });
        }
        
        // Get paginated apps
        $apps = $appsQuery->orderBy('nama_app')->paginate(12);
        
        // Preserve query parameters in pagination
        $apps->appends($request->query());
            
        // Check if user has panel access
        $hasPanelAccess = $user->hasNonDefaultPermissions();
        
        return view('client.aplikasi', compact('apps', 'categories', 'hasPanelAccess'));
    }
}

<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MasterApp;
use App\Models\Instansi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MasterAppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Apply superadmin middleware for create, destroy. Allow show for all authenticated users.
        // Allow edit/update only for superadmin and app managers
        $this->middleware('superadmin')->only(['create', 'store', 'destroy']);
    }

    /**
     * Check if user can edit app
     */
    private function canEditApp($app, $user)
    {
        if ($user->is_superadmin) {
            return true;
        }
        
        // Admin can edit apps within their instansi
        if ($user->role && $user->role->nama_role === 'Administrator' && $user->instansi_id == $app->instansi_id) {
            return true;
        }
        
        return false;
    }

    /**
     * Check if user can view app - all authenticated users can view
     */
    private function canViewApp($app, $user)
    {
        // All authenticated users can view apps
        return true;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Show all active apps to all authenticated users
        // Edit access is determined by instansi_id and app_id, not visibility
        $apps = MasterApp::where('is_active', true)
            ->with(['creator', 'instansi'])
            ->latest()
            ->get();

        return view('master.master-app.index', compact('apps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        
        if (!$user->is_superadmin && !($user->role && $user->role->nama_role === 'Administrator')) {
            abort(403, 'Access denied.');
        }
        
        if ($user->is_superadmin) {
            $instansi = Instansi::all();
        } else {
            $instansi = $user->instansi ? collect([$user->instansi]) : collect();
        }
        
        return view('master.master-app.create', compact('instansi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        if (!$user->is_superadmin && !($user->role && $user->role->nama_role === 'Administrator')) {
            abort(403, 'Access denied.');
        }

        $validated = $request->validate([
            'kode_app' => 'required|string|max:20|unique:master_app,kode_app',
            'nama_app' => 'required|string|max:255',
            'deskripsi_app' => 'nullable|string',
            'url_app' => 'nullable|url',
            'instansi_id' => 'required|exists:instansi,id',
            'is_active' => 'boolean',
        ]);

        // If user is admin, they can only create apps for their instansi
        if (!$user->is_superadmin && $user->instansi_id !== $validated['instansi_id']) {
            abort(403, 'You can only create apps for your instansi.');
        }

        $validated['created_by'] = $user->id;
        $validated['is_active'] = $request->has('is_active');

        MasterApp::create($validated);

        return redirect()
            ->route('master.master-app.index')
            ->with('success', 'Aplikasi berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterApp $masterApp)
    {
        $user = auth()->user();
        
        if (!$this->canEditApp($masterApp, $user)) {
            abort(403, 'Access denied. You can only edit apps you are assigned to manage.');
        }
        
        if ($user->is_superadmin) {
            $instansi = Instansi::all();
        } else {
            $instansi = $user->instansi ? collect([$user->instansi]) : collect();
        }
        
        return view('master.master-app.edit', compact('masterApp', 'instansi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterApp $masterApp)
    {
        $user = auth()->user();
        
        if (!$this->canEditApp($masterApp, $user)) {
            abort(403, 'Access denied. You can only edit apps you are assigned to manage.');
        }

        $validated = $request->validate([
            'kode_app' => 'required|string|max:20|unique:master_app,kode_app,' . $masterApp->id,
            'nama_app' => 'required|string|max:255',
            'deskripsi_app' => 'nullable|string',
            'url_app' => 'nullable|url',
            'instansi_id' => 'required|exists:instansi,id',
            'is_active' => 'boolean',
        ]);

        // If user is admin, they have different restrictions
        if (!$user->is_superadmin) {
            // Admin can only update apps they manage (within their instansi)
            // And they can only assign app to their own instansi
            if ($user->instansi_id != $validated['instansi_id']) {
                $errorMsg = sprintf(
                    'You can only assign apps to your instansi. Your instansi ID: %s (%s), Requested instansi ID: %s',
                    $user->instansi_id,
                    $user->instansi ? $user->instansi->nama_instansi : 'None',
                    $validated['instansi_id']
                );
                abort(403, $errorMsg);
            }
        }

        $validated['is_active'] = $request->has('is_active');
        $masterApp->update($validated);

        return redirect()
            ->route('master.master-app.index')
            ->with('success', 'Aplikasi berhasil diperbarui!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterApp $masterApp)
    {
        $user = auth()->user();
        
        if (!$this->canViewApp($masterApp, $user)) {
            abort(403, 'Access denied. You can only view apps you have access to.');
        }
        
        $masterApp->load(['creator', 'instansi', 'roles']);
        return view('master.master-app.show', compact('masterApp'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterApp $masterApp)
    {
        $user = auth()->user();
        
        if (!$this->canEditApp($masterApp, $user)) {
            abort(403, 'Access denied. You can only delete apps you are assigned to manage.');
        }

        $masterApp->delete();

        return redirect()
            ->route('master.master-app.index')
            ->with('success', 'Aplikasi berhasil dihapus!');
    }
}

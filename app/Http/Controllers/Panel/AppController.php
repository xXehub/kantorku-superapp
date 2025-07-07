<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\MasterApp;
use App\Models\Instansi;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of apps based on user access
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            // Super admin can see all apps
            $apps = MasterApp::with('instansi')->latest()->paginate(15);
        } elseif ($user->isAdmin()) {
            // Admin can only see apps from their instansi
            $apps = MasterApp::with('instansi')
                ->where('instansi_id', $user->instansi_id)
                ->latest()
                ->paginate(15);
        } else {
            abort(403, 'Access denied.');
        }

        $instansi = $user->isSuperAdmin() ? Instansi::all() : Instansi::where('id', $user->instansi_id)->get();

        return view('panel.apps.index', compact('apps', 'instansi'));
    }

    /**
     * Show the form for creating a new app
     */
    public function create()
    {
        $user = auth()->user();

        if (!$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $instansi = $user->isSuperAdmin() ? Instansi::all() : Instansi::where('id', $user->instansi_id)->get();

        return view('panel.apps.create', compact('instansi'));
    }

    /**
     * Store a newly created app
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $rules = [
            'nama_app' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'url_app' => 'nullable|url|max:255',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ];

        // Add instansi validation based on user level
        if ($user->isSuperAdmin()) {
            $rules['instansi_id'] = 'required|exists:instansi,id';
        } else {
            // Admin can only create apps for their own instansi
            $request->merge(['instansi_id' => $user->instansi_id]);
        }

        $validatedData = $request->validate($rules);
        $validatedData['is_active'] = $request->has('is_active');

        MasterApp::create($validatedData);

        return redirect()->route('panel.apps.index')
            ->with('success', 'Aplikasi berhasil ditambahkan.');
    }

    /**
     * Display the specified app
     */
    public function show(MasterApp $app)
    {
        $user = auth()->user();

        // Check access permissions
        if (!$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        if ($user->isAdmin() && $app->instansi_id !== $user->instansi_id) {
            abort(403, 'Access denied.');
        }

        return view('panel.apps.show', compact('app'));
    }

    /**
     * Show the form for editing the specified app
     */
    public function edit(MasterApp $app)
    {
        $user = auth()->user();

        // Check access permissions
        if (!$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        if ($user->isAdmin() && $app->instansi_id !== $user->instansi_id) {
            abort(403, 'Access denied.');
        }

        $instansi = $user->isSuperAdmin() ? Instansi::all() : Instansi::where('id', $user->instansi_id)->get();

        return view('panel.apps.edit', compact('app', 'instansi'));
    }

    /**
     * Update the specified app
     */
    public function update(Request $request, MasterApp $app)
    {
        $user = auth()->user();

        // Check access permissions
        if (!$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        if ($user->isAdmin() && $app->instansi_id !== $user->instansi_id) {
            abort(403, 'Access denied.');
        }

        $rules = [
            'nama_app' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'url_app' => 'nullable|url|max:255',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ];

        // Add instansi validation based on user level
        if ($user->isSuperAdmin()) {
            $rules['instansi_id'] = 'required|exists:instansi,id';
        } else {
            // Admin cannot change instansi
            $request->merge(['instansi_id' => $app->instansi_id]);
        }

        $validatedData = $request->validate($rules);
        $validatedData['is_active'] = $request->has('is_active');

        $app->update($validatedData);

        return redirect()->route('panel.apps.index')
            ->with('success', 'Aplikasi berhasil diupdate.');
    }

    /**
     * Remove the specified app
     */
    public function destroy(MasterApp $app)
    {
        $user = auth()->user();

        // Check access permissions
        if (!$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        if ($user->isAdmin() && $app->instansi_id !== $user->instansi_id) {
            abort(403, 'Access denied.');
        }

        $app->delete();

        return redirect()->route('panel.apps.index')
            ->with('success', 'Aplikasi berhasil dihapus.');
    }
}

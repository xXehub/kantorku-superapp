<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of instansi (Super admin only)
     */
    public function index()
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $instansi = Instansi::withCount(['users', 'masterApps'])
            ->latest()
            ->paginate(15);

        return view('panel.instansi.index', compact('instansi'));
    }

    /**
     * Show the form for creating a new instansi
     */
    public function create()
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        return view('panel.instansi.create');
    }

    /**
     * Store a newly created instansi
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $validatedData = $request->validate([
            'nama_instansi' => 'required|string|max:255|unique:instansi',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'is_active' => 'boolean'
        ]);

        $validatedData['is_active'] = $request->has('is_active');

        Instansi::create($validatedData);

        return redirect()->route('panel.instansi.index')
            ->with('success', 'Instansi berhasil ditambahkan.');
    }

    /**
     * Display the specified instansi
     */
    public function show(Instansi $instansi)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $instansi->load(['users', 'masterApps']);

        return view('panel.instansi.show', compact('instansi'));
    }

    /**
     * Show the form for editing the specified instansi
     */
    public function edit(Instansi $instansi)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        return view('panel.instansi.edit', compact('instansi'));
    }

    /**
     * Update the specified instansi
     */
    public function update(Request $request, Instansi $instansi)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $validatedData = $request->validate([
            'nama_instansi' => 'required|string|max:255|unique:instansi,nama_instansi,' . $instansi->id,
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'is_active' => 'boolean'
        ]);

        $validatedData['is_active'] = $request->has('is_active');

        $instansi->update($validatedData);

        return redirect()->route('panel.instansi.index')
            ->with('success', 'Instansi berhasil diupdate.');
    }

    /**
     * Remove the specified instansi
     */
    public function destroy(Instansi $instansi)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        // Check if instansi has users or apps
        if ($instansi->users()->count() > 0 || $instansi->masterApps()->count() > 0) {
            return redirect()->route('panel.instansi.index')
                ->with('error', 'Instansi tidak dapat dihapus karena masih memiliki user atau aplikasi.');
        }

        $instansi->delete();

        return redirect()->route('panel.instansi.index')
            ->with('success', 'Instansi berhasil dihapus.');
    }
}

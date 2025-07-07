<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Only superadmin can create, edit, delete instansi. Everyone can view.
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            $action = $request->route()->getActionMethod();
            
            // Allow index and show methods for all authenticated users
            if (in_array($action, ['index', 'show'])) {
                return $next($request);
            }
            
            // Only superadmin can manage instansi (create, edit, delete)
            if (!$user->is_superadmin) {
                abort(403, 'Access denied. Super Administrator only.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Show all active instansi to all authenticated users
        // Edit access is determined by user role, not visibility
        $instansi = Instansi::where('is_active', true)
            ->withCount(['masterApps', 'users'])
            ->latest()
            ->get();
        return view('master.instansi.index', compact('instansi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.instansi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_instansi' => 'required|string|max:20|unique:instansi,kode_instansi',
            'nama_instansi' => 'required|string|max:255',
            'deskripsi_instansi' => 'nullable|string',
            'alamat_instansi' => 'nullable|string',
            'telepon_instansi' => 'nullable|string|max:20',
            'email_instansi' => 'nullable|email|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        Instansi::create($validated);

        return redirect()->route('master.instansi.index')
                         ->with('success', 'Instansi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instansi $instansi)
    {
        $instansi->load(['masterApps', 'users.role']);
        return view('master.instansi.show', compact('instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instansi $instansi)
    {
        return view('master.instansi.edit', compact('instansi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instansi $instansi)
    {
        $validated = $request->validate([
            'kode_instansi' => 'required|string|max:20|unique:instansi,kode_instansi,' . $instansi->id,
            'nama_instansi' => 'required|string|max:255',
            'deskripsi_instansi' => 'nullable|string',
            'alamat_instansi' => 'nullable|string',
            'telepon_instansi' => 'nullable|string|max:20',
            'email_instansi' => 'nullable|email|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $instansi->update($validated);

        return redirect()->route('master.instansi.index')
                         ->with('success', 'Instansi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instansi $instansi)
    {
        $instansi->delete();

        return redirect()->route('master.instansi.index')
                         ->with('success', 'Instansi berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

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
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isSuperAdmin()) {
            $instansi = Instansi::latest()->paginate(10);
        } else {
            // Regular users can only see their own instansi
            if ($user->instansi_id) {
                $instansi = Instansi::where('id', $user->instansi_id)->latest()->paginate(10);
            } else {
                $instansi = collect()->paginate(10);
            }
        }

        return view('admin.instansi.index', compact('instansi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Instansi::class);
        return view('admin.instansi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Instansi::class);

        $validated = $request->validate([
            'kode_instansi' => 'required|string|max:255|unique:instansi',
            'nama_istansi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        Instansi::create($validated);

        return redirect()->route('admin.instansi.index')
                         ->with('success', 'Instansi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instansi $instansi)
    {
        $instansi->load('roleAkses.role');
        return view('admin.instansi.show', compact('instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instansi $instansi)
    {
        $this->authorize('update', $instansi);
        return view('admin.instansi.edit', compact('instansi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instansi $instansi)
    {
        $this->authorize('update', $instansi);

        $validated = $request->validate([
            'kode_instansi' => 'required|string|max:255|unique:instansi,kode_instansi,' . $instansi->id,
            'nama_istansi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $instansi->update($validated);

        return redirect()->route('admin.instansi.index')
                         ->with('success', 'Instansi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instansi $instansi)
    {
        $this->authorize('delete', $instansi);

        $instansi->delete();

        return redirect()->route('admin.instansi.index')
                         ->with('success', 'Instansi berhasil dihapus.');
    }
}

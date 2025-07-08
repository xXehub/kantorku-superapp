<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\KategoriApp;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriAppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = KategoriApp::ordered()->paginate(10);
        return view('panel.kategori.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_kategori);
        $data['is_active'] = $request->has('is_active');

        KategoriApp::create($data);

        return redirect()->route('panel.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriApp $kategori)
    {
        $kategori->load(['apps' => function($query) {
            $query->where('is_active', true);
        }]);
        
        return view('panel.kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriApp $kategori)
    {
        return view('panel.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriApp $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_kategori);
        $data['is_active'] = $request->has('is_active');

        $kategori->update($data);

        return redirect()->route('panel.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriApp $kategori)
    {
        // Check if category has apps
        if ($kategori->apps()->count() > 0) {
            return redirect()->route('panel.kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki aplikasi.');
        }

        $kategori->delete();

        return redirect()->route('panel.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}

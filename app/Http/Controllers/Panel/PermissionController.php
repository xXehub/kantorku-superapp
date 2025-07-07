<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of permissions (Super admin only)
     */
    public function index()
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $permissions = Permission::withCount('roles')
            ->latest()
            ->paginate(15);

        return view('panel.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission
     */
    public function create()
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        return view('panel.permissions.create');
    }

    /**
     * Store a newly created permission
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
            'description' => 'nullable|string',
        ]);

        Permission::create($validatedData);

        return redirect()->route('panel.permissions.index')
            ->with('success', 'Permission berhasil ditambahkan.');
    }

    /**
     * Display the specified permission
     */
    public function show(Permission $permission)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $permission->load('roles');

        return view('panel.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified permission
     */
    public function edit(Permission $permission)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        return view('panel.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified permission
     */
    public function update(Request $request, Permission $permission)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'description' => 'nullable|string',
        ]);

        $permission->update($validatedData);

        return redirect()->route('panel.permissions.index')
            ->with('success', 'Permission berhasil diupdate.');
    }

    /**
     * Remove the specified permission
     */
    public function destroy(Permission $permission)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        // Check if permission is in use
        if ($permission->roles()->count() > 0) {
            return redirect()->route('panel.permissions.index')
                ->with('error', 'Permission tidak dapat dihapus karena masih digunakan oleh role.');
        }

        $permission->delete();

        return redirect()->route('panel.permissions.index')
            ->with('success', 'Permission berhasil dihapus.');
    }
}

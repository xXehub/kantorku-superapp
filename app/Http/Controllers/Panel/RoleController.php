<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of roles
     */
    public function index()
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $roles = Role::with('permissions')->latest()->paginate(15);
        
        return view('panel.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role
     */
    public function create()
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $permissions = Permission::all();
        
        return view('panel.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $validatedData = $request->validate([
            'nama_role' => 'required|string|max:255|unique:roles',
            'deskripsi' => 'nullable|string',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::create([
            'nama_role' => $validatedData['nama_role'],
            'deskripsi' => $validatedData['deskripsi'] ?? '',
        ]);

        if (isset($validatedData['permissions'])) {
            $role->permissions()->sync($validatedData['permissions']);
        }

        return redirect()->route('panel.roles.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    /**
     * Display the specified role
     */
    public function show(Role $role)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        return view('panel.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role
     */
    public function edit(Role $role)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        
        return view('panel.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified role
     */
    public function update(Request $request, Role $role)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $validatedData = $request->validate([
            'nama_role' => 'required|string|max:255|unique:roles,nama_role,' . $role->id,
            'deskripsi' => 'nullable|string',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role->update([
            'nama_role' => $validatedData['nama_role'],
            'deskripsi' => $validatedData['deskripsi'] ?? '',
        ]);

        if (isset($validatedData['permissions'])) {
            $role->permissions()->sync($validatedData['permissions']);
        } else {
            $role->permissions()->detach();
        }

        return redirect()->route('panel.roles.index')
            ->with('success', 'Role berhasil diupdate.');
    }

    /**
     * Remove the specified role
     */
    public function destroy(Role $role)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        // Check if role is in use
        if ($role->users()->count() > 0) {
            return redirect()->route('panel.roles.index')
                ->with('error', 'Role tidak dapat dihapus karena masih digunakan oleh user.');
        }

        $role->delete();

        return redirect()->route('panel.roles.index')
            ->with('success', 'Role berhasil dihapus.');
    }

    /**
     * Show role permissions form
     */
    public function permissions(Role $role)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        
        return view('panel.roles.permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update role permissions
     */
    public function updatePermissions(Request $request, Role $role)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin()) {
            abort(403, 'Access denied. Super admin only.');
        }

        $validatedData = $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        if (isset($validatedData['permissions'])) {
            $role->permissions()->sync($validatedData['permissions']);
        } else {
            $role->permissions()->detach();
        }

        return redirect()->route('panel.roles.index')
            ->with('success', 'Permission role berhasil diupdate.');
    }
}

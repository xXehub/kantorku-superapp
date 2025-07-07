<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\MasterApp;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isSuperAdmin()) {
                abort(403, 'Access denied. Superadmin only.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $roles = Role::with(['app', 'permissions'])->paginate(20);
        return view('master.roles.index', compact('roles'));
    }

    public function create()
    {
        $apps = MasterApp::all();
        $permissions = Permission::orderBy('group')->orderBy('name')->get();
        $permissionGroups = $permissions->groupBy('group');
        
        return view('master.roles.create', compact('apps', 'permissions', 'permissionGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'nama_role' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'is_default' => 'boolean',
            'app_id' => 'nullable|exists:master_app,id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'nama_role' => $request->nama_role,
            'description' => $request->description,
            'is_default' => $request->boolean('is_default', false),
            'app_id' => $request->app_id,
        ]);

        // Sync permissions
        if ($request->permissions) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->route('master.roles.index')->with('success', 'Role created successfully.');
    }

    public function show(Role $role)
    {
        $role->load(['app', 'permissions', 'users.instansi']);
        return view('master.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $apps = MasterApp::all();
        $permissions = Permission::orderBy('group')->orderBy('name')->get();
        $permissionGroups = $permissions->groupBy('group');
        $role->load('permissions');
        
        return view('master.roles.edit', compact('role', 'apps', 'permissions', 'permissionGroups'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'nama_role' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'is_default' => 'boolean',
            'app_id' => 'nullable|exists:master_app,id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update([
            'name' => $request->name,
            'nama_role' => $request->nama_role,
            'description' => $request->description,
            'is_default' => $request->boolean('is_default', false),
            'app_id' => $request->app_id,
        ]);

        // Sync permissions
        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('master.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'admin' || $role->name === 'user') {
            return redirect()->route('master.roles.index')->with('error', 'Cannot delete default roles.');
        }

        if ($role->users()->count() > 0) {
            return redirect()->route('master.roles.index')->with('error', 'Cannot delete role that has users assigned.');
        }

        $role->delete();

        return redirect()->route('master.roles.index')->with('success', 'Role deleted successfully.');
    }

    /**
     * Show role permissions management
     */
    public function permissions(Role $role)
    {
        $permissions = Permission::orderBy('group')->orderBy('name')->get();
        $permissionGroups = $permissions->groupBy('group');
        $role->load('permissions');
        
        return view('master.roles.permissions', compact('role', 'permissions', 'permissionGroups'));
    }

    /**
     * Update role permissions
     */
    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('master.roles.permissions', $role)
                         ->with('success', 'Role permissions updated successfully.');
    }
}

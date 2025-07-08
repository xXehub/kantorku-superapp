<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class RoleController extends Controller
{
    /**
     * Get roles data for DataTable
     */
    public function index(Request $request)
    {
        try {
            $user = auth()->user();
            
            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $query = Role::withCount(['users', 'permissions']);

            // Search functionality
            if ($request->has('search') && $request->search['value']) {
                $search = $request->search['value'];
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }

            // Get total count before pagination
            $totalData = Role::count();
            $totalFiltered = $query->count();

            // Pagination
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;
            
            $roles = $query->skip($start)
                           ->take($length)
                           ->get();

            // Format data for DataTable
            $data = $roles->map(function($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'description' => $role->description ?? '-',
                    'users_count' => $role->users_count,
                    'permissions_count' => $role->permissions_count,
                    'created_at' => $role->created_at->format('d/m/Y H:i'),
                    'updated_at' => $role->updated_at->format('d/m/Y H:i'),
                ];
            });

            return response()->json([
                'draw' => intval($request->draw ?? 1),
                'recordsTotal' => $totalData,
                'recordsFiltered' => $totalFiltered,
                'data' => $data
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => 'Error loading data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a new role
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            
            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:roles',
                'description' => 'nullable|string',
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,id'
            ]);

            $permissions = $validatedData['permissions'] ?? [];
            unset($validatedData['permissions']);

            $role = Role::create($validatedData);
            
            if (!empty($permissions)) {
                $role->permissions()->sync($permissions);
            }

            $role->load('permissions');

            return response()->json([
                'success' => true,
                'message' => 'Role berhasil ditambahkan',
                'data' => $role
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get specific role
     */
    public function show(Role $role)
    {
        try {
            $user = auth()->user();
            
            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $role->load(['permissions', 'users']);

            return response()->json([
                'success' => true,
                'data' => $role
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found'
            ], 404);
        }
    }

    /**
     * Update role
     */
    public function update(Request $request, Role $role)
    {
        try {
            $user = auth()->user();
            
            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
                'description' => 'nullable|string',
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,id'
            ]);

            $permissions = $validatedData['permissions'] ?? [];
            unset($validatedData['permissions']);

            $role->update($validatedData);
            
            if (isset($request->permissions)) {
                $role->permissions()->sync($permissions);
            }

            $role->load('permissions');

            return response()->json([
                'success' => true,
                'message' => 'Role berhasil diupdate',
                'data' => $role
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete role
     */
    public function destroy(Role $role)
    {
        try {
            $user = auth()->user();
            
            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            // Check if role is in use
            if ($role->users()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Role tidak dapat dihapus karena masih digunakan oleh user'
                ], 400);
            }

            $role->delete();

            return response()->json([
                'success' => true,
                'message' => 'Role berhasil dihapus'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get role permissions
     */
    public function permissions(Role $role)
    {
        try {
            $user = auth()->user();
            
            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $allPermissions = Permission::all();
            $rolePermissions = $role->permissions->pluck('id')->toArray();

            return response()->json([
                'success' => true,
                'data' => [
                    'role' => $role,
                    'all_permissions' => $allPermissions,
                    'role_permissions' => $rolePermissions
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading permissions: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update role permissions
     */
    public function updatePermissions(Request $request, Role $role)
    {
        try {
            $user = auth()->user();
            
            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $validatedData = $request->validate([
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,id'
            ]);

            $role->permissions()->sync($validatedData['permissions'] ?? []);
            $role->load('permissions');

            return response()->json([
                'success' => true,
                'message' => 'Role permissions berhasil diupdate',
                'data' => $role
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating permissions: ' . $e->getMessage()
            ], 500);
        }
    }
}

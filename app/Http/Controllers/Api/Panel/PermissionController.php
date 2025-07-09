<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class PermissionController extends Controller
{
    public function __construct()
    {
        // Middleware sudah ditangani di routes, tidak perlu di controller
    }

    /**
     * Get permissions data for DataTable
     */
    public function index(Request $request)
    {
        try {
            $user = auth()->user();
            
            // Debug log yang lebih detail
            \Log::info('Permission API called', [
                'user_id' => $user?->id,
                'user_email' => $user?->email,
                'is_super_admin' => $user?->isSuperAdmin(),
                'request_data' => $request->all(),
                'auth_check' => auth()->check(),
                'bearer_token' => $request->bearerToken() ? 'present' : 'absent',
                'session_id' => $request->hasSession() ? $request->session()->getId() : null,
                'guards' => [
                    'web' => \Auth::guard('web')->check(),
                    'sanctum' => \Auth::guard('sanctum')->check(),
                ]
            ]);
            
            if (!$user) {
                \Log::warning('Permission API: User not authenticated');
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            
            if (!$user->isSuperAdmin()) {
                \Log::warning('Permission API: Access denied for user', ['user_id' => $user->id]);
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $query = Permission::withCount('roles');

            // Search functionality
            if ($request->has('search') && $request->search['value']) {
                $search = $request->search['value'];
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('display_name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('group', 'like', "%{$search}%");
                });
            }

            // Ordering
            if ($request->has('order')) {
                $orderColumn = $request->columns[$request->order[0]['column']]['data'];
                $orderDirection = $request->order[0]['dir'];
                
                switch ($orderColumn) {
                    case 'name':
                        $query->orderBy('name', $orderDirection);
                        break;
                    case 'display_name':
                        $query->orderBy('display_name', $orderDirection);
                        break;
                    case 'group':
                        $query->orderBy('group', $orderDirection);
                        break;
                    case 'roles_count':
                        $query->orderBy('roles_count', $orderDirection);
                        break;
                    case 'created_at':
                        $query->orderBy('created_at', $orderDirection);
                        break;
                    default:
                        $query->orderBy('created_at', 'desc');
                }
            } else {
                $query->orderBy('created_at', 'desc');
            }

            // Get total count before pagination
            $totalData = Permission::count();
            $totalFiltered = $query->count();

            // Pagination
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;
            
            $permissions = $query->skip($start)
                               ->take($length)
                               ->get();

            // Format data for DataTable
            $data = $permissions->map(function($permission) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'display_name' => $permission->display_name ?? '-',
                    'description' => $permission->description ?? '-',
                    'group' => $permission->group ?? '-',
                    'roles_count' => $permission->roles_count,
                    'created_at' => $permission->created_at->format('d/m/Y H:i'),
                    'updated_at' => $permission->updated_at->format('d/m/Y H:i'),
                ];
            });

            $response = [
                'draw' => intval($request->draw ?? 1),
                'recordsTotal' => $totalData,
                'recordsFiltered' => $totalFiltered,
                'data' => $data
            ];
            
            \Log::info('Permission API response', $response);

            return response()->json($response);

        } catch (Exception $e) {
            return response()->json(['error' => 'Error loading data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a new permission
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            
            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:permissions',
                'display_name' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'group' => 'nullable|string|max:100',
            ]);

            $permission = Permission::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Permission berhasil ditambahkan',
                'data' => $permission
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
                'message' => 'Error creating permission: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get specific permission
     */
    public function show(Permission $permission)
    {
        try {
            $user = auth()->user();
            
            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $permission->load('roles');

            return response()->json([
                'success' => true,
                'data' => $permission
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Permission not found'
            ], 404);
        }
    }

    /**
     * Update permission
     */
    public function update(Request $request, Permission $permission)
    {
        try {
            $user = auth()->user();
            
            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
                'display_name' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'group' => 'nullable|string|max:100',
            ]);

            $permission->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Permission berhasil diupdate',
                'data' => $permission
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
                'message' => 'Error updating permission: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete permission
     */
    public function destroy(Permission $permission)
    {
        try {
            $user = auth()->user();
            
            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            // Check if permission is in use
            if ($permission->roles()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Permission tidak dapat dihapus karena masih digunakan oleh role'
                ], 400);
            }

            $permission->delete();

            return response()->json([
                'success' => true,
                'message' => 'Permission berhasil dihapus'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting permission: ' . $e->getMessage()
            ], 500);
        }
    }
}

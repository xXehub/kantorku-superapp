<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Instansi;
use App\Models\MasterApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;

class UserController extends Controller
{
    /**
     * Get users data for DataTable
     */
    public function index(Request $request)
    {
        try {
            $user = auth()->user();

            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $query = User::with(['role', 'instansi', 'masterApp']);

            // Search functionality
            if ($request->has('search') && $request->search['value']) {
                $search = $request->search['value'];
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas('role', function ($rq) use ($search) {
                            $rq->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('instansi', function ($iq) use ($search) {
                            $iq->where('name', 'like', "%{$search}%");
                        });
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
                    case 'email':
                        $query->orderBy('email', $orderDirection);
                        break;
                    case 'username':
                        $query->orderBy('username', $orderDirection);
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
            $totalData = User::count();
            $totalFiltered = $query->count();

            // Pagination
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;

            $users = $query->skip($start)
                ->take($length)
                ->get();

            // Format data for DataTable
            $data = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'is_superadmin' => $user->is_superadmin,
                    'role' => $user->role ? [
                        'id' => $user->role->id,
                        'name' => $user->role->name
                    ] : null,
                    'instansi' => $user->instansi ? [
                        'id' => $user->instansi->id,
                        'name' => $user->instansi->name
                    ] : null,
                    'app' => $user->masterApp ? [
                        'id' => $user->masterApp->id,
                        'name' => $user->masterApp->name
                    ] : null,
                    'created_at' => $user->created_at->format('d/m/Y H:i'),
                    'updated_at' => $user->updated_at->format('d/m/Y H:i'),
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
     * Store a new user
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            if (!$user->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'avatar' => 'nullable|string',
                'is_superadmin' => 'boolean',
                'role_id' => 'nullable|exists:roles,id',
                'instansi_id' => 'nullable|exists:instansi,id',
                'app_id' => 'nullable|exists:master_app,id',
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);

            $newUser = User::create($validatedData);
            $newUser->load(['role', 'instansi', 'masterApp']);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan',
                'data' => $newUser
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
                'message' => 'Error creating user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get specific user
     */
    public function show(User $user)
    {
        try {
            $authUser = auth()->user();

            if (!$authUser->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $user->load(['role', 'instansi', 'masterApp']);

            return response()->json([
                'success' => true,
                'data' => $user
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        try {
            $authUser = auth()->user();

            if (!$authUser->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:6',
                'avatar' => 'nullable|string',
                'is_superadmin' => 'boolean',
                'role_id' => 'nullable|exists:roles,id',
                'instansi_id' => 'nullable|exists:instansi,id',
                'app_id' => 'nullable|exists:master_app,id',
            ]);

            if (!empty($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                unset($validatedData['password']);
            }

            $user->update($validatedData);
            $user->load(['role', 'instansi', 'masterApp']);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diupdate',
                'data' => $user
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
                'message' => 'Error updating user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        try {
            $authUser = auth()->user();

            if (!$authUser->isSuperAdmin()) {
                return response()->json(['error' => 'Access denied. Super admin only.'], 403);
            }

            // Prevent deleting self
            if ($user->id === $authUser->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghapus akun sendiri'
                ], 400);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting user: ' . $e->getMessage()
            ], 500);
        }
    }
}

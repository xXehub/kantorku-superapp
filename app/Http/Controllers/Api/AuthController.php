<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login dengan email dan password, return token
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            // Validasi input
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            // Cari user berdasarkan email
            $user = User::where('email', $credentials['email'])->first();

            // Check apakah user ada dan password benar
            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah.',
                ], 401);
            }

            // Buat token untuk user
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'is_super_admin' => $user->isSuperAdmin(),
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer',
                ],
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login gagal: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Logout user (revoke token aktif)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            // Revoke token yang sedang digunakan
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Logout berhasil',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout gagal: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Logout dari semua devices (revoke semua token)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutAll(Request $request)
    {
        try {
            // Revoke semua token user
            $request->user()->tokens()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Logout dari semua device berhasil',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout gagal: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get profile user yang sedang login
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        try {
            $user = $request->user();

            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil dimuat',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'username' => $user->username,
                        'email' => $user->email,
                        'avatar' => $user->avatar,
                        'is_super_admin' => $user->isSuperAdmin(),
                        'role_id' => $user->role_id,
                        'instansi_id' => $user->instansi_id,
                        'app_id' => $user->app_id,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                    ],
                    'token_name' => $user->currentAccessToken()->name,
                    'token_created' => $user->currentAccessToken()->created_at,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat profile: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update profile user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        try {
            $user = $request->user();

            $validatedData = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'username' => 'sometimes|required|string|max:255|unique:users,username,' . $user->id,
                'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
                'avatar' => 'sometimes|nullable|string',
            ]);

            $user->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil diupdate',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'username' => $user->username,
                        'email' => $user->email,
                        'avatar' => $user->avatar,
                        'is_super_admin' => $user->isSuperAdmin(),
                    ],
                ],
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal update profile: ' . $e->getMessage(),
            ], 500);
        }
    }
}

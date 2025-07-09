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
     * Login dengan email dan password
     * - Untuk API requests: return token
     * - Untuk browser requests: set session + optional token
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
                'remember' => 'sometimes|boolean',
                'token_name' => 'sometimes|string|max:255',
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

            // Determine if this is a browser request or API request
            $isBrowserRequest = !$request->expectsJson() && !$request->is('api/*') && 
                               !$request->hasHeader('Authorization') && 
                               !$request->wantsJson();

            $responseData = [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'is_super_admin' => $user->isSuperAdmin(),
                ],
                'auth_method' => null,
            ];

            // Untuk browser requests, set session
            if ($isBrowserRequest) {
                Auth::login($user, $credentials['remember'] ?? false);
                $responseData['auth_method'] = 'session';
                $responseData['message'] = 'Login berhasil dengan session';
            } else {
                // Untuk API requests, buat token
                $tokenName = $credentials['token_name'] ?? 'api-token-' . now()->format('Y-m-d-H-i-s');
                $token = $user->createToken($tokenName)->plainTextToken;
                
                $responseData['token'] = $token;
                $responseData['token_type'] = 'Bearer';
                $responseData['token_name'] = $tokenName;
                $responseData['auth_method'] = 'token';
                $responseData['message'] = 'Login berhasil dengan token';
            }

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'data' => $responseData,
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
     * Logout user
     * - Untuk session-based: logout dari session
     * - Untuk token-based: revoke current token
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            
            // Cek apakah menggunakan token atau session
            if ($request->bearerToken() && $user->currentAccessToken()) {
                // Token-based logout
                $user->currentAccessToken()->delete();
                $message = 'Token berhasil dihapus';
                $authMethod = 'token';
            } else {
                // Session-based logout
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $message = 'Session logout berhasil';
                $authMethod = 'session';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'auth_method' => $authMethod,
                    'logged_out_at' => now(),
                ]
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
     * Works for both session and token auth
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        try {
            $user = $request->user();
            
            $authMethod = 'session';
            $tokenInfo = null;
            
            // Cek jika menggunakan token auth
            if ($request->bearerToken() && $user->currentAccessToken()) {
                $authMethod = 'token';
                $tokenInfo = [
                    'token_name' => $user->currentAccessToken()->name,
                    'token_created' => $user->currentAccessToken()->created_at,
                    'token_last_used' => $user->currentAccessToken()->last_used_at,
                ];
            }

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
                    'auth_method' => $authMethod,
                    'token_info' => $tokenInfo,
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

    /**
     * Get CSRF Cookie (required for SPA authentication)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function csrfCookie()
    {
        return response()->json([
            'success' => true,
            'message' => 'CSRF cookie set',
            'data' => [
                'csrf_token' => csrf_token(),
            ]
        ]);
    }

    /**
     * Check current authentication status
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAuth(Request $request)
    {
        $isAuthenticated = false;
        $authMethod = null;
        $user = null;

        // Cek session auth
        if (Auth::guard('web')->check()) {
            $isAuthenticated = true;
            $authMethod = 'session';
            $user = Auth::guard('web')->user();
        }
        // Cek token auth
        elseif ($request->bearerToken() && Auth::guard('sanctum')->check()) {
            $isAuthenticated = true;
            $authMethod = 'token';
            $user = Auth::guard('sanctum')->user();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'authenticated' => $isAuthenticated,
                'auth_method' => $authMethod,
                'user' => $user ? [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'is_super_admin' => $user->isSuperAdmin(),
                ] : null,
            ]
        ]);
    }
}

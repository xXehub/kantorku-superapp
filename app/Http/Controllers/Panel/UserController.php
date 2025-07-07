<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of users based on user's access level
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isSuperAdmin()) {
            // Super admin can see all users
            $users = User::with(['role', 'instansi'])
                ->latest()
                ->paginate(15);
        } elseif ($user->isAdmin()) {
            // Admin can only see users from their instansi
            $users = User::with(['role', 'instansi'])
                ->where('instansi_id', $user->instansi_id)
                ->latest()
                ->paginate(15);
        } else {
            // Other roles cannot access user management
            abort(403, 'Access denied.');
        }

        $roles = Role::all();
        $instansi = $user->isSuperAdmin() ? Instansi::all() : Instansi::where('id', $user->instansi_id)->get();

        return view('panel.users.index', compact('users', 'roles', 'instansi'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $roles = Role::all();
        $instansi = $user->isSuperAdmin() ? Instansi::all() : Instansi::where('id', $user->instansi_id)->get();

        return view('panel.users.create', compact('roles', 'instansi'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        if (!$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'nullable|exists:roles,id',
        ];

        // Add instansi validation based on user level
        if ($user->isSuperAdmin()) {
            $rules['instansi_id'] = 'nullable|exists:instansi,id';
        } else {
            // Admin can only assign users to their own instansi
            $request->merge(['instansi_id' => $user->instansi_id]);
        }

        $validatedData = $request->validate($rules);
        $validatedData['password'] = Hash::make($validatedData['password']);

        $newUser = User::create($validatedData);

        return redirect()->route('panel.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        $currentUser = auth()->user();
        
        // Check access permissions
        if (!$currentUser->isSuperAdmin() && !$currentUser->isAdmin()) {
            abort(403, 'Access denied.');
        }
        
        if ($currentUser->isAdmin() && $user->instansi_id !== $currentUser->instansi_id) {
            abort(403, 'Access denied.');
        }

        return view('panel.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        $currentUser = auth()->user();
        
        // Check access permissions
        if (!$currentUser->isSuperAdmin() && !$currentUser->isAdmin()) {
            abort(403, 'Access denied.');
        }
        
        if ($currentUser->isAdmin() && $user->instansi_id !== $currentUser->instansi_id) {
            abort(403, 'Access denied.');
        }

        $roles = Role::all();
        $instansi = $currentUser->isSuperAdmin() ? Instansi::all() : Instansi::where('id', $currentUser->instansi_id)->get();

        return view('panel.users.edit', compact('user', 'roles', 'instansi'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $currentUser = auth()->user();
        
        // Check access permissions
        if (!$currentUser->isSuperAdmin() && !$currentUser->isAdmin()) {
            abort(403, 'Access denied.');
        }
        
        if ($currentUser->isAdmin() && $user->instansi_id !== $currentUser->instansi_id) {
            abort(403, 'Access denied.');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'nullable|exists:roles,id',
        ];

        // Add instansi validation based on user level
        if ($currentUser->isSuperAdmin()) {
            $rules['instansi_id'] = 'nullable|exists:instansi,id';
        } else {
            // Admin cannot change instansi
            $request->merge(['instansi_id' => $user->instansi_id]);
        }

        $validatedData = $request->validate($rules);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('panel.users.index')
            ->with('success', 'User berhasil diupdate.');
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        $currentUser = auth()->user();
        
        // Check access permissions
        if (!$currentUser->isSuperAdmin() && !$currentUser->isAdmin()) {
            abort(403, 'Access denied.');
        }
        
        if ($currentUser->isAdmin() && $user->instansi_id !== $currentUser->instansi_id) {
            abort(403, 'Access denied.');
        }

        // Prevent deletion of own account
        if ($user->id === $currentUser->id) {
            return redirect()->route('panel.users.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('panel.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Master;

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
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->is_superadmin) {
                abort(403, 'Access denied. Superadmin only.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::with(['role', 'instansi', 'managedApp'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('master.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        $roles = Role::orderBy('nama_role')->get();
        $instansi = Instansi::orderBy('nama_instansi')->get();

        return view('master.users.create', compact('roles', 'instansi'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users|alpha_dash',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'instansi_id' => 'nullable|exists:instansi,id',
            'app_id' => 'nullable|exists:master_app,id',
            'is_superadmin' => 'boolean',
        ]);

        DB::transaction(function () use ($request) {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'instansi_id' => $request->instansi_id,
                'app_id' => $request->app_id,
                'is_superadmin' => $request->boolean('is_superadmin'),
            ]);
        });

        return redirect()->route('master.users.index')
            ->with('success', 'User berhasil dibuat!');
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        $user->load(['role', 'instansi', 'managedApp']);
        return view('master.users.show', compact('user'));
    }

    /**
     * Show the form for editing user
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('nama_role')->get();
        $instansi = Instansi::orderBy('nama_instansi')->get();

        return view('master.users.edit', compact('user', 'roles', 'instansi'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('users')->ignore($user->id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'instansi_id' => 'nullable|exists:instansi,id',
            'app_id' => 'nullable|exists:master_app,id',
            'is_superadmin' => 'boolean',
        ]);

        DB::transaction(function () use ($request, $user) {
            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'instansi_id' => $request->instansi_id,
                'app_id' => $request->app_id,
                'is_superadmin' => $request->boolean('is_superadmin'),
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);
        });

        return redirect()->route('master.users.index')
            ->with('success', 'User berhasil diupdate!');
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        // Prevent deleting superadmin accounts
        if ($user->is_superadmin && User::where('is_superadmin', true)->count() <= 1) {
            return redirect()->route('master.users.index')
                ->with('error', 'Tidak dapat menghapus superadmin terakhir!');
        }

        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return redirect()->route('master.users.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        DB::transaction(function () use ($user) {
            $user->delete();
        });

        return redirect()->route('master.users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'avatar',
        'password',
        'is_superadmin',
        'role_id',
        'instansi_id',
        'app_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_superadmin' => 'boolean',
        ];
    }

    /**
     * Get the role that the user belongs to.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the instansi that the user belongs to.
     */
    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }

    /**
     * Get the app that the user manages (for admin users).
     */
    public function managedApp()
    {
        return $this->belongsTo(MasterApp::class, 'app_id');
    }

    /**
     * Legacy compatibility - DEPRECATED: Use managedApp() relationship instead
     * @deprecated This relationship is deprecated. Use managedApp() for app management.
     */
    public function userApps()
    {
        return $this->hasMany(UserApp::class);
    }

    /**
     * Get apps created by this user
     */
    public function createdApps()
    {
        return $this->hasMany(MasterApp::class, 'created_by');
    }

    /**
     * Get all apps that the user can access based on their role.
     */
    public function accessibleApps()
    {
        if ($this->isSuperAdmin()) {
            return MasterApp::all();
        }

        if ($this->isAdmin() && $this->app_id) {
            // Admin users can only access their assigned app
            return MasterApp::where('id', $this->app_id)->get();
        }

        // Regular users can access apps where their role is allowed
        if ($this->role && $this->instansi) {
            return MasterApp::whereHas('roles', function ($query) {
                $query->where('role_id', $this->role_id);
            })->get();
        }

        return collect([]);
    }

    /**
     * Check if user has access to specific app
     */
    public function hasAppAccess($appId)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->isAdmin() && $this->app_id == $appId) {
            return true;
        }

        return $this->accessibleApps()->contains('id', $appId);
    }

    /**
     * Get user's role for specific app
     */
    public function getAppRole($appId = null)
    {
        return $this->role;
    }

    /**
     * Check if user is superadmin
     */
    public function isSuperAdmin()
    {
        return $this->is_superadmin;
    }

    public function hasRole($role)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        return $this->role && $this->role->nama_role === $role;
    }

    public function hasPermission($permission, $appId = null, $instansiId = null)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        if (!$this->role) {
            return false;
        }

        return $this->role->hasPermission($permission);
    }

    /**
     * Check if user has permission for specific instansi (simplified)
     */
    public function hasInstansiPermission($instansiId, $permission, $appId = null)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        // Check if user belongs to the specified instansi
        if ($this->instansi_id !== $instansiId) {
            return false;
        }

        return $this->hasPermission($permission, $appId, $instansiId);
    }

    /**
     * Check if user has permissions beyond default role
     */
    public function hasNonDefaultPermissions(): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        if (!$this->role) {
            return false;
        }
        
        // Check if user has permissions beyond basic dashboard.view
        $basicPermissions = ['dashboard.view'];
        $userPermissions = $this->role->permissions->pluck('name')->toArray();
        
        return count(array_diff($userPermissions, $basicPermissions)) > 0;
    }

    public function isAdmin()
    {
        return $this->isSuperAdmin() || $this->hasRole('Administrator');
    }

    public function isManager()
    {
        return $this->hasRole('Manager');
    }

    public function isUser()
    {
        return $this->hasRole('User');
    }

    /**
     * Check if user can manage specific app (show settings button)
     */
    public function canManageApp($appId)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->isAdmin() && $this->app_id == $appId) {
            return true;
        }

        return false;
    }
}

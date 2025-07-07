<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';

    protected $fillable = [
        'nama_role',
        'description',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the app this role belongs to
     */
    public function app()
    {
        return $this->belongsTo(MasterApp::class, 'app_id');
    }

    /**
     * Get all permissions for this role
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    /**
     * Get user-app relationships using this role
     * @deprecated This relationship is deprecated as user_app table is no longer used.
     */
    public function userApps()
    {
        return $this->hasMany(UserApp::class);
    }

    /**
     * Get all apps that this role can access
     * @deprecated This many-to-many relationship is deprecated. Use app() belongsTo relationship instead.
     */
    public function apps()
    {
        return $this->belongsToMany(MasterApp::class, 'app_role', 'role_id', 'app_id');
    }

    /**
     * Check if role has specific permission
     */
    public function hasPermission($permission)
    {
        return $this->permissions()->where('name', $permission)->exists();
    }

    /**
     * Give permission to role
     */
    public function givePermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->first();
        }
        
        if ($permission && !$this->hasPermission($permission->name)) {
            $this->permissions()->attach($permission->id);
        }
        
        return $this;
    }

    /**
     * Revoke permission from role
     */
    public function revokePermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->first();
        }
        
        if ($permission) {
            $this->permissions()->detach($permission->id);
        }
        
        return $this;
    }

    /**
     * Sync permissions for role
     */
    public function syncPermissions($permissions)
    {
        $permissionIds = [];
        
        foreach ($permissions as $permission) {
            if (is_string($permission)) {
                $perm = Permission::where('name', $permission)->first();
                if ($perm) {
                    $permissionIds[] = $perm->id;
                }
            } else {
                $permissionIds[] = $permission;
            }
        }
        
        $this->permissions()->sync($permissionIds);
        return $this;
    }
}

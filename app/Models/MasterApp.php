<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterApp extends Model
{
    use HasFactory;

    protected $table = 'master_app';

    protected $fillable = [
        'kode_app',
        'nama_app',
        'deskripsi_app',
        'url_app',
        'logo_app',
        'is_active',
        'created_by',
        'instansi_id',
        'kategori_app_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who created this app
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get all roles that can access this app
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'app_role', 'app_id', 'role_id');
    }

    /**
     * Get users who manage this app (admin users)
     */
    public function users()
    {
        return $this->hasMany(User::class, 'app_id');
    }

    /**
     * Get all users who can access this app based on roles
     */
    public function accessibleUsers()
    {
        return User::whereIn('role_id', $this->roles->pluck('id'));
    }

    /**
     * Get users with specific role for this app
     */
    public function usersWithRole($roleId)
    {
        return User::where('role_id', $roleId)
                   ->whereHas('role.apps', function ($query) {
                       $query->where('app_id', $this->id);
                   });
    }

    /**
     * Legacy compatibility - DEPRECATED: Use users() relationship instead
     * @deprecated This relationship is deprecated. Use users() for user management.
     */
    public function userApps()
    {
        return $this->hasMany(UserApp::class, 'app_id');
    }

    /**
     * Get the instansi that owns this app
     */
    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }

    /**
     * Get the category that this app belongs to
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriApp::class, 'kategori_app_id');
    }
}

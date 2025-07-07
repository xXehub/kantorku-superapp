<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table = 'instansi';

    protected $fillable = [
        'kode_instansi',
        'nama_instansi',
        'deskripsi_instansi',
        'alamat_instansi',
        'telepon_instansi',
        'email_instansi',
        'website_instansi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all user apps that are scoped to this instansi
     * @deprecated This relationship is deprecated as user_app table is no longer used.
     */
    public function userApps()
    {
        return $this->hasMany(UserApp::class);
    }

    /**
     * Get the apps that belong to this instansi
     */
    public function apps()
    {
        return $this->hasMany(MasterApp::class);
    }

    /**
     * Get the master apps that belong to this instansi (alias for apps)
     */
    public function masterApps()
    {
        return $this->hasMany(MasterApp::class);
    }

    /**
     * Get the users that belong to this instansi
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the admin user for this instansi
     */
    public function admin()
    {
        return $this->hasOne(User::class)->whereHas('role', function ($query) {
            $query->where('name', 'admin');
        });
    }
}

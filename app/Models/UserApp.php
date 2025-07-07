<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @deprecated This model is deprecated and will be removed in future versions.
 * Use direct relationships via users.app_id and users.instansi_id instead.
 */
class UserApp extends Model
{
    use HasFactory;

    protected $table = 'user_app';

    protected $fillable = [
        'user_id',
        'app_id',
        'role_id',
        'instansi_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that this relationship belongs to
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the app that this relationship belongs to
     */
    public function app()
    {
        return $this->belongsTo(MasterApp::class, 'app_id');
    }

    /**
     * Get the role for this user-app relationship
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the instansi for this user-app relationship
     */
    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }
}

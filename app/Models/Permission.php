<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'group',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all roles that have this permission
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }

    /**
     * Check if permission belongs to a specific group
     */
    public function isInGroup($group)
    {
        return $this->group === $group;
    }

    /**
     * Scope permissions by group
     */
    public function scopeInGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}

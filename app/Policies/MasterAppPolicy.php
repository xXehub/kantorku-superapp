<?php

namespace App\Policies;

use App\Models\MasterApp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MasterAppPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MasterApp $masterApp): bool
    {
        return $user->isSuperAdmin() || $user->hasAppAccess($masterApp->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MasterApp $masterApp): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        // User can update if they created the app or have admin role
        return $masterApp->created_by === $user->id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MasterApp $masterApp): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        // User can delete if they created the app or have admin role
        return $masterApp->created_by === $user->id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MasterApp $masterApp): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MasterApp $masterApp): bool
    {
        return $user->isSuperAdmin();
    }
}

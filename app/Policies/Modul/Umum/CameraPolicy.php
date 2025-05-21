<?php

namespace App\Policies\Modul\Umum;

use App\Models\Modul\Auth\User;
use App\Models\Modul\Umum\Camera;
use Illuminate\Auth\Access\Response;

class CameraPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-cameras');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Camera $camera): bool
    {
        return $user->can('view-cameras');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create-cameras');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Camera $camera): bool
    {
        return $user->can('edit-cameras');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Camera $camera): bool
    {
        return $user->can('delete-cameras');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Camera $camera): bool
    {
        return $user->can('restore-cameras');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Camera $camera): bool
    {
        return $user->can('force-delete-cameras');
    }

    public function manage(User $user): bool
    {
        return $user->can('manage-cameras');
    }
}

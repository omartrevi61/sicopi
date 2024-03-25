<?php

namespace App\Policies;

use App\Models\Administrativo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdministrativoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Administrador']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Administrador']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Administrativo $administrativo): bool
    {
        return $user->hasAnyRole(['Administrador']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Administrativo $administrativo): bool
    {
        return $user->hasAnyRole(['Administrador']);
    }
}

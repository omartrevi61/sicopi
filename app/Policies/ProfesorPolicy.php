<?php

namespace App\Policies;

use App\Models\Profesor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProfesorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Administrador', 'Operador', 'Profesor']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Administrador', 'Operador']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Profesor $profesor): bool
    {
        return $user->hasAnyRole(['Administrador', 'Operador']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Profesor $profesor): bool
    {
        return $user->hasAnyRole(['Administrador']);
    }
}

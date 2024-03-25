<?php

namespace App\Policies;

use App\Models\Provedor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProvedorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Administrador', 'Operador', 'Consultor']);
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
    public function update(User $user, Provedor $provedor): bool
    {
        return $user->hasAnyRole(['Administrador', 'Operador']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Provedor $provedor): bool
    {
        return $user->hasAnyRole(['Administrador']);
    }
}

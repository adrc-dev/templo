<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function changeRole(User $authUser, User $targetUser, string $newRole): bool
    {
        // No puede cambiarse a sí mismo si es admin
        if ($authUser->id === $targetUser->id && $authUser->role === User::ROLE_ADMIN) {
            return false;
        }

        // Operador no puede modificar admins ni otros operadores
        if ($authUser->role === User::ROLE_OPERATOR) {
            if (in_array($targetUser->role, [User::ROLE_ADMIN, User::ROLE_OPERATOR])) {
                return false;
            }

            // operador solo puede asignar rol 'socio' o 'user'
            return in_array($newRole, [User::ROLE_SOCIO, User::ROLE_USER]);
        }

        // Solo admin puede cambiar el rol de otro admin
        if ($targetUser->role === User::ROLE_ADMIN && $authUser->role !== User::ROLE_ADMIN) {
            return false;
        }

        return true;
    }

    public function delete(User $authUser, User $user): bool
    {
        // Un admin no puede borrarse a sí mismo
        if ($authUser->id === $user->id) {
            return false;
        }

        // Solo los admins pueden borrar usuarios (que no sean ellos mismos)
        return $authUser->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}

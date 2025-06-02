<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * Política de autorización para acciones relacionadas con usuarios.
 *
 * Define qué roles pueden modificar, eliminar o asignar roles a otros usuarios.
 */
class UserPolicy
{
    /**
     * Determina si el usuario autenticado puede cambiar el rol de otro usuario.
     *
     * @param  User    $authUser   Usuario que realiza la acción.
     * @param  User    $targetUser Usuario cuyo rol se desea cambiar.
     * @param  string  $newRole    Rol que se desea asignar.
     * @return bool
     */
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

    /**
     * Determina si el usuario autenticado puede eliminar a otro usuario.
     *
     * @param  User  $authUser Usuario que realiza la acción.
     * @param  User  $user     Usuario que se desea eliminar.
     * @return bool
     */
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
     * Determina si el usuario puede ver la lista de modelos de usuario.
     *
     * @param  User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede ver un modelo de usuario específico.
     *
     * @param  User  $user
     * @param  User  $model
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede crear un nuevo modelo de usuario.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede actualizar un modelo de usuario.
     *
     * @param  User  $user
     * @param  User  $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede restaurar un modelo de usuario.
     *
     * @param  User  $user
     * @param  User  $model
     * @return bool
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente un modelo de usuario.
     *
     * @param  User  $user
     * @param  User  $model
     * @return bool
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}

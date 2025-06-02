<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * Actualiza el rol de un usuario tras validar y autorizar la acción.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRole(Request $request, User $user)
    {
        // Validar rol recibido en la petición
        $request->validate([
            'role' => ['required', 'in:user,socio,operator,admin'],
        ]);

        // Comprobar autorización mediante policy
        $this->authorize('changeRole', [$user, $request->role]);

        // Verificar que no se deje sin administradores
        if (
            $user->role === User::ROLE_ADMIN &&
            $request->role !== User::ROLE_ADMIN &&
            User::where('role', User::ROLE_ADMIN)->count() === 1
        ) {
            return redirect()->back()->with('error', 'users.at_least_one_admin');
        }

        // Actualizar rol
        $user->update(['role' => $request->role]);

        return back()->with('success', 'users.role_updated');
    }

    /**
     * Activa la membresía de un usuario mediante el comprobante pendiente más reciente.
     * Añade 30 días a la expiración si ya existía una membresía activa.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateMembership(User $user)
    {
        // Buscar el comprobante pendiente más reciente
        $member = $user->memberships()->where('status', 'pending')->latest()->first();

        if (!$member) {
            return redirect()->back()->with('error', 'users.proof_not_found');
        }

        // Cambiar estado del comprobante a activo
        $member->status = 'active';
        $member->save();

        $now = Carbon::now();

        // Actualizar fecha de expiración sumando 30 días
        if ($user->membership_expires_at && $user->membership_expires_at->isFuture()) {
            $user->membership_expires_at = Carbon::parse($user->membership_expires_at)->addDays(30);
        } else {
            $user->membership_expires_at = $now->addDays(30);
        }

        // Cambiar rol a socio
        $user->role = 'socio';
        $user->save();

        return redirect()->back()->with('success', 'users.membership_activated');
    }

    /**
     * Elimina un usuario tras autorizar la acción.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        // Autorizar eliminación
        $this->authorize('delete', $user);

        // Eliminar usuario
        $user->delete();

        return back()->with('success', 'users.user_deleted');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    use AuthorizesRequests;
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'in:user,socio,operator,admin'],
        ]);

        // Comprobar autorización
        $this->authorize('changeRole', [$user, $request->role]);

        // Verificar si es el último admin
        if (
            $user->role === User::ROLE_ADMIN &&
            $request->role !== User::ROLE_ADMIN &&
            User::where('role', User::ROLE_ADMIN)->count() === 1
        ) {
            return redirect()->back()->with('error', 'Debe haber al menos un admin.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Rol actualizado correctamente.');
    }

    public function activateMembership(User $user)
    {
        $member = $user->memberships()->where('status', 'pending')->latest()->first();

        if (!$member) {
            return redirect()->back()->with('error', 'No se encontró comprobante.');
        }

        // Cambiar estado del comprobante
        $member->status = 'active';
        $member->save();

        // Si ya tiene membresía activa, sumamos 30 días desde la fecha actual de expiración
        $now = Carbon::now();

        if ($user->membership_expires_at && $user->membership_expires_at->isFuture()) {
            $user->membership_expires_at = Carbon::parse($user->membership_expires_at)->addDays(30);
        } else {
            $user->membership_expires_at = $now->addDays(30);
        }

        $user->role = 'socio';
        $user->save();

        return redirect()->back()->with('success', 'Membresía activada con éxito');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}

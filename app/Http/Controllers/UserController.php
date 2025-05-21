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
            return response()->json(['error' => 'Debe haber al menos un admin.'], 403);
        }

        $user->update(['role' => $request->role]);

        return back()->with('message', 'Rol actualizado correctamente.');
    }

    public function activateMembership(User $user)
    {
        $member = $user->memberships()->where('status', 'pending')->latest()->first();

        if (!$member) {
            return response()->json(['error' => 'No se encontró comprobante.'], 404);
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

        return response()->json([
            'message' => 'Sociedad activada por 30 días.',
            'expires_at' => $user->membership_expires_at,
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        return back()->with('message', 'Usuario eliminado correctamente.');
    }
}

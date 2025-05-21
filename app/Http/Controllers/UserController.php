<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        return back()->with('message', 'Usuario eliminado correctamente.');
    }
}

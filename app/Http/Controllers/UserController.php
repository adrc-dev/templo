<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'in:user,socio,operator,admin'],
        ]);

        $authUser = $request->user();

        if ($authUser->role === 'operator' && $user->role === 'admin') {
            return response()->json(['error' => 'No tienes permiso para modificar al administrador.'], 403);
        }

        if ($authUser->role === 'operator' && $user->role === 'operator') {
            return response()->json(['error' => 'No tienes permiso para modificar a otro operador.'], 403);
        }

        if ($authUser->role === 'admin' && $user->role === 'admin') {
            return response()->json(['error' => 'No puedes modificar tu propio rol.'], 403);
        }

        if (
            $user->role === 'admin' &&
            $request->role !== 'admin' &&
            User::where('role', 'admin')->count() === 1
        ) {
            return response()->json(['error' => 'Debe haber al menos un admin.'], 403);
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('message', 'Rol actualizado correctamente.');
    }
}

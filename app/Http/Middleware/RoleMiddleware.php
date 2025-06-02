<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Maneja una petición entrante.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$roles  Roles permitidos para acceder a la ruta
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verificar si el rol del usuario autenticado NO está dentro de los roles permitidos
        if (!in_array($request->user()->role, $roles)) {
            // Si no está autorizado, detener la ejecución y responder con error 403
            abort(403, 'Unauthorized');
        }

        // Si está autorizado, continuar con la siguiente etapa del middleware / petición
        return $next($request);
    }
}

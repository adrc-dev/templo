<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Muestra el listado paginado de usuarios con opción de búsqueda por nombre, apellido o email.
     * Carga además la relación 'memberships' para cada usuario.
     *
     * @param  \Illuminate\Http\Request  $request Petición HTTP que puede contener el parámetro 'search'
     * @return \Inertia\Response Vista Inertia con la lista paginada de usuarios
     */
    public function index(Request $request)
    {
        // Iniciar consulta base sobre el modelo User
        $query = User::query();

        // Comprobar si existe el parámetro 'search' y no está vacío para aplicar filtro
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;

            // Aplicar filtro buscando coincidencias parciales (LIKE) en nombre, apellido o email
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('surname', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        // Ejecutar la consulta con la relación memberships cargada,
        // ordenar por id ascendente, paginar con 10 resultados por página,
        // y conservar los parámetros de la query string para mantener el estado en la paginación
        $users = $query
            ->with('memberships')
            ->orderBy('id', 'asc')
            ->paginate(10)
            ->withQueryString();

        // Renderizar la vista 'Dashboard/Index' usando Inertia, pasando los usuarios paginados
        return Inertia::render('Dashboard/Index', [
            'users' => $users,
        ]);
    }
}

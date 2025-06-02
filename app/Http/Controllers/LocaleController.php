<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Establece el idioma de la sesión según la selección del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function set(Request $request)
    {
        // Validar que el parámetro 'locale' esté presente y sea uno de los idiomas permitidos
        $request->validate([
            'locale' => 'required|string|in:es,en,pt',
        ]);

        // Guardar el idioma seleccionado en la sesión
        session(['locale' => $request->locale]);

        // Redirigir a la página anterior con un mensaje de éxito
        return redirect()->back()->with('success', 'locale.change_success');
    }
}

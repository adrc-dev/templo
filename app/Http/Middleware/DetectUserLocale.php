<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DetectUserLocale
{
    /**
     * Maneja la petición entrante para detectar y establecer el idioma del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Definir los idiomas soportados por la aplicación
        $supportedLocales = ['es', 'en', 'pt'];

        // Obtener los primeros dos caracteres del encabezado HTTP_ACCEPT_LANGUAGE
        // que indican el idioma preferido del navegador del usuario
        $browserLocale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        // Comprobar si el idioma detectado del navegador está dentro de los soportados
        // Si es así, usarlo; si no, usar el idioma por defecto definido en la configuración
        // También se revisa si ya existe un locale guardado en sesión para persistencia
        $locale = session('locale', in_array($browserLocale, $supportedLocales) ? $browserLocale : config('app.locale'));

        // Establecer el idioma activo de la aplicación según el locale detectado o guardado
        App::setLocale($locale);

        // Guardar el locale en la sesión para mantenerlo en futuras peticiones
        session(['locale' => $locale]);

        // Continuar con la siguiente etapa del middleware / petición
        return $next($request);
    }
}

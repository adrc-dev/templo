<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    /**
     * Registra al usuario autenticado en un evento.
     *
     * @param  Request  $request
     * @param  Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Event $event)
    {
        $user = Auth::user();

        // Comprobar si el usuario ya está inscrito en el evento para evitar registros duplicados
        if ($event->registeredUsers()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'events.already_registered');
        }

        // Adjuntar el usuario a la relación muchos a muchos (registrados)
        $event->registeredUsers()->attach($user->id);

        return back()->with('success', 'events.registration_success');
    }

    /**
     * Elimina la inscripción del usuario autenticado en un evento.
     *
     * @param  Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Event $event)
    {
        $user = Auth::user();

        // Verificar si el usuario está inscrito para permitir la baja
        if ($event->registeredUsers()->where('user_id', $user->id)->exists()) {
            // Quitar al usuario de la relación muchos a muchos
            $event->registeredUsers()->detach($user->id);
            return back()->with('success', 'events.unregistration_success');
        }

        // Si el usuario no estaba inscrito, mostrar error
        return back()->with('error', 'events.not_registered');
    }
}

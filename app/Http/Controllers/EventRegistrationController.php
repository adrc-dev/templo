<?php

namespace App\Http\Controllers;


use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $user = Auth::user();

        if ($event->registeredUsers()->where('user_id', $user->id)->exists()) {
            return back()->with('message', 'Ya estás inscrito/a en este evento.');
        }

        $event->registeredUsers()->attach($user->id);

        return back()->with('message', 'Inscripción realizada correctamente.');
    }
    public function destroy(Event $event)
    {
        $user = auth()->user();

        if ($event->registeredUsers()->where('user_id', $user->id)->exists()) {
            $event->registeredUsers()->detach($user->id);
            return back()->with('message', 'Te has desinscrito del evento.');
        }

        return back()->with('message', 'No estás inscrito en este evento.');
    }
}

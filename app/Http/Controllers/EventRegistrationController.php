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
            return back()->with('error', 'events.already_registered');
        }

        $event->registeredUsers()->attach($user->id);

        return back()->with('success', 'events.registration_success');
    }

    public function destroy(Event $event)
    {
        $user = Auth::user();

        if ($event->registeredUsers()->where('user_id', $user->id)->exists()) {
            $event->registeredUsers()->detach($user->id);
            return back()->with('success', 'events.unregistration_success');
        }

        return back()->with('error', 'events.not_registered');
    }
}

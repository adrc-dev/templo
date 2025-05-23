<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('is_active', true)
            ->whereDate('event_date', '>=', now())
            ->orderBy('event_date')
            ->get();

        return Inertia::render('Events/Index', [
            'events' => $events,
        ]);
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        return Inertia::render('Events/Show', [
            'event' => $event,
            'isSubscribed' => Auth::check() && $event->registeredUsers()->where('user_id', Auth::id())->exists(),
            'userRole' => Auth::check() ? Auth::user()->role : null,
        ]);
    }

    public function attendees(Event $event)
    {
        $event->load('registeredUsers');

        return Inertia::render('Events/Attendees', [
            'event' => $event,
            'inscritos' => $event->registeredUsers,
            'inscritosCount' => $event->registeredUsers->count(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\Events\StoreEventRequest;
use App\Http\Requests\Events\UpdateEventRequest;
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
            'suscribeCount' => $event->registeredUsers->count(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Events/Create');
    }

    public function store(StoreEventRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('events', 'public');
            $validated['featured_image'] = $path;
        }

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'events.event_created');
    }

    public function edit(Event $event)
    {
        return Inertia::render('Events/Edit', [
            'event' => $event
        ]);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('events', 'public');
            $validated['featured_image'] = $path;
        } else {
            $validated['featured_image'] = $event->featured_image;
        }

        $event->update($validated);

        return redirect()->route('events.show', $event->slug)->with('success', 'events.event_updated');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events')->with('success', 'events.event_deleted');
    }

    public function attendees(Event $event)
    {
        $event->load('registeredUsers');

        return Inertia::render('Events/Attendees', [
            'event' => $event,
            'inscritos' => $event->registeredUsers,
            'suscribeCount' => $event->registeredUsers->count(),
        ]);
    }

    public function adminEvents()
    {
        $activeEvents = Event::where('is_active', true)
            ->whereDate('event_date', '>=', now())
            ->orderBy('event_date')
            ->get();

        $pastEvents = Event::where('is_active', true)
            ->whereDate('event_date', '<', now())
            ->orderBy('event_date')
            ->get();

        $inactiveEvents = Event::where('is_active', false)
            ->orderBy('event_date')
            ->get();

        return Inertia::render('Events/AdminEvents', [
            'activeEvents' => $activeEvents,
            'inactiveEvents' => $inactiveEvents,
            'pastEvents' => $pastEvents,
        ]);
    }

    public function toggleStatus(Event $event)
    {
        $event->is_active = !$event->is_active;
        $event->save();

        return back()->with('success', 'events.status_updated');
    }
}

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
            'suscribeCount' => $event->registeredUsers->count(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Events/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:events,slug',
            'content' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'event_end_date' => 'nullable|date|after_or_equal:event_date',
            'event_end_time' => 'nullable',
            'event_location' => 'required|string',
            'modality' => 'required|string',
            'price' => 'numeric',
            'currency' => 'nullable|string|max:3',
            'featured_image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'language' => 'nullable|string|max:2',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('events', 'public');
            $validated['featured_image'] = $path;
        }

        Event::create($validated);

        return redirect()->route('events.index')->with('message', 'Evento creado correctamente.');
    }

    public function edit(Event $event)
    {
        return Inertia::render('Events/Edit', [
            'event' => $event
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:events,slug,' . $event->id,
            'content' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'event_end_date' => 'nullable|date|after_or_equal:event_date',
            'event_end_time' => 'nullable',
            'event_location' => 'required|string',
            'modality' => 'required|string',
            'price' => 'nullable|numeric',
            'currency' => 'nullable|string|max:3',
            'featured_image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'language' => 'required|string|max:2',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('events', 'public');
            $validated['featured_image'] = $path;
        } else {
            $validated['featured_image'] = $event->featured_image;
        }

        $event->update($validated);

        return redirect()->route('events.index')->with('message', 'Evento actualizado correctamente.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('message', 'Evento eliminado correctamente.');
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
}

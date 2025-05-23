<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::where('is_active', true)
            ->whereDate('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(3) // opcional: solo los 3 primeros
            ->get();

        return Inertia::render('Home', [
            'events' => $events,
        ]);
    }
}

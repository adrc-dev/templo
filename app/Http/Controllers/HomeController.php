<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use App\Services\DeepLService;

class HomeController extends Controller
{
    public function index(DeepLService $deepl)
    {
        $locale = App::getLocale();

        $events = Event::where('is_active', true)
            ->whereDate('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(3)
            ->get();

        foreach ($events as $event) {
            if (strtolower($locale) !== strtolower($event->language)) {
                $event->title = Cache::remember(
                    "event_{$event->id}_title_{$locale}",
                    21600,
                    function () use ($deepl, $event, $locale) {
                        return $deepl->translate($event->title, $locale, $event->language);
                    }
                );

                $event->content = Cache::remember(
                    "event_{$event->id}_content_{$locale}",
                    21600,
                    function () use ($deepl, $event, $locale) {
                        return $deepl->translate($event->content, $locale, $event->language);
                    }
                );
            }
        }

        return Inertia::render('Home', [
            'events' => $events,
        ]);
    }
}

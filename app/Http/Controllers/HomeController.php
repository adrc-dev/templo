<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use App\Services\DeepLService;

class HomeController extends Controller
{
    /**
     * Muestra la página principal con los próximos eventos activos traducidos si es necesario.
     *
     * @param DeepLService $deepl Servicio para traducción automática.
     * @return \Inertia\Response
     */
    public function index(DeepLService $deepl)
    {
        $locale = App::getLocale();

        // Obtener los próximos 3 eventos activos y futuros ordenados por fecha
        $events = Event::where('is_active', true)
            ->whereDate('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(3)
            ->get();

        // Traducir título y contenido de los eventos si el idioma actual es distinto al original
        foreach ($events as $event) {
            if (strtolower($locale) !== strtolower($event->language)) {
                // Cachear la traducción del título para evitar llamadas repetidas al servicio
                $event->title = Cache::remember(
                    "event_{$event->id}_title_{$locale}",
                    21600, // 6 horas en segundos
                    function () use ($deepl, $event, $locale) {
                        return $deepl->translate($event->title, $locale, $event->language);
                    }
                );

                // Cachear la traducción del contenido para mejorar rendimiento
                $event->content = Cache::remember(
                    "event_{$event->id}_content_{$locale}",
                    21600,
                    function () use ($deepl, $event, $locale) {
                        return $deepl->translate($event->content, $locale, $event->language);
                    }
                );
            }
        }

        // Renderizar la vista principal con los eventos traducidos si aplica
        return Inertia::render('Home', [
            'events' => $events,
        ]);
    }
}

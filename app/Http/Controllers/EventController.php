<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\Events\StoreEventRequest;
use App\Http\Requests\Events\UpdateEventRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Services\DeepLService;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    /**
     * Muestra el listado de eventos activos con fecha igual o posterior a hoy,
     * traduciendo título y contenido si el idioma del evento difiere del idioma actual.
     *
     * @param DeepLService $deepl Servicio para traducción automática
     * @return \Inertia\Response Vista con listado de eventos
     */
    public function index(DeepLService $deepl)
    {
        $locale = app()->getLocale();

        // Obtener eventos activos con fecha actual o futura, ordenados por fecha ascendente
        $events = Event::where('is_active', true)
            ->whereDate('event_date', '>=', now())
            ->orderBy('event_date')
            ->get();

        // Traducir título y contenido si el idioma del evento no coincide con el idioma actual
        foreach ($events as $event) {
            if (strtolower($locale) !== strtolower($event->language)) {
                // Cachear traducción por 6 horas para evitar llamadas repetidas a DeepL
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

        // Renderizar vista con los eventos (ya traducidos si aplica)
        return Inertia::render('Events/Index', [
            'events' => $events,
        ]);
    }

    /**
     * Muestra el detalle de un evento específico identificado por su slug,
     * incluyendo traducción si es necesario y estado de inscripción del usuario autenticado.
     *
     * @param string $slug Identificador único del evento
     * @param DeepLService $deepl Servicio para traducción automática
     * @return \Inertia\Response Vista con detalle del evento
     */
    public function show($slug, DeepLService $deepl)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $locale = app()->getLocale();

        // Traducir título y contenido si el idioma del evento difiere del idioma actual
        // Cachear traducción por 6 horas para evitar llamadas repetidas a DeepL
        if (strtolower($locale) !== strtolower($event->language)) {
            $event->title = Cache::remember("event_{$event->id}_title_{$locale}", 21600, function () use ($deepl, $event, $locale) {
                return $deepl->translate($event->title, $locale, $event->language);
            });

            $event->content = Cache::remember("event_{$event->id}_content_{$locale}", 21600, function () use ($deepl, $event, $locale) {
                return $deepl->translate($event->content, $locale, $event->language);
            });
        }

        // Determinar si el usuario autenticado está inscrito en el evento
        $isSubscribed = Auth::check() && $event->registeredUsers()->where('user_id', Auth::id())->exists();

        // Contar usuarios inscritos para mostrar en la vista
        $subscribeCount = $event->registeredUsers->count();

        // Renderizar vista detalle con datos y estado de inscripción
        return Inertia::render('Events/Show', [
            'event' => $event,
            'isSubscribed' => $isSubscribed,
            'suscribeCount' => $subscribeCount,
        ]);
    }

    /**
     * Renderiza el formulario para crear un nuevo evento.
     *
     * @return \Inertia\Response Vista con formulario de creación
     */
    public function create()
    {
        return Inertia::render('Events/Create');
    }

    /**
     * Almacena un nuevo evento en la base de datos con los datos validados.
     * Si se sube una imagen destacada, se guarda y se actualiza la ruta en los datos.
     *
     * @param StoreEventRequest $request Petición con validación específica para creación de eventos
     * @return \Illuminate\Http\RedirectResponse Redirección al listado de eventos con mensaje de éxito
     */
    public function store(StoreEventRequest $request)
    {
        $validated = $request->validated();

        // Si hay imagen destacada, almacenarla en disco público y actualizar ruta validada
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('events', 'public');
            $validated['featured_image'] = $path;
        }

        // Crear nuevo evento con los datos validados
        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'events.event_created');
    }

    /**
     * Renderiza el formulario de edición con los datos del evento indicado.
     *
     * @param Event $event Evento a editar
     * @return \Inertia\Response Vista con formulario de edición
     */
    public function edit(Event $event)
    {
        return Inertia::render('Events/Edit', [
            'event' => $event
        ]);
    }

    /**
     * Actualiza un evento existente con los datos validados.
     * Si se sube una nueva imagen destacada, se actualiza la ruta; si no, se mantiene la antigua.
     *
     * @param UpdateEventRequest $request Petición con validación específica para actualización
     * @param Event $event Evento a actualizar
     * @return \Illuminate\Http\RedirectResponse Redirección al detalle del evento con mensaje de éxito
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $validated = $request->validated();

        // Actualizar imagen destacada si se subió nueva; si no, conservar la existente
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('events', 'public');
            $validated['featured_image'] = $path;
        } else {
            $validated['featured_image'] = $event->featured_image;
        }

        // Actualizar evento con los datos validados
        $event->update($validated);

        return redirect()->route('events.show', $event->slug)->with('success', 'events.event_updated');
    }

    /**
     * Elimina un evento de la base de datos.
     *
     * @param Event $event Evento a eliminar
     * @return \Illuminate\Http\RedirectResponse Redirección al listado de eventos admin con mensaje de éxito
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events')->with('success', 'events.event_deleted');
    }

    /**
     * Muestra la lista de usuarios inscritos en un evento específico.
     *
     * @param Event $event Evento cuyos inscritos se desean listar
     * @return \Inertia\Response Vista con datos de inscritos
     */
    public function attendees(Event $event)
    {
        // Cargar relación de usuarios inscritos para evitar consultas N+1
        $event->load('registeredUsers');

        return Inertia::render('Events/Attendees', [
            'event' => $event,
            'inscritos' => $event->registeredUsers,
            'suscribeCount' => $event->registeredUsers->count(),
        ]);
    }

    /**
     * Muestra la gestión de eventos en el panel administrativo,
     * agrupando eventos activos futuros, eventos activos pasados e inactivos.
     *
     * @return \Inertia\Response Vista administrativa con eventos organizados por estado y fecha
     */
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

    /**
     * Cambia el estado activo/inactivo de un evento y guarda el cambio.
     *
     * @param Event $event Evento cuyo estado se desea alternar
     * @return \Illuminate\Http\RedirectResponse Redirección a la página anterior con mensaje de éxito
     */
    public function toggleStatus(Event $event)
    {
        $event->is_active = !$event->is_active;
        $event->save();

        return back()->with('success', 'events.status_updated');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Inertia\Inertia;
use App\Http\Requests\VideoRequest;

class VideoController extends Controller
{
    /**
     * Muestra la lista de videos, ordenados por fecha de creación descendente.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Videos/Index', [
            'videos' => Video::latest()->get(),
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo video.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Videos/Create');
    }

    /**
     * Almacena un nuevo video en la base de datos tras validar la entrada.
     * Extrae el ID de YouTube desde la URL o lo usa directamente si ya es el ID.
     *
     * @param  \App\Http\Requests\VideoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VideoRequest $request)
    {
        $youtubeId = $this->extractYoutubeId($request->youtube_id) ?? $request->youtube_id;

        Video::create([
            'title' => $request->title,
            'youtube_id' => $youtubeId,
            'is_premium' => $request->is_premium,
            'description' => $request->description,
        ]);

        return redirect()->route('videos.index')->with('success', 'videos.created');
    }

    /**
     * Muestra el formulario para editar un video existente.
     *
     * @param  \App\Models\Video  $video
     * @return \Inertia\Response
     */
    public function edit(Video $video)
    {
        return Inertia::render('Videos/Edit', [
            'video' => $video,
        ]);
    }

    /**
     * Actualiza un video existente tras validar la entrada.
     * Extrae el ID de YouTube desde la URL o lo usa directamente si ya es el ID.
     *
     * @param  \App\Http\Requests\VideoRequest  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VideoRequest $request, Video $video)
    {
        $youtubeId = $this->extractYoutubeId($request->youtube_id) ?? $request->youtube_id;

        $video->update([
            'title' => $request->title,
            'youtube_id' => $youtubeId,
            'is_premium' => $request->is_premium,
            'description' => $request->description,
        ]);

        return redirect()->route('videos.index')->with('success', 'videos.updated');
    }

    /**
     * Elimina un video de la base de datos.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'videos.deleted');
    }

    /**
     * Extrae el ID de un video de YouTube a partir de una URL o cadena dada.
     * Soporta URLs estándar y enlaces cortos (youtu.be).
     *
     * @param  string  $url
     * @return string|null
     */
    private function extractYoutubeId(string $url): ?string
    {
        // Parsear la URL para extraer sus componentes
        $parts = parse_url($url);

        if (!isset($parts['host'])) {
            // No es una URL válida
            return null;
        }

        // Si la URL es un enlace corto tipo youtu.be/xyz
        if (strpos($parts['host'], 'youtu.be') !== false) {
            return ltrim($parts['path'], '/'); // Quitar la barra inicial
        }

        // Si es enlace normal tipo youtube.com/watch?v=xyz
        if (strpos($parts['host'], 'youtube.com') !== false) {
            if (!isset($parts['query'])) {
                return null;
            }

            // Extraer parámetros de la query
            parse_str($parts['query'], $queryParams);

            // El ID del video está en el parámetro "v"
            return $queryParams['v'] ?? null;
        }

        // No es un enlace válido de YouTube
        return null;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Inertia\Inertia;
use App\Http\Requests\VideoRequest;

class VideoController extends Controller
{
    public function index()
    {
        return Inertia::render('Videos/Index', [
            'videos' => Video::latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Videos/Create');
    }

    public function store(VideoRequest $request)
    {
        $youtubeId = $this->extractYoutubeId($request->youtube_id) ?? $request->youtube_id;

        Video::create([
            'title' => $request->title,
            'youtube_id' => $youtubeId,
            'is_premium' => $request->is_premium,
            'description' => $request->description,
        ]);

        return redirect()->route('videos.index');
    }

    public function edit(Video $video)
    {
        return Inertia::render('Videos/Edit', [
            'video' => $video,
        ]);
    }

    public function update(VideoRequest $request, Video $video)
    {
        $youtubeId = $this->extractYoutubeId($request->youtube_id) ?? $request->youtube_id;

        $video->update([
            'title' => $request->title,
            'youtube_id' => $youtubeId,
            'is_premium' => $request->is_premium,
            'description' => $request->description,
        ]);

        return redirect()->route('videos.index');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'El vídeo se ha eliminado correctamente.');
    }

    private function extractYoutubeId(string $url): ?string
    {
        // Parsear la URL para sacar query params
        $parts = parse_url($url);

        if (!isset($parts['host'])) {
            return null;
        }

        // Si es un enlace corto tipo youtu.be
        if (strpos($parts['host'], 'youtu.be') !== false) {
            return ltrim($parts['path'], '/');
        }

        // Si es enlace normal youtube.com
        if (strpos($parts['host'], 'youtube.com') !== false) {
            if (!isset($parts['query'])) {
                return null;
            }

            parse_str($parts['query'], $queryParams);

            // El id está en "v"
            return $queryParams['v'] ?? null;
        }

        return null;
    }
}

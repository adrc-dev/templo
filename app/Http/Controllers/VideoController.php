<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'youtube_id' => 'required',
            'is_premium' => 'boolean',
            'description' => 'nullable',
        ]);

        Video::create($request->all());

        return redirect()->route('videos.index');
    }

    public function edit(Video $video)
    {
        return Inertia::render('Videos/Edit', [
            'video' => $video,
        ]);
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required',
            'youtube_id' => 'required',
            'is_premium' => 'boolean',
            'description' => 'nullable',
        ]);

        $video->update($request->all());

        return redirect()->route('videos.index');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index')->with('message', 'El vídeo se ha eliminado correctamente.');
    }
}

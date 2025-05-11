<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|array',
            'content' => 'required|array',
            'event_date' => 'required|date',
            'event_time' => 'nullable|date_format:H:i',
            'modality' => 'required|string|max:255',
            'price' => 'required|numeric',
            'featured_image' => 'required|string',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'og_image' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']['es'] ?? array_values($validated['title'])[0]);

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post creado correctamente.');
    }

    public function show(Post $post)
    {
        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }

    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|array',
            'content' => 'required|array',
            'event_date' => 'required|date',
            'event_time' => 'nullable|date_format:H:i',
            'modality' => 'required|string|max:255',
            'price' => 'required|numeric',
            'featured_image' => 'required|string',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'og_image' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']['es'] ?? array_values($validated['title'])[0]);

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post actualizado.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post eliminado.');
    }
}

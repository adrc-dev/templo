<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Video;
use Inertia\Inertia;

class AulaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Dividir según tipo
        $freeVideosQuery = Video::where('is_premium', false);
        $premiumVideosQuery = Video::where('is_premium', true);

        if (!in_array($user->role, ['socio', 'admin', 'operator'])) {
            $premiumVideos = collect();
        } else {
            $premiumVideos = $premiumVideosQuery->paginate(3, ['*'], 'premium_page');
        }

        $freeVideos = $freeVideosQuery->paginate(3, ['*'], 'free_page');

        return Inertia::render('Aulas', [
            'freeVideos' => $freeVideos,
            'premiumVideos' => $premiumVideos,
        ]);
    }
}

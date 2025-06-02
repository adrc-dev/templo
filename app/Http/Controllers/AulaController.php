<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Video;
use App\Services\DeepLService;
use Inertia\Inertia;

class AulaController extends Controller
{
    public function index(DeepLService $deepl)
    {
        $locale = app()->getLocale();
        $user = Auth::user();

        $freeVideos = Video::where('is_premium', false)->paginate(3, ['*'], 'free_page');
        $premiumVideos = in_array($user->role, ['socio', 'admin', 'operator'])
            ? Video::where('is_premium', true)->paginate(3, ['*'], 'premium_page')
            : null;

        // Traducir colección de videos gratuitos
        $translatedFree = $freeVideos->getCollection()->transform(function ($video) use ($locale, $deepl) {
            return $this->translateVideo($video, $locale, $deepl);
        });
        $freeVideos->setCollection($translatedFree);

        // Traducir colección de videos premium si existen
        if ($premiumVideos) {
            $translatedPremium = $premiumVideos->getCollection()->transform(function ($video) use ($locale, $deepl) {
                return $this->translateVideo($video, $locale, $deepl);
            });
            $premiumVideos->setCollection($translatedPremium);
        }

        return Inertia::render('Aulas', [
            'freeVideos' => $freeVideos,
            'premiumVideos' => $premiumVideos,
        ]);
    }

    protected function translateVideo(Video $video, string $locale, DeepLService $deepl): Video
    {
        // Idioma original: 'es'
        if (strtolower($locale) !== 'es') {
            $video->title = Cache::remember("video_{$video->id}_title_{$locale}", 21600, function () use ($deepl, $video, $locale) {
                return $deepl->translate($video->title, $locale, 'es');
            });

            $video->description = Cache::remember("video_{$video->id}_description_{$locale}", 21600, function () use ($deepl, $video, $locale) {
                return $deepl->translate($video->description, $locale, 'es');
            });
        }

        return $video;
    }
}

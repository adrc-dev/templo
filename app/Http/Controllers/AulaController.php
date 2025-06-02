<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Video;
use App\Services\DeepLService;
use Inertia\Inertia;

class AulaController extends Controller
{
    /**
     * Muestra la página de aulas con videos gratuitos y, si corresponde, videos premium.
     * Traduce los títulos y descripciones usando el servicio DeepL según el idioma actual.
     *
     * @param  \App\Services\DeepLService  $deepl
     * @return \Inertia\Response
     */
    public function index(DeepLService $deepl)
    {
        // Obtener el idioma actual configurado en la aplicación
        $locale = app()->getLocale();

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener videos gratuitos con paginación (3 por página)
        // Se usa una clave de página diferente para evitar conflictos con la paginación de videos premium
        $freeVideos = Video::where('is_premium', false)->paginate(3, ['*'], 'free_page');

        // Obtener videos premium solo si el usuario tiene rol socio, admin u operador
        $premiumVideos = in_array($user->role, ['socio', 'admin', 'operator'])
            ? Video::where('is_premium', true)->paginate(3, ['*'], 'premium_page')
            : null;

        // Traducir títulos y descripciones de los videos gratuitos si el idioma no es español
        $translatedFree = $freeVideos->getCollection()->transform(function ($video) use ($locale, $deepl) {
            return $this->translateVideo($video, $locale, $deepl);
        });

        // Reemplazar la colección original de videos gratuitos por la traducida
        $freeVideos->setCollection($translatedFree);

        // Si existen videos premium, aplicar la misma traducción
        if ($premiumVideos) {
            $translatedPremium = $premiumVideos->getCollection()->transform(function ($video) use ($locale, $deepl) {
                return $this->translateVideo($video, $locale, $deepl);
            });
            $premiumVideos->setCollection($translatedPremium);
        }

        // Renderizar la vista con Inertia pasando las colecciones traducidas
        return Inertia::render('Aulas', [
            'freeVideos' => $freeVideos,
            'premiumVideos' => $premiumVideos,
        ]);
    }

    /**
     * Traduce el título y la descripción de un video usando el servicio DeepL,
     * y cachea el resultado para optimizar rendimiento.
     *
     * @param  \App\Models\Video  $video
     * @param  string  $locale Idioma destino de la traducción
     * @param  \App\Services\DeepLService  $deepl Servicio para realizar la traducción
     * @return \App\Models\Video El video con textos traducidos (si corresponde)
     */
    protected function translateVideo(Video $video, string $locale, DeepLService $deepl): Video
    {
        // Solo se traducen los textos si el idioma no es español (idioma original)
        if (strtolower($locale) !== 'es') {
            // Cachear la traducción del título durante 6 horas (21600 segundos)
            $video->title = Cache::remember("video_{$video->id}_title_{$locale}", 21600, function () use ($deepl, $video, $locale) {
                return $deepl->translate($video->title, $locale, 'es');
            });

            // Cachear la traducción de la descripción también durante 6 horas
            $video->description = Cache::remember("video_{$video->id}_description_{$locale}", 21600, function () use ($deepl, $video, $locale) {
                return $deepl->translate($video->description, $locale, 'es');
            });
        }

        // Retornar el video con los textos traducidos (o sin cambios si es español)
        return $video;
    }
}

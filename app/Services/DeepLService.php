<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Servicio para interactuar con la API de traducción de DeepL.
 *
 * Este servicio utiliza la API gratuita de DeepL para traducir texto entre distintos idiomas.
 */
class DeepLService
{
    /**
     * Clave API de autenticación para DeepL.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * URL base del endpoint de traducción de DeepL.
     *
     * @var string
     */
    protected $baseUrl = 'https://api-free.deepl.com/v2/translate';

    /**
     * Constructor que obtiene la clave API desde el archivo de configuración.
     */
    public function __construct()
    {
        $this->apiKey = config('services.deepl.key');
    }

    /**
     * Traduce un texto utilizando la API de DeepL.
     *
     * @param  string       $text        Texto a traducir.
     * @param  string       $targetLang  Código del idioma de destino (por ejemplo, "ES", "EN").
     * @param  string|null  $sourceLang  Código del idioma de origen (opcional, por ejemplo, "FR").
     * @return string                     Texto traducido. Si hay un error, se devuelve el texto original.
     */
    public function translate(string $text, string $targetLang, ?string $sourceLang = null): string
    {
        $params = [
            'auth_key'    => $this->apiKey,
            'text'        => $text,
            'target_lang' => strtoupper($targetLang),
        ];

        if ($sourceLang) {
            $params['source_lang'] = strtoupper($sourceLang);
        }

        $response = Http::asForm()->post($this->baseUrl, $params);

        if ($response->successful()) {
            $result = $response->json();

            return $result['translations'][0]['text'] ?? $text;
        }

        // En caso de error, devuelve el texto original
        return $text;
    }
}

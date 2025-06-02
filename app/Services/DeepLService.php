<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DeepLService
{
    protected $apiKey;
    protected $baseUrl = 'https://api-free.deepl.com/v2/translate';

    public function __construct()
    {
        $this->apiKey = config('services.deepl.key');
    }

    /**
     * Traduce un texto con DeepL
     *
     * @param string $text Texto a traducir
     * @param string $targetLang Código de idioma destino (p.ej. "ES", "EN")
     * @param string|null $sourceLang Código de idioma origen (opcional)
     * @return string Texto traducido
     */
    public function translate(string $text, string $targetLang, ?string $sourceLang = null): string
    {
        $params = [
            'auth_key' => $this->apiKey,
            'text' => $text,
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Video
 *
 * Representa un vídeo disponible en la plataforma, que puede ser gratuito o premium.
 *
 * @property int $id
 * @property string $title Título del vídeo
 * @property string|null $description Descripción del contenido del vídeo
 * @property string $youtube_id Identificador del vídeo en YouTube
 * @property bool $is_premium Indica si el vídeo es exclusivo para socios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Video extends Model
{
    /**
     * Atributos que pueden ser asignados masivamente.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'youtube_id',
        'is_premium',
    ];

    /**
     * Conversión de atributos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_premium' => 'boolean',
    ];
}

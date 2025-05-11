<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'event_date',
        'event_time',
        'modality',
        'price',
        'featured_image',
        'is_active',
        'meta_title',
        'meta_description',
        'og_image',
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'is_active' => 'boolean',
        'event_date' => 'date',
        'event_time' => 'datetime:H:i',
    ];

    // Relación con imágenes adicionales
    public function images()
    {
        return $this->hasMany(EventImage::class);
    }

    // Accessor para obtener título en el idioma actual
    public function getLocalizedTitle(string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->title[$locale] ?? $this->title['es'] ?? array_values($this->title)[0] ?? '';
    }

    public function getLocalizedContent(string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->content[$locale] ?? $this->content['es'] ?? array_values($this->content)[0] ?? '';
    }

    // Usar slug en lugar de ID en las rutas
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

/**
 * Modelo Event
 *
 * Representa un evento que puede tener usuarios registrados.
 *
 * @property int $id
 * @property string $title Título del evento
 * @property string $slug Slug amigable para la URL
 * @property string $content Contenido o descripción del evento
 * @property \Illuminate\Support\Carbon|null $event_date Fecha de inicio del evento
 * @property \Illuminate\Support\Carbon|null $event_end_date Fecha de finalización del evento
 * @property \Illuminate\Support\Carbon|null $event_time Hora de inicio del evento (formato H:i)
 * @property \Illuminate\Support\Carbon|null $event_end_time Hora de finalización del evento (formato H:i)
 * @property string|null $event_location Lugar donde se realiza el evento
 * @property string|null $modality Modalidad (presencial, online, híbrida, etc.)
 * @property string|null $price Precio del evento
 * @property string|null $currency Moneda del precio (por ejemplo, EUR, USD)
 * @property string|null $featured_image Imagen destacada del evento
 * @property bool $is_active Indica si el evento está activo o no
 * @property string|null $language Idioma del evento
 * @property string|null $seo_title Título SEO
 * @property string|null $seo_description Descripción SEO
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $registeredUsers
 */
class Event extends Model
{
    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'event_date',
        'event_end_date',
        'event_time',
        'event_end_time',
        'event_location',
        'modality',
        'price',
        'currency',
        'featured_image',
        'is_active',
        'language',
        'seo_title',
        'seo_description'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos específicos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event_date' => 'date',
        'event_end_date' => 'date',
        'event_time' => 'datetime:H:i',
        'event_end_time' => 'datetime:H:i',
        'is_active' => 'boolean',
    ];

    /**
     * Relación con los usuarios registrados en el evento.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function registeredUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_registrations')->withTimestamps();
    }
}

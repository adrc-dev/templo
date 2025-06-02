<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Modelo User
 *
 * Representa a un usuario registrado en la aplicación.
 *
 * @property int $id
 * @property string $name Nombre del usuario
 * @property string|null $surname Apellido del usuario
 * @property string|null $phone Teléfono de contacto
 * @property string $email Correo electrónico
 * @property string $password Contraseña hasheada
 * @property string $role Rol del usuario (user, socio, operator, admin)
 * @property Carbon|null $email_verified_at Fecha de verificación del email
 * @property Carbon|null $membership_expires_at Fecha de caducidad de la membresía (si aplica)
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Member[] $memberships Membresías asociadas al usuario
 * @property-read Event[] $eventRegistrations Eventos a los que el usuario se ha inscrito
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_USER = 'user';
    public const ROLE_SOCIO = 'socio';
    public const ROLE_OPERATOR = 'operator';
    public const ROLE_ADMIN = 'admin';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'password',
        'role',
    ];

    /**
     * Los atributos que deben ocultarse al serializar el modelo.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversión de atributos a tipos nativos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'membership_expires_at' => 'datetime',
        ];
    }

    /**
     * Relación con las solicitudes de membresía del usuario.
     *
     * @return HasMany<Member>
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    /**
     * Relación con los eventos a los que el usuario se ha registrado.
     *
     * @return BelongsToMany<Event>
     */
    public function eventRegistrations(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_registrations')->withTimestamps();
    }

    /**
     * Verifica si el usuario tiene rol administrador.
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Verifica si el usuario tiene rol operador.
     */
    public function isOperator(): bool
    {
        return $this->role === self::ROLE_OPERATOR;
    }

    /**
     * Verifica si el usuario tiene rol socio.
     */
    public function isSocio(): bool
    {
        return $this->role === self::ROLE_SOCIO;
    }
}

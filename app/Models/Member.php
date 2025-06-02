<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

/**
 * Modelo Member
 *
 * Representa una solicitud de membresía de un usuario.
 *
 * @property int $id
 * @property int $user_id ID del usuario solicitante
 * @property string|null $payment_proof_path Ruta del archivo con el comprobante de pago
 * @property string $status Estado de la membresía (pendiente, aprobada, rechazada, etc.)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read User $user Usuario asociado a la membresía
 */
class Member extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'memberships';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'payment_proof_path',
        'status',
    ];

    /**
     * Relación con el usuario propietario de la solicitud de membresía.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

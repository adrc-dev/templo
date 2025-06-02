<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     *
     * Solo usuarios autenticados con rol 'admin' u 'operator' pueden continuar.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud para crear o actualizar videos.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'youtube_id' => 'required|string',
            'is_premium' => 'boolean',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Mensajes personalizados para errores de validación.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'validation.videos.title.required',
            'youtube_id.required' => 'validation.videos.youtube_id.required',
            'is_premium.boolean' => 'validation.videos.is_premium.boolean',
        ];
    }
}

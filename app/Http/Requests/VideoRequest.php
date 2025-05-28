<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'youtube_id' => 'required|string',
            'is_premium' => 'boolean',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'youtube_id.required' => 'El enlace o ID de YouTube es obligatorio.',
            'is_premium.boolean' => 'El campo premium debe ser verdadero o falso.',
        ];
    }
}

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
            'title.required' => 'validation.videos.title.required',
            'youtube_id.required' => 'validation.videos.youtube_id.required',
            'is_premium.boolean' => 'validation.videos.is_premium.boolean',
        ];
    }
}

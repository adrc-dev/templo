<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:events,slug',
            'content' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'event_end_date' => 'nullable|date|after_or_equal:event_date',
            'event_end_time' => 'nullable',
            'event_location' => 'required|string',
            'modality' => 'required|string',
            'price' => 'nullable|numeric',
            'currency' => 'nullable|string|max:3',
            'featured_image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'language' => 'nullable|string|max:2',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede superar los 255 caracteres.',

            'slug.required' => 'El slug es obligatorio.',
            'slug.max' => 'El slug no puede superar los 255 caracteres.',
            'slug.unique' => 'Ya existe un evento con ese slug.',

            'content.required' => 'El contenido es obligatorio.',

            'event_date.required' => 'La fecha del evento es obligatoria.',
            'event_date.date' => 'La fecha del evento debe ser válida.',

            'event_time.required' => 'La hora del evento es obligatoria.',

            'event_end_date.date' => 'La fecha de fin debe ser válida.',
            'event_end_date.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha del evento.',

            'event_location.required' => 'La localización es obligatoria.',

            'modality.required' => 'La modalidad es obligatoria.',

            'price.numeric' => 'El precio debe ser un número.',

            'currency.max' => 'El código de moneda no puede tener más de 3 caracteres.',

            'featured_image.image' => 'La imagen destacada debe ser un archivo de imagen.',
            'featured_image.max' => 'La imagen destacada no puede superar los 2MB.',

            'is_active.boolean' => 'El estado activo debe ser verdadero o falso.',

            'language.max' => 'El idioma debe tener máximo 2 caracteres.',

            'seo_title.max' => 'El título SEO no puede superar los 255 caracteres.',
            'seo_description.max' => 'La descripción SEO no puede superar los 255 caracteres.',
        ];
    }
}

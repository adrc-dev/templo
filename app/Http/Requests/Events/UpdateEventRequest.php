<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
    }

    public function rules(): array
    {
        // Obtener el ID del evento para la regla unique
        $eventId = $this->route('event')->id ?? null;

        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('events', 'slug')->ignore($eventId),
            ],
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
            'language' => 'required|string|max:2',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'validation.events.update.title.required',
            'title.max' => 'validation.events.update.title.max',

            'slug.required' => 'validation.events.update.slug.required',
            'slug.max' => 'validation.events.update.slug.max',
            'slug.unique' => 'validation.events.update.slug.unique',

            'content.required' => 'validation.events.update.content.required',

            'event_date.required' => 'validation.events.update.event_date.required',
            'event_date.date' => 'validation.events.update.event_date.date',

            'event_time.required' => 'validation.events.update.event_time.required',

            'event_end_date.date' => 'validation.events.update.event_end_date.date',
            'event_end_date.after_or_equal' => 'validation.events.update.event_end_date.after_or_equal',

            'event_location.required' => 'validation.events.update.event_location.required',

            'modality.required' => 'validation.events.update.modality.required',

            'price.numeric' => 'validation.events.update.price.numeric',

            'currency.max' => 'validation.events.update.currency.max',

            'featured_image.image' => 'validation.events.update.featured_image.image',
            'featured_image.max' => 'validation.events.update.featured_image.max',

            'is_active.boolean' => 'validation.events.update.is_active.boolean',

            'language.required' => 'validation.events.update.language.required',
            'language.max' => 'validation.events.update.language.max',

            'seo_title.max' => 'validation.events.update.seo_title.max',
            'seo_description.max' => 'validation.events.update.seo_description.max',
        ];
    }
}

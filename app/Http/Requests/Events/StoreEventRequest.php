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
            'title.required' => 'validation.events.store.title.required',
            'title.max' => 'validation.events.store.title.max',

            'slug.required' => 'validation.events.store.slug.required',
            'slug.max' => 'validation.events.store.slug.max',
            'slug.unique' => 'validation.events.store.slug.unique',

            'content.required' => 'validation.events.store.content.required',

            'event_date.required' => 'validation.events.store.event_date.required',
            'event_date.date' => 'validation.events.store.event_date.date',

            'event_time.required' => 'validation.events.store.event_time.required',

            'event_end_date.date' => 'validation.events.store.event_end_date.date',
            'event_end_date.after_or_equal' => 'validation.events.store.event_end_date.after_or_equal',

            'event_location.required' => 'validation.events.store.event_location.required',

            'modality.required' => 'validation.events.store.modality.required',

            'price.numeric' => 'validation.events.store.price.numeric',

            'currency.max' => 'validation.events.store.currency.max',

            'featured_image.image' => 'validation.events.store.featured_image.image',
            'featured_image.max' => 'validation.events.store.featured_image.max',

            'is_active.boolean' => 'validation.events.store.is_active.boolean',

            'language.max' => 'validation.events.store.language.max',

            'seo_title.max' => 'validation.events.store.seo_title.max',
            'seo_description.max' => 'validation.events.store.seo_description.max',
        ];
    }
}

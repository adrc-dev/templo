<?php

namespace App\Http\Requests\Settings;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'string',
                'regex:/^\+?[0-9\s\-\(\)]{7,20}$/',
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'validation.settings.profile.update.name.required',
            'name.string' => 'validation.settings.profile.update.name.string',
            'name.max' => 'validation.settings.profile.update.name.max',

            'surname.required' => 'validation.settings.profile.update.surname.required',
            'surname.string' => 'validation.settings.profile.update.surname.string',
            'surname.max' => 'validation.settings.profile.update.surname.max',

            'phone.required' => 'validation.settings.profile.update.phone.required',
            'phone.string' => 'validation.settings.profile.update.phone.string',
            'phone.regex' => 'validation.settings.profile.update.phone.regex',

            'email.required' => 'validation.settings.profile.update.email.required',
            'email.string' => 'validation.settings.profile.update.email.string',
            'email.lowercase' => 'validation.settings.profile.update.email.lowercase',
            'email.email' => 'validation.settings.profile.update.email.email',
            'email.max' => 'validation.settings.profile.update.email.max',
            'email.unique' => 'validation.settings.profile.update.email.unique',
        ];
    }
}

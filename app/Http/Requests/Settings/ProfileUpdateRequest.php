<?php

namespace App\Http\Requests\Settings;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     *
     * Nota: Si se requiere autorización explícita, puede añadirse este método.
     * Por defecto, FormRequest permite todas las solicitudes.
     *
     * @return bool
     */
    // public function authorize(): bool
    // {
    //     return auth()->check();
    // }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud de actualización del perfil.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Nombre requerido, tipo cadena, máximo 255 caracteres
            'name' => ['required', 'string', 'max:255'],

            // Apellido requerido, tipo cadena, máximo 255 caracteres
            'surname' => ['required', 'string', 'max:255'],

            // Teléfono requerido, tipo cadena, con expresión regular para validar formato internacional y local
            'phone' => [
                'required',
                'string',
                'regex:/^\+?[0-9\s\-\(\)]{7,20}$/',
            ],

            // Email requerido, tipo cadena, debe estar en minúsculas, formato válido, máximo 255 caracteres
            // Único en la tabla users, ignorando el email actual del usuario para permitir actualización sin conflicto
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

    /**
     * Define los mensajes personalizados para los errores de validación.
     *
     * @return array<string, string>
     */
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     *
     * En este caso, se permite a cualquier usuario enviar el formulario de contacto.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud de contacto.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            // Nombre requerido, tipo cadena, máximo 255 caracteres
            'name' => 'required|string|max:255',

            // Teléfono requerido, tipo cadena, máximo 25 caracteres
            'phone' => 'required|string|max:25',

            // Email requerido, formato válido de correo, máximo 255 caracteres
            'email' => 'required|email|max:255',

            // Mensaje requerido, tipo cadena (texto libre)
            'message' => 'required|string',

            // Aceptación de política de privacidad, debe estar marcado ("accepted")
            'privacy' => 'accepted',

            // Token de recaptcha para validar humano, requerido y tipo cadena
            'recaptcha_token' => 'required|string',
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
            'name.required' => 'validation.contact.name.required',
            'phone.required' => 'validation.contact.phone.required',
            'email.required' => 'validation.contact.email.required',
            'message.required' => 'validation.contact.message.required',
            'privacy.accepted' => 'validation.contact.privacy.accepted',
            'recaptcha_token.required' => 'validation.contact.recaptcha_token.required',
        ];
    }
}

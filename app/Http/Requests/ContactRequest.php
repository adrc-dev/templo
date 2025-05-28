<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;


class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'privacy' => 'accepted',
            'recaptcha_token' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'phone.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'message.required' => 'El mensaje es obligatorio.',
            'privacy.accepted' => 'Debes aceptar la política de privacidad.',
            'recaptcha_token.required' => 'La verificación de seguridad es obligatoria.',
        ];
    }
}

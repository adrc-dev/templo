<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'lowercase', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', Password::defaults()],
            'recaptcha_token' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',

            'surname.required' => 'Los apellidos son obligatorios.',
            'surname.string' => 'Los apellidos deben ser un texto.',
            'surname.max' => 'Los apellidos no pueden tener más de 255 caracteres.',

            'phone.required' => 'El teléfono es obligatorio.',
            'phone.regex' => 'El formato del teléfono no es válido.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.string' => 'El correo electrónico debe ser un texto.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'email.lowercase' => 'El correo electrónico debe estar en minúsculas.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.*' => 'La contraseña no cumple con los requisitos de seguridad.',

            'recaptcha_token.required' => 'La verificación de seguridad es obligatoria.',
        ];
    }

    protected function passedValidation()
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $this->recaptcha_token,
            'remoteip' => $this->ip(),
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
            throw ValidationException::withMessages([
                'recaptcha_token' => 'La verificación de seguridad falló. Inténtalo de nuevo.',
            ]);
        }
    }
}

<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Permite que cualquier usuario haga esta solicitud (registro público)
        return true;
    }

    /**
     * Define las reglas de validación para el formulario de registro.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            // Nombre requerido, cadena y máximo 255 caracteres
            'name' => 'required|string|max:255',

            // Apellido requerido, cadena y máximo 255 caracteres
            'surname' => 'required|string|max:255',

            // Teléfono requerido con expresión regular para números con posibles símbolos +, -, espacios, paréntesis
            'phone' => ['required', 'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'],

            // Email requerido, cadena, formato válido, máximo 255, forzar minúsculas y único en la tabla users
            'email' => ['required', 'string', 'email', 'max:255', 'lowercase', Rule::unique('users', 'email')],

            // Contraseña requerida, confirmada (coincide con password_confirmation) y con reglas por defecto (seguridad)
            'password' => ['required', 'confirmed', Password::defaults()],

            // Token de reCAPTCHA requerido como cadena
            'recaptcha_token' => ['required', 'string'],
        ];
    }

    /**
     * Define los mensajes de error personalizados para cada regla de validación.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'validation.auth.register.name.required',
            'name.string' => 'validation.auth.register.name.string',
            'name.max' => 'validation.auth.register.name.max',

            'surname.required' => 'validation.auth.register.surname.required',
            'surname.string' => 'validation.auth.register.surname.string',
            'surname.max' => 'validation.auth.register.surname.max',

            'phone.required' => 'validation.auth.register.phone.required',
            'phone.regex' => 'validation.auth.register.phone.regex',

            'email.required' => 'validation.auth.register.email.required',
            'email.string' => 'validation.auth.register.email.string',
            'email.email' => 'validation.auth.register.email.email',
            'email.max' => 'validation.auth.register.email.max',
            'email.lowercase' => 'validation.auth.register.email.lowercase',
            'email.unique' => 'validation.auth.register.email.unique',

            'password.required' => 'validation.auth.register.password.required',
            'password.confirmed' => 'validation.auth.register.password.confirmed',
            'password' => 'validation.auth.register.password.default',

            'recaptcha_token.required' => 'validation.auth.register.recaptcha.required',
        ];
    }

    /**
     * Después de que la validación básica pasa, valida el token de reCAPTCHA con Google.
     *
     * @throws \Illuminate\Validation\ValidationException Si la validación de reCAPTCHA falla
     */
    protected function passedValidation()
    {
        // Realiza una petición POST a la API de Google reCAPTCHA para verificar el token
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'), // Clave secreta del servicio reCAPTCHA
            'response' => $this->recaptcha_token,            // Token enviado desde el frontend
            'remoteip' => $this->ip(),                        // IP del usuario para mayor seguridad
        ]);

        // Obtiene el resultado en formato JSON
        $result = $response->json();

        // Comprueba que la verificación fue exitosa y que el score supera el umbral 0.5
        if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
            // Si falla, lanza una excepción de validación con mensaje personalizado
            throw ValidationException::withMessages([
                'recaptcha_token' => 'validation.auth.register.recaptcha.failed',
            ]);
        }
    }
}

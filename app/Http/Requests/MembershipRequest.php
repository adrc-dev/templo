<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;

class MembershipRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     *
     * En este caso, solo usuarios autenticados pueden enviar esta solicitud.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud de membresía.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // Comprobante de pago obligatorio, debe ser un archivo JPG, JPEG, PNG o PDF, tamaño máximo 2MB
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],

            // Token de reCAPTCHA obligatorio, debe ser cadena
            'recaptcha_token' => ['required', 'string'],
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
            'payment_proof.required' => 'validation.membership.payment_proof.required',
            'payment_proof.file' => 'validation.membership.payment_proof.file',
            'payment_proof.mimes' => 'validation.membership.payment_proof.mimes',
            'payment_proof.max' => 'validation.membership.payment_proof.max',
            'recaptcha_token.required' => 'validation.membership.recaptcha_token.required',
            'recaptcha_token.string' => 'validation.membership.recaptcha_token.string',
        ];
    }

    /**
     * Añade validación adicional después de las reglas iniciales.
     *
     * Valida el token de reCAPTCHA mediante una petición al servicio de Google.
     * Añade error si la validación falla o la puntuación es menor que 0.5.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret'),
                'response' => $this->input('recaptcha_token'),
            ]);

            $result = $response->json();

            if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
                $validator->errors()->add('recaptcha_token', 'validation.membership.recaptcha_token.failed');
            }
        });
    }
}

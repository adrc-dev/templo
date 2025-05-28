<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;

class MembershipRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'recaptcha_token' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'payment_proof.required' => 'El comprobante de pago es obligatorio.',
            'payment_proof.file' => 'El comprobante debe ser un archivo válido.',
            'payment_proof.mimes' => 'El comprobante debe ser un archivo de tipo: jpg, jpeg, png o pdf.',
            'payment_proof.max' => 'El comprobante no debe pesar más de 2MB.',
            'recaptcha_token.required' => 'La verificación de seguridad es obligatoria.',
            'recaptcha_token.string' => 'La verificación de seguridad es inválida.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret'),
                'response' => $this->input('recaptcha_token'),
            ]);

            $result = $response->json();

            if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
                $validator->errors()->add('recaptcha_token', 'La verificación de seguridad falló. Inténtalo de nuevo.');
            }
        });
    }
}

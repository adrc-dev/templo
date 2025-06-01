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
            'payment_proof.required' => 'validation.membership.payment_proof.required',
            'payment_proof.file' => 'validation.membership.payment_proof.file',
            'payment_proof.mimes' => 'validation.membership.payment_proof.mimes',
            'payment_proof.max' => 'validation.membership.payment_proof.max',
            'recaptcha_token.required' => 'validation.membership.recaptcha_token.required',
            'recaptcha_token.string' => 'validation.membership.recaptcha_token.string',
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
                $validator->errors()->add('recaptcha_token', 'validation.membership.recaptcha_token.failed');
            }
        });
    }
}

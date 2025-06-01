<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name.required' => 'validation.contact.name.required',
            'phone.required' => 'validation.contact.phone.required',
            'email.required' => 'validation.contact.email.required',
            'message.required' => 'validation.contact.message.required',
            'privacy.accepted' => 'validation.contact.privacy.accepted',
            'recaptcha_token.required' => 'validation.contact.recaptcha_token.required',
        ];
    }
}

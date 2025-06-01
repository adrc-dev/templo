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
                'recaptcha_token' => 'validation.auth.register.recaptcha.failed',
            ]);
        }
    }
}

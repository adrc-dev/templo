<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Http;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function send(ContactRequest $request)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('recaptcha_token'),
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
            return back()->with(
                'error',
                'contact.recaptcha_failed'
            );
        }

        Mail::to(config('mail.contact'))->send(new ContactFormMail($request->validated()));

        return back()->with('success', 'contact.thank_you_message');
    }
}

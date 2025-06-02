<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Http;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Gestiona el envío del formulario de contacto.
     * Valida el token de reCAPTCHA v3 para evitar envíos automáticos (bots),
     * y envía un correo electrónico con los datos proporcionados si la validación es correcta.
     *
     * @param  \App\Http\Requests\ContactRequest  $request Petición validada del formulario de contacto
     * @return \Illuminate\Http\RedirectResponse Redirige a la página anterior con mensaje de estado
     */
    public function send(ContactRequest $request)
    {
        // Enviar petición POST a la API de Google reCAPTCHA para validar el token recibido desde el frontend
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'), // Clave secreta obtenida de la configuración
            'response' => $request->input('recaptcha_token'), // Token generado por reCAPTCHA en el formulario
        ]);

        // Decodificar la respuesta JSON de la API
        $result = $response->json();

        // Comprobar que la validación fue exitosa y que el score es suficiente (>= 0.5) para evitar bots
        if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
            // En caso de fallo en la validación, redirigir de vuelta con mensaje de error específico
            return back()->with(
                'error',
                'contact.recaptcha_failed'
            );
        }

        // Si la validación fue exitosa, enviar el correo con los datos del formulario
        Mail::to(config('mail.contact'))->send(new ContactFormMail($request->validated()));

        // Finalmente, redirigir de vuelta con mensaje de éxito para informar al usuario
        return back()->with('success', 'contact.thank_you_message');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Datos del formulario de contacto que se enviarán al correo.
     *
     * @var array
     */
    public array $data;

    /**
     * Crear una nueva instancia del mensaje.
     *
     * @param array $data Datos del formulario de contacto
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Obtener el sobre (envelope) del mensaje, incluyendo asunto y otros metadatos.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo mensaje de contacto Jardín del Despertar',
        );
    }

    /**
     * Obtener el contenido del mensaje, indicando la vista markdown y los datos asociados.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact',
            with: [
                'data' => $this->data,
            ],
        );
    }

    /**
     * Obtener los archivos adjuntos del mensaje.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment> Array vacío ya que no se adjunta nada.
     */
    public function attachments(): array
    {
        return [];
    }
}

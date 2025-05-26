<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::create([
            'title' => 'Retiro de Silencio en Montaña',
            'slug' => 'retiro-de-silencio-en-montana',
            'content' => 'Te invitamos a vivir una experiencia transformadora de meditación en la montaña...',
            'event_date' => '2025-06-10',
            'event_end_date' => '2025-06-10',
            'event_time' => '10:00:00',
            'event_end_time' => '17:00:00',
            'event_location' => 'Masía Rural, Girona',
            'modality' => 'Presencial',
            'price' => 50.00,
            'featured_image' => '',
            'language' => 'es',
            'seo_title' => 'Retiro budista de silencio',
            'seo_description' => 'Ven a nuestro retiro en Girona y descubre la paz interior.',
        ]);

        Event::create([
            'title' => 'Curso Online de Introducción al Budismo',
            'slug' => 'curso-online-introduccion-budismo',
            'content' => 'Un curso básico para conocer los principios fundamentales del budismo desde casa.',
            'event_date' => '2025-06-01',
            'event_end_date' => '2025-06-15',
            'event_time' => '18:00:00',
            'event_end_time' => '20:00:00',
            'event_location' => 'Online (Zoom)',
            'modality' => 'Online',
            'price' => 0.00,
            'featured_image' => '',
            'language' => 'es',
            'seo_title' => 'Curso de budismo para principiantes',
            'seo_description' => 'Aprende los fundamentos del budismo desde casa con este curso gratuito online.',
        ]);

        Event::create([
            'title' => 'Meditación al Amanecer en la Playa',
            'slug' => 'meditacion-amanecer-playa',
            'content' => 'Comienza el día con serenidad y energía positiva en una sesión de meditación junto al mar.',
            'event_date' => '2025-07-12',
            'event_end_date' => '2025-07-12',
            'event_time' => '06:30:00',
            'event_end_time' => '08:00:00',
            'event_location' => 'Playa de Castelldefels, Barcelona',
            'modality' => 'Presencial',
            'price' => 10.00,
            'featured_image' => '',
            'language' => 'es',
            'seo_title' => 'Meditación en la playa al amanecer',
            'seo_description' => 'Conéctate con la naturaleza y tu interior en esta práctica matinal de meditación.',
        ]);

        Event::create([
            'title' => 'Taller de Mindfulness para el Estrés',
            'slug' => 'taller-mindfulness-estres',
            'content' => 'Aprende técnicas de atención plena para manejar el estrés diario en este taller práctico.',
            'event_date' => '2025-08-20',
            'event_end_date' => '2025-08-20',
            'event_time' => '16:00:00',
            'event_end_time' => '19:30:00',
            'event_location' => 'Centro Budista de Vic',
            'modality' => 'Presencial',
            'price' => 25.00,
            'featured_image' => '',
            'language' => 'es',
            'seo_title' => 'Mindfulness contra el estrés',
            'seo_description' => 'Reduce el estrés y mejora tu bienestar con este taller de mindfulness práctico.',
        ]);
    }
}

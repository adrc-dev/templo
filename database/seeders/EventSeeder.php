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
            'content' => <<<EOT
Sumérgete en un entorno natural rodeado de montañas y silencio para reconectar con tu interior.
Este retiro está diseñado para quienes buscan un espacio de introspección profunda a través de la práctica de la meditación y la atención plena.

Durante el retiro, realizaremos diversas actividades contemplativas como sesiones de meditación sentada, caminatas conscientes, ejercicios de respiración y momentos de reflexión grupal.
Contaremos con la guía de instructores experimentados que te acompañarán en todo momento.

Las comidas serán vegetarianas, preparadas con ingredientes locales y mucho amor.
Tendrás también la oportunidad de disfrutar de espacios libres para integrarte con la naturaleza, leer o simplemente descansar.

No se requiere experiencia previa.
Solo es necesario tener disposición para el silencio, el aprendizaje interior y el respeto hacia los demás participantes.

El lugar cuenta con habitaciones compartidas y baños ecológicos.
Te recomendamos traer ropa cómoda, calzado adecuado para senderismo, linterna, tu cojín de meditación (si lo usas) y una libreta de notas.

Este retiro es una oportunidad única para desconectar del ruido externo y redescubrir la paz interior.
Ideal para reducir el estrés, mejorar la concentración y cultivar una mente más clara y compasiva.

Las plazas son limitadas para preservar la tranquilidad del grupo.
Recomendamos reservar con antelación. Para más información o dudas, puedes escribirnos a contacto@templo.org.
EOT,
            'event_date' => '2025-06-10',
            'event_end_date' => '2025-06-10',
            'event_time' => '10:00:00',
            'event_end_time' => '17:00:00',
            'event_location' => 'Masía Rural, Girona',
            'modality' => 'Presencial',
            'price' => 50.00,
            'featured_image' => 'fallback-event.png',
            'language' => 'es',
            'seo_title' => 'Retiro budista de silencio',
            'seo_description' => 'Ven a nuestro retiro en Girona y descubre la paz interior.',
        ]);

        Event::create([
            'title' => 'Curso Online de Introducción al Budismo',
            'slug' => 'curso-online-introduccion-budismo',
            'content' => <<<EOT
Este curso está dirigido a todas las personas que desean tener un primer contacto con el budismo, sin importar sus creencias o experiencia previa.

Durante dos semanas exploraremos los principios fundamentales de esta filosofía milenaria: las Cuatro Nobles Verdades, el Noble Óctuple Sendero, el karma, la compasión y la mente atenta. Las clases serán en directo vía Zoom y también quedarán grabadas para quienes no puedan asistir en vivo.

Además del contenido teórico, se propondrán prácticas para aplicar en el día a día, como la meditación básica, ejercicios de respiración y actitudes conscientes frente a situaciones cotidianas.

Contarás con un foro para hacer preguntas, compartir experiencias y recibir apoyo de los facilitadores. También entregaremos materiales descargables con esquemas, lecturas y ejercicios.

No hay exámenes ni evaluaciones. Este curso busca ser una guía amable para el autoconocimiento, la paz interior y una vida más equilibrada.

Es completamente gratuito y solo necesitas una conexión a internet y disposición para aprender.
EOT,
            'event_date' => '2025-06-01',
            'event_end_date' => '2025-06-15',
            'event_time' => '18:00:00',
            'event_end_time' => '20:00:00',
            'event_location' => 'Online (Zoom)',
            'modality' => 'Online',
            'price' => 0.00,
            'featured_image' => 'fallback-event.png',
            'language' => 'es',
            'seo_title' => 'Curso de budismo para principiantes',
            'seo_description' => 'Aprende los fundamentos del budismo desde casa con este curso gratuito online.',
        ]);

        Event::create([
            'title' => 'Meditación al Amanecer en la Playa',
            'slug' => 'meditacion-amanecer-playa',
            'content' => <<<EOT
Esta actividad está pensada para comenzar el día desde la calma, el silencio y la conexión con la naturaleza. Acompañados por el sonido de las olas y la suave luz del amanecer, practicaremos meditación consciente en la playa.

La sesión incluye una breve caminata meditativa, una práctica guiada de respiración consciente y una meditación en silencio. No se trata de una clase formal, sino de un espacio para compartir la presencia y el momento.

Se recomienda llevar una esterilla, ropa cómoda, una manta ligera y, si lo deseas, una taza de té caliente para después de la práctica.

Nos encontraremos justo antes del amanecer para aprovechar la energía tranquila del inicio del día. En caso de mal tiempo, se notificará por email si hay cambios o cancelación.

Esta experiencia es apta para todas las edades y niveles. Es una hermosa forma de regalarte un momento contigo mismo en un entorno inspirador.
EOT,
            'event_date' => '2025-07-12',
            'event_end_date' => '2025-07-12',
            'event_time' => '06:30:00',
            'event_end_time' => '08:00:00',
            'event_location' => 'Playa de Castelldefels, Barcelona',
            'modality' => 'Presencial',
            'price' => 10.00,
            'featured_image' => 'fallback-event.png',
            'language' => 'es',
            'seo_title' => 'Meditación en la playa al amanecer',
            'seo_description' => 'Conéctate con la naturaleza y tu interior en esta práctica matinal de meditación.',
        ]);

        Event::create([
            'title' => 'Taller de Mindfulness para el Estrés',
            'slug' => 'taller-mindfulness-estres',
            'content' => <<<EOT
Este taller intensivo está diseñado para ayudarte a reconocer y manejar el estrés de forma más saludable y consciente. A través de técnicas prácticas basadas en el mindfulness, aprenderás a observar tus emociones y pensamientos sin juicio.

Durante la jornada trabajaremos con ejercicios de respiración, escaneo corporal, meditación guiada y dinámicas para aplicar en tu entorno laboral o familiar.

Además, se presentará la base científica que respalda los beneficios del mindfulness en la reducción del estrés y la mejora del bienestar general. Hablaremos sobre la respuesta automática al estrés y cómo interrumpir ese patrón con presencia y compasión.

Cada participante recibirá un pequeño manual con recursos para continuar la práctica en casa, así como audios de meditación grabados.

El taller está facilitado por instructores certificados en mindfulness y psicología contemplativa. Es una experiencia enriquecedora tanto para quienes comienzan como para quienes ya tienen práctica previa.

Inscripción previa requerida. Aforo limitado a 20 personas para asegurar una atención personalizada.
EOT,
            'event_date' => '2025-08-20',
            'event_end_date' => '2025-08-20',
            'event_time' => '16:00:00',
            'event_end_time' => '19:30:00',
            'event_location' => 'Centro Budista de Vic',
            'modality' => 'Presencial',
            'price' => 25.00,
            'featured_image' => 'fallback-event.png',
            'language' => 'es',
            'seo_title' => 'Mindfulness contra el estrés',
            'seo_description' => 'Reduce el estrés y mejora tu bienestar con este taller de mindfulness práctico.',
        ]);
    }
}

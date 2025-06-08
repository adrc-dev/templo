<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    public function run()
    {
        $videos = [
            [
                'title' => 'Meditación Guiada al Amanecer',
                'description' => 'Sumérgete en una experiencia única de conexión interior mientras el sol comienza a elevarse sobre el horizonte. Esta meditación guiada te ayudará a establecer una intención clara para el día y a cultivar una mente tranquila y compasiva desde el primer momento del día. Ideal tanto para principiantes como para practicantes avanzados.',
                'youtube_id' => 'EC2h-0IFspY',
                'is_premium' => false,
            ],
            [
                'title' => 'Técnicas de Respiración para Reducir el Estrés',
                'description' => 'Explora una variedad de técnicas de respiración profundas y conscientes que han sido utilizadas durante siglos en la práctica budista para calmar la mente y el cuerpo. Aprende a manejar situaciones estresantes del día a día a través de ejercicios que puedes practicar en cualquier momento y lugar.',
                'youtube_id' => 'W5Z0Rkg7IG4',
                'is_premium' => false,
            ],
            [
                'title' => 'Introducción al Vipassana',
                'description' => 'Una clase completa que introduce los principios básicos de la meditación Vipassana, incluyendo la observación de sensaciones, la impermanencia y el desapego. Se ofrecen herramientas prácticas para comenzar una práctica diaria con conciencia y disciplina.',
                'youtube_id' => 'W5Z0Rkg7IG4',
                'is_premium' => true,
            ],
            [
                'title' => 'Mindfulness en la Vida Cotidiana',
                'description' => 'Aprende cómo incorporar el mindfulness en cada aspecto de tu vida, desde caminar hasta lavar los platos, transformando tareas rutinarias en oportunidades de atención plena y crecimiento personal. Una clase inspiradora con ejemplos y prácticas aplicables desde hoy mismo.',
                'youtube_id' => 'krz330upmMI',
                'is_premium' => true,
            ],
            [
                'title' => 'Silencio Interior: Clase práctica desde el retiro',
                'description' => 'Grabación realizada en uno de nuestros retiros en la montaña. En esta clase se guía una práctica para cultivar el silencio interior, dejando atrás el ruido mental y emocional. Una experiencia inmersiva ideal para acompañarte en momentos de introspección profunda.',
                'youtube_id' => 'uNHKs4U3zB0',
                'is_premium' => true,
            ],
            [
                'title' => 'Meditación Sentada para Principiantes',
                'description' => 'Una sesión detallada que cubre la postura, la respiración y la actitud mental ideal para una meditación sentada efectiva. Perfecta para quienes se inician y quieren establecer una base sólida en su práctica.',
                'youtube_id' => 'W5Z0Rkg7IG4',
                'is_premium' => false,
            ],
            [
                'title' => 'Charla sobre los Cuatro Nobles Caminos',
                'description' => 'Esta charla ofrece una explicación profunda sobre los Cuatro Nobles Caminos desde una perspectiva accesible y contemporánea. Ideal para estudiantes del curso de introducción al budismo.',
                'youtube_id' => 'uNHKs4U3zB0',
                'is_premium' => false,
            ],
            [
                'title' => 'Cómo cultivar compasión hacia uno mismo',
                'description' => 'Una clase dedicada a explorar la autocompasión como una práctica esencial en el camino budista. Incluye ejercicios guiados, reflexión personal y consejos para cultivar una relación más amable contigo mismo.',
                'youtube_id' => 'krz330upmMI',
                'is_premium' => true,
            ],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}

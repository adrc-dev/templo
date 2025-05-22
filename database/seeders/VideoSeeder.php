<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Video::create([
            'title' => 'Clase gratuita de meditación',
            'description' => 'Introducción para principiantes',
            'youtube_id' => 'EC2h-0IFspY',
            'is_premium' => false,
        ]);

        Video::create([
            'title' => 'Clase avanzada de meditación',
            'description' => 'Solo para miembros',
            'youtube_id' => 'W5Z0Rkg7IG4',
            'is_premium' => true,
        ]);
    }
}

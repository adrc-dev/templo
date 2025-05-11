<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // multilingüe
            $table->string('slug')->unique();
            $table->json('content'); // multilingüe
            $table->date('event_date');
            $table->time('event_time')->nullable();
            $table->string('modality');
            $table->decimal('price', 8, 2);
            $table->string('featured_image');
            $table->boolean('is_active')->default(true);

            // campos SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('og_image')->nullable();

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

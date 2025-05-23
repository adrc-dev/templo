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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->date('event_date');
            $table->date('event_end_date')->nullable();
            $table->time('event_time')->nullable();
            $table->time('event_end_time')->nullable();
            $table->string('event_location')->nullable();
            $table->enum('modality', ['Presencial', 'Online'])->default('Presencial');
            $table->decimal('price', 8, 2)->default(0);
            $table->string('currency', 3)->default('EUR');
            $table->string('featured_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('language', 2)->default('es');
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

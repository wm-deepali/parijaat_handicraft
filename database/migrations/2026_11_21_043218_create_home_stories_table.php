<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_stories', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable();
            $table->string('title');
            $table->text('description')->nullable();

            $table->string('main_image')->nullable();
            $table->string('main_image_alt')->nullable();
            $table->string('detail_image')->nullable();
            $table->string('detail_image_alt')->nullable();
            $table->string('badge_text')->nullable();

            $table->json('pillars')->nullable();   // [{icon, title, text}, ...]

            $table->string('primary_btn_text')->nullable();
            $table->string('primary_btn_link')->nullable();
            $table->string('secondary_btn_text')->nullable();
            $table->string('secondary_btn_link')->nullable();

            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_stories');
    }
};
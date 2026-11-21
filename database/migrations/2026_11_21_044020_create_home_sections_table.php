<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();          // craft | craft_feature | why | affiliate
            $table->string('eyebrow')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('btn1_text')->nullable();
            $table->string('btn1_link')->nullable();
            $table->string('btn2_text')->nullable();
            $table->string('btn2_link')->nullable();
            $table->json('lines')->nullable();        // simple text list (e.g. partner points)
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('home_cards', function (Blueprint $table) {
            $table->id();
            $table->string('section')->index();       // craft | why
            $table->string('title');
            $table->string('text')->nullable();
            $table->string('badge_big', 20)->nullable();
            $table->string('badge_small', 20)->nullable();
            $table->string('btn_text', 60)->nullable();
            $table->string('icon')->nullable();       // Font Awesome class (why items)
            $table->string('image')->nullable();      // craft cards
            $table->string('link')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_cards');
        Schema::dropIfExists('home_sections');
    }
};
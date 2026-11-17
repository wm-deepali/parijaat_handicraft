<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affiliate_links', function (Blueprint $table) {
            $table->id();
            $table->string('url', 2048);
            $table->string('title')->nullable();          // OG title / admin typed
            $table->text('description')->nullable();      // OG description / admin typed
            $table->string('image', 2048)->nullable();    // OG image URL ya uploaded storage path
            $table->decimal('price', 10, 2)->nullable();  // Partner Price (b)
            $table->decimal('mrp', 10, 2)->nullable();    // Old price (del)
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['status', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliate_links');
    }
};
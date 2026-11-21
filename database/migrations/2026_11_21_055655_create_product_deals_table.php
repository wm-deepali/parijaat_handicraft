<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('title', 120)->nullable();       // banner heading (default: product name)
            $table->string('text')->nullable();             // banner sub text
            $table->string('coupon_code', 60)->nullable();  // shown as "Use Code: ..."
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->index();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_deals');
    }
};
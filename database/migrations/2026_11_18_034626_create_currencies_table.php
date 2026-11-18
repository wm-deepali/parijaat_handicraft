<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $t) {
            $t->string('code', 3)->primary();
            $t->string('symbol', 8);
            $t->unsignedTinyInteger('decimals')->default(2);
            $t->decimal('usd_rate', 18, 8)->nullable();   // 1 USD = ? of this currency
            $t->boolean('rate_is_manual')->default(false); // admin ne khud rate dala to auto-update skip
            $t->timestamp('rates_updated_at')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};

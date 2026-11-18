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
        Schema::create('countries', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->char('iso2', 2)->unique();
            $t->string('currency_code', 3);
            $t->foreign('currency_code')->references('code')->on('currencies');
            $t->boolean('is_enabled')->default(false);
            $t->boolean('is_default')->default(false);
            $t->decimal('price_adjustment', 5, 2)->default(0);      // extra %
            $t->string('tax_handling', 20)->default('export');       // india_gst | export | destination_vat
            $t->decimal('vat_rate', 5, 2)->default(0);               // sirf destination_vat me use hoga
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};

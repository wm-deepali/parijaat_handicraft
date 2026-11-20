<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $t) {
            $t->string('default_currency_code', 3)->nullable();   // order ke din default currency kaunsi thi
            $t->string('country_code', 2)->nullable();
            $t->string('currency_code', 3)->nullable();
            $t->decimal('exchange_rate', 18, 8)->nullable();          // 1 default currency = ? customer currency (extra % ke bina)
            $t->decimal('price_adjustment_percent', 6, 2)->default(0);
            $t->decimal('price_adjustment_amount', 14, 3)->default(0); // default currency me, tax nahi, extra revenue
            $t->string('tax_handling', 20)->nullable();
            $t->decimal('total_default', 14, 3)->nullable();
            $t->decimal('total_customer', 14, 3)->nullable();         // customer ne jo diya
            $t->decimal('inr_rate', 18, 8)->nullable();               // 1 default currency = ? INR (us din ka)
            $t->decimal('total_inr', 14, 2)->nullable();              // accounts ke liye
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $t) {
            $t->dropColumn([
                'default_currency_code',
                'country_code',
                'currency_code',
                'exchange_rate',
                'price_adjustment_percent',
                'price_adjustment_amount',
                'tax_handling',
                'total_default',
                'total_customer',
                'inr_rate',
                'total_inr',
            ]);
        });
    }
};
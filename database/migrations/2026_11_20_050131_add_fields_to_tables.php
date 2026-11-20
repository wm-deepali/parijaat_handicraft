<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('countries', function (Blueprint $t) {
            $t->decimal('shipping_charge', 12, 2)->nullable();      // flat, default currency; NULL = shipping nahi
        });

        Schema::table('refund_transactions', function (Blueprint $t) {
            $t->string('currency_code', 3)->nullable();             // order ki (customer) currency
            $t->decimal('amount_customer', 14, 3)->nullable();      // refund customer ki currency me (order ke frozen rate se)
        });
    }

    public function down(): void
    {
        Schema::table('refund_transactions', function (Blueprint $t) {
            $t->dropColumn(['currency_code', 'amount_customer']);
        });

        Schema::table('countries', function (Blueprint $t) {
            $t->dropColumn('shipping_charge');
        });
    }
};
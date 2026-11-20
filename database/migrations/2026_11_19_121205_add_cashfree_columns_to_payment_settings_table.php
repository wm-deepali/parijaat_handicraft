<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('payment_settings', function (Blueprint $table) {
            $table->string('cf_test_app_id')->nullable();
            $table->text('cf_test_secret')->nullable();
            $table->string('cf_live_app_id')->nullable();
            $table->text('cf_live_secret')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('payment_settings', function (Blueprint $table) {
            $table->dropColumn(['cf_test_app_id', 'cf_test_secret', 'cf_live_app_id', 'cf_live_secret']);
        });
    }
};
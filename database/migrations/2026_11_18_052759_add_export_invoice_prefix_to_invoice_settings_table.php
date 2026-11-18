<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('invoice_settings', function (Blueprint $t) {
            $t->string('export_invoice_prefix', 20)->default('EXP')->after('invoice_serial');
            $t->unsignedInteger('export_invoice_serial')->default(1)->after('export_invoice_prefix');
        });
    }

    public function down(): void
    {
        Schema::table('invoice_settings', function (Blueprint $t) {
            $t->dropColumn(['export_invoice_prefix', 'export_invoice_serial']);
        });
    }
};
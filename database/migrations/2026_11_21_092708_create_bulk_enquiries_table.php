<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bulk_enquiries', function (Blueprint $t) {
            $t->id();
            $t->string('full_name', 120);
            $t->string('company', 150);
            $t->string('email', 150);
            $t->string('phone', 30);
            $t->string('phone_full', 30)->nullable();
            $t->string('country_code', 5)->nullable();
            $t->string('dial_code', 8)->nullable();
            $t->string('category', 120);
            $t->unsignedInteger('quantity');
            $t->string('ship_country', 100);
            $t->string('frequency', 50)->nullable();
            $t->text('message')->nullable();
            $t->json('files')->nullable();
            $t->string('status', 20)->default('new');   // new | contacted | quoted | closed
            $t->boolean('is_read')->default(false);
            $t->text('admin_note')->nullable();
            $t->string('ip_address', 45)->nullable();
            $t->timestamps();
            $t->softDeletes();

            $t->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bulk_enquiries');
    }
};
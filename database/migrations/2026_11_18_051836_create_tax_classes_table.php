<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tax_classes', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->decimal('gst_rate', 5, 2)->default(0);
            $t->boolean('is_default')->default(false);
            $t->timestamps();
        });

        Schema::table('categories', function (Blueprint $t) {
            $t->foreignId('tax_class_id')->nullable()->after('id')->constrained('tax_classes')->nullOnDelete();
        });

        Schema::table('products', function (Blueprint $t) {
            $t->foreignId('tax_class_id')->nullable()->after('id')->constrained('tax_classes')->nullOnDelete();
        });

        // purani CGST/SGST/IGST setting se pehli class
        $igst = DB::table('invoice_settings')->value('igst') ?? 18;
        DB::table('tax_classes')->insert([
            'name' => 'Standard', 'gst_rate' => $igst, 'is_default' => true,
            'created_at' => now(), 'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::table('products', fn (Blueprint $t) => $t->dropConstrainedForeignId('tax_class_id'));
        Schema::table('categories', fn (Blueprint $t) => $t->dropConstrainedForeignId('tax_class_id'));
        Schema::dropIfExists('tax_classes');
    }
};
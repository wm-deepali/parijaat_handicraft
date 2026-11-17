<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();

            $table->string('name');

            $table->string('slug')->unique();

            $table->string('sku')->nullable();

            $table->text('short_description')->nullable();

            /* ── Content: detail page accordions (in display order) ── */
            $table->json('specifications')->nullable();          // Product Details (label/value rows)
            $table->longText('material_craft')->nullable();      // Material & Craft
            $table->longText('size_dimensions')->nullable();     // Size & Dimensions
            $table->longText('care_instructions')->nullable();   // Care Instructions
            $table->longText('shipping_delivery')->nullable();   // Shipping & Delivery
            $table->longText('returns_exchange')->nullable();    // Returns & Exchange
            $table->longText('offers_how_to_avail')->nullable(); // Offers & Coupons

            $table->string('price_type', 10)->default('single');
            $table->decimal('mrp', 12, 2)->default(0);

            $table->enum('discount_type', [
                'amount',
                'percentage'
            ])->default('amount');

            $table->decimal('discount', 12, 2)->default(0);

            $table->decimal('price', 12, 2)->default(0);

            $table->integer('stock')->default(0);

            $table->integer('min_qty')->default(1);

            $table->string('delivery_time')->nullable();

            $table->string('meta_title')->nullable();

            $table->text('meta_description')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

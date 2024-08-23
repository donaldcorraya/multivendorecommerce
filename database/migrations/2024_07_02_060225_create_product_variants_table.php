<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('color_id')->nullable();
            $table->integer('attribute_id')->nullable();
            $table->integer('attribute_item_id')->nullable();
            $table->double('discount_amount', 10, 2)->nullable();
            $table->enum('discount_type', ['percent', 'fixed'])->default('fixed');
            $table->string('discount_starts_at')->nullable();
            $table->string('discount_expires_at')->nullable();
            $table->double('max_discount_amount', 10, 2)->nullable();  
            $table->double('min_discount_amount', 10, 2)->nullable();  
            $table->string('points')->nullable();
            $table->string('variants_price')->nullable();
            $table->string('qty');
            $table->string('sku')->nullable();
            $table->string('image')->nullable();
            $table->string('low_qty')->nullable();
            $table->string('show_stock_quantity')->default(0);   
            $table->string('show_stock_with_text_only')->default(0);   
            $table->string('hide_stock')->default(0);   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};

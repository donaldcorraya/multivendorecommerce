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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->string('unit');
            $table->integer('unit_amount');
            $table->string('minimum_purchase_qty');
            $table->text('tags');
            $table->string('bar_code')->unique()->nullable();
            $table->string('product_type');
            $table->integer('refundable')->default(0);
            $table->longText('description')->nullable();
            $table->integer('featured')->default(0);
            $table->integer('todays_deal')->default(0);
            $table->integer('flash_deal')->default(0);
            $table->string('flash_discount')->nullable();
            $table->string('flash_discount_type')->nullable();
            $table->string('tax')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('vat')->nullable();
            $table->string('vat_type')->nullable();
            $table->text('gallery_images')->nullable();
            $table->text('thumbnail_image')->nullable();
            $table->string('video_provider')->nullable();
            $table->string('unit_price');
            
            $table->integer('cash_on_delivery')->default(0);   
            $table->integer('free_shipping')->default(0);   
            $table->integer('flat_rate')->default(0);   
            $table->integer('is_product_quantity_mulitiply')->default(0);   

            $table->string('seo_meta_title')->nullable();
            $table->longText('seo_meta_description')->nullable();
            $table->string('meta_image')->nullable();

            $table->tinyInteger('status')->default(1);         
            $table->timestamps();
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

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
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('brand_id');
            $table->longText('name');
            $table->longText('slug')->unique();
            $table->string('model');
            $table->string('price',400);
            $table->string('regular_price',400);
            $table->string('active');
            $table->string('status');
            $table->longText('summary');
            $table->longText('specification');
            $table->longText('description');
            $table->longText('product_img');
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

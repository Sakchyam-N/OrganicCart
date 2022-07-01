<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_image');
            $table->float('product_price',8,2);
            $table->longText('product_description');
            $table->integer('product_quantity');
            $table->date('manufacture_date');
            $table->date('expiry_date');
            $table->integer('max_order');
            $table->integer('min_order');
            $table->longText('allergy_details')->nullable();
            $table->foreignId('shop_id')->constrained('shops');
            $table->foreignId('categories_id')->constrained('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};

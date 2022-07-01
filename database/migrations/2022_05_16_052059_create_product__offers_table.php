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
        Schema::create('product__offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('offers');
            $table->foreignId('product_id')->constrained('products');
            $table->primary(['id','offer_id','product_id']);
            $table->float('offer_percentage',5,2);
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
        Schema::dropIfExists('product__offers');
    }
};

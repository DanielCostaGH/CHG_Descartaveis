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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('shopping_carts')->onDelete('cascade');
            $table->foreignId('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 8, 2);
            $table->string('variation');
            $table->string('color');
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
        Schema::dropIfExists('table_cart_items');
    }
};

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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('SKU');
            $table->string('name');
            $table->text('description');
            $table->decimal('price');
            $table->string('image');
            $table->foreignId('category_id');
            $table->string('brand');
            $table->string('color');
            $table->string('size');
            $table->integer('quantity');
            $table->enum('status', ['active', 'inactive', 'out_of_stock']);
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
        Schema::dropIfExists('product');
    }
};

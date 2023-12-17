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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('cart_id')->constrained('shopping_carts')->onDelete('cascade');
            $table->foreignId('address_id')->constrained('user_addresses')->onDelete('cascade');
            $table->decimal('total_price', 8, 2);
            $table->enum('payment_method', ['credit_card', 'paypal', 'bank_transfer']);
            $table->enum('status', ['processing', 'shipped', 'delivered', 'cancelled'])->default('processing');
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
        Schema::dropIfExists('table_orders');
    }
};

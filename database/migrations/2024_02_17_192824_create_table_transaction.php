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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['paid', 'waiting_payment', 'error']);
            $table->float('total', 8, 2);
            $table->string('gateway_transaction_id', 255);
            $table->timestamps();
            $table->foreignId('order_id')->constrained('orders');
            $table->string('pix_base64', 500)->nullable();
            $table->string('pix_copy_paste', 500)->nullable();
            $table->dateTime('pix_expiration_date_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
};

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
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            // Adiciona a coluna user_id
            $table->unsignedBigInteger('user_id');

            // Adiciona a chave estrangeira
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('admin_id');

            // Adiciona a chave estrangeira
            $table->foreign('admin_id')->references('id')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            // Remove a chave estrangeira
            $table->dropForeign(['user_id']);

            // Remove a coluna user_id
            $table->dropColumn('user_id');

            $table->dropForeign(['admin_id']);

            // Remove a coluna user_id
            $table->dropColumn('admin_id');
        });
    }
};

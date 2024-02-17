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
        // Adicione os valores específicos que você forneceu
        DB::table('settings')->insert([
            ['name' => 'pagarme_token', 'value' => 'c2tfdGVzdF9iZDllYjA0OGJjMDk0NDIwYjFhNjE1MzQyMzczNDE0Nzo='],
            ['name' => 'pagarme_secret_key', 'value' => 'sk_test_bd9eb048bc094420b1a6153423734147'],
            ['name' => 'pagarme_recipient_id', 'value' => 're_clsqnvcmp379w019tuk99eenp'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['pagarme_token', 'pagarme_secret_key', 'pagarme_recipient_id']);
        });
    }
};

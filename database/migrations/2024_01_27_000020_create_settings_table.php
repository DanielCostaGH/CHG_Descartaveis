<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        DB::table('settings')->insert([
            ['name' => 'MELHOR_ENVIO_CLIENT_ID', 'value' => '13764'],
            ['name' => 'MELHOR_ENVIO_CLIENT_SECRET', 'value' => 'Hy1DvUzUutA3B1kX7pQQNU5Jd1mnMencb7xLLUqN'],
            ['name' => 'MELHOR_ENVIO_REDIRECT_URI', 'value' => 'http://localhost/dashboard/config'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};

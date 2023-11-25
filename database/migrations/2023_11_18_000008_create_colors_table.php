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
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        // Inserindo valores padrão na tabela
        DB::table('colors')->insert([
            ['name' => 'Vermelho', 'value' => '#FF0000'],
            ['name' => 'Azul', 'value' => '#0000FF'],
            ['name' => 'Verde', 'value' => '#00FF00'],
            ['name' => 'Amarelo', 'value' => '#FFFF00'],
            ['name' => 'Preto', 'value' => '#000000']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colors');
    }
};

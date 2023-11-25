<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('images');
            $table->string('status');
            $table->timestamps();
        });


        // Produto teste (opicional)
        DB::table('categories')->insert([
            'name' => 'Categoria1',
            'description' => 'e . ',
            'images' => "c1.png",
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categories')->insert([
            'name' => 'Categoria2',
            'description' => 'desc',
            'images' => "c2.jpg",
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categories')->insert([
            'name' => 'Categoria3',
            'description' => 'desc',
            'images' => "c3.jpeg",
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categories')->insert([
            'name' => 'Categoria4',
            'description' => 'desc',
            'images' => "c4.jpg",
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categories')->insert([
            'name' => 'Categoria5',
            'description' => 'desc',
            'images' => "c5.jpeg",
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

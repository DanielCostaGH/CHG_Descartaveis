<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('SKU');
            $table->string('name');
            $table->text('description');
            $table->decimal('price');
            $table->string('images');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('brand');
            $table->foreignId('color_id')->nullable()->constrained('colors')->onDelete('set null');
            $table->string('variation');
            $table->integer('quantity');
            $table->enum('status', ['active', 'inactive', 'out_of_stock']);
            $table->timestamps();
        });


        // Produto teste (opicional)
        DB::table('product')->insert([
            'SKU' => 'ABC127',
            'name' => 'Apple iPhone 14 Pro Max',
            'description' => 'O Apple iPhone 14 Pro Max é um smartphone iOS com características inovadoras que o tornam uma excelente opção para qualquer tipo de utilização, representando um dos melhores dispositivos móveis já feitos. A tela de 6.7 polegadas coloca esse Apple no topo de sua categoria. A resolução também é alta: 2796x1290 pixel. As funcionalidades oferecidas pelo Apple iPhone 14 Pro Max são muitas e todas top de linha. Começando pelo 5G que permite a transferência de dados e excelente navegação na internet, além de conectividade Wi-fi e GPS presente no aparelho. Tem também leitor multimídia, videoconferência, e bluetooth. Enfatizamos a excelente memória interna de 1000 GB mas sem a possibilidade de expansão. A excelência deste Apple iPhone 14 Pro Max é completada por uma câmera de 48 megapixels que permite tirar fotos fantásticas com uma resolução de 8000x6000 pixels e gravar vídeos em 4K a espantosa resolução de 3840x2160 pixels. A espessura de apenas 7.9 milímetros torna o Apple iPhone 14 Pro Max um dos telefones mais finos que existem. ',
            'price' => 1000.00,
            'images' => "i1.png;i2.png;i3.png;i4.png;i5.png",
            'category_id' => 1,
            'brand' => 'Apple',
            'color_id' => 1,
            'variation' => '256GB;500GB;',
            'quantity' => 100,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('product');
    }
}

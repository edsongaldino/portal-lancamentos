<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssinaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assinaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->decimal('preco', 14, 2)->nullable();
            $table->decimal('preco_desconto', 14, 2)->nullable();
            $table->enum('tipo', ['Mensal', 'Trimestral', 'Semestral', 'Anual'])->nullable();
            $table->integer('quantidade_produtos')->nullable();
            $table->integer('periodo_bonus')->nullable();
            $table->decimal('valor_adicional', 14, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assinaturas');
    }
}

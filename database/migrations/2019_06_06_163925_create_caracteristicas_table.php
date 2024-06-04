<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracteristicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caracteristicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_antigo')->nullable();
            $table->string('nome');
            $table->enum('tipo', ['Geral', 'Empreendimento', 'Torre', 'Planta', 'Quadra', 'Lazer', 'Proximidades', 'Unidade'])->nullable()->default('Geral');            
            $table->string('icone')->nullable();
            $table->enum('exibir', ['Sim', 'Não'])->nullable()->default('Sim');
            $table->softDeletes();
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
        Schema::dropIfExists('caracteristicas');
    }
}

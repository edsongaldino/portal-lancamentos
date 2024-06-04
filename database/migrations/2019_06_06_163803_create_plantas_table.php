<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned()->nullable();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('empreendimento_id')->unsigned()->nullable();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->string('nome');
            $table->decimal('valor_inicial', 14, 2)->nullable();
            $table->decimal('valor_final', 14, 2)->nullable();
            $table->longtext('observacoes')->nullable();
            $table->enum('status', ['Liberada', 'Bloqueada', 'Excluído'])->default('Liberada')->nullable();
            $table->string('foto_planta')->nullable();
            $table->string('foto_primeira_planta')->nullable();
            $table->string('foto_segunda_planta')->nullable();
            $table->string('foto_terceira_planta')->nullable();
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
        Schema::dropIfExists('plantas');
    }
}

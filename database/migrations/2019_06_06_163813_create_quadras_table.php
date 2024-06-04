<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuadrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quadras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('empreendimento_id')->unsigned();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->string('nome');
            $table->integer('total_unidades')->nullable();
            $table->date('previsao_entrega')->nullable();
            $table->enum('nomenclatura', ['Sequencial', 'Reiniciar'])->default('Sequencial')->nullable();
            $table->enum('status', ['Liberada', 'Bloqueada', 'Excluído'])->default('Liberada')->nullable();
            $table->longtext('observacoes')->nullable();
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
        Schema::dropIfExists('quadras');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTorresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned()->nullable();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('empreendimento_id')->unsigned()->nullable();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->string('nome');
            $table->date('previsao_entrega')->nullable();
            $table->enum('etapa', [
                'Única', 
                'Primeira', 
                'Segunda', 
                'Terceira',
                'Quarta',
                'Quinta',
                'Sexta',
                'Sétima'
            ])->default('Única')->nullable();
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
        Schema::dropIfExists('torres');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('empreendimento_id')->unsigned();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->integer('planta_id')->unsigned()->nullable();
            $table->foreign('planta_id')->references('id')->on('plantas');
            $table->string('nome')->nullable();
            $table->string('descricao')->nullable();
            $table->string('arquivo')->nullable();
            $table->string('extensao')->nullable();
            $table->enum('tipo', ['Geral', 'Interna', 'Externa', 'Decorado', 'Estágio de Obra', 'Implantação', 'Implantação Vertical - Frente', 'Implantação Vertical - Fundo', 'Mapa de Vagas'])->nullable()->default('Geral');
            $table->enum('destaque_principal', ['Sim', 'Não'])->nullable()->default('Não');
            $table->enum('destaque', ['Sim', 'Não'])->nullable()->default('Não');
            $table->enum('mini_destaque', ['Sim', 'Não'])->nullable()->default('Não');
            $table->integer('coord_x')->unsigned()->nullable();
            $table->integer('coord_y')->unsigned()->nullable();
            $table->enum('tipo_ponto', ['I', 'M'])->default('I')->nullable();
            $table->enum('status', ['Liberada', 'Bloqueada', 'Excluído'])->default('Bloqueada')->nullable();
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
        Schema::dropIfExists('fotos');
    }
}

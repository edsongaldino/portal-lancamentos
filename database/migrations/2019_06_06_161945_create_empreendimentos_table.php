<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpreendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empreendimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned()->nullable();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('endereco_id')->unsigned()->nullable();
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->integer('seo_id')->unsigned()->nullable();
            $table->foreign('seo_id')->references('id')->on('seo');
            $table->string('nome')->nullable();
            $table->longtext('descricao')->nullable();
            $table->enum('tipo', ['Vertical', 'Horizontal'])->default('Vertical')->nullable();
            $table->decimal('valor_inicial', 14, 2)->nullable();
            $table->decimal('valor_final', 14, 2)->nullable();
            $table->date('previsao_entrega')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('logomarca')->nullable();
            $table->enum('status', ['Liberada', 'Bloqueada', 'Excluído'])->default('Bloqueada')->nullable();
            $table->enum('modalidade', [
                    'Breve',
                    'Lançamento',
                    'Em Obra',
                    'Mude Já'
            ])->default('Breve')->nullable();
            $table->enum('gerou_unidades', ['Sim', 'Não'])->default('Não')->nullable();
            $table->enum('mostra_mapa', ['Sim', 'Não'])->default('Não')->nullable();
            $table->longtext('selo_oferta')->nullable();
            $table->string('video')->nullable();
            $table->string('telefone_central')->nullable();
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
        Schema::dropIfExists('empreendimentos');
    }
}

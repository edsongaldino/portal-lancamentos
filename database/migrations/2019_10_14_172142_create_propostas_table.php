<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propostas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('unidade_id')->unsigned();
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->integer('empreendimento_id')->unsigned();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->integer('oferta_id')->unsigned();
            $table->foreign('oferta_id')->references('id')->on('ofertas');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->decimal('saldo_remanescente', 14, 2)->nullable();
            $table->decimal('valor_proposta', 14, 2)->nullable();
            $table->decimal('entrada_proposta', 14, 2)->nullable();            
            $table->integer('quantidade_parcela')->nullable();
            $table->decimal('valor_parcela', 14, 2)->nullable();
            $table->decimal('valor_bens', 14, 2)->nullable();
            $table->longText('descricao_bens')->nullable();            
            
            $table->enum('tipo_negociacao_saldo', [
                'Mediante Financiamento', 
                'Bens Negociáveis'
            ])->nullable();

            $table->longText('comentarios')->nullable();

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
        Schema::dropIfExists('propostas');
    }
}

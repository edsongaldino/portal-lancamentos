<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelaVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabela_vendas', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('construtora_id')->unsigned();
            //$table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('empreendimento_id')->unsigned();
            //$table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->integer('tipo_tabela_id')->unsigned();
            //$table->foreign('tipo_tabela_id')->references('id')->on('tipo_tabela');
            $table->string('nome_tabela');
            $table->decimal('percentual_entrada', 14, 2)->nullable(); 
            $table->decimal('percentual_parcela_unica', 14, 2)->nullable(); 
            $table->integer('qtd_mensais')->nullable();
            $table->decimal('percentual_mensais', 14, 2)->nullable();
            $table->integer('qtd_baloes')->nullable();
            $table->decimal('percentual_baloes', 14, 2)->nullable();
            $table->decimal('percentual_remanescente', 14, 2)->nullable();
            $table->enum('banco_parceiro', ['Não', 'Banco do Brasil','Caixa', 'Bradesco', 'Itaú', 'Santander'])->default('Não');
            $table->decimal('desconto_avista', 14, 2)->nullable();
            $table->decimal('renda_minima', 14, 2)->nullable();
            $table->enum('programa_habitacional', ['Não', 'MCMV','CV'])->default('Não');
            $table->decimal('subsidio_maximo', 14, 2)->nullable();
            $table->enum('correcao_obra', ['Não', 'INCC'])->default('Não');
            $table->enum('correcao_poschave', ['Não', 'IGPM','IPCA'])->default('Não');
            $table->enum('aceita_bens', ['Não', 'Sim'])->default('Não');
            $table->decimal('valor_vaga_extra', 14, 2)->nullable();
            $table->date('validade_tabela');
            $table->enum('situacao_tabela', ['Liberada', 'Bloqueada'])->default('Liberada');
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
        Schema::dropIfExists('tabela_vendas');
    }
}

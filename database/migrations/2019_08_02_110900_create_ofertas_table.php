<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('unidade_id')->unsigned();
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->integer('empreendimento_id')->unsigned();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->decimal('preco_tabela', 14, 2)->nullable();
            $table->decimal('preco_oferta', 14, 2)->nullable();
            $table->decimal('percentual_desconto', 14, 2)->nullable();
            $table->decimal('valor_desconto', 14, 2)->nullable();
            
            $table->enum('tipo_negociacao', [
                'EntradaComFinanciamento',
                'EntradaParcelamentoDireto',
                'EntradaComBaloesFinanciamento',
                'EntradaComMensaisFinanciamento',
                'EntradaComMensaisBaloesFinanciamento',
                'Avista'
            ])->default('Avista')->nullable();

            $table->decimal('valor_entrada', 14, 2)->nullable();
            $table->decimal('percentual_entrada', 14, 2)->nullable();
            $table->decimal('saldo_remanescente', 14, 2)->nullable();

            $table->enum('aceita_bens', [
                'Sim',
                'Não',
            ])->default('Não')->nullable();

            $table->integer('quantidade_parcela')->nullable();
            $table->decimal('valor_parcela', 14, 2)->nullable();
            $table->date('validade')->nullable();
            $table->decimal('correcao_parcela', 14, 2)->nullable();
            $table->decimal('correcao_parcela_balao', 14, 2)->nullable();
            $table->longText('informacoes')->nullable();

            $table->enum('aceita_termos', [
                'Sim',
                'Não',
            ])->default('Não')->nullable();
                        
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
        Schema::dropIfExists('ofertas');
    }
}

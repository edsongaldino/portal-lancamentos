<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLancamentosFinanceirosRecorrentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamentos_financeiros_recorrentes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned()->nullable();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->enum('tipo_cobranca', ['Avulsa', 'Recorrente'])->default('Avulsa');
            $table->enum('tipo_fim_cobranca', ['Nunca', 'Especifico'])->default('Nunca');            
            $table->integer('qtd_recorrencia')->nullable()->default(0);
            $table->integer('qtd_recorrencia_restantes')->nullable()->default(0);
            $table->integer('dias_antes_vencimento_gerar_cobranca')->nullable()->default(0);
            $table->enum('situacao', ['Aberto', 'Pago', 'Cancelado'])->default('Aberto');
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
        Schema::dropIfExists('lancamentos_financeiros_recorrentes');
    }
}

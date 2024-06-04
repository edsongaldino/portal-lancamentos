<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQtdeParcelasEntradaToTabelaVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tabela_vendas', function (Blueprint $table) {
            $table->integer('qtd_parcelas_entrada')->after('percentual_entrada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tabela_vendas', function (Blueprint $table) {
            $table->removeColumn('qtd_parcelas_entrada');
        });
    }
}

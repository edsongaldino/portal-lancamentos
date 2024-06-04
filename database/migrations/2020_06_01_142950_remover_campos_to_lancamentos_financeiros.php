<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoverCamposToLancamentosFinanceiros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lancamentos_financeiros', function (Blueprint $table) {
            $table->dropColumn('valor_pago');
            $table->dropColumn('desconto');
            $table->dropColumn('juros');
            $table->dropColumn('competencia');
            $table->dropColumn('pago');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lancamentos_financeiros', function (Blueprint $table) {
            //
        });
    }
}

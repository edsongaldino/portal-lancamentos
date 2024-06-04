<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLancamentoFinanceiroRecorrenteIdToLancamentosFinanceiros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lancamentos_financeiros', function (Blueprint $table) {
            $table->integer('lancamento_financeiro_recorrente_id')->unsigned()->nullable()->after('construtora_id');
            $table->foreign('lancamento_financeiro_recorrente_id', 'lfr_id_foreign')->references('id')->on('lancamentos_financeiros_recorrentes');
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
            $table->dropColumn('lancamento_financeiro_recorrente_id');
        });
    }
}

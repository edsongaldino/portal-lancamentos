<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NovosCamposToLancamentosFinanceiros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lancamentos_financeiros', function (Blueprint $table) {
            $table->string('transacao_id')->nullable()->after('gerar_nf');
            $table->enum('situacao', ['Aberto', 'Pago', 'Cancelado'])->default('Aberto');
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
            $table->dropColumn('transacao_id');
        });
    }
}

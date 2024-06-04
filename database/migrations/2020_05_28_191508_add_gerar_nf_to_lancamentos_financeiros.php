<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGerarNfToLancamentosFinanceiros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lancamentos_financeiros', function (Blueprint $table) {
            $table->enum('gerar_nf', ['Sim', 'Não'])->default('Não')->after('url');
            $table->dropColumn('token');
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
            $table->dropColumn('gerar_nf');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnviarEmailToLancamentosFinanceiros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lancamentos_financeiros', function (Blueprint $table) {
            $table->enum('enviar_email', ['Sim', 'Não'])->default('Não');
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
            $table->dropColumn('enviar_email');
        });
    }
}

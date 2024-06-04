<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoToResumoEstatisticas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resumo_estatisticas', function (Blueprint $table) {
            $table->enum('tipo', ['Visualização', 'Clique'])->default('Visualização')->after('empreendimento_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resumo_estatisticas', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
}

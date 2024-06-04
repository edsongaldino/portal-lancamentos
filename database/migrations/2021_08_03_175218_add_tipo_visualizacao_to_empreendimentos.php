<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoVisualizacaoToEmpreendimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empreendimentos', function (Blueprint $table) {
            $table->enum('tipo_visualizacao', ['Padrão', 'Premium'])->default('Padrão')->after('telefone_central');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empreendimentos', function (Blueprint $table) {
            $table->removeColumn('tipo_visualizacao');
        });
    }
}

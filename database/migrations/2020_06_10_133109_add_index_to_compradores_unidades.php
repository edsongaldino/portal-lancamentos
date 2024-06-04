<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToCompradoresUnidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compradores_unidades', function (Blueprint $table) {
            $table->index('construtora_id');
            $table->index('empreendimento_id');
            $table->index('unidade_id');
            $table->index('nome');
            $table->index('valor');
            $table->index('valor_honorario');
            $table->index('origem_venda');
            $table->index('nome_corretor');
            $table->index('creci_corretor');
            $table->index('telefone_corretor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compradores_unidades', function (Blueprint $table) {
            $table->dropIndex('construtora_id');
            $table->dropIndex('empreendimento_id');
            $table->dropIndex('unidade_id');
            $table->dropIndex('nome');
            $table->dropIndex('valor');
            $table->dropIndex('valor_honorario');
            $table->dropIndex('origem_venda');
            $table->dropIndex('nome_corretor');
            $table->dropIndex('creci_corretor');
            $table->dropIndex('telefone_corretor');
        });
    }
}

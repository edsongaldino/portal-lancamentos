<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToUnidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unidades', function (Blueprint $table) {
            $table->index('construtora_id');
            $table->index('empreendimento_id');
            $table->index('torre_id');
            $table->index('quadra_id');
            $table->index('planta_id');
            $table->index('andar_id');
            $table->index('nome');
            $table->index('situacao');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unidades', function (Blueprint $table) {
            $table->dropIndex('construtora_id');
            $table->dropIndex('empreendimento_id');
            $table->dropIndex('torre_id');
            $table->dropIndex('quadra_id');
            $table->dropIndex('planta_id');
            $table->dropIndex('andar_id');
            $table->dropIndex('nome');
            $table->dropIndex('situacao');            
        });
    }
}

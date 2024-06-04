<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToEmpreendimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empreendimentos', function (Blueprint $table) {
            $table->index('variacao_id');
            $table->index('subtipo_id');
            $table->index('construtora_id');
            $table->index('endereco_id');
            $table->index('seo_id');
            $table->index('nome');
            $table->index('tipo');
            $table->index('status');
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
            $table->dropIndex('variacao_id');
            $table->dropIndex('subtipo_id');
            $table->dropIndex('construtora_id');
            $table->dropIndex('endereco_id');
            $table->dropIndex('seo_id');
            $table->dropIndex('nome');
            $table->dropIndex('tipo');
            $table->dropIndex('status');
        });
    }
}

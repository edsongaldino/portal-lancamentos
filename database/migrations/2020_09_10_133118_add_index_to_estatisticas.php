<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToEstatisticas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estatisticas', function (Blueprint $table) {
            $table->index('empreendimento_id');
            $table->index('tipo');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estatisticas', function (Blueprint $table) {
            $table->dropIndex('empreendimento_id');
            $table->dropIndex('tipo');
            $table->dropIndex('created_at');
        });
    }
}
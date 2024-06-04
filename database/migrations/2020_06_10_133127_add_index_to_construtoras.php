<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToConstrutoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('construtoras', function (Blueprint $table) {
            $table->index('endereco_id');
            $table->index('nome');
            $table->index('nome_abreviado');
            $table->index('email');
            $table->index('telefone');
            $table->index('cnpj');
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
        Schema::table('construtoras', function (Blueprint $table) {
            $table->dropIndex('endereco_id');
            $table->dropIndex('nome');
            $table->dropIndex('nome_abreviado');
            $table->dropIndex('email');
            $table->dropIndex('telefone');
            $table->dropIndex('cnpj');
            $table->dropIndex('status');
        });
    }
}

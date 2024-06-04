<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FazerRelacionamentos2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->foreign('bairro_id')->references('id')->on('bairros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('endereco', function (Blueprint $table) {
            $table->dropForeign('enderecos_cidade_id_for_id');
            $table->dropForeign('enderecos_bairro_id_for_id');
        });
    }
}

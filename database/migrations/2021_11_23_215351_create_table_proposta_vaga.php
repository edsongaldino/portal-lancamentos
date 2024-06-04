<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePropostaVaga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposta_vaga', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('proposta_id')->unsigned();
            $table->foreign('proposta_id')->references('id')->on('propostas');
            $table->integer('garagem_id')->unsigned();
            $table->foreign('garagem_id')->references('id')->on('garagens');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposta_vaga');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstrutorasAssinaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construtoras_assinaturas', function (Blueprint $table) {
            $table->integer('construtora_id')->unsigned();
            $table->integer('assinatura_id')->unsigned();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->foreign('assinatura_id')->references('id')->on('assinaturas');
            $table->date('inicio');
            $table->date('fim');
            $table->enum('forma_pagamento', ['Cartão de Crédito', 'Transferência Bancária', 'Boleto'])->default('Cartão de Crédito');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('construtoras_assinaturas');
    }
}

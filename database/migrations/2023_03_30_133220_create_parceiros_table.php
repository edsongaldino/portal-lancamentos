<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParceirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parceiros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('construtora_id')->unsigned();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->string('nome');
            $table->string('email');
            $table->string('telefone');
            $table->enum('situacao', ['Ativo', 'Bloqueado'])->default('Ativo');
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
        Schema::dropIfExists('parceiros');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaragensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garagens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pavimento_garagem_id')->unsigned()->nullable();
            $table->foreign('pavimento_garagem_id')->references('id')->on('pavimentos_garagens');
            $table->integer('construtora_id')->unsigned()->nullable();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('empreendimento_id')->unsigned()->nullable();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->integer('torre_id')->unsigned()->nullable();
            $table->foreign('torre_id')->references('id')->on('torres');
            $table->string('nome');
            $table->enum('situacao', ['Disponível', 'Reservada', 'Vendida', 'Bloqueada', 'Outros'])->default('Disponível')->nullable();
            $table->enum('status', ['Liberada', 'Bloqueada'])->default('Liberada')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('garagens');
    }
}

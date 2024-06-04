<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContatoClique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contato_clique', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('empreendimento_id')->unsigned()->nullable();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->enum('tipo_clique', ['Telefone','Whatsapp', 'Chat']);
            $table->string('nome');
            $table->string('whatsapp');
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
        Schema::dropIfExists('contato_clique');
    }
}

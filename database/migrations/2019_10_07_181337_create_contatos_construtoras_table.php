<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContatosConstrutorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatos_construtoras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->string('nome')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->enum('situacao', ['Liberada', 'Bloqueada'])->nullable();
            $table->enum('recebe_relatorio', ['Sim', 'Não'])->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('contatos_construtoras');
    }
}

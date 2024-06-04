<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estado_id')->unsigned()->nullable(true);
            $table->integer('cidade_id')->unsigned()->nullable(true);
            $table->integer('bairro_id')->unsigned()->nullable(true);
            $table->string('cep')->nullable(true);
            $table->string('logradouro')->nullable();
            $table->string('complemento')->nullable(true);
            $table->string('numero')->nullable();            
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
        Schema::dropIfExists('enderecos');
    }
}

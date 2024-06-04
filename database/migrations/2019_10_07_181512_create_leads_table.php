<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('empreendimento_id')->unsigned();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->string('nome')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('interesse')->nullable();
            $table->string('renda')->nullable();
            $table->string('previsao')->nullable();
            $table->string('mensagem')->nullable();
            $table->string('dispositivo')->nullable();
            $table->string('origem')->nullable();
            $table->string('tempo')->nullable();
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
        Schema::dropIfExists('leads');
    }
}

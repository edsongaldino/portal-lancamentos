<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstrutorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construtoras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('endereco_id')->unsigned()->nullable();
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->string('nome');
            $table->string('nome_abreviado')->nullable();
            $table->string('black_friday')->nullable();
            $table->string('url_hotsite')->nullable();
            $table->string('tempo_mercado')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->string('razao_social')->nullable(true);
            $table->string('cnpj')->nullable();
            $table->string('ie')->nullable(true);            
            $table->string('facebook')->nullable(true);
            $table->string('instagram')->nullable(true);
            $table->string('twitter')->nullable(true);
            $table->string('logo')->nullable(true);
            $table->integer('ano_fundacao')->nullable(true);
            $table->longText('observacoes')->nullable(true);
            $table->enum('status', ['Liberada', 'Bloqueada', 'Excluído'])->default('Liberada')->nullable();
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
        Schema::dropIfExists('construtoras');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePavimentosGaragensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pavimentos_garagens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned()->nullable();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('empreendimento_id')->unsigned()->nullable();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->integer('torre_id')->unsigned()->nullable();
            $table->foreign('torre_id')->references('id')->on('torres');
            $table->string('nome');            
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
        Schema::dropIfExists('pavimentos_garagens');
    }
}

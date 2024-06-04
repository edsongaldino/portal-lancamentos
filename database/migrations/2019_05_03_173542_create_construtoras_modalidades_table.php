<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstrutorasModalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construtoras_modalidades', function (Blueprint $table) {
            $table->integer('construtora_id')->unsigned();
            $table->integer('modalidade_id')->unsigned();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->foreign('modalidade_id')->references('id')->on('modalidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('construtoras_modalidades');
    }
}

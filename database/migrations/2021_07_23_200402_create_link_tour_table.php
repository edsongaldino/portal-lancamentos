<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkTourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_virtual', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('empreendimento_id')->unsigned()->nullable();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->string('link')->nullable();
            $table->string('titulo')->nullable();
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
        Schema::dropIfExists('tour_virtual');
    }
}

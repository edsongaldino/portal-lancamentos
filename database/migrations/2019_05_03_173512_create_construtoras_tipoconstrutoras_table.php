<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstrutorasTipoconstrutorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construtoras_tipoconstrutoras', function (Blueprint $table) {
            $table->integer('construtora_id')->unsigned();
            $table->integer('tipoconstrutora_id')->unsigned();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->foreign('tipoconstrutora_id')->references('id')->on('tipoconstrutoras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('construtoras_tipoconstrutoras');
    }
}

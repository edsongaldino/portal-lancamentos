<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAndaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('andares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('torre_id')->unsigned();
            $table->foreign('torre_id')->references('id')->on('torres');
            $table->string('numero');
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
        Schema::dropIfExists('andares');
    }
}

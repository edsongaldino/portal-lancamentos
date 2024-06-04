<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompradoresGaragensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compradores_garagens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('garagem_id')->unsigned()->nullable();
            $table->foreign('garagem_id')->references('id')->on('garagens');
            $table->string('nome')->nullable();
            $table->decimal('valor', 14, 2)->nullable();
            $table->date('data')->nullable();
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
        Schema::dropIfExists('compradores_garagens');
    }
}

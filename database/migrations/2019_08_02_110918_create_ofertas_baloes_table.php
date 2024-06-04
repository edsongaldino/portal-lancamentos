<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertasBaloesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas_baloes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oferta_id')->unsigned();
            $table->decimal('valor', 14, 2)->nullable();
            $table->date('data')->nullable();
            $table->foreign('oferta_id')->references('id')->on('ofertas');
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
        Schema::dropIfExists('ofertas_baloes');
    }
}

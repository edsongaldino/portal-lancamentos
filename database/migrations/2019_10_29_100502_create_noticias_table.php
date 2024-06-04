<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo')->nullable();
            $table->date('data')->nullable();
            $table->string('arquivo')->nullable();
            $table->longtext('texto')->nullable();
            $table->enum('status', ['Excluída', 'Bloqueada', 'Liberada']);
            $table->string('resumo')->nullable();
            $table->string('fonte')->nullable();
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
        Schema::dropIfExists('noticias');
    }
}

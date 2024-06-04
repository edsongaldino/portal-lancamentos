<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned()->nullable();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('empreendimento_id')->unsigned()->nullable();
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
            $table->integer('torre_id')->unsigned()->nullable();
            $table->foreign('torre_id')->references('id')->on('torres');
            $table->integer('quadra_id')->unsigned()->nullable();
            $table->foreign('quadra_id')->references('id')->on('quadras');
            $table->integer('planta_id')->unsigned()->nullable();
            $table->foreign('planta_id')->references('id')->on('plantas');
            $table->string('nome');
            $table->integer('andar_id')->unsigned()->nullable();
            $table->foreign('andar_id')->references('id')->on('andares');
            $table->string('andar_antigo')->nullable();
            $table->enum('situacao', ['Disponível', 'Reservada', 'Vendida', 'Bloqueada', 'Outros'])->default('Disponível')->nullable();
            $table->enum('status', ['Liberada', 'Bloqueada', 'Excluído'])->default('Liberada')->nullable();
            $table->integer('coord_x')->nullable();
            $table->integer('coord_y')->nullable();
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
        Schema::dropIfExists('unidades_verticais');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas_unidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unidade_id')->unsigned()->nullable();
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->enum('tipo_reserva', ['Cliente','Parceiro'])->nullable()->default(null);

            $table->string('nome_cliente')->nullable();
            $table->string('cpf_cliente')->nullable();
            $table->string('telefone_cliente')->nullable();
            $table->string('email_cliente')->nullable();

            $table->string('nome_parceiro')->nullable();
            $table->string('creci_parceiro')->nullable();
            $table->string('telefone_parceiro')->nullable();
            $table->string('email_parceiro')->nullable();

            $table->date('data_final_reserva')->nullable();
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
        Schema::dropIfExists('reservas_unidades');
    }
}

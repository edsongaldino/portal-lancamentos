<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conjuge_id')->nullable();
            $table->string('nome');
            $table->string('cpf')->nullable();
            $table->string('data_nascimento')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->enum('estado_civil', [
                'Solteiro', 
                'Casado', 
                'Viúvo', 
                'União Estável', 
                'Separado',
                'Divorciado',
                'Não Informado'
            ])->nullable();
            $table->decimal('renda', 14, 2)->nullable();
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
        Schema::dropIfExists('clientes');
    }
}

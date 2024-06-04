<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoVagatoGaragens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('garagens', function (Blueprint $table) {
            $table->enum('tipo_vaga', ['Individual','Gaveta'])->default('Individual')->after('unidade_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('garagens', function (Blueprint $table) {
            $table->removeColumn('tipo_vaga');
        });
    }
}

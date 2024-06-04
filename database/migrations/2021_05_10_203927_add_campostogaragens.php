<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddCampostogaragens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('garagens', function (Blueprint $table) {
            DB::statement("ALTER TABLE garagens MODIFY tipo_vaga enum('Gaveta Coberta','Individual Coberta','Gaveta Descoberta','Individual Descoberta') NOT NULL;");
            DB::statement("UPDATE `garagens` set `tipo_vaga` = 'Individual Coberta' where `tipo_vaga` = 'Individual';");
            DB::statement("UPDATE `garagens` set `tipo_vaga` = 'Gaveta Coberta' where `tipo_vaga` = 'Gaveta';");
            DB::statement("ALTER TABLE garagens MODIFY tipo_vaga enum('Gaveta Coberta','Individual Coberta','Gaveta Descoberta','Individual Descoberta') NOT NULL;");

            $table->enum('vaga_pne', ['Não','Sim'])->default('Não')->after('status');
            $table->enum('formato_vaga', ['Padrão','Extra', 'Visitante'])->default('Padrão')->after('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

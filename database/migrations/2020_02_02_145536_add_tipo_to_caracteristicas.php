<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoToCaracteristicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE caracteristicas MODIFY COLUMN tipo ENUM('Geral','Empreendimento','Torre','Planta','Quadra','Lazer','Proximidades','Unidade','Foto','Garagem')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE caracteristicas MODIFY COLUMN tipo ENUM('Geral','Empreendimento','Torre','Planta','Quadra','Lazer','Proximidades','Unidade')");
    }
}

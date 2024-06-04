<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionaTipoTelefoneFixoSemDddToTelefones extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE telefones MODIFY COLUMN tipo ENUM('Celular','Fixo','WhatsApp','CelularWhatsApp', 'FixoSemDDD') DEFAULT 'Fixo'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE telefones MODIFY COLUMN tipo ENUM('Celular','Fixo','WhatsApp','CelularWhatsApp') DEFAULT 'Fixo'");
    }
}

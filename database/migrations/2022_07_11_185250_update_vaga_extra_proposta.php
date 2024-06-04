<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateVagaExtraProposta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('propostas', function (Blueprint $table) {
            DB::statement("ALTER TABLE propostas MODIFY vaga_extra enum('Não','Padrão','Gaveta Dupla') NOT NULL;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('propostas', function (Blueprint $table) {
            DB::statement("ALTER TABLE propostas MODIFY vaga_extra enum('Sim','Não) NOT NULL;");
        });
    }
}

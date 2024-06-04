<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteraSituacaoPadraoToEmpreendimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE empreendimentos MODIFY COLUMN status ENUM('Liberada','Bloqueada','Excluído') DEFAULT 'Bloqueada'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE empreendimentos MODIFY COLUMN status ENUM('Liberada','Bloqueada','Excluído') DEFAULT 'Liberada'");
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteraPerfilUserDomus2 extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN perfil_domus ENUM('Não Integrado','Integrado') DEFAULT 'Não Integrado'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN perfil_domus ENUM('Não Integrado','Integrado') DEFAULT 'Não Integrado'");
    }
}

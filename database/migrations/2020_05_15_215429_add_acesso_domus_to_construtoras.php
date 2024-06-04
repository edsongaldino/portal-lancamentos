<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcessoDomusToConstrutoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('construtoras', function (Blueprint $table) {
            $table->enum('acesso_domus', ['Sim', 'Não'])->default('Não');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('construtoras', function (Blueprint $table) {
            $table->removeColumn('acesso_domus');
        });
    }
}

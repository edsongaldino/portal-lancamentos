<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViewCorretorToEmpreendimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empreendimentos', function (Blueprint $table) {
            $table->enum('view_corretor', ['Sim', 'Não'])->default('Não')->after('tipo_visualizacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empreendimentos', function (Blueprint $table) {
            $table->removeColumn('view_corretor');
        });
    }
}

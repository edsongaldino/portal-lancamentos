<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGerouUnidadesToTorres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('torres', function (Blueprint $table) {
            $table->enum('gerou_unidades', ['Sim', 'Não'])->default('Não')->after('observacoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('torres', function (Blueprint $table) {
            $table->dropColumn('gerou_unidades');
        });
    }
}

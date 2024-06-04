<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGerouGaragensToPavimentosGaragens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pavimentos_garagens', function (Blueprint $table) {
            $table->enum('gerou_garagens', ['Não', 'Sim'])->default('Não')->after('nome');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pavimentos_garagens', function (Blueprint $table) {
            $table->dropColumn('gerou_garagens');
        });
    }
}

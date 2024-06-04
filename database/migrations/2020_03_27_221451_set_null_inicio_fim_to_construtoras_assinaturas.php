<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullInicioFimToConstrutorasAssinaturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('construtoras_assinaturas', function (Blueprint $table) {
            $table->date('inicio')->nullable()->change();
            $table->date('fim')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('construtoras_assinaturas', function (Blueprint $table) {
            
        });
    }
}

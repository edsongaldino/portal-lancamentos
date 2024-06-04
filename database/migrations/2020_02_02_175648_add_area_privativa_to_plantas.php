<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAreaPrivativaToPlantas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plantas', function (Blueprint $table) {
            $table->decimal('area_privativa', 14, 2)->nullable()->after('foto_terceira_planta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plantas', function (Blueprint $table) {
            $table->dropColumn('area_privativa');
        });
    }
}

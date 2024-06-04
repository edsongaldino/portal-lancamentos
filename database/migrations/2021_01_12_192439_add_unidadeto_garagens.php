<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnidadetoGaragens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('garagens', function (Blueprint $table) {
            $table->Integer('unidade_id')->length(10)->unsigned()->nullable()->after('torre_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('garagens', function (Blueprint $table) {
            $table->removeColumn('unidade_id');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTabelaBaloes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tabela_baloes', function (Blueprint $table) {
            $table->Integer('tabela_id')->length(10)->unsigned();
            $table->decimal('percentual_balao', 14, 2)->nullable();
            $table->date('data_balao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tabela_baloes', function (Blueprint $table) {
            $table->removeColumn('tabela_id');
            $table->removeColumn('percentual_balao');
            $table->removeColumn('data_balao');
        });
    }
}

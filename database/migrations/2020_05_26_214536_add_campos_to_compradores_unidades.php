<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposToCompradoresUnidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compradores_unidades', function (Blueprint $table) {
            $table->string('email')->after('data')->nullable();
            $table->string('celular')->after('data')->nullable();
            $table->string('estado_civil')->after('data')->nullable();
            $table->string('nome_esposa')->after('data')->nullable();
            $table->string('origem_venda')->after('data')->nullable();
            $table->string('nome_corretor')->after('data')->nullable();
            $table->string('creci_corretor')->after('data')->nullable();
            $table->string('telefone_corretor')->after('data')->nullable();
            $table->decimal('percentual_honorario', 14, 2)->after('data')->nullable();
            $table->decimal('valor_honorario', 14, 2)->after('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compradores_unidades', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('celular');
            $table->dropColumn('estado_civil');
            $table->dropColumn('nome_esposa');
            $table->dropColumn('origem_venda');
            $table->dropColumn('nome_corretor');
            $table->dropColumn('creci_corretor');
            $table->dropColumn('telefone_corretor');
            $table->dropColumn('percentual_honorario');
            $table->dropColumn('valor_honorario');
        });
    }
}

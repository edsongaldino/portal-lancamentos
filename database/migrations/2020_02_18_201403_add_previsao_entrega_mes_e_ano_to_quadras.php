<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrevisaoEntregaMesEAnoToQuadras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quadras', function (Blueprint $table) {
            $table->string('previsao_entrega_mes')->nullable()->after('nome');
            $table->string('previsao_entrega_ano')->nullable()->after('nome');
            $table->dropColumn('previsao_entrega');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quadras', function (Blueprint $table) {
            $table->dropColumn('previsao_entrega_mes');
            $table->dropColumn('previsao_entrega_ano');
            $table->date('previsao_entrega')->nullable();
        });
    }
}

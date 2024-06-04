<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposPercentuaisToTabelaVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tabela_vendas', function (Blueprint $table) {
            $table->decimal('percentual_juros_mensal', 14, 2)->nullable()->after('percentual_mensais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tabela_vendas', function (Blueprint $table) {
            $table->removeColumn('percentual_juros_mensal');
        });
    }
}

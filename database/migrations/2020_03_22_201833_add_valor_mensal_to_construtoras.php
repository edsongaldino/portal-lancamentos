<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValorMensalToConstrutoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('construtoras', function (Blueprint $table) {
            $table->decimal('valor_mensal', 14,2)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('construtoras', function (Blueprint $table) {
            $table->dropColumn('valor_mensal');
        });
    }
}

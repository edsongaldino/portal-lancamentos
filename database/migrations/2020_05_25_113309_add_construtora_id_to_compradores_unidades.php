<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstrutoraIdToCompradoresUnidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compradores_unidades', function (Blueprint $table) {
            $table->integer('construtora_id')->unsigned()->after('id')->nullable();
            $table->foreign('construtora_id')->references('id')->on('construtoras');
            $table->integer('empreendimento_id')->unsigned()->nullable()->after('construtora_id');
            $table->foreign('empreendimento_id')->references('id')->on('empreendimentos');
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
            $table->dropColumn('construtora_id');
            $table->dropColumn('empreendimento_id');
        });
    }
}

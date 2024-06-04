<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoSubtipoEmpreendimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empreendimentos_subtipos', function ($table) {
            $table->increments('id');
            $table->string('nome');
            $table->enum('tipo', ['Vertical', 'Horizontal'])->nullable()->default('Vertical');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('empreendimentos_variacoes', function ($table) {
            $table->increments('id');
            $table->integer('subtipo_id')->nullable()->unsigned();
            $table->foreign('subtipo_id')->references('id')->on('empreendimentos_subtipos');
            $table->string('nome');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('empreendimentos', function ($table) {
            $table->integer('subtipo_id')->unsigned()->nullable()->after('id');
            $table->integer('variacao_id')->unsigned()->nullable()->after('id');
            $table->foreign('subtipo_id', 'empreendimentos_empreendimentos_subtipos')->references('id')->on('empreendimentos_subtipos');
            $table->foreign('variacao_id', 'empreendimentos_empreendimentos_variacoes')->references('id')->on('empreendimentos_variacoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empreendimentos', function ($table) {
            $table->dropColumn('subtipo_id');
            $table->dropColumn('variacao_id');
        });

        Schema::dropIfExists('empreendimentos_subtipos');
        Schema::dropIfExists('empreendimentos_variacoes');
    }
}

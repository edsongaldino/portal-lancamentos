<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVagaExtraToTabela extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tabela_vendas', function (Blueprint $table) {
            $table->enum('possui_vaga_extra', ['Não', 'Sim_PG', 'Sim_SG', 'Sim_SP'])->default('Não')->after('valor_vaga_extra');
            $table->decimal('valor_vaga_extra_gaveta', 14, 2)->nullable()->after('valor_vaga_extra');
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
            $table->removeColumn('possui_vaga_extra');
            $table->removeColumn('valor_vaga_extra_gaveta');
        });
    }
}

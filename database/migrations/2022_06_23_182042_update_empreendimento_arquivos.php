<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateEmpreendimentoArquivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empreendimentos_arquivos', function (Blueprint $table) {
            DB::statement("ALTER TABLE empreendimentos_arquivos MODIFY tipo enum('Memorial Descritivo','Vídeo','Tabela') NOT NULL;");
            $table->string('descricao')->nullable()->after('arquivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empreendimentos_arquivos', function (Blueprint $table) {
            DB::statement("ALTER TABLE empreendimentos_arquivos MODIFY tipo enum('Memorial Descritivo') NOT NULL;");
            $table->removeColumn('descricao');
        });
    }
}

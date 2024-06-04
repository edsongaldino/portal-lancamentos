<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPreferenciastoPropostas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('propostas', function (Blueprint $table) {
            $table->enum('preferencia_contato', ['Telefone', 'Whatsapp', 'E-mail', 'Qualquer Opção'])->default('Qualquer Opção')->after('comentarios');
            $table->enum('preferencia_horario', ['Manhã', 'Tarde', 'Horário de Almoço', 'Horário Comercial', 'Noite', 'Qualquer'])->default('Qualquer')->after('comentarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('propostas', function (Blueprint $table) {
            $table->removeColumn('preferencia_contato');
            $table->removeColumn('preferencia_horario');
        });
    }
}

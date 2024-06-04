<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo')->after('email');
            $table->date('data_nascimento')->nullable(true)->after('email');
            $table->string('cpf')->nullable(true)->after('email');
            $table->string('celular')->nullable(true)->after('email');
            $table->string('whatsapp')->nullable(true)->after('email');
            $table->string('telefone_fixo')->nullable(true)->after('email');
            $table->longText('perfil_profissional')->nullable(true)->after('email');
            $table->longText('foto')->nullable(true)->after('email');
            $table->enum('recebe_relatorio', ['Sim', 'Não'])->default('Não');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->removeColumn('status');            
            $table->removeColumn('telefone_fixo');
            $table->removeColumn('celular');
            $table->removeColumn('whatsapp');
            $table->removeColumn('data_nascimento');
            $table->removeColumn('cpf');
        });
    }
}

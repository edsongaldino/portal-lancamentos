<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToConstrutoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('construtoras', function (Blueprint $table) {
            $table->enum('envio_lead', ['Ativo', 'Bloqueado'])->default('Ativo')->after('status');
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
            //
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorretorEmpreendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corretor_empreendimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('corretor_id')->constrained('corretor');
            $table->bigInteger('empreendimento_id')->constrained('empreendimentos');
            $table->date('data_vencimento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corretor_empreendimentos');
    }
}

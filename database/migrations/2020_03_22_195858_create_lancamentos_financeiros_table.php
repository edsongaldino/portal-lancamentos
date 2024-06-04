<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLancamentosFinanceirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamentos_financeiros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construtora_id')->unsigned()->nullable();
            $table->foreign('construtora_id')->references('id')->on('construtoras');            
            $table->string('nome');            
            $table->decimal('valor', 14, 2)->nullable();
            $table->decimal('valor_pago', 14, 2)->nullable();
            $table->decimal('desconto', 14, 2)->nullable();
            $table->decimal('juros', 14, 2)->nullable();
            $table->enum('pago', ['Sim', 'Não'])->default('Não');
            $table->date('competencia')->nullable();
            $table->date('vencimento')->nullable();
            $table->string('observacoes');            
            $table->string('url')->nullable();
            $table->string('token')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('lancamentos_financeiros');
    }
}

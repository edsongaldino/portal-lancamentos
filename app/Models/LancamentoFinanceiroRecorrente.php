<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LancamentoFinanceiroRecorrente extends Model
{
	use SoftDeletes;

	/*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $table = 'lancamentos_financeiros_recorrentes';
	protected $fillable = [
		'tipo_cobranca',
		'tipo_fim_cobranca',
		'qtd_recorrencia',
		'qtd_recorrencia_restantes',
		'dias_antes_vencimento_gerar_cobranca',
		'situacao'
	];
	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	public function registrar(array $parametros)
	{		
		$lancamento = $this;
		$lancamento->construtora_id = $parametros['construtora_id'];
		$lancamento->tipo_cobranca = $parametros['tipo_cobranca'];
		$lancamento->tipo_fim_cobranca = $parametros['tipo_fim_cobranca'];
		$lancamento->qtd_recorrencia = $parametros['qtd_recorrencia'];
		$lancamento->qtd_recorrencia_restantes = $parametros['qtd_recorrencia'];
		$lancamento->dias_antes_vencimento_gerar_cobranca = $parametros['dias_antes_vencimento_gerar_cobranca'];
		$lancamento->save();

		return $lancamento->id;
	}

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

	public function construtora()
	{
		return $this->belongsTo('App\Models\Construtora');
	}

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
}

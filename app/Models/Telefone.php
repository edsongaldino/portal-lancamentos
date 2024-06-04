<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telefone extends Model
{
	use SoftDeletes;

	/*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $table = 'telefones';
	protected $fillable = ['construtora_id', 'numero', 'tipo'];
	protected $dates = ['deleted_at'];

	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	public function cadastrar($request, $construtora)
	{
		$numeros_telefones = array_filter($request->numero_telefone);
		$tipos_telefones = array_filter($request->tipo_telefone);

		if (!isset($numeros_telefones)) {
			return false;
		}
		
		foreach ($numeros_telefones as $k => $numero) {
		    if (isset($tipos_telefones[$k])) {
		        $telefone = $this->create([
		        	'construtora_id' => $construtora->id,
		            'numero' => $numero,
		            'tipo'   => $tipos_telefones[$k]
		        ]);
		    }
		}
	}

	public function atualizar($request, $construtora)
	{
		$numeros_telefones = array_filter($request->numero_telefone);
		$tipos_telefones = array_filter($request->tipo_telefone);

		$telefones = $construtora->telefones;

		foreach ($telefones as $telefone) {
		    $telefone->delete();
		}

		if ($numeros_telefones) {		    		    		    
		    $this->cadastrar($request, $construtora);
		}
	}

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

	public function construtora()
	{
	    return $this->belongsTo('App\Models\Construtora', 'construtoras_telefones');
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

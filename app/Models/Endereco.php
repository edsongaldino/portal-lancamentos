<?php

namespace App\Models;

use App\Models\Bairro;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\UserPerfil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
	use SoftDeletes;
	
	/*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/


	protected $table = 'enderecos';
	protected $fillable = [
		'construtora_id',
		'estado_id',
		'cidade_id',
		'bairro_id',
		'cep',
		'logradouro',
		'complemento',
		'numero',
		'latitude',
		'longitude'
	];
	protected $dates = ['deleted_at'];

	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	public function cadastrar($request)
	{		
		if ($this->validar($request)) {
			$endereco = $this->salvar($request, null);
			return $endereco->id;
		}
	}

	public function atualizar($request, $model)
	{
		if ($this->validar($request)) {
			$endereco = $model->endereco;
    		$this->salvar($request, $endereco->id);	
		}
	}

	public function atualizarEnderecoStand($request, $model)
	{
		if ($this->validar($request)) {
			$endereco = $model->enderecoStand;
    		$this->salvar($request, $endereco->id);	
		}
	}

	public function validar($request)
	{
		if (!isset($request->cidade_id) or !isset($request->logradouro) or !isset($request->numero)) {
			return false;
		}

		return true;
	}

	public function salvar($request, $id = null) 
	{		
		$endereco = new Endereco();
		
		if ($id) {
			$endereco = $this->find($id);
		}

		$estado = $this->getEstado($request->estado_id, $request->estado_nome_cep);
		$cidade = $this->getCidade($request->cidade_id, $request->cidade_nome_cep, $estado->id);		
		$bairro = $this->getBairro($request->bairro_id, $request->bairro_nome_cep, $cidade->id);			
		
		$endereco->logradouro = $request->logradouro;
		$endereco->estado_id = $estado->id;
		$endereco->cidade_id = $cidade->id;
		$endereco->bairro_id = $bairro->id;
		$endereco->numero = $request->numero;
		$endereco->bairro_comercial = $request->bairro_comercial;
		$endereco->cep = $request->cep;
		$endereco->complemento = $request->complemento;
		$endereco->marcar_mapa = $request->marcar_mapa;
		$endereco->save();

		return $endereco;
	}

	public function getBairro($bairro_id, $bairro_nome, $cidade_id)
	{
		if ($bairro_id) {
			return Bairro::find($bairro_id);
		}

		$bairro = new Bairro();

		$existe = Bairro::where('nome', $bairro_nome)->where('status', 'L')->where('cidade_id', $cidade_id)->first();

		if ($existe) {
			$bairro = $existe;
		} else {
			$bairro->nome = $bairro_nome;
			$bairro->cidade_id = $cidade_id;
			$bairro->status = 'L';
			$bairro->save();	
		}

		return $bairro;
	}

	public function getCidade($cidade_id, $cidade_nome, $estado_id)
	{
		if ($cidade_id) {
			return Cidade::find($cidade_id);
		}

		$cidade = new Cidade();

		$existe = Cidade::where('nome', $cidade_nome)->where('status', 'L')->where('estado_id', $cidade_id)->first();;

		if ($existe) {
			$cidade = $existe;
		} else {
			$cidade->nome = $cidade_nome;
			$cidade->estado_id = $estado_id;
			$cidade->status = 'L';
			$cidade->save();	
		}

		return $cidade;
	}

	public function getEstado($estado_id, $uf)
	{
		if ($estado_id) {
			return Estado::find($estado_id);
		}

		$estado = new Estado();

		$existe = Estado::where('uf', $uf)->where('status', 'L')->first();

		if ($existe) {
			$estado = $existe;
		} else {
			$estado->nome = Estado::getEstadoNomeByUf($uf);
			$estado->uf = $uf;
			$estado->status = 'L';
			$estado->save();	
		}	

		return $estado;
	}	

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

	public function cidade()
	{
		return $this->belongsTo('App\Models\Cidade');
	}

	public function estado()
	{
		return $this->belongsTo('App\Models\Estado');
	}

	public function bairro()
	{
		return $this->belongsTo('App\Models\Bairro');
	}

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

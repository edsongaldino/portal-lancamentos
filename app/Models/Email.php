<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
	use SoftDeletes;

	/*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $table = 'emails';
	protected $fillable = ['construtora_id', 'email'];
	protected $dates = ['deleted_at'];

	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	public function cadastrar($request, $construtora)
	{
		if ($this->validar($request)) {
			$emails = json_decode($request->emails, true);

			foreach ($emails as $email) {	    
		        $email = $this->create([
		        	'construtora_id' => $construtora->id,
		            'email' => $email['email']
		        ]);
			}
		}
	}

	public function validar($request)
	{
		$emails = array_filter(json_decode($request->emails, true));		

		if (!$emails) {
			return false;
		}

		return true;
	}

	public function atualizar($request, $construtora)
	{
		$emails = $construtora->emails;  

		foreach ($emails as $email) {
		    $email->delete();
		}
		
	    $this->cadastrar($request, $construtora);
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

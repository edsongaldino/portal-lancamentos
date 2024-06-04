<?php

namespace App\Traits;

use App\Models\Construtora;
use \Auth;

trait ConstrutoraTrait {

	protected $construtora;

	public function getConstrutora()
	{
		return $this->construtora = Construtora::find(Auth::user()->construtora_id);
	}
}
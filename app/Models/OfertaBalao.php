<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfertaBalao extends Model
{
   	use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'ofertas_baloes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['oferta_id', 'valor', 'data'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvarBaloes($request, $oferta)
    {
		$baloes = $oferta->baloes;

		foreach ($baloes as $balao) {
		    $balao->delete();
		}

		$valores = array_filter($request->valor_parcela_balao);
		$datas = array_filter($request->data_parcela_balao);

	    $this->cadastrar($valores, $datas, $oferta);
    }

    public function cadastrar($valores, $datas, $oferta)
    {
    	if (!isset($valores)) {
    		return false;
    	}
    	
    	foreach ($valores as $k => $valor) {
    	    if (isset($datas[$k])) {
    	        $balao = $this->create([
                    'oferta_id' => $oferta->id,
    	            'valor' => $valor,
    	            'data'   => $datas[$k]
    	        ]);
    	    }
    	}
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */


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

    public function getValorAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getDataAttribute($valor)
    {
        if ($valor && (new \DateTime($valor))) {
            return (new \DateTime($valor))->format('d/m/Y');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setDataAttribute($valor)
    {
        if ($valor && (\DateTime::createFromFormat('d/m/Y', $valor))) {
            $this->attributes['data'] = (\DateTime::createFromFormat('d/m/Y', $valor))->format('Y-m-d');
        }
    }

    public function setValorAttribute($valor)
    {
        $valor = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor'] = $valor;
    }
}

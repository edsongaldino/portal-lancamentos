<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropostaBalao extends Model
{
   	use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'propostas_baloes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['proposta_id', 'valor', 'data'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvarBaloes($request, $proposta)
    {
		$valores = array_filter($request->valor_parcela_balao);
		$datas = array_filter($request->data_parcela_balao);
	    $this->cadastrar($valores, $datas, $proposta);
    }

    public function delBaloes($proposta)
    {
		$balao = PropostaBalao::where('proposta_id',$proposta->id);
        $balao->delete();
    }

    public function cadastrar($valores, $datas, $proposta)
    {
    	if (!isset($valores)) {
    		return false;
    	}
    	
    	foreach ($valores as $k => $valor) {
    	    if (isset($datas[$k])) {
    	        $balao = $this->create([
                    'proposta_id' => $proposta->id,
    	            'valor' => $valor,
    	            'data'   => data_mysql($datas[$k])
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
    
    public function setValorAttribute($valor)
    {
        $valor = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor'] = $valor;
    }
}

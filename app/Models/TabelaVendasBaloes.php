<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabelaVendasBaloes extends Model
{

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'tabela_baloes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['tabela_id', 'percentual_balao', 'data_balao'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvarBaloes($request, $tabela)
    {
		$baloes = $tabela->baloes;

		foreach ($baloes as $balao) {
		    $balao->delete();
		}

	    for($i=0;$i<count($request->data_parcela_balao);$i++){

            $balao = new TabelaVendasBaloes();
            $balao->tabela_id = $tabela->id;
            $balao->percentual_balao = $request->percentual_parcela_balao[$i];
            $balao->data_balao = $request->data_parcela_balao[$i];
            $balao->save();
    
        }
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Garagem;

class PropostaVaga extends Model
{
    protected $table = 'proposta_vaga';
    protected $fillable = ['proposta_id', 'garagem_id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvarVaga($request, $proposta)
    {
		$vaga = new PropostaVaga();
        $vaga->garagem_id = $request->idVaga;
        $vaga->proposta_id = $proposta->id;
        $vaga->save();
        //(new Garagem())->atualizarUnidade($proposta->unidade_id, $request->idVaga);
        return $vaga;
    }

    public function removerVaga($request)
    {
		$vaga = PropostaVaga::where('proposta_id',$request->proposta_id)->where('garagem_id',$request->vaga_id);
        $vaga->delete();
    }

    public function vaga()
    {
        return $this->belongsTo('App\Models\Garagem', 'garagem_id', 'id');        
    }
}

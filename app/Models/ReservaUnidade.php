<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservaUnidade extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'reservas_unidades';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvar(array $dados)
    {
        $reserva = ReservaUnidade::where('unidade_id', $dados['unidade_id'])->first();
        
        if (!$reserva) {
            $reserva = new ReservaUnidade();
            $reserva->unidade_id = $dados['unidade_id'];
        }   
        
        $reserva->tipo_reserva = $dados['tipo_reserva'];
        $reserva->data_final_reserva = $dados['data_final_reserva'];

        $reserva->nome_cliente = $dados['nome_cliente'];
        $reserva->cpf_cliente = $dados['cpf_cliente'];
        $reserva->email_cliente = $dados['email_cliente'];        
        $reserva->telefone_cliente = $dados['telefone_cliente'];

        $reserva->nome_parceiro = $dados['nome_parceiro'];
        $reserva->creci_parceiro = $dados['creci_parceiro'];
        $reserva->telefone_parceiro = $dados['telefone_parceiro'];
        $reserva->email_parceiro = $dados['email_parceiro'];

        $reserva->save();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function unidade()
    {
        return $this->belongsTo('App\Models\Unidade');
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

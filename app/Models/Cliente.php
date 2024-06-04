<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'clientes';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvar($request)
    {
        $cliente = $this;
        $existe = $this->getByCpf($request->cpf);
        
        if ($existe) {
            $cliente = $existe;
        }

        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;

        if ($request->data_nascimento) {
            $cliente->data_nascimento = $request->data_nascimento;    
        }
        
        if ($request->email) {
            $cliente->email = $request->email;
        }

        if ($request->telefone) {
            $cliente->telefone = $request->telefone;
        }

        $cliente->estado_civil = $request->estado_civil;

        if ($request->renda) {
            $cliente->renda = converte_reais_to_mysql($request->renda);
        }

        $cliente->save();

        return $cliente;
    }

    public function salvarConjuge($request, $cliente)
    {
        if ($request->conjuge_nome) {
            $conjuge = $this;
            $conjuge->nome = $request->conjuge_nome;
            $conjuge->cpf = $request->conjuge_cpf;
            $conjuge->estado_civil = $request->estado_civil;
            $conjuge->save();
            
            $cliente->conjuge_id = $conjuge->id;
            $cliente->save();

            $conjuge->conjuge_id = $cliente->id;
            $conjuge->save();
        }

        return $conjuge;
    }

    public function getByCpf($cpf)
    {
        return $this->where('cpf', $cpf)->get()->first();
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
    /*
    public function getDataNascimentoAttribute($valor)
    {
        if ($valor && (new \DateTime($valor))) {
            return (new \DateTime($valor))->format('d/m/Y');
        }
    }*/

    public function getRendaAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

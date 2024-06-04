<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompradorGaragem extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'compradores_garagens';
    protected $fillable = ['nome', 'valor', 'data'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvar(array $dados)
    {
        $comprador = CompradorGaragem::where('garagem_id', $dados['garagem_id'])->first();

        if (!$comprador) {
            $comprador = new CompradorGaragem();
            $comprador->garagem_id = $dados['garagem_id'];
        }

        if (isset($dados['nome']) && $dados['nome']) {
            $comprador->nome = $dados['nome'];
        }

        if (isset($dados['valor']) && $dados['valor']) {
            $comprador->valor = $dados['valor'];
        }

        if (isset($dados['data']) && $dados['data']) {
            $comprador->data = $dados['data'];
        }

        $comprador->save();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function garagem()
    {
        return $this->belongsTo('App\Models\Garagem');
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

    public function getValorAttribute($valor)
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

    public function setValorAttribute($valor)
    {
        $valor_venda = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor'] = $valor_venda;
    }
}

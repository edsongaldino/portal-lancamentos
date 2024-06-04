<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\CrudTrait;

class Assinatura extends Model
{
    use SoftDeletes, CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'assinaturas';
    protected $fillable = ['nome', 'preco', 'tipo', 'quantidade_produtos', 'preco_desconto', 'periodo_bonus', 'valor_adicional'];
    protected $dates = ['deleted_at'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function cadastrar($request, $construtora)
    {
        $this->salvar($request, $construtora);
    }

    public function atualizar($request, $construtora)
    {
        $construtora->assinatura()->detach();
        $this->salvar($request, $construtora);
    }

    public function salvar($request, $construtora) 
    {
        $construtora->assinatura()->attach($request->assinatura_id);
    }

    public function getValorPorUnidade()
    {
        return number_format($this->getOriginal('preco') / $this->getOriginal('quantidade_produtos'), 2, ',', '.');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function construtora()
    {
        return $this->belongsToMany(
            'App\Models\Construtora', 
            'construtoras_assinaturas'
        );
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

    public function getPrecoAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getPrecoDescontoAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getValorAdicionalAttribute($valor)
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

    public function setPrecoAttribute($valor)
    {
        $preco = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['preco'] = $preco;
    }

    public function setPrecoDescontoAttribute($valor)
    {
        $preco = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['preco_desconto'] = $preco;
    }

    public function setValorAdicionalAttribute($valor)
    {
        $valor = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor_adicional'] = $valor;
    }
}

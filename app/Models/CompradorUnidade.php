<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompradorUnidade extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'compradores_unidades';
    protected $fillable = [
        'nome',
        'cpf', 
        'valor', 
        'data',
        'email',
        'celular',
        'estado_civil',
        'nome_esposa',
        'origem_venda',
        'nome_corretor',
        'creci_corretor',
        'telefone_corretor',
        'percentual_honorario',
        'valor_honorario',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvar(array $dados)
    {
        $comprador = CompradorUnidade::where('unidade_id', $dados['unidade_id'])->first();
        
        if (!$comprador) {
            $comprador = new CompradorUnidade();
            $comprador->unidade_id = $dados['unidade_id'];
        }        

        $comprador->nome = $dados['nome'];
        $comprador->cpf = $dados['cpf'];
        $comprador->valor = $dados['valor'];
        $comprador->data = $dados['data'];
        $comprador->email = $dados['email'];        
        $comprador->celular = $dados['celular'];
        $comprador->estado_civil = $dados['estado_civil'];
        $comprador->nome_esposa = $dados['nome_esposa'];
        $comprador->origem_venda = $dados['origem_venda'];
        $comprador->nome_corretor = $dados['nome_corretor'];
        $comprador->creci_corretor = $dados['creci_corretor'];
        $comprador->telefone_corretor = $dados['telefone_corretor'];
        $comprador->percentual_honorario = $dados['percentual_honorario'];
        $comprador->valor_honorario = $dados['valor_honorario'];
        $comprador->construtora_id = $dados['construtora_id'];
        $comprador->empreendimento_id = $dados['empreendimento_id'];

        $comprador->save();
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

    public function empreendimento()
    {
        return $this->belongsTo('App\Models\Empreendimento');
    }

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

    public function getValorAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getValorHonorarioAttribute($valor)
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
        $this->attributes['valor'] = converte_reais_to_mysql($valor);
    }

    public function setValorHonorarioAttribute($valor)
    {        
        $this->attributes['valor_honorario'] = converte_reais_to_mysql($valor);
    }

    public function setPercentualHonorarioAttribute($valor)
    {                        
        $this->attributes['percentual_honorario'] = str_replace(',', '.', $valor);
    }
}

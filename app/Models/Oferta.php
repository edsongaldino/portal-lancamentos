<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Unidade;

class Oferta extends Model
{
   	use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'ofertas';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['construtora_id', 'unidade_id', 'empreendimento_id', 'preco_tabela', 'preco_oferta', 'percentual_desconto', 'valor_desconto', 'valor_entrada', 'percentual_entrada', 'saldo_remanescente', 'tipo_negociacao', 'aceita_bens', 'quantidade_parcela', 'valor_parcela', 'validade', 'correcao_parcela', 'correcao_parcela_balao', 'aceita_termos', 'informacoes_adicionais'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvarOferta($request, $id = null, $construtora_id)
    {        
    	$oferta = new Oferta();

    	if ($id) {
    		$oferta = $this->find($id);
    	}

        $oferta->construtora_id = $construtora_id;
        $oferta->unidade_id = $request->unidade_id;
        
        if ($request->empreendimento_id) {
    	   $oferta->empreendimento_id = $request->empreendimento_id;
        }

    	$oferta->preco_tabela = $request->preco_tabela;
    	$oferta->preco_oferta = $request->preco_oferta;
    	$oferta->percentual_desconto = $request->percentual_desconto;
    	$oferta->valor_desconto = $request->valor_desconto;
    	$oferta->tipo_negociacao = $request->tipo_negociacao;
        
        if ($request->valor_entrada) {
            $oferta->valor_entrada = $request->valor_entrada;    
        }
    	
    	$oferta->percentual_entrada = $request->entrada_percentual;
    	$oferta->saldo_remanescente = $request->saldo_remanescente;

    	if ($request->quantidade_parcela) {
    		$oferta->quantidade_parcela = $request->quantidade_parcela;	
    	}

    	if ($request->valor_parcela) {
    		$oferta->valor_parcela = $request->valor_parcela;	
    	}
    	
    	
    	$oferta->validade = $request->validade;

    	if ($request->correcao_parcela) {
    		$oferta->correcao_parcela = $request->correcao_parcela;	
    	}
    	
    	if ($request->correcao_parcela_balao) {
    		$oferta->correcao_parcela_balao = $request->correcao_parcela_balao;	
    	}
    	
    	$oferta->aceita_termos = $request->aceita_termos ? 'Sim' : 'Não';
		$oferta->aceita_bens = $request->aceita_bens ? 'Sim' : 'Não';
		$oferta->informacoes = $request->informacoes;
    	$oferta->save();

    	if ($request->valor_parcela_balao) {
    		(new OfertaBalao())->salvarBaloes($request, $oferta);
    	}

    	if ($request->planta_id) {            
    		$unidade = Unidade::find($oferta->unidade_id);
    		$unidade->planta_id = $request->planta_id;
    		$unidade->save();	
        }
        
        if ($request->metragem_total) {

    		$unidade = Unidade::find($oferta->unidade_id);           
            atribuir_caracteristica_manual($request->metragem_total, $unidade, 'Unidade', 'metragem_total');
            
    	}

    	return true;
    }

    public function excluir($id)
    {
        $this->find($id)->delete();

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

   	public function baloes()
   	{
   		return $this->hasMany('App\Models\OfertaBalao', 'oferta_id');
   	}

    public function unidade()
    {
        return $this->belongsTo('App\Models\Unidade', 'unidade_id');
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

    public function getSaldoRemanescenteAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getPrecoTabelaAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getValorEntradaAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getValorDescontoAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getPrecoOfertaAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getValorParcelaAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getCorrecaoParcelaAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getCorrecaoParcelaBalaoAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getValidadeAttribute($valor)
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

    public function setValidadeAttribute($valor)
    {
        if ($valor && (\DateTime::createFromFormat('d/m/Y', $valor))) {
            $this->attributes['validade'] = (\DateTime::createFromFormat('d/m/Y', $valor))->format('Y-m-d');
        }
    }

    public function setPrecoTabelaAttribute($valor)
    {
        $preco_tabela = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['preco_tabela'] = $preco_tabela;
    }

    public function setPrecoOfertaAttribute($valor)
    {
        $preco_oferta = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['preco_oferta'] = $preco_oferta;
    }

    public function setValorDescontoAttribute($valor)
    {
        $valor_desconto = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor_desconto'] = $valor_desconto;
    }

    public function setValorParcelaAttribute($valor)
    {
        $valor_parcela = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor_parcela'] = $valor_parcela;
    }

    public function setCorrecaoParcelaAttribute($valor)
    {
        $correcao_parcela = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['correcao_parcela'] = $correcao_parcela;
    }

    public function setCorrecaoParcelaBalaoAttribute($valor)
    {
        $correcao_parcela_balao = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['correcao_parcela_balao'] = $correcao_parcela_balao;
    }

    public function setValorEntradaAttribute($valor)
    {
        $valor_entrada = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor_entrada'] = $valor_entrada;
    }

    public function setSaldoRemanescenteAttribute($valor)
    {
        $saldo_remanescente = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['saldo_remanescente'] = $saldo_remanescente;
    }
}

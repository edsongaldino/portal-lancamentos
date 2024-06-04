<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garagem extends Model
{
    use CrudTrait, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'garagens';
    protected $fillable = ['empreendimento_id', 'construtora_id', 'torre_id', 'unidade_id', 'pavimento_garagem_id', 'nome'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function atualizar($request, $id)
    {
        $garagem = $this->find($id);
        $garagem->situacao = $request->situacao;
        $garagem->tipo_vaga = $request->tipo_vaga;

        if($request->formato_vaga){
            $garagem->formato_vaga = $request->formato_vaga;
        }
        
        if($request->vaga_pne){
            $garagem->vaga_pne = $request->vaga_pne;
        }
        
        if ($request->nome) {
            $garagem->nome = $request->nome;    
        }

        if ($request->unidade) {
            $garagem->unidade_id = $request->unidade;    
        }else{
            $garagem->unidade_id = null;  
        }

        if ($request->valor_vaga) {
            $this->atualizacaoValor('valor_vaga', $garagem, $request->valor_vaga);    
        }
        
        
        $garagem->save();        

        return true;
    } 

    public function atualizarUnidade($unidade, $id)
    {
        $garagem = $this->find($id);
        $garagem->unidade_id = $unidade;   
        $garagem->save();        

        return true;
    } 

    public function atualizarSituacao($id, $situacao)
    {
        $garagem = $this->find($id);
        $garagem->situacao = $situacao;
        $garagem->save();
    }

    public function atualizarVendagaragem($request, $id)
    {
        $garagem = $this->find($id);
        $garagem->situacao = $request->situacao;
        if ($request->unidade) {
            $garagem->unidade_id = $request->unidade;    
        }
        $garagem->save();

        (new CompradorGaragem)->salvar([
            'nome' => $request->nome_comprador,
            'data' => $request->data_venda,
            'valor' => $request->valor_venda,
            'garagem_id' => $id
        ]);

        return true;
    }

    public function filtrarGaragens($request)
    {
        $garagens = Garagem::query();

        $empreendimento = Empreendimento::find($request->empreendimento_id);
        $garagens->where('empreendimento_id', $empreendimento->id);
        $garagens->where('construtora_id', $empreendimento->construtora->id);

        $garagens->when($request->torre_id, function ($q) use ($request) {
            if ($request->torre_id && $request->torre_id != 'Todas') {
                $q->where('torre_id', $request->torre_id);
            }
        });

        $garagens->when($request->situacao, function ($q) use ($request) {
            if ($request->situacao && $request->situacao != 'Todas') {
                $q->where('situacao', $request->situacao);
            }
        });

        return $garagens->get();
    }

    public function getCaracteristica($nome)
    {
        $caracteristica = $this->caracteristicas->where('nome', $nome)->first();
        if ($caracteristica) {
            return $caracteristica->pivot->valor;
        }
    }

    public function atualizarCoordenadas($request)
    {    
        $model = $this->find($request->garagem_id);
        $model->coord_x = $request->coord_x;
        $model->coord_y = $request->coord_y;
        $model->save();

        $caracteristicas = [
            'tam_implantacao_garagem'
        ];

        $empreendimento = Empreendimento::find($model->empreendimento_id);
        atribuir_caracteristica($request, $empreendimento, 'Empreendimento', $caracteristicas);
        return true;
    }

    private function atualizacaoValor($item_alteracao, $garagem, $valor)
    {
        if ($item_alteracao == 'valor_vaga') {
            atribuir_caracteristica_manual($valor, $garagem, 'Garagem', 'valor_vaga');
            return;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function caracteristicas()
    {
        return $this->belongsToMany('App\Models\Caracteristica', 'caracteristicas_garagens')->withPivot('valor');
    }

    public function construtora()
    {
        return $this->belongsTo('App\Models\Construtora');
    }

    public function empreendimento()
    {
        return $this->belongsTo('App\Models\Empreendimento');
    }

    public function torre()
    {
        return $this->belongsTo('App\Models\Torre');
    }

    public function unidade()
    {
        return $this->belongsTo('App\Models\Unidade');
    }

    public function pavimento()
    {
        return $this->belongsTo('App\Models\PavimentoGaragem', 'pavimento_garagem_id');
    }

    public function comprador()
    {
        return $this->hasOne('App\Models\CompradorGaragem', 'garagem_id');
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Unidade;
use App\Models\Andar;
use \DB;

class Torre extends Model
{
    use CrudTrait, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'torres';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'nome', 
        'construtora_id', 
        'empreendimento_id', 
        'previsao_entrega', 
        'etapa', 
        'status', 
        'observacoes',
        'previsao_entrega_ano',
        'previsao_entrega_mes'
    ];
    // protected $hidden = [];
    // protected $dates = [];    

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvarTorre($request, $id = null, $construtora_id)
    {
        DB::beginTransaction();

        $torre = new Torre();

        if ($id) {
            $torre = $this->find($id);
        }

        $torre->construtora_id = $construtora_id;
        $torre->nome = $request->nome;
        $torre->empreendimento_id = $request->empreendimento_id;
        $torre->previsao_entrega_mes = $request->previsao_entrega_mes;
        $torre->previsao_entrega_ano = $request->previsao_entrega_ano;
        $torre->etapa = $request->etapa;
        $torre->status = $request->status;

        if (!$id) {
            $torre->gerou_unidades = 'Não';
        }

        $torre->save();

        if ($torre->gerou_unidades == 'Não') {
            $this->gerarUnidades(1, 
                $request->andares, 
                $request->unidades_andar,
                $request->andares_custom,                
                $request->unidades_andar_custom,  
                $request->nomenclatura_unidades, 
                $torre->id, $construtora_id, 
                $torre->empreendimento_id, 
                $request->unidades_terreo, 
                $request->cobertura, 
                $request->qtde_unidades_terreo, 
                $request->qtde_unidades_cobertura
            );    

            if ($request->pavimentos_garagem && $request->vagas_garagem) {
                $this->gerarGaragens([
                    'empreendimento_id' => $torre->empreendimento_id,
                    'construtora_id' => $torre->construtora_id,
                    'torre_nome' => $torre->nome,
                    'torre_id' => $torre->id,
                    'pavimentos_garagem' => $request->pavimentos_garagem,
                    'vagas_garagem' => $request->vagas_garagem
                ]);
            }            
        }

        $this->salvarCaracteristicasTorre($request, $torre);

        DB::commit();

        (new EmpreendimentoPerfil())->marcarPerfil($torre->empreendimento_id, 'Torres');
        (new EmpreendimentoPerfil())->marcarPerfil($torre->empreendimento_id, 'Unidades');

        return $torre->empreendimento_id;
    }

    public function gerarGaragens(array $parametros)
    {
        $pavimentos = $parametros['pavimentos_garagem'];
        $garagens = $parametros['vagas_garagem'];

        $controle = 1;
        
        while ($controle <= $pavimentos) {

            $pavimento = new PavimentoGaragem();
            $pavimento->empreendimento_id = $parametros['empreendimento_id'];
            $pavimento->construtora_id = $parametros['construtora_id'];
            $pavimento->torre_id = $parametros['torre_id'];
            $pavimento->nome = "{$parametros['torre_nome']} - Pavimento {$controle}";
            $pavimento->save();

            $controle2 = 1;

            while ($controle2 <= $garagens) {           
                
                $garagem = new Garagem();
                $garagem->empreendimento_id = $parametros['empreendimento_id'];
                $garagem->construtora_id = $parametros['construtora_id'];
                $garagem->torre_id = $parametros['torre_id'];
                $garagem->pavimento_garagem_id = $pavimento->id;
                $garagem->nome = "{$pavimento->nome} - Garagem {$controle2}";
                $garagem->save();

                $controle2++;
            }

            $controle++;
        }
    }

    public function salvarCaracteristicasTorre($request, $torre)
    {
        $caracteristicas = [
            'unidades_terreo',
            'andares',
            'cobertura',
            'unidades_andar',
            'elevador_social',
            'elevador_servico',
            'nomenclatura_unidades',
            'qtde_unidades_terreo',
            'qtde_unidades_cobertura'
        ];

        atribuir_caracteristica($request, $torre, 'Torre', $caracteristicas);
    }

    public function excluir($request)
    {
        $id = $request->id;

        if ($id) {
            $torre = $this->find($id);
            $torre->caracteristicas()->detach();
            foreach ($torre->unidades as $unidade) {
                $unidade->delete();
            }
            $this->destroy($id);
        }

        return true;
    }

    public function excluirTorresUnidades($request)
    {
        $empreendimento = Empreendimento::find($request->empreendimento_id);
        $torres = $empreendimento->torres;
        
        if ($torres) {
            foreach ($torres as $torre) {
                foreach ($torre->unidades as $unidade) {
                    $unidade->delete();
                }
                $this->destroy($torre->id);
            }

            $empreendimento->gerou_unidades = 'Não';
            $empreendimento->save();
        }

        return true;
    }

    public function gerarTorresUnidades(
        $torres, 
        $andares, 
        $unidades, 
        $nomenclatura, 
        $empreendimento_id, 
        $construtora_id, 
        $unidadesTerreo = false,
        $unidadesCobertura = false,
        $request
    ) 
    {
        try {            
            if ($torres) {                                
                DB::beginTransaction();
                $torre = 1;
                while ($torre <= $torres) {            
                    $andar = 1; 

                    $t = new Torre();
                    $t->empreendimento_id = $empreendimento_id;
                    $t->construtora_id = $construtora_id;
                    $t->nome = "Torre {$torre}";
                    $t->save();

                    if ($unidadesTerreo) {                   
                        $andares--;     
                        $this->gerarUnidadesAndar('T', $request->qtde_unidades_terreo, $nomenclatura, $t->id, $construtora_id, $empreendimento_id);
                    }                    

                    if ($unidadesCobertura) {                        
                        $andares--;
                        $this->gerarUnidadesAndar('C', $request->qtde_unidades_cobertura, $nomenclatura, $t->id, $construtora_id, $empreendimento_id);
                    }                                        

                    $this->gerarUnidades(
                        $andar, 
                        $andares, 
                        $unidades, 
                        $nomenclatura, 
                        $t->id, 
                        $construtora_id, 
                        $empreendimento_id
                    );
                
                    $this->salvarCaracteristicasTorre($request, $t);

                    $torre++;
                }

                DB::commit();
                
                return true;
            }

        } catch (\Exception $e) {
            echo '<pre>';
            var_dump($e->getMessage());
            exit();

            DB::rollback();
            return false;
        }
    }

    public function gerarUnidades(
        $andar, 
        $andares, 
        $unidades, 
        $andares_custom,                
        $unidades_andar_custom, 
        $nomenclatura, 
        $torre_id, 
        $construtora_id, 
        $empreendimento_id, 
        $unidadesTerreo, 
        $unidadesCobertura, 
        $qtdeUnidadesTerreo, 
        $qtdeUnidadesCobertura
    ) {

        if($nomenclatura == 'DezenaT' || $nomenclatura == 'CentenaT'){

            $nomenclatura = substr($nomenclatura, 0, -1);
                             
            if ($unidadesCobertura == 'Sim') {                        
                $andares_custom--;
                $this->gerarUnidadesAndar('C', $qtdeUnidadesCobertura, $nomenclatura, $torre_id, $construtora_id, $empreendimento_id);
            }
                
            while ($andar <= $andares_custom) {

                $unidade = 1;

                $andarModel = $this->gerarAndar($construtora_id, $torre_id, $andar);
                
                while ($unidade <= $unidades_andar_custom) {
                    
                    $this->gerarUnidade($unidade, $andarModel, $nomenclatura, $construtora_id, $empreendimento_id, $torre_id);
                    $unidade++;

                }
    
                $andar++;
            }

        }else{

            if ($unidadesTerreo == 'Sim') {  
                $andares--;                      
                $this->gerarUnidadesAndar('T', $qtdeUnidadesTerreo, $nomenclatura, $torre_id, $construtora_id, $empreendimento_id);
            }                    
    
            if ($unidadesCobertura == 'Sim') {                        
                $andares--;
                $this->gerarUnidadesAndar('C', $qtdeUnidadesCobertura, $nomenclatura, $torre_id, $construtora_id, $empreendimento_id);
            }
    
            while ($andar <= $andares) {
                $unidade = 1;
    
                $andarModel = $this->gerarAndar($construtora_id, $torre_id, $andar);
    
                while ($unidade <= $unidades) {
    
                    $this->gerarUnidade($unidade, $andarModel, $nomenclatura, $construtora_id, $empreendimento_id, $torre_id);
    
                    $unidade++;
                }
    
                $andar++;
            }

        }
        
    }

    public function gerarAndar($construtora_id, $torre_id, $andar) 
    {
        $andarModel = new Andar();
        $andarModel->construtora_id = $construtora_id;
        $andarModel->torre_id = $torre_id;        
        $andarModel->numero = $andar;
        $andarModel->save();        

        return $andarModel;
    }

    public function gerarUnidade($unidade, $andarModel, $nomenclatura, $construtora_id, $empreendimento_id, $torre_id)
    {    
        $un = new Unidade();
        $un->novaUnidadeVertical($unidade, $andarModel, $nomenclatura, $torre_id, $construtora_id, $empreendimento_id);        
    }

    public function gerarUnidadesAndar($andar, $unidades, $nomenclatura, $torre_id, $construtora_id, $empreendimento_id)
    {           
        $andarModel = $this->gerarAndar($construtora_id, $torre_id, $andar);

        $unidade = 1;

        while ($unidade <= $unidades) {
            $this->gerarUnidade($unidade, $andarModel, $nomenclatura, $construtora_id, $empreendimento_id, $torre_id);            
            $unidade++;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function unidades()
    {
        return $this->hasMany('App\Models\Unidade');
    }

    public function andares()
    {
        return $this->hasMany('App\Models\Andar');
    }

    public function empreendimento()
    {
        return $this->belongsTo('App\Models\Empreendimento');
    }

    public function tabelas()
    {
        return $this->hasMany('App\Models\TabelaVendas');
    }

    public function plantas()
    {
        return $this->hasMany('App\Models\Planta');
    }    

    public function caracteristicas()
    {
        return $this->belongsToMany('App\Models\Caracteristica', 'caracteristicas_torres')->withPivot('valor');
    }

    public function pavimentos()
    {
        return $this->hasMany('App\Models\PavimentoGaragem');
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

<?php

namespace App\Models;

use App\Models\Caracteristica;
use App\Models\CompradorUnidade;
use App\Models\HistoricoAlteracaoUnidade;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Garagem;
use \DB;

class Unidade extends Model
{
    use CrudTrait, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'unidades';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['planta_id', 'construtora_id', 'nome', 'situacao', 'status'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function novaUnidadeVertical($unidade, $andar, $nomenclatura, $torre_id, $construtora_id, $empreendimento_id)
    {
        $model = $this;
        $model->construtora_id = $construtora_id;
        $model->empreendimento_id = $empreendimento_id;
        $model->nome = $this->getNomeUnidade($unidade, $andar, $nomenclatura);        
        $model->torre_id = $torre_id;
        $model->andar_id = $andar->id;
        $model->save();
    }

    public function novaUnidadeHorizontal($unidade, $quadra_id, $construtora_id, $empreendimento_id)
    {
        $model = $this;
        $model->nome = $unidade;
        $model->construtora_id = $construtora_id;
        $model->empreendimento_id = $empreendimento_id;
        $model->quadra_id = $quadra_id;
        $model->save();
    }

    public function getNomeUnidade($numero, $andar, $nomenclatura)
    {
        if ($nomenclatura == 'Dezena') {
            $base = "{$andar->numero}";
        }

        if ($nomenclatura == 'Centena') {        
            $base = "{$andar->numero}0";

            if ($numero > 9) {
                $base = "{$andar->numero}";                
            }
        }
        
        return "{$base}{$numero}";        
    }

    public function atualizar($request, $id)
    {
        $unidade = $this->find($id);
        $unidade->situacao = $request->situacao;

        if ($request->nome) {
            $unidade->nome = $request->nome;    
        }        

        if ($request->planta_id) {
            $unidade->planta_id = $request->planta_id;
        }

        if($request->tipo_alteracao == 'Individual'){
            if ($request->valor_unidade) {
                $request->valor_unidade = converte_reais_to_mysql($request->valor_unidade);
            }
        }
        else{
            if ($request->valor_m2) {
                $request->valor_unidade = 0;
            }else{
                if ($request->valor_unidade) {
                    $request->valor_unidade = converte_reais_to_mysql($request->valor_unidade);
                }
            }
        }
        
        $unidade->save();        

        $caracteristicas = [
            'metragem_total',
            'vagas_garagem',
            'tipo_sol',
            'valor_m2',
            'valor_unidade',
            'posicao_unidade_torre',
            'lote_lateral_dir',
            'lote_lateral_esq',
            'lote_frente',
            'lote_fundo'
        ];

        atribuir_caracteristica($request, $unidade, 'Unidade', $caracteristicas);

        return true;
    } 

    public function atualizarSituacao($request, $id)
    {
        $unidade = $this->find($id);
        $unidade->situacao = $request->situacao;
        $unidade->save();  
        
        $garagem = Garagem::where('unidade_id', $id)->first();

        if(isset($garagem->id)):
            (new Garagem)->atualizarSituacao($garagem->id, $request->situacao);
        endif;

        return true;
    } 

    public function atualizarVendaUnidade($request, $id)
    {
        $unidade = $this->find($id);
        $unidade->situacao = 'Vendida';
        $unidade->save();

        (new CompradorUnidade)->salvar([
            'nome' => $request->nome_comprador,
            'cpf' => $request->cpf,
            'data' => $request->data_venda,
            'valor' => $request->valor_venda,
            'email' => $request->email,
            'celular' => $request->celular,
            'estado_civil' => $request->estado_civil,
            'nome_esposa' => $request->nome_esposa,
            'origem_venda' => $request->origem_venda,
            'nome_corretor' => $request->nome_corretor,
            'creci_corretor' => $request->creci_corretor,
            'telefone_corretor' => $request->telefone_corretor,
            'percentual_honorario' => $request->percentual_honorario,
            'valor_honorario' => $request->valor_honorario,
            'unidade_id' => $id,
            'construtora_id' => $unidade->construtora_id,
            'empreendimento_id' => $unidade->empreendimento_id
        ]);
        
        $garagem = Garagem::where('unidade_id', $id)->first();

        if(isset($garagem->id)){
            (new Garagem)->atualizarSituacao($garagem->id, 'Vendida');
        }
        
        return true;
    }

    public function atualizarReservaUnidade($request, $id)
    {
        $unidade = $this->find($id);
        $unidade->situacao = 'Reservada';
        $unidade->save();

        (new ReservaUnidade)->salvar([
            'tipo_reserva' => $request->tipo_reserva,
            'data_final_reserva' => $request->data_final_reserva,
            'nome_cliente' => $request->nome_cliente,
            'cpf_cliente' => $request->cpf_cliente,
            'telefone_cliente' => $request->telefone_cliente,
            'email_cliente' => $request->email_cliente,
            'nome_parceiro' => $request->nome_parceiro,
            'email_parceiro' => $request->email_parceiro,
            'creci_parceiro' => $request->creci_parceiro,
            'telefone_parceiro' => $request->telefone_parceiro,
            'unidade_id' => $id
        ]);

        return true;
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
        $model = $this->find($request->unidade_id);
        $model->coord_x = $request->coord_x;
        $model->coord_y = $request->coord_y;
        $model->save();

        $caracteristicas = [
            'posicao_unidade_torre'
        ];
        atribuir_caracteristica($request, $model, 'Unidade', $caracteristicas);


        $caracteristicas = [
            'tam_implantacao'
        ];

        $empreendimento = Empreendimento::find($model->empreendimento_id);
        atribuir_caracteristica($request, $empreendimento, 'Empreendimento', $caracteristicas);

        return true;
    }

    public function getFotoImplantacaoVertical($valor)
        {
            switch($valor):
                case 'frente';
                $foto = $this->empreendimento->fotos->where('tipo', 'Implantação Vertical - Frente')->where('empreendimento_id', $this->empreendimento_id)->first();
                if(isset($foto->arquivo)){
                        return url("/uploads/empreendimento/{$this->empreendimento_id}/original/{$foto->arquivo}");
                    }else{
                        return url("assets/premium/img/sem-implantacao.jpg"); 
                    }
                    
                break;

                case 'fundo';
                    $foto = $this->empreendimento->fotos->where('tipo', 'Implantação Vertical - Fundo')->where('empreendimento_id', $this->empreendimento_id)->first();
                    if(isset($foto->arquivo)){
                        return url("/uploads/empreendimento/{$this->empreendimento_id}/original/{$foto->arquivo}");
                    }else{
                        return url("assets/premium/img/sem-implantacao.jpg"); 
                    }
                break;

                case 'lateral';
                $foto = $this->empreendimento->fotos->where('tipo', 'Implantação Vertical - Lateral')->where('empreendimento_id', $this->empreendimento_id)->first();
                if(isset($foto->arquivo)){
                        return url("/uploads/empreendimento/{$this->empreendimento_id}/original/{$foto->arquivo}");
                    }else{
                        return url("assets/premium/img/sem-implantacao.jpg"); 
                    }
                break;
                

                case '';
                    return url("assets/premium/img/sem-implantacao.jpg");
                break;

            endswitch;

        }

    public function alteracoesEmLote(array $parametros)
    {              
        $empreendimento = Empreendimento::find($parametros['empreendimento_id']);
        $parametros['empreendimento'] = $empreendimento;
        $parametros['tipo_empreendimento'] = $empreendimento->tipo;
        $alvo_alteracao = $parametros['alvo_alteracao'];
        
        $unidades = Unidade::query();

        $unidades->select('unidades.*');
        
        $unidades->where('empreendimento_id', $empreendimento->id);

        $unidades = $this->filtroUnidadesSituacoes($alvo_alteracao, $unidades);

        $unidades = $this->filtroTorresAndaresPlantas($alvo_alteracao, $unidades);

        $unidades = $this->filtroQuadrasPlantas($alvo_alteracao, $unidades);

        $parametros['unidades'] = $unidades;
        
        $this->alterarUnidadesEmLote($parametros);

        (new HistoricoAlteracaoUnidade())->registrar($parametros);

        return true;
    }

    public function filtroQuadrasPlantas($alvo_alteracao, $unidades)
    {
        if ($alvo_alteracao == 'quadras_plantas_disponiveis') {
            $unidades = $unidades->join('quadras', function ($j) {
                $j->on('unidades.quadra_id', '=', 'quadras.id')
                    ->where('quadras.status', 'Liberada');
            });

            $unidades = $unidades->join('plantas', function ($j) {
                $j->on('unidades.planta_id', '=', 'plantas.id')
                    ->where('plantas.status', 'Liberada');
            });            
        }

        if ($alvo_alteracao == 'quadras_plantas_bloqueadas') {
            $unidades = $unidades->join('quadras', function ($j) {
                $j->on('unidades.quadra_id', '=', 'quadras.id')
                    ->where('quadras.status', 'Bloqueada');
            });

            $unidades = $unidades->join('plantas', function ($j) {
                $j->on('unidades.planta_id', '=', 'plantas.id')
                    ->where('plantas.status', 'Bloqueada');
            });            
        }

        return $unidades;
    }

    public function filtroTorresAndaresPlantas($alvo_alteracao, $unidades)
    {
        if ($alvo_alteracao == 'torres_andares_plantas_disponiveis') {
            $unidades = $unidades->join('torres', function ($j) {
                $j->on('unidades.torre_id', '=', 'torres.id')
                    ->where('torres.status', 'Liberada');
            });

            $unidades = $unidades->join('plantas', function ($j) {
                $j->on('unidades.planta_id', '=', 'plantas.id')
                    ->where('plantas.status', 'Liberada');
            });            
        }

        if ($alvo_alteracao == 'torres_andares_plantas_bloqueadas') {
            $unidades = $unidades->join('torres', function ($j) {
                $j->on('unidades.torre_id', '=', 'torres.id')
                    ->where('torres.status', 'Bloqueada');
            });

            $unidades = $unidades->join('plantas', function ($j) {
                $j->on('unidades.planta_id', '=', 'plantas.id')
                    ->where('plantas.status', 'Bloqueada');
            });            
        }

        return $unidades;
    }

    public function filtroUnidadesSituacoes($alvo_alteracao, $unidades)
    {
        if ($alvo_alteracao == 'todas_unidades_disponiveis') {
            $unidades = $unidades->where('situacao', 'Disponível')->get();            
        }

        if ($alvo_alteracao == 'todas_unidades_bloqueadas') {            
            $unidades = $unidades->where('situacao', 'Bloqueada');
        }

        if ($alvo_alteracao == 'todas_unidades_reservadas') {
            $unidades = $unidades->where('situacao', 'Reservada');
        }

        if ($alvo_alteracao == 'todas_unidades_vendidas') {
            $unidades = $unidades->where('situacao', 'Vendida');
        }

        return $unidades;
    }

    public function alterarUnidadesEmLote(array $parametros)
    {
        $unidades = $parametros['unidades'];
        
        if ($unidades) {

            $item_alteracao = $parametros['item_alteracao'];
            $empreendimento = $parametros['empreendimento'];            
            $valor = converte_reais_to_mysql($parametros['valor_alteracao']);

            if ($empreendimento->tipo == 'Vertical') {
                $unidades = $this->filtrosVerticais($parametros);    
            }

            if ($empreendimento->tipo == 'Horizontal') {
                $unidades = $this->filtrosHorizontais($parametros);    
            }

            if (get_class($unidades) == 'Illuminate\Database\Eloquent\Builder') {
                $unidades = $unidades->get();
            }

            DB::beginTransaction();

            foreach ($unidades as $unidade) {
                $this->atualizacaoValor($item_alteracao, $unidade, $valor);
                $this->atualizacaoValorM2($item_alteracao, $unidade, $valor);
                $this->atualizacaoMetragem($item_alteracao, $unidade, $valor);
                $this->atualizacaoPlanta($item_alteracao, $unidade, $parametros['planta_alteracao']);
                $this->atualizacaoSituacao($item_alteracao, $unidade, $parametros['situacao_alteracao']);
                $this->atualizacaoSol($item_alteracao, $unidade, $parametros['tipo_sol_alteracao']);
                $this->atualizacaoPosicao($item_alteracao, $unidade, $parametros['posicao_unidade_alteracao']);
                $this->atualizacaoDimensaoLote($item_alteracao, $unidade, $parametros['dimensoes_lote_alteracao']);
            }

            DB::commit();
        }        
    }

    private function atualizacaoSituacao($item_alteracao, $unidade, $situacao)
    {
        if ($item_alteracao == 'definir_situacao') {
            $unidade->situacao = $situacao;
            $unidade->save();
        }
    }

    private function atualizacaoPlanta($item_alteracao, $unidade, $planta_id)
    {
        if ($item_alteracao == 'definir_planta') {
            $unidade->planta_id = $planta_id;
            $unidade->save();
        }
    }

    private function atualizacaoMetragem($item_alteracao, $unidade, $valor)
    {
        if ($item_alteracao == 'metragem_valor_fixo') {
            atribuir_caracteristica_manual($valor, $unidade, 'Unidade', 'metragem_total');
            return;
        }
    }

    private function atualizacaoValorM2($item_alteracao, $unidade, $valor)
    {
        if ($item_alteracao == 'valor_m2') {
            atribuir_caracteristica_manual($valor, $unidade, 'Unidade', 'valor_m2');
            atribuir_caracteristica_manual(0, $unidade, 'Unidade', 'valor_unidade');
            return;
        }

    }

    private function atualizacaoPosicao($item_alteracao, $unidade, $valor)
    {
        if ($item_alteracao == 'posicao_unidade_torre') {
            atribuir_caracteristica_manual($valor, $unidade, 'Unidade', 'posicao_unidade_torre');
            atribuir_caracteristica_manual('', $unidade, 'Unidade', 'valor_unidade');
            return;
        }
    }

    private function atualizacaoSol($item_alteracao, $unidade, $valor)
    {
        if ($item_alteracao == 'incidencia_sol') {
            atribuir_caracteristica_manual($valor, $unidade, 'Unidade', 'tipo_sol');
            return;
        }
    }

    private function atualizacaoDimensaoLote($item_alteracao, $unidade, $valor)
    {
        if ($item_alteracao == 'dimensoes_lote') {
            $dimensao = explode("|", $valor);
            atribuir_caracteristica_manual($dimensao[0], $unidade, 'Unidade', 'lote_frente');
            atribuir_caracteristica_manual($dimensao[1], $unidade, 'Unidade', 'lote_fundo');
            atribuir_caracteristica_manual($dimensao[2], $unidade, 'Unidade', 'lote_lateral_dir');
            atribuir_caracteristica_manual($dimensao[3], $unidade, 'Unidade', 'lote_lateral_esq');
        }
    }

    private function atualizacaoValor($item_alteracao, $unidade, $valor)
    {
        if ($item_alteracao == 'valor_fixo') {        
            atribuir_caracteristica_manual($valor, $unidade, 'Unidade', 'valor_unidade');
            return;
        } 

        if ($item_alteracao == 'acrescimo_percentual' || 
            $item_alteracao == 'decrescimo_percentual' ||
            $item_alteracao == 'acrescimo_real' ||
            $item_alteracao == 'decrescimo_real') {
            
            $valor_atual = 0;
            $valor_atualizado = 0;

            $valor_unidade_atual = $unidade->caracteristicas->where('nome', 'valor_unidade')->first();

            if ($valor_unidade_atual) {
                $valor_atual = $valor_unidade_atual->pivot->valor;   
            }

            $valor_calculado = $valor_atual * ($valor / 100);

            if ($item_alteracao == 'acrescimo_percentual') {
                $valor_atualizado = $valor_atual + $valor_calculado;
            }

            if ($item_alteracao == 'decrescimo_percentual') {
                $valor_atualizado = $valor_atual - $valor_calculado;   
            }

            if ($item_alteracao == 'acrescimo_real') {                            
                $valor_atualizado = $valor_atual + $valor;
            }

            if ($item_alteracao == 'decrescimo_real') {
                $valor_atualizado = $valor_atual - $valor;   
            }

            atribuir_caracteristica_manual($valor_atualizado, $unidade, 'Unidade', 'valor_unidade');
        }        
    }

    public function filtrosHorizontais(array $parametros)
    {
        $ids_quadras = isset($parametros['quadras']) ? $parametros['quadras'] : null;
        $ids_plantas = isset($parametros['plantas']) ? $parametros['plantas'] : null;
        $ids_unidades = isset($parametros['unidades_especificas']) ? $parametros['unidades_especificas'] : null;

        $unidades = $parametros['unidades'];

        $unidades->when($ids_quadras, function ($q) use ($ids_quadras) {            
            $q->whereIn('unidades.quadra_id', $ids_quadras);
        });

        $unidades->when($ids_plantas, function ($q) use ($ids_plantas) {            
            $q->whereIn('unidades.planta_id', $ids_plantas);
        });

        $unidades->when($ids_unidades, function ($q) use ($ids_unidades) {            
            $q->whereIn('unidades.id', $ids_unidades);
        });

        return $unidades;
    }

    public function filtrosVerticais($parametros)
    {
        $ids_torres = isset($parametros['torres']) ? $parametros['torres'] : null;
        $ids_andares = isset($parametros['andares']) ? $parametros['andares'] : null;
        $ids_plantas = isset($parametros['plantas']) ? $parametros['plantas'] : null;
        $ids_unidades = isset($parametros['unidades_especificas']) ? $parametros['unidades_especificas'] : null;
        
        $unidades = $parametros['unidades'];
        
        $unidades->when($ids_torres, function ($q) use ($ids_torres) {            
            $q->whereIn('unidades.torre_id', $ids_torres);
        });

        $unidades->when($ids_andares, function ($q) use ($ids_andares) {            
            $q->join('andares', function ($join) use ($ids_andares) {
                $join->on('unidades.andar_id', '=', 'andares.id')
                    ->whereIn('andares.numero', $ids_andares);
            });
        });

        $unidades->when($ids_plantas, function ($q) use ($ids_plantas) {            
            $q->whereIn('unidades.planta_id', $ids_plantas);
        });

        $unidades->when($ids_unidades, function ($q) use ($ids_unidades) {            
            $q->whereIn('unidades.id', $ids_unidades);
        });

        return $unidades;

    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function caracteristicas()
    {
        return $this->belongsToMany('App\Models\Caracteristica', 'caracteristicas_unidades')->withPivot('valor');
    }

    public function empreendimento()
    {
        return $this->belongsTo('App\Models\Empreendimento');
    }

    public function planta()
    {
        return $this->belongsTo('App\Models\Planta');
    }

    public function torre()
    {
        return $this->belongsTo('App\Models\Torre');
    }

    public function garagem()
    {
        return $this->hasMany('App\Models\Garagem');
    }

    public function comprador()
    {
        return $this->hasOne('App\Models\CompradorUnidade', 'unidade_id');
    }

    public function reserva()
    {
        return $this->hasOne('App\Models\ReservaUnidade', 'unidade_id');
    }

    public function andar()
    {
        return $this->belongsTo('App\Models\Andar');
    }

    public function quadra()
    {
        return $this->belongsTo('App\Models\Quadra');
    }

    public function ofertas()
    {
        return $this->hasMany('App\Models\Oferta');
    }

    public function ofertaValida()
    {
        return $this->hasMany('App\Models\Oferta')->where('validade', '>=', (new \DateTime())->format('Y-m-d'))->orderBy('validade', 'DESC');
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

    public function getValorVendaAttribute($valor)
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

    public function setValorVendaAttribute($valor)
    {
        $valor_venda = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor_venda'] = $valor_venda;
    }
}

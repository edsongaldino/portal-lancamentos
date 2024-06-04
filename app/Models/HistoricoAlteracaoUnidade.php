<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoricoAlteracaoUnidade extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'historico_alteracoes_unidades';
    protected $fillable = ['tipo', 'alvo', 'valor', 'html', 'user_id'];
    protected $html_alteracao = '';
    protected $tipo_alteracao = null;
    protected $alvo_alteracao = null;
    protected $valor_alteracao = null;
    protected $plantas = 'Nenhuma planta(s) específica(s)'; 
    protected $torres = 'Nenhuma torre(s) específica(s)';
    protected $andares = 'Nenhum andar(es) específico(s)';
    protected $quadras = 'Nenhuma quadra(s) específica(s)';
    protected $unidades = 'Nenhuma unidade(s) específica(s)';
    protected $params = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function registrar(array $params)
    {
        $this->montaMensagem($params);

        $historico = $this;
        $historico->empreendimento_id = $params['empreendimento']->id;
        $historico->construtora_id = $params['empreendimento']->construtora_id;        
        $historico->tipo = $this->tipo_alteracao;
        $historico->alvo = $this->alvo_alteracao;
        $historico->valor = $this->valor_alteracao;
        $historico->html = $this->html_alteracao;
        $historico->user_id = $this->params['user_id'];
        $historico->save();
    }

    public function montaMensagem(array $params)
    {
        $this->params = $params;
        $this->montaMensagemValor();
        $this->montaMensagemPercentual();
        $this->montaMensagemSituacao();
        $this->montaMensagemPlantas();
        $this->montaMensagemSituacao();
        $this->montaMensagemMetragem();
        $this->montaAlvoAlteracao();
        $this->setarDados();

        if ($this->params['tipo_empreendimento'] == 'Vertical') {
            $this->html_alteracao = trim("
                Tipo: <strong>{$this->tipo_alteracao}</strong><br/>
                Valor: <strong> {$this->valor_alteracao} </strong> <br/>
                Alvo: <strong> {$this->alvo_alteracao} </strong><br/>
                Torre(s): <strong> {$this->torres} </strong> <br/>                
                Andare(s): <strong> {$this->andares} </strong> <br/>                
                Unidade(s): <strong> {$this->unidades} </strong> <br/>
                Planta(s): <strong> {$this->plantas} </strong> <br/>
            ");
        }

        if ($this->params['tipo_empreendimento'] == 'Horizontal') {
            $this->html_alteracao = trim("
                Tipo: <strong>{$this->tipo_alteracao}</strong><br/>
                Valor: <strong> {$this->valor_alteracao} </strong> <br/>
                Alvo: <strong> {$this->alvo_alteracao} </strong><br/>
                Quadras: <strong> {$this->quadras} </strong> <br/>
                Unidades: <strong> {$this->unidades} </strong> <br/>
                Planta(s): <strong> {$this->plantas} </strong> <br/>
            ");
        }
    }

    public function setarDados()
    {        
        $this->andares = isset($this->params['andares']) ? implode(', ', $this->params['andares']) : $this->andares;
        $this->setarValor();
        $this->setarTorres();
        $this->setarQuadras();
        $this->setarPlantas();
        $this->setarUnidades();
    }

    public function setarPlantas()
    {
        if (isset($this->params['plantas'])) {

            $plantas = $this->params['plantas'];

            $array = [];

            foreach ($plantas as $p) {
                $planta = Planta::find($p);
                
                if ($planta) {
                    $array[] = $planta->nome;
                }
            }

            $this->plantas = implode(', ', $array);
        }
    }

    public function setarValor()
    {
        $this->valor_alteracao = converte_reais_to_mysql($this->params['valor_alteracao']);

        if ($this->params['item_alteracao'] == 'acrescimo_percentual' || $this->params['item_alteracao'] == 'decrescimo_percentual') {
            $valor = number_format($this->valor_alteracao, 0, '', '');
            $this->valor_alteracao = "{$valor}%";
        }   

        if ($this->params['item_alteracao'] == 'metragem_valor_fixo') {
            $valor = number_format($this->valor_alteracao, 0, '', '');
            $this->valor_alteracao = "{$valor}m<sup>2</sup>";
        }

        if ($this->params['item_alteracao'] == 'definir_planta') {
            $planta = Planta::find($this->valor_alteracao);
            $this->valor_alteracao = $planta->nome;
        }
    }

    public function setarTorres()
    {
        if (isset($this->params['torres'])) {

            $torres = $this->params['torres'];

            $array = [];

            foreach ($torres as $t) {
                $torre = Torre::find($t);
                
                if ($torre) {
                    $array[] = $torre->nome;
                }
            }

            $this->torres = implode(', ', $array);
        }
    }

    public function setarQuadras()
    {
        if (isset($this->params['quadras'])) {

            $quadras = $this->params['quadras'];

            $array = [];

            foreach ($quadras as $q) {
                $quadra = Quadra::find($q);
                
                if ($quadra) {
                    $array[] = $quadra->nome;
                }
            }

            $this->quadras = implode(', ', $array);
        }
    }

    public function setarUnidades()
    {
        if (isset($this->params['unidades_especificas'])) {

            $unidades = $this->params['unidades_especificas'];

            $array = [];

            foreach ($unidades as $un) {
                $unidade = Unidade::find($un);
                
                if ($unidade) {
                    $array[] = $unidade->nome;
                }
            }

            $this->unidades = implode(', ', $array);
        }
    }

    public function montaAlvoAlteracao()
    {
        if ($this->params['alvo_alteracao'] == 'todas_unidades') {
          $this->alvo_alteracao = "Todas as unidades";
        }

        if ($this->params['alvo_alteracao'] == 'todas_unidades_disponiveis') {
          $this->alvo_alteracao = "Todas as unidades disponíveis";
        }

        if ($this->params['alvo_alteracao'] == 'unidades_especificas') {
          $this->alvo_alteracao = "Unidades Específicas";
        }

        if ($this->params['alvo_alteracao'] == 'unidades_quadra') {
          $this->alvo_alteracao = "Unidades de quadras específicas";
        }

        if ($this->params['alvo_alteracao'] == 'plantas_disponiveis') {
          $this->alvo_alteracao = "Unidades com plantas específicas";
        }

        if ($this->params['alvo_alteracao'] == 'torres_andares_disponiveis') {
          $this->alvo_alteracao = "Unidades de andares específicos";
        }
    }

    public function montaMensagemMetragem()
    {
        if ($this->params['item_alteracao'] == 'metragem_valor_fixo') {
          $this->tipo_alteracao = "Alterar a metragem do terreno";
        }
    }

    public function montaMensagemPlantas()
    {
        if ($this->params['item_alteracao'] == 'definir_planta') {
          $this->tipo_alteracao = "Alterar a planta";
        }
    }

    public function montaMensagemSituacao()
    {
        if ($this->params['item_alteracao'] == 'definir_situacao') {
          $this->tipo_alteracao = "Alterar a situação";
        }
    }

    public function montaMensagemValor()
    {
        if ($this->params['item_alteracao'] == 'valor_fixo') {
          $this->tipo_alteracao = "O Valor fixo";          
        }

        if ($this->params['item_alteracao'] == 'acrescimo_real') {
          $this->tipo_alteracao = "Aumentar o valor";
        }

        if ($this->params['item_alteracao'] == 'decrescimo_real') {
          $this->tipo_alteracao = "Diminuir o valor";
        }
    }

    public function montaMensagemPercentual()
    {
        if ($this->params['item_alteracao'] == 'acrescimo_percentual') {
          $this->tipo_alteracao = "Aumentar o valor percentual";
        }

        if ($this->params['item_alteracao'] == 'decrescimo_percentual') {
          $this->tipo_alteracao = "Diminuir o valor Percentual";
        }

        if ($this->params['item_alteracao'] == 'valor_m2') {
          $this->tipo_alteracao = "Valor do M²";
        }
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
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

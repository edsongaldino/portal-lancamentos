<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CriarLancamentoFinanceiroRequest;
use App\Models\Construtora;
use App\Models\LancamentoFinanceiro;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;

class FinanceiroController extends Controller
{
    private $view;

    public function __construct() {
        $this->view = isMobile() ? 'admin.financeiro.desktop.index' : 'admin.financeiro.desktop.index';
    }

    public function index(Request $request)
    {           
        $construtora_id = get_construtora_id();        

        $this->data['construtora_id'] = $construtora_id;

        if ($construtora_id) {
            $construtora = Construtora::find($construtora_id);
            $this->data['construtora'] = $construtora;
        }

        $this->data['vendas'] = new Unidade();
        $this->data['empreendimento_id'] = RequestFacade::input('empreendimento_id', null);
        $this->data['nome_comprador'] = RequestFacade::input('nome_comprador', null);
        $this->data['data_compra'] = data_mysql(RequestFacade::input('data_compra', null));
        $this->data['quadra_filtro'] = RequestFacade::input('quadra_id', null);
        $this->data['torre_filtro'] = RequestFacade::input('torre_id', null);
        $this->data['unidade_filtro'] = RequestFacade::input('unidade_filtro', null);

    	return view($this->view, $this->data);
    }

    public function meuPlano(Request $request)
    {   
        $this->data['lancamentos'] = [];     
        
        $construtora_id = get_construtora_id();        

        $this->data['construtora_id'] = $construtora_id;

        if ($construtora_id) {
            $construtora = Construtora::find($construtora_id);
            $this->data['construtora'] = $construtora;
            $this->data['lancamentos'] = $construtora->lancamentosFinanceiros()->orderBy('vencimento', 'ASC')->paginate(10);
        }

        if (!$construtora_id && isAdmin()) {
            $this->data['lancamentos'] = LancamentoFinanceiro::orderBy('vencimento', 'ASC')->paginate(10);   
        }
        
        return view('admin.financeiro.desktop.meu_plano', $this->data);
    }

    public function criarLancamentoFinanceiro(CriarLancamentoFinanceiroRequest $request)
    {
        $parametros = $request->all();
        $construtora = Construtora::find($request->construtora_id);
        $parametros['construtora'] = $construtora;
        $resultado = (new LancamentoFinanceiro())->criarLancamentoFinanceiro($parametros);

        return response()->json([
            'sucesso' => $resultado['erro'] == false ? 'true' : 'false',
            'retorno' => $resultado['retorno']
        ]);
    }

    public function cancelarLancamentoFinanceiro($transacao_id)
    {
        $resultado = (new LancamentoFinanceiro())->cancelarLancamentoFinanceiro($transacao_id);

        return response()->json([
            'sucesso' => $resultado['erro'] == false ? 'true' : 'false',
            'retorno' => $resultado['retorno']
        ]);        
    }

    public function retornoSafePay(Request $request)
    {
        $resultado = (new LancamentoFinanceiro())->retornoSafePay($request);

        return response()->json([
            'sucesso' => 'true',
            'retorno' => 'ok'
        ]);   
    }

    public function reenviarPorEmail(Request $request)
    {
        LancamentoFinanceiro::find($request->id)->enviarPorEmail();
        
        return response()->json([
            'sucesso' => 'true',
            'retorno' => 'ok'
        ]);   
    }
}

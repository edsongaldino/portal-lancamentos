<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Construtora;
use App\Models\TabelaVendas;
use App\Models\tipoTabela;
use App\Models\TabelaVendasBaloes;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Empreendimento;
use App\Models\Quadra;
use App\Models\Torre;

class TabelaVendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $construtora_id = get_construtora_id();
        $this->data['empreendimento_id'] = RequestFacade::input('empreendimento_id', null);

        if($this->data['empreendimento_id']){
            $this->data['tabelas'] = TabelaVendas::where('empreendimento_id', $this->data['empreendimento_id'])->get();
        }elseif ($construtora_id) {
            $this->data['tabelas'] = TabelaVendas::where('construtora_id', $construtora_id)->get();
        }

        return view('admin.tabela_vendas.desktop.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $construtora_id = get_construtora_id();

        $this->data['construtora_id'] = $construtora_id;

        if ($construtora_id) {
            $construtora = Construtora::find($construtora_id);
            $this->data['construtora'] = $construtora;
        }

        $this->data['empreendimento_id'] = RequestFacade::input('empreendimento_id', null);
        $this->data['tipo_tabela'] = tipoTabela::where('construtora_id', $construtora_id)->get();
        return view('admin.tabela_vendas.desktop.adicionar-tabela', $this->data);

    }

    public function buscarTorresQuadrasTabela(Request $request)
    {
        $empreendimento = Empreendimento::find($request->empreendimento_id);

        if ($empreendimento->tipo == 'Vertical') {
            $this->data['torres'] = $empreendimento->getTorresDisponiveis();
            $this->data['empreendimento'] = $empreendimento;
            return view('admin.tabela_vendas.desktop.getTorresQuadras', $this->data);
        } else {
            $this->data['quadras'] = $empreendimento->getQuadrasDisponiveis();
            $this->data['empreendimento'] = $empreendimento;
            return view('admin.tabela_vendas.desktop.getTorresQuadras', $this->data);
        }
    }

    public function buscarPrevisaoEntrega(Request $request)
    {
        if ($request->torre_id) {
            $this->data['previsao'] = Torre::find($request->torre_id);
        } elseif($request->quadra_id) {
            $this->data['previsao'] = Quadra::find($request->quadra_id);
        }
        return view('admin.tabela_vendas.desktop.getPrevisao', $this->data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tabela = new TabelaVendas();
        $tabela->construtora_id = $request->construtora_id;
        $tabela->empreendimento_id = $request->empreendimento_id;
        $tabela->tipo_tabela_id = $request->tipo_tabela_id;
        $tabela->percentual_entrada = converte_reais_to_mysql($request->percentual_entrada);
        $tabela->percentual_parcela_unica = converte_reais_to_mysql($request->percentual_parcela_unica);
        $tabela->data_parcela_unica = $request->data_parcela_unica;
        $tabela->qtd_mensais = $request->qtd_mensais;
        $tabela->percentual_mensais = converte_reais_to_mysql($request->percentual_mensais);
        $tabela->qtd_parcelas_entrada = $request->qtd_parcelas_entrada;
        $tabela->percentual_juros_mensal = converte_reais_to_mysql($request->percentual_juros_mensal);
        $tabela->qtd_baloes = $request->qtd_baloes;
        $tabela->percentual_baloes = converte_reais_to_mysql($request->percentual_baloes);
        $tabela->percentual_remanescente = converte_reais_to_mysql($request->percentual_remanescente);
        $tabela->banco_parceiro = $request->banco_parceiro;
        $tabela->desconto_avista = converte_reais_to_mysql($request->desconto_avista);
        $tabela->renda_minima = converte_reais_to_mysql($request->renda_minima);
        $tabela->programa_habitacional = $request->programa_habitacional;
        $tabela->subsidio_maximo = converte_reais_to_mysql($request->subsidio_maximo);
        //$tabela->correcao_obra = $request->correcao_obra;
        $tabela->correcao_poschave = $request->correcao_poschave;
        $tabela->aceita_bens = $request->aceita_bens;
        $tabela->possui_vaga_extra = $request->possui_vaga_extra;
        $tabela->valor_vaga_extra = converte_reais_to_mysql($request->valor_vaga_extra);
        $tabela->valor_vaga_extra_gaveta = converte_reais_to_mysql($request->valor_vaga_extra_gaveta);

        if($request->quadra_id):
            $tabela->quadra_id = $request->quadra_id;
        endif;

        if($request->torre_id):
            $tabela->torre_id = $request->torre_id;
        endif;

        $tabela->validade_tabela = $request->validade_tabela;
        $tabela->save();

        if ($request->data_parcela_balao) {
    		(new TabelaVendasBaloes())->salvarBaloes($request, $tabela);
    	}

        if ($tabela) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados incluídos'
	        ]);

	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $tabela = TabelaVendas::find($id);
        $construtora_id = get_construtora_id();

        $empreendimento = Empreendimento::find($tabela->empreendimento_id);

        $this->data['tabela'] = $tabela;
        $this->data['construtora_id'] = $construtora_id;
        $this->data['empreendimento'] = $empreendimento;


        if($tabela->torre_id){
            $torre = Torre::find($tabela->torre_id);
            $this->data['torre'] = $torre;
        }

        if($tabela->quadra_id){
            $quadra = Quadra::find($tabela->quadra_id);
            $this->data['quadra'] = $quadra;
        }

        if ($construtora_id) {
            $construtora = Construtora::find($construtora_id);
            $this->data['construtora'] = $construtora;
        }
        $this->data['tipo_tabela'] = tipoTabela::where('construtora_id', $construtora_id)->get();

        return view('admin.tabela_vendas.desktop.editar-tabela', $this->data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tabela = TabelaVendas::findOrFail($id);
        $tabela->construtora_id = $request->construtora_id;
        $tabela->empreendimento_id = $request->empreendimento_id;
        $tabela->tipo_tabela_id = $request->tipo_tabela_id;
        $tabela->percentual_entrada = converte_reais_to_mysql($request->percentual_entrada);
        $tabela->percentual_parcela_unica = converte_reais_to_mysql($request->percentual_parcela_unica);
        $tabela->data_parcela_unica = $request->data_parcela_unica;
        $tabela->qtd_mensais = $request->qtd_mensais;
        $tabela->percentual_mensais = converte_reais_to_mysql($request->percentual_mensais);
        $tabela->percentual_juros_mensal = converte_reais_to_mysql($request->percentual_juros_mensal);
        $tabela->qtd_parcelas_entrada = $request->qtd_parcelas_entrada;
        $tabela->qtd_baloes = $request->qtd_baloes;
        $tabela->percentual_baloes = converte_reais_to_mysql($request->percentual_baloes);
        $tabela->percentual_remanescente = converte_reais_to_mysql($request->percentual_remanescente);
        $tabela->banco_parceiro = $request->banco_parceiro;
        $tabela->desconto_avista = converte_reais_to_mysql($request->desconto_avista);
        $tabela->renda_minima = converte_reais_to_mysql($request->renda_minima);
        $tabela->programa_habitacional = $request->programa_habitacional;
        $tabela->subsidio_maximo = converte_reais_to_mysql($request->subsidio_maximo);
        //$tabela->correcao_obra = $request->correcao_obra;
        $tabela->correcao_poschave = $request->correcao_poschave;
        $tabela->aceita_bens = $request->aceita_bens;
        $tabela->possui_vaga_extra = $request->possui_vaga_extra;
        $tabela->valor_vaga_extra = converte_reais_to_mysql($request->valor_vaga_extra);
        $tabela->valor_vaga_extra_gaveta = converte_reais_to_mysql($request->valor_vaga_extra_gaveta);

        if($request->quadra_id):
            $tabela->quadra_id = $request->quadra_id;
        endif;

        if($request->torre_id):
            $tabela->torre_id = $request->torre_id;
        endif;

        $tabela->validade_tabela = $request->validade_tabela;
        $tabela->save();

        if ($request->data_parcela_balao) {
    		(new TabelaVendasBaloes())->salvarBaloes($request, $tabela);
    	}

        if ($tabela) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados com sucesso'
	        ]);

	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delTabela = TabelaVendas::findOrFail($id);
        $delTabela->delete();


        if ($delTabela) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Tabela removida com sucesso'
	        ]);

	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao excluir dados'
	        ]);
	    }
    }


    public function GravaTipoTabela(Request $request){

        $tipo = new tipoTabela();
        $tipo->construtora_id = $request->construtora_id;
        $tipo->nome = $request->nome;
        $tipo->save();

        if ($tipo) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $tipo
	        ]);

	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }

    }
}

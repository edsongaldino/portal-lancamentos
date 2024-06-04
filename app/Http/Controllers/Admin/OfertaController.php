<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Empreendimento;
use App\Models\Torre;
use App\Models\Quadra;
use App\Models\Oferta;
use App\Models\Unidade;
use App\Traits\ConstrutoraTrait;
use \Auth;

class OfertaController extends Controller
{
    use ConstrutoraTrait;

    private $view_index;
    private $view_form;

    public function __construct()
    {
        $this->view_index = isMobile() ? 'admin.oferta.desktop.index' : 'admin.oferta.desktop.index';
        $this->view_form = isMobile() ? 'admin.oferta.desktop.form' : 'admin.oferta.desktop.form';
    }

    public function index(Request $request)
    {        
        $construtora = $this->getConstrutora();
        $this->data['empreendimentos'] = $construtora->getEmpreendimentos();

    	return view($this->view_index, $this->data);
    }

    // Ofertas Verticais

    public function novaOferta(Request $request)
    {      
        $construtora = $this->getConstrutora();  
        $empreendimentos = $construtora->getEmpreendimentosLiberados();
        $this->data['empreendimentos'] = $empreendimentos;
        $this->data['empreendimento'] = null;
    	return view($this->view_form, $this->data);
    }

    public function cadastrarOferta(Request $request)
    {
        $construtora_id = Auth::user()->construtora_id;

        $resultado = (new Oferta())->salvarOferta($request, null, $construtora_id);

        if ($resultado) {
            return response()->json([
                'sucesso' => 'true',
                'mensagem' => 'Oferta salva com sucesso',
                'id' => $resultado
            ]);
        } else {
            return response()->json([
                'sucesso' => 'false',
                'mensagem' => 'Erro salvar dados da oferta'
            ]);
        }
    }

    public function alterarOferta(Request $request, $id)
    {        
    	$oferta = Oferta::find($id);
        $empreendimento = $oferta->empreendimento;
        $unidade = Unidade::find($oferta->unidade_id);
        
        $this->data['unidade'] = $unidade;
        $this->data['oferta'] = $oferta;
        $this->data['empreendimento'] = $empreendimento;
        $construtora = $this->getConstrutora();  
        $empreendimentos = $construtora->getEmpreendimentos();
        $this->data['empreendimentos'] = $empreendimentos;

        return view($this->view_form, $this->data);
    }

    public function atualizarOferta(Request $request, $id)
    {
        $construtora_id = Auth::user()->construtora_id;

        $resultado = (new Oferta())->salvarOferta($request, $id, $construtora_id);

        if ($resultado) {
            return response()->json([
                'sucesso' => 'true',
                'mensagem' => 'Oferta atualizada com sucesso',
                'id' => $resultado
            ]);
        } else {
            return response()->json([
                'sucesso' => 'false',
                'mensagem' => 'Erro atualizar dados da oferta'
            ]);
        }
    }

    public function excluirOferta($id)
    {
        $resultado = (new Oferta())->excluir($id);

        if ($resultado) {
            return response()->json([
                'sucesso' => 'true',
                'mensagem' => 'Oferta excluída com sucesso',
                'id' => $resultado
            ]);
        } else {
            return response()->json([
                'sucesso' => 'false',
                'mensagem' => 'Erro salvar dados da oferta'
            ]);
        }
    }

    public function buscarUnidade($id)
    {
        $unidade = Unidade::findOrFail($id);
        $valor = number_format(obter_valor_unidade($unidade), 0, '.', '');    
        return response()->json([
            'unidade' => $unidade,
            'valor_unidade' => $valor
        ]);
    }
}

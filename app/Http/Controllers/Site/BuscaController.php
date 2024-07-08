<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Construtora;
use App\Models\Cidade;
use App\Models\Empreendimento;
use App\Models\Oferta;
use App\Models\Subtipo;
use Illuminate\Support\Facades\Request as RequestFacade;

class BuscaController extends Controller
{
    private $view;

    public function __construct()
    {
        $this->view = isMobile() ? 'site.busca.mobile.index' : 'site-2023.busca-mapa';
    }

    public function index(Request $request)
    {        
        $this->getDadosBusca($request);
        return view($this->view, $this->data);
    }

    public function ajax(Request $request)
    {
        $this->getDadosBusca($request);
        return view('site-2023.busca-mapa', $this->data);
    }

    public function getDadosBusca($request, $array = null)
    {

        $parametros = [
            'estado_id' => $request->input('estado_id', null),
            'cidade_id' => $request->input('cidade_id', null),
            'subtipo_id' => $request->input('subtipo_id', null),
            'busca_rapida' => $request->input('busca_rapida', null),
            'construtora_id_multiplo' => $request->input('construtora_id_multiplo', null),
            'construtora_id' => $request->input('construtora_id', null),
            'subtipo_id_multiplo' => $request->input('subtipo_id_multiplo', null),
            'modalidade' => $request->input('modalidade', null),
            'estado_id_multiplo' => $request->estado_id_multiplo,
            'cidade_id_multiplo' => $request->input('cidade_id_multiplo', null),
            'bairro_id_multiplo' => $request->input('bairro_id_multiplo', null),
            'valor' => str_replace(' ', '', $request->input('valor', null)),
            'quarto' => str_replace(' ', '', $request->input('quarto', null)),
            'area' => str_replace(' ', '', $request->input('area', null)),
            'oferta' => $request->input('oferta', false),
            'page' => $request->input('page', 1),
            'querystring' => $request->getQueryString(),
            'url' => isset($array['url']) ? $array['url'] : '/resultado-busca',
            'ordenacao' => $request->input('ordenacao', null),
            'valor_min' => str_replace(' ', '', $request->input('valor_min', null)),
            'valor_max' => str_replace(' ', '', $request->input('valor_max', null))
        ];

        $retorno = (new Empreendimento())->buscar($parametros);

        $this->data['parametros'] = $parametros;      
        $this->data['subtipos'] = Subtipo::all();   
        $this->data['total'] = $retorno['total'];
        $this->data['empreendimentos'] = $retorno['resultados'];
        $this->data['paginacao'] = $retorno['paginacao'];
        
        if($parametros["oferta"]):
            $this->data['construtora'] = Construtora::find($parametros["construtora_id"]);
        else:
            $this->data['construtora'] = null;
        endif;
        
        $empreendimentos_autocomplete = Empreendimento::where('status', 'Liberada')->get();
        $this->data['empreendimentos_autocomplete'] = $empreendimentos_autocomplete;
        return $this->data;
    }

    public function cidade(Request $request, $cidade, $id)
    {                     
        $request->request->set('cidade_id', $id);

        $this->getDadosBusca($request);

        return view($this->view, $this->data);
    }

    public function Regiao(Request $request, $regiao, $id)
    {  
                           
        switch ($id) {
            //Centro Oeste
            case '1':
                $estados = array(1, 2, 3, 4);
                $request->request->set('estado_id_multiplo', $estados);
                break;
            //Sudeste
            case '2':
                $estados = array(15, 6, 20, 17);
                $request->request->set('estado_id_multiplo', $estados);
                break;
            //Norte e Nordeste
            case '3':
                $estados = array(7, 8, 9, 10, 11, 12, 16, 18, 22, 23, 24, 25, 26, 27, 28, 29);
                $request->request->set('estado_id_multiplo', $estados);
                break;
            //Sul
            case '4':
                $estados = array(13, 18, 21);
                $request->request->set('estado_id_multiplo', $estados);
                break;
            default:
                $estados = array(null);
                $request->request->set('estado_id_multiplo', $estados);
                break;
        }

        $this->getDadosBusca($request);

        return view($this->view, $this->data);
    }

    public function subtipo(Request $request, $id)
    {        
        $subtipo = Subtipo::find($id);
        
        if (!$subtipo) {
            return redirect('/pagina-inicial.html');
        }            

        $request->request->set('subtipo_id', $subtipo->id);

        $this->getDadosBusca($request);

        return view($this->view, $this->data);
    }

    public function oferta(Request $request, $id = null)
    {                
        $request->request->set('oferta', true);
        $request->request->set('construtora_id', $id);

        $this->getDadosBusca($request);

        return view($this->view, $this->data);
    }

    public function modalidade(Request $request, $subtipo, $id)
    {               
        $modalidades = [
            1 => 'Em Obra',
            2 => 'Breve',
            3 => 'Lançamento',
            4 => 'Mude Já'
        ];        

        $request->request->set('modalidade', $modalidades[$id]);

        $subtipos = [
            'apartamentos' => 1,
            'comerciais' => 2,
            'condominios' => 3,
        ];

        $request->request->set('subtipo_id', $subtipos[$subtipo]);        

        $this->getDadosBusca($request);

        return view($this->view, $this->data);
    }

    public function autocomplete(Request $request)
    {        
        $retorno = (new Empreendimento())->GetPorNomes($request->term)->get('nome')->toArray();

        if ($retorno) {
            $retorno = array_column($retorno, 'nome');
            return response()->json($retorno);
        }
    }

    public function autocompleteGeral(Request $request)
    {        
        $texto = $request->texto;

        $retorno = (new Empreendimento())->autocompleteGeral($texto);      
        
        if ($retorno) {
            $retorno = array_column($retorno, 'nome');
            return response()->json($retorno);
        }

        return response()->json([]);
    }

}

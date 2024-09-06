<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Construtora;
use App\Models\Empreendimento;
use App\Models\Newsletter;
use App\Models\Publicacao;
use App\Http\Requests\NewsletterRequest;
use App\Models\Cidade;
use App\Models\ContatoComercial;
use App\Models\Subtipo;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $viewHome;
    private $viewConstrutora;

    public function __construct()
    {
        $this->viewHome = isMobile() ? 'site.home.mobile.index' : 'site.home.desktop.index';
        $this->viewConstrutora = isMobile() ? 'site.construtora.mobile.index' : 'site.construtora.desktop.index';
    }

    public function index()
    {
        $this->data['construtoras'] = Construtora::where('status', 'Liberada')->get()->all();
        $this->data['apartamentos'] = Empreendimento::where('subtipo_id', 1)->where('status', 'Liberada')->get()->count();
        $this->data['condominios'] = Empreendimento::where('subtipo_id', 3)->where('status', 'Liberada')->get()->count();
        $this->data['salas'] = Empreendimento::where('subtipo_id', 2)->where('status', 'Liberada')->get()->count();
        $this->data['lotes'] = Empreendimento::where('subtipo_id', 4)->where('status', 'Liberada')->get()->count();
        $this->data['noticias'] = Publicacao::where('status', 'Liberada')->orderBy('data', 'DESC')->take(4)->get();
        $this->data['subtipos'] = Subtipo::all();
        $this->data['empreendimentos'] = Empreendimento::latest()->where('status', 'Liberada')->get();
        $this->data['noticias'] = Publicacao::where('status', 'Liberada')->orderBy('data', 'DESC')->take(3)->get();
        $this->data['destaques'] = Empreendimento::latest()->where('status', 'Liberada')->take(12)->get();

        return view($this->viewHome, $this->data);
    }

    public function construtora(Request $request, $construtora, $id)
    {
        $request->request->set('construtora_id', $id);
        $this->data = (new BuscaController())->getDadosBusca($request, [
            'url' => "/construtora/{$construtora}-{$id}.html"
        ]);
        $this->data['construtora'] = Construtora::find($id);

        return view($this->viewConstrutora, $this->data);
    }

    public function termosUso()
    {
        return view('site.termos_uso/index');
    }

    public function politicaPrivacidade()
    {
        return view('site.politica_privacidade.index');
    }

    public function PaginaComercial(){
        return view('site.pagina-comercial.index');
    }

    public function NovaIndex(){
        $subtipos = Subtipo::all();
        $empreendimentos = Empreendimento::latest()->where('status', 'Liberada')->take(30)->get();
        $noticias = Publicacao::where('status', 'Liberada')->orderBy('data', 'DESC')->take(3)->get();
        $destaques = Empreendimento::latest()->where('status', 'Liberada')->take(12)->get();
        return view('site-2023.index', compact('empreendimentos', 'subtipos', 'noticias', 'destaques'));
    }

    public function BuscaMapa(Request $busca){
        $ListaEmpreendimentos = Empreendimento::where('status', 'Liberada');

        if($busca->modalidade){
            $ListaEmpreendimentos->where('empreendimentos.modalidade', $busca->modalidade);
        }
        if($busca->subtipo_id){
            $ListaEmpreendimentos->where('empreendimentos.subtipo_id', $busca->subtipo_id);
        }

        if($busca->valor_min){
            $ListaEmpreendimentos->where('empreendimentos.valor_inicial','>=', $busca->valor_min);
        }

        if($busca->valor_max){
            $ListaEmpreendimentos->where('empreendimentos.valor_final','<', $busca->valor_max);
        }

        if($busca->cidade){
            $ListaEmpreendimentos->endereco->where('enderecos.cidade_id', $busca->cidade);
        }

        $empreendimentos = $ListaEmpreendimentos->paginate(10);
        return view('site-2023.busca-mapa', compact('empreendimentos', 'subtipos'));
    }

    public function Busca(){
        $empreendimentos = Empreendimento::latest()->where('status', 'Liberada')->paginate(50);
        $subtipos = Subtipo::all();
        return view('site-2023.lista', compact('empreendimentos', 'subtipos'));
    }

    public function newsletter(NewsletterRequest $request)
    {
        $resultado = (new Newsletter())->salvar($request);

        $sucesso = 'false';

        if ($resultado) {
            $sucesso = 'true';
        }

        return response()->json([
            'sucesso' => $sucesso,
            'retorno' => 'E-mail salvo com sucesso'
        ]);
    }

    public function SiteMap()
	{
       $empreendimentos = Empreendimento::latest()->where('status', 'Liberada')->get()->all();

	  return response()->view('site.sitemap.index', [
	      'empreendimentos' => $empreendimentos,
	  ])->header('Content-Type', 'text/xml');
	}

    public function ContatoComercial(Request $request){

        $contato = (new ContatoComercial())->salvar($request);

        if ($contato) {
            return response()->json([
                'sucesso' => 'true',
                'retorno' => 'Recebemos seu contato e você receberá uma resposta no prazo máximo de 24 horas'
            ]);
        }

        return response()->json([
            'sucesso' => 'erro',
            'retorno' => 'Ocorreu um erro, tente novamente mais tarde'
        ]);

    }

    public function AutoCompleteCidades($query)
    {
        //$municipios = Cidade::where('status', 'L')->where("cidades.nome","LIKE","%$query%")->get();
        $municipios = DB::table('cidades')
        ->select('cidades.id', DB::Raw("CONCAT(cidades.nome, ' (', estados.uf, ')') AS nome"))
        ->join('estados', 'estados.id', '=', 'cidades.estado_id')
        ->where("cidades.nome","LIKE","%$query%")->orWhere("estados.uf","LIKE","%$query%")
        ->get();

        return response()->json($municipios);
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContatoConstrutoraRequest;
use App\Models\Cliente;
use App\Models\ContatoClique;
use App\Models\Empreendimento;
use App\Models\Estatistica;
use App\Models\Foto;
use App\Models\Garagem;
use App\Models\Lead;
use App\Models\Oferta;
use App\Models\Planta;
use App\Models\Proposta;
use App\Models\TourVirtual;
use App\Models\Unidade;
use App\Models\TabelaVendas;
use Illuminate\Http\Request;

class EmpreendimentoController extends Controller
{
    private $view;
    private $viewProposta;
    private $viewPremium;

    public function __construct()
    {
        $this->view = isMobile() ? 'site.empreendimento.mobile.index' : 'site.empreendimento.desktop.index';
        $this->viewPremium = isMobile() ? 'site.empreendimento.premium.index' : 'site.empreendimento.desktop.index';
        $this->viewProposta = isMobile() ? 'site.empreendimento.mobile.proposta' : 'site.empreendimento.desktop.proposta';
    }

    public function index($url, $id)
    {
        $empreendimento = Empreendimento::find($id);

        if ($empreendimento->status == 'Bloqueada' or $empreendimento->construtora->status == 'Bloqueada') {
            return redirect('/');
        }

        (new Estatistica())->salvarClique($empreendimento);
        $this->data['empreendimento'] = $empreendimento;
        $this->data['array_empreendimentos_favoritos'] = [];
        $this->data['tour360'] = TourVirtual::where('empreendimento_id', $id)->get();

        $viewEmpreendimento = $this->viewPremium;
        
        return view($viewEmpreendimento, $this->data);
    }

    public function unidades($id){
        $this->data['empreendimento'] = Empreendimento::find($id);
        $this->data['unidades'] = Unidade::where('empreendimento_id', $id)->where('situacao','Disponível')->get();
        return view('site.empreendimento.premium.mobile.unidades', $this->data);
    }

    public function fotos($id){
        $this->data['empreendimento'] = Empreendimento::find($id);
        $this->data['fotos'] = Foto::where('empreendimento_id', $id)->where('tipo','<>','Implantação')->where('status','Liberada')->get();
        return view('site.empreendimento.premium.mobile.fotos', $this->data);
    }

    public function premium($id){
        $empreendimento = Empreendimento::find($id);
        $unidade = Unidade::where('empreendimento_id', $id)->where('situacao','Disponível')->get();
        return view('site.empreendimento.premium.index', compact('empreendimento', 'unidade'));
    }

    public function unidade($id){
        $unidade = Unidade::find($id);
        $this->data['caracteristicas'] = $unidade->empreendimento->caracteristicas->where('tipo', 'Empreendimento')->where('exibir', 'Sim');
        $this->data['unidade'] = $unidade;
        $this->data['empreendimento'] = Empreendimento::find($unidade->empreendimento_id);
        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $unidade->empreendimento_id)->where('tipo_tabela_id', 1)->first();

        //elimina sessão proposta
        session()->pull('proposta');

        return view('site.empreendimento.premium.mobile.unidade', $this->data);
    }

    public function detalhePlanta(Request $request){

        $planta = Planta::find($request->planta);
        return view('site.empreendimento.premium.global.infoPlanta', compact('planta'));

    }

    public function unidadesPlanta($id){

        $planta = Planta::find($id);
        $empreendimento = Empreendimento::find($planta->empreendimento_id);
        $unidades = Unidade::where('planta_id', $id)->where('situacao','Disponível')->get();
        return view('site.empreendimento.premium.mobile.unidades', compact('empreendimento', 'unidades'));

    }

    public function formularProposta($id){
        $unidade = Unidade::find($id);
        $this->data['unidade'] = $unidade;
        $this->data['empreendimento'] = Empreendimento::find($unidade->empreendimento_id);
        return view('site.empreendimento.premium.mobile.proposta.dados', $this->data);
    }

    public function DadosProposta($id){
        $unidade = Unidade::find($id);
        $this->data['unidade'] = $unidade;
        $this->data['empreendimento'] = Empreendimento::find($unidade->empreendimento_id);
        return view('site.empreendimento.premium.mobile.proposta.index', $this->data);
    }

    public function CondicoesConstrutora($id){
        $unidade = Unidade::find($id);
        $this->data['unidade'] = $unidade;
        $this->data['empreendimento'] = Empreendimento::find($unidade->empreendimento_id);
        $this->data['tabela'] = TabelaVendas::where('empreendimento_id', $unidade->empreendimento_id)->where('tipo_tabela_id', 1)->first();
        $this->data['proposta'] = session()->get('proposta');
        return view('site.empreendimento.premium.mobile.proposta.condicoes', $this->data);
    }

    public function conferirProposta($id){
        $unidade = Unidade::find($id);
        $this->data['unidade'] = $unidade;
        $this->data['empreendimento'] = Empreendimento::find($unidade->empreendimento_id);
        return view('site.empreendimento.premium.mobile.proposta.conferir', $this->data);
    }

    public function finalizarProposta($id){
        $unidade = Unidade::find($id);
        $this->data['unidade'] = $unidade;
        $this->data['empreendimento'] = Empreendimento::find($unidade->empreendimento_id);
        return view('site.empreendimento.premium.mobile.proposta.finalizar', $this->data);
    }

    public function plantas($id){
        $this->data['empreendimento'] = Empreendimento::find($id);
        $this->data['plantas'] = Planta::where('empreendimento_id',$id)->get();
        return view('site.empreendimento.premium.mobile.plantas', $this->data);
    }

    public function garagem($id){
        $this->data['empreendimento'] = Empreendimento::find($id);
        $this->data['plantas'] = Planta::where('empreendimento_id',$id)->get();
        return view('site.empreendimento.premium.mobile.garagem', $this->data);
    }

    public function tour360($id){
        $this->data['empreendimento'] = Empreendimento::find($id);
        $this->data['plantas'] = Planta::where('empreendimento_id',$id)->get();
        return view('site.empreendimento.premium.mobile.tour360', $this->data);
    }

    public function contato(ContatoConstrutoraRequest $request)
    {

        //return redirect()->back()->with('warning', 'Este CNPJ já consta em nosso banco de dados! Verifique.');

        $resultado = (new Lead())->contato($request);

        if ($resultado) {
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

    public function ContatoConstrutora(Request $request)
    {

        //return redirect()->back()->with('warning', 'Este CNPJ já consta em nosso banco de dados! Verifique.');

        $resultado = (new Lead())->contato($request);

        if ($resultado) {
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

    public function ChatEmpreendimento(Request $request)
    {
        $contato = new ContatoClique();
        $contato->empreendimento_id = $request->empreendimento_id;
        $contato->tipo_clique = $request->tipo_clique;
        $contato->nome = $request->nome;
        $contato->whatsapp = $request->whatsapp;
        $contato->save();

        if ($contato) {

            (new Lead())->contato($request);
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

    public function oferta(Request $request)
    {
        $id = $request->id;
        $this->data['oferta'] = Oferta::find($id);
        return view('site.empreendimento.desktop.oferta_modal', $this->data);
    }

    public function buscarCliente(Request $request)
    {
        $cpf = $request->cpf;

        $cliente = Cliente::where('cpf', $cpf)->get()->first();

        return response()->json([
            'nome' => isset($cliente) ? $cliente->nome : '',
            'email' => isset($cliente) ? $cliente->email : '',
            'data_nascimento' => isset($cliente) ? $cliente->getOriginal('data_nascimento') : '',
            'telefone' => isset($cliente) ? $cliente->telefone : '',
            'estado_civil' => isset($cliente) ? $cliente->estado_civil : '',
            'renda' => isset($cliente) ? $cliente->renda : '',
            'conjuge_nome' => (isset($cliente) && $cliente->conjuge) ? $cliente->conjuge->nome : '',
            'conjuge_cpf' => (isset($cliente) && $cliente->conjuge) ? $cliente->conjuge->cpf : '',
        ]);
    }

    public function enviarProposta(Request $request)
    {
        $resultado = (new Proposta())->salvar($request);

        if ($resultado) {
            return response()->json([
                'sucesso' => 'true',
                'retorno' => 'Proposta recebida, você receberá uma resposta no prazo máximo de 24 horas'
            ]);
        }

        return response()->json([
            'sucesso' => 'erro',
            'retorno' => 'Ocorreu um erro, tente novamente mais tarde'
        ]);
    }

    public function mapa(Request $request)
    {
        $this->data['empreendimento'] = Empreendimento::find($request->id);
        return view('site.empreendimento.desktop.mapa', $this->data);
    }

    public function unidadeMapa(Request $request)
    {
        $this->data['unidade'] = Unidade::find($request->unidade);
        //dd($this->data['unidade']);
        return view('site.empreendimento.desktop.unidade_mapa', $this->data);
    }

    public function dimensaoLote(Request $request)
    {
        $unidade = Unidade::find($request->unidade);
        return view('site.empreendimento.desktop.dimensao_lote', compact('unidade'));
    }

    public function GetunidadeMapa($id)
    {
        $this->data['unidade'] = Unidade::find($id);
        return view('site.empreendimento.desktop.unidade_mapa', $this->data);
    }

    public function garagemMapa(Request $request)
    {
        $this->data['garagem'] = Garagem::find($request->garagem);
        return view('site.empreendimento.desktop.garagem_mapa', $this->data);
    }

    public function proposta(Request $request, $id)
    {
        $this->data['oferta'] = Oferta::find($id);
        return view($this->viewProposta, $this->data);
    }

    public function RestoreFoto($id)
    {
        // Recupera o post pelo ID
        //$foto = Foto::find($id);
        $foto = Foto::withTrashed()->findOrFail($id);

        // Restaura:
        $foto->restore();

        // Também é possível fazer assim, em uma única linha:
        // $post = $post->find($id)->restore();
    }
}

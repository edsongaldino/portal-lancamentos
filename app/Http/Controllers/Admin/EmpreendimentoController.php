<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmpreendimentoEnderecoRequest;
use App\Http\Requests\EmpreendimentoRequest;
use App\Http\Requests\GerarQuadrasUnidadesRequest;
use App\Http\Requests\GerarTorresUnidadesRequest;
use App\Http\Requests\PlantaRequest;
use App\Http\Requests\QuadraRequest;
use App\Http\Requests\TorreRequest;
use App\Http\Requests\PavimentoGaragemRequest;
use App\Models\Andar;
use App\Models\Bairro;
use App\Models\Caracteristica;
use App\Models\Cidade;
use App\Models\Construtora;
use App\Models\Empreendimento;
use App\Models\EmpreendimentoArquivos;
use App\Models\EmpreendimentoPerfil;
use App\Models\Endereco;
use App\Models\Estado;
use App\Models\Foto;
use App\Models\Garagem;
use App\Models\PavimentoGaragem;
use App\Models\Planta;
use App\Models\Quadra;
use App\Models\Seo;
use App\Models\Subtipo;
use App\Models\Torre;
use App\Models\Unidade;
use App\Models\Variacao;
use BrunoCouty\BuscaViaCep\Services\Cep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use \Auth;
use Illuminate\Support\Facades\Response;
use App\Models\Pdf;
use App\Models\User;
use App\Models\TourVirtual;
use Illuminate\Support\Facades\DB;

class EmpreendimentoController
{

    private $viewMapa;

    public function __construct()
    {
        $this->viewMapa = isMobile() ? 'site.empreendimento.mobile.mapa.visualizar' : 'site.empreendimento.desktop.mapa.visualizar';
		$this->viewMapaVertical = isMobile() ? 'site.empreendimento.mobile.mapa.visualizarVertical' : 'site.empreendimento.desktop.mapa.visualizarVertical';
		$this->viewGaragens = isMobile() ? 'site.empreendimento.mobile.mapa.vagas' : 'site.empreendimento.desktop.mapa.visualizar_vagas';
		$this->viewMapaLazer = isMobile() ? 'site.empreendimento.mobile.mapa.visualizarLazer' : 'site.empreendimento.desktop.mapa.visualizarLazer';
    }

	public function index()
    {
		$construtora_id = Auth::user()->construtora_id;
		$this->data['empreendimentos'] = [];
		$this->data['construtoras'] = [];

		if (isAdmin()) {
			$this->data['construtoras'] = Construtora::all();
		}

		if ($construtora_id) {
			$construtora = Construtora::find($construtora_id);
        	$this->data['empreendimentos'] = $construtora->getEmpreendimentos();
		}

        return view('admin.empreendimentos.desktop.empreendimento.index', $this->data);
	}

	public function filtrarEmpreendimentos(Request $request)
	{
        $construtora_id = Auth::user()->construtora_id;

		$this->data['empreendimentos'] = (new Empreendimento())->filtrar($request, $construtora_id);

		return view('admin.empreendimentos.desktop.empreendimento.lista', $this->data);
	}

	public function trocarConstrutora(Request $request)
    {
		$construtora_id = $request->construtora_id;
		Auth::user()->construtora_id = $construtora_id;
		Auth::user()->save();
		return response()->json([
			'sucesso' => true,
			'retorno' => 'Construtora alterada com sucesso'
		]);
	}

	public function cadastrar()
    {
        $this->data['itens_lazer'] = Caracteristica::where('tipo', 'lazer')->where('exibir', 'Sim')->get()->toArray();
		$this->data['caracteristicas'] = Caracteristica::where('tipo', 'Empreendimento')->where('exibir', 'Sim')->get()->toArray();

        return view('admin.empreendimentos.desktop.empreendimento.form', $this->data);
    }

    public function editar($id)
    {
		$empreendimento = Empreendimento::find($id);
        $this->data['entry'] = $empreendimento;
        $this->data['id'] = $id;
		$this->data['view'] = "edit";
        $this->data = $this->getRelacionamentos($id, $this->data);

        return view('admin.empreendimentos.desktop.empreendimento.form', $this->data);
	}

	public function infoUnidade(Request $request, $id)
	{
		$unidade = Unidade::find($id);
		$plantas = $unidade->empreendimento->plantas;

		$this->data['situacao'] = $request->situacao;
		$this->data['plantas'] = $plantas;
		$this->data['entry'] = $unidade;

		return view('admin.empreendimentos.desktop.empreendimento.unidade.visualizar', $this->data);
	}

	public function view($id)
    {
		$empreendimento = Empreendimento::find($id);
        $this->data['entry'] = $empreendimento;
        $this->data['id'] = $id;
		$this->data['view'] = "view";
        $this->data = $this->getRelacionamentos($id, $this->data);

        return view('admin.empreendimentos.desktop.empreendimento.form', $this->data);
	}

	public function excluirEmpreendimento(Request $request)
	{
	    $resultado = (new Empreendimento())->excluir($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Empreendimento excluído com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Para excluir um empreendimento todas as unidades precisam estar vendidas'
	        ]);
	    }
	}

    private function getRelacionamentos($id, $dados)
    {
        $dadosEndereco = [];
        $cidades = [];
        $bairros = [];
        $cidades_stand = [];
        $bairros_stand = [];
        $empreendimento = Empreendimento::find($id);

        $endereco = $empreendimento->endereco;

        if ($endereco && $endereco->cidade_id) {
            $cidade = Cidade::find($endereco->cidade_id);
            $cidades = Estado::find($cidade->estado_id)->cidades()->where('status', 'L')->get();
            $bairros = $cidade->bairros()->where('status', 'L')->get();
        }

        $endereco_stand = $empreendimento->enderecoStand;

        if ($endereco_stand && $endereco_stand->cidade_id) {
            $cidade = Cidade::find($endereco_stand->cidade_id);
            $cidades_stand = Estado::find($cidade->estado_id)->cidades()->where('status', 'L')->get();
            $bairros_stand = $cidade->bairros()->where('status', 'L')->get();
        }

        $dados['cidades'] = $cidades;
        $dados['bairros'] = $bairros;
        $dados['estados'] = Estado::where('status', 'L')->get();
        $dados['endereco'] = $endereco;
        $dados['endereco_stand'] = $endereco_stand;
        $dados['cidades_stand'] = $cidades_stand;
        $dados['bairros_stand'] = $bairros_stand;
        $dados['itens_lazer'] = $this->itensLazer($empreendimento);
        $dados['caracteristicas'] = $this->caracteristicasEmpreendimento($empreendimento);
        $dados['perfil'] = $empreendimento->perfil->toArray();
        $dados['percentual'] = (new EmpreendimentoPerfil())->getPercentual($dados['perfil']);
        $dados['subtipos'] = Subtipo::where('tipo',$empreendimento->tipo)->get();
        $dados['variacoes'] = Variacao::where('subtipo_id',$empreendimento->subtipo_id)->get();
		$dados['itens_tour'] = $this->tour360($empreendimento);
        return $dados;
	}

	public function mapaLazer($id)
	{
		$empreendimento = Empreendimento::find($id);

        $this->data['empreendimento'] = $empreendimento;
		$this->data['tipo'] = 'Lazer';

        return view('site.empreendimento.desktop.mapa.lazer', $this->data);
	}

	public function mapa($id)
	{
		$empreendimento = Empreendimento::find($id);

		if ($empreendimento->unidades->count() == 0) {
			return 'Primeiro você precisa gerar ou cadastrar as unidades do seu empreendimento para marcar as unidades no mapa';
		}

        $this->data['empreendimento'] = $empreendimento;

        return view('site.empreendimento.desktop.mapa.index', $this->data);
	}

	public function mapaVertical($id,$view)
	{
		$empreendimento = Empreendimento::find($id);

		if ($empreendimento->unidades->count() == 0) {
			return 'Primeiro você precisa gerar ou cadastrar as unidades do seu empreendimento para marcar as unidades no mapa';
		}

        $this->data['empreendimento'] = $empreendimento;
		$this->data['view'] = $view;

		$total = DB::table('unidades')
		->join('caracteristicas_unidades', 'unidades.id', '=', 'caracteristicas_unidades.unidade_id')
		->where('caracteristicas_unidades.valor', $view)
		->where('unidades.empreendimento_id', $id)
		->count();

		if($total > 0){
			$this->data['unidades'] = Unidade::select('unidades.*')
			->join('caracteristicas_unidades', 'unidades.id', '=', 'caracteristicas_unidades.unidade_id')
			->where('caracteristicas_unidades.valor', $view)
			->where('unidades.empreendimento_id', $id)
			->get();
		}else{
			$this->data['unidades'] = Unidade::select('unidades.*')
			->join('caracteristicas_unidades', 'unidades.id', '=', 'caracteristicas_unidades.unidade_id')
			->where('caracteristicas_unidades.valor', '')
			->where('unidades.empreendimento_id', $id)
			->get();
		}

		switch($view):
			case 'frente':
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Frente');
			break;
			case 'fundo':
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Fundo');
			break;
			case 'lateral':
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Lateral');
			break;
			default:
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Frente');
			break;
		endswitch;

        return view('site.empreendimento.desktop.mapa.vertical', $this->data);
	}

	public function mapaGaragens($id)
	{
		$empreendimento = Empreendimento::find($id);

		if ($empreendimento->garagens->count() == 0) {
			return 'Primeiro você precisa gerar ou cadastrar as garagens do seu empreendimento para marcar as vagas no mapa';
		}

        $this->data['empreendimento'] = $empreendimento;

        return view('admin.empreendimentos.desktop.empreendimento.garagem.mapa_garagem', $this->data);
	}

	public function visualizarMapa($id,$hash,$view)
	{

		if($view == "user"){
			$idUser = $hash/37;
			$user = User::find($idUser);
			$this->data['user'] = $user;
		}


		$empreendimento = Empreendimento::find($id);

		if ($empreendimento->unidades->count() == 0) {
			return 'Primeiro você precisa gerar ou cadastrar as unidades do seu empreendimento para marcar as unidades no mapa';
		}

		$this->data['empreendimento'] = $empreendimento;
		$this->data['view'] = $view;

        return view($this->viewMapa, $this->data);
	}

	public function visualizarUnidadeMapa($id,$hash,$view)
	{

		if($view == "user"){
			$idUser = $hash/37;
			$user = User::find($idUser);
			$this->data['user'] = $user;
		}

		$unidade = Unidade::find($id);
		$empreendimento = Empreendimento::find($unidade->empreendimento_id);

		$this->data['empreendimento'] = $empreendimento;
		$this->data['unidade'] = $unidade;
		$this->data['view'] = $view;
		$this->data['tipo'] = 'unidade';

        return view($this->viewMapa, $this->data);
	}

	public function visualizarUnidadeMapaVertical($id,$hash,$view)
	{

		if($view == "user"){
			$idUser = $hash/37;
			$user = User::find($idUser);
			$this->data['user'] = $user;
		}

		$unidade = Unidade::find($id);
		$empreendimento = Empreendimento::find($unidade->empreendimento_id);


		$this->data['view'] = $view;

		switch($view):
			case 'frente':
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Frente');
			break;
			case 'fundo':
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Fundo');
			break;
			case 'lateral':
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Lateral');
			break;
			default:
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Frente');
			break;
		endswitch;

		$this->data['empreendimento'] = $empreendimento;
		$this->data['unidade'] = $unidade;
		$this->data['view'] = $view;
		$this->data['tipo'] = 'unidade';

        return view($this->viewMapaVertical, $this->data);
	}

	public function visualizarMapaLazer($id,$hash,$view)
	{

		if($view == "user"){
			$idUser = $hash/37;
			$user = User::find($idUser);
			$this->data['user'] = $user;
		}


		$empreendimento = Empreendimento::find($id);

		if ($empreendimento->unidades->count() == 0) {
			return 'Primeiro você precisa gerar ou cadastrar as unidades do seu empreendimento para marcar as unidades no mapa';
		}

		$this->data['empreendimento'] = $empreendimento;
		$this->data['view'] = $view;

        return view($this->viewMapaLazer, $this->data);
	}

	public function visualizarMapaVertical($id,$hash,$view)
	{

		if($view == "user"){
			$idUser = $hash/37;
			$user = User::find($idUser);
			$this->data['user'] = $user;
		}


		$empreendimento = Empreendimento::find($id);

		if ($empreendimento->unidades->count() == 0) {
			return 'Primeiro você precisa gerar ou cadastrar as unidades do seu empreendimento para marcar as unidades no mapa';
		}

		$total = DB::table('unidades')
		->join('caracteristicas_unidades', 'unidades.id', '=', 'caracteristicas_unidades.unidade_id')
		->where('caracteristicas_unidades.valor', $view)
		->where('unidades.empreendimento_id', $id)
		->count();

		if($total > 0){
			$this->data['unidades'] = Unidade::select('unidades.*')
			->join('caracteristicas_unidades', 'unidades.id', '=', 'caracteristicas_unidades.unidade_id')
			->where('caracteristicas_unidades.valor', $view)
			->where('unidades.empreendimento_id', $id)
			->get();
		}else{
			$this->data['unidades'] = Unidade::select('unidades.*')
			->join('caracteristicas_unidades', 'unidades.id', '=', 'caracteristicas_unidades.unidade_id')
			->where('caracteristicas_unidades.valor', '')
			->where('unidades.empreendimento_id', $id)
			->get();
		}

		$this->data['empreendimento'] = $empreendimento;
		$this->data['view'] = $view;

		switch($view):
			case 'frente':
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Frente');
			break;
			case 'fundo':
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Fundo');
			break;
			case 'lateral':
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Lateral');
			break;
			default:
				$this->data['foto_implantacao'] = $empreendimento->getFotoTipo('Implantação Vertical - Frente');
			break;
		endswitch;

        return view($this->viewMapaVertical, $this->data);
	}

	public function viewMapa($id,$hash,$view)
	{

		if($view == "user"){
			$idUser = $hash/37;
			$user = User::find($idUser);
			$this->data['user'] = $user;
		}


		$empreendimento = Empreendimento::find($id);

		if ($empreendimento->unidades->count() == 0) {
			return 'Primeiro você precisa gerar ou cadastrar as unidades do seu empreendimento para marcar as unidades no mapa';
		}

		$this->data['empreendimento'] = $empreendimento;
		$this->data['view'] = $view;

        return view('site.empreendimento.mobile.mapa.view', $this->data);
	}

	public function visualizarGaragens($id,$hash,$view)
	{
		$idUser = $hash/37;
		$user = User::find($idUser);

		$empreendimento = Empreendimento::find($id);

		if ($empreendimento->garagens->count() == 0) {
			return 'Primeiro você precisa gerar ou cadastrar as garagens do seu empreendimento para marcar as vagas no mapa';
		}

		$this->data['empreendimento'] = $empreendimento;
		$this->data['view'] = $view;
		$this->data['user'] = $user;

		if($view == 'mobile'){
			$this->data['view'] = 'pdf';
			$url = 'site.empreendimento.desktop.mapa.visualizar_vagas';
		}else{
			$url = $this->viewGaragens;
		}

        return view($url, $this->data);
	}

	public function atualizarGaragensEmpreendimento($id)
	{

		$unidades = Unidade::where('empreendimento_id',$id)->get();

		foreach($unidades as $unidade){

			$garagens = Garagem::where('unidade_id',$unidade->id)->get();

			foreach($garagens as $garagem){

				$resultado = (new Garagem())->atualizarSituacao($garagem->id, $unidade->situacao);

			}

		}
	}

	public function downloadPdfMapa($id, $acao)
	{
		$empreendimento = Empreendimento::find($id);
		$filename = "PDF_".url_amigavel($empreendimento->nome).".pdf";

		if($acao == "visualizar" && file_exists("uploads/pdf/$filename")){
			$data_modificacao_pdf = date("Y-m-d H:i:s", filemtime("uploads/pdf/$filename"));
			$unidade_modificacao = Unidade::select('unidades.updated_at')
								->where('empreendimento_id', $id)
								->orderBy('updated_at','DESC')
								->first();
			if($data_modificacao_pdf < $unidade_modificacao->updated_at){
				$response = $empreendimento->geraPdfMapa($empreendimento->getUrlMapa(), $id);
				file_put_contents("uploads/pdf/$filename", $response);
			}else{
				//echo $data_modificacao_pdf." = ".$unidade_modificacao->updated_at;
			}
		}
		else{
			$response = $empreendimento->geraPdfMapa($empreendimento->getUrlMapa(), $id);
			file_put_contents("uploads/pdf/$filename", $response);
		}

		return response()->file("uploads/pdf/".$filename);
	}

    private function itensLazer($empreendimento)
    {
        $itens = Caracteristica::where('tipo', 'Lazer')->get()->toArray();
        return array_map(function ($item) use ($empreendimento) {

            $existe = $empreendimento->itensLazer->where('id', $item['id'])->toArray();

            if ($existe) {
                $item['selected'] = 'true';
            } else {
                $item['selected'] = 'false';
            }

            return $item;
        }, $itens);
    }

	private function tour360($empreendimento)
    {
        return TourVirtual::where('empreendimento_id', $empreendimento->id)->get();

    }

    private function caracteristicasEmpreendimento($empreendimento)
    {
        $itens = Caracteristica::where('tipo', 'Empreendimento')
            ->where('exibir', 'Sim')
            ->get()
            ->toArray();

        return array_map(function ($item) use ($empreendimento) {
            $existe = $empreendimento->caracteristicas->where('id', $item['id'])->toArray();

            if ($existe) {
                $item['selected'] = 'true';
            } else {
                $item['selected'] = 'false';
            }

            return $item;
        }, $itens);
    }

	public function salvarDadosEmpreendimento(EmpreendimentoRequest $request)
	{
		$id = $request->id;

		$construtora_id = Auth::user()->construtora_id;

	    $resultado = (new Empreendimento())->salvarDadosEmpreendimento($request, $id, $construtora_id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function salvarMidiasEmpreendimento(Request $request)
	{
		$id = $request->id;
	    $resultado = (new Empreendimento())->salvarMidiasEmpreendimento($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function salvarHonorariosIntermediacao(Request $request)
	{
		$id = $request->id;
	    $resultado = (new Empreendimento())->salvarHonorariosIntermediacao($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function salvarCanaisEmpreendimento(Request $request)
	{
		$id = $request->id;
	    $resultado = (new Empreendimento())->salvarCanaisEmpreendimento($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function salvarArquivosEmpreendimento(Request $request)
	{
		$id = $request->id;
	    $resultado = (new EmpreendimentoArquivos())->salvarArquivosEmpreendimento($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function salvarEnderecoEmpreendimento(EmpreendimentoEnderecoRequest $request)
	{
		$id = $request->id;

		if (!$id) {
			return response()->json([
				'sucesso' => 'false',
				'mensagem' => 'Primeiramente, cadastre os dados do empreendimento'
			]);
		}

	    $resultado = (new Empreendimento())->salvarEnderecoEmpreendimento($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $id
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function salvarEnderecoStand(EmpreendimentoEnderecoRequest $request)
	{
		$id = $request->id;

		if (!$id) {
			return response()->json([
				'sucesso' => 'false',
				'mensagem' => 'Primeiramente, cadastre os dados do empreendimento'
			]);
		}

	    $resultado = (new Empreendimento())->salvarEnderecoStand($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $id
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function salvarItensLazerEmpreendimento(Request $request)
	{
		$id = $request->id;

		if (!$id) {
			return response()->json([
				'sucesso' => 'false',
				'mensagem' => 'Primeiramente, cadastre os dados do empreendimento'
			]);
		}

	    $resultado = (new Empreendimento())->salvarItensLazerEmpreendimento($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $id
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function salvarCaracteristicasEmpreendimento(Request $request)
	{
		$id = $request->id;

		if (!$id) {
			return response()->json([
				'sucesso' => 'false',
				'mensagem' => 'Primeiramente, cadastre os dados do empreendimento'
			]);
		}

	    $resultado = (new Empreendimento())->salvarCaracteristicasEmpreendimento($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $id
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function gerarTorresUnidades(GerarTorresUnidadesRequest $request)
	{
		$empreendimento = Empreendimento::find($request->empreendimento_id);

		if ($empreendimento && $empreendimento->gerou_unidades == 'Sim') {
			return response()->json([
				'sucesso' => 'false',
				'mensagem' => 'As unidades desse empreendimento já foram geradas, esse procedimento só pode ser feito uma vez para não gerar inconsistência nos dados'
			]);
		}

		$construtora_id = Auth::user()->construtora_id;

	    $resultado = (new Torre())->gerarTorresUnidades(
			$request->torres,
			$request->andares,
			$request->unidades_andar,
			$request->nomenclatura_unidades,
			$request->empreendimento_id,
			$construtora_id,
			$request->unidades_terreo,
			$request->cobertura,
			$request
		);

	    if ($resultado) {
	    	$empreendimento->gerou_unidades = 'Sim';
	    	$empreendimento->save();

	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Torres e unidades geradas com sucesso',
	        	'id' => $request->empreendimento_id
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao gerar torres e unidades'
	        ]);
	    }
	}

	public function gerarQuadrasUnidades(GerarQuadrasUnidadesRequest $request)
	{
		$empreendimento = Empreendimento::find($request->empreendimento_id);

		if ($empreendimento && $empreendimento->gerou_unidades == 'Sim') {
			return response()->json([
				'sucesso' => 'false',
				'mensagem' => 'As unidades desse empreendimento já foram geradas, esse procedimento só pode ser feito uma vez para não gerar inconsistência nos dados'
			]);
		}

		$construtora_id = Auth::user()->construtora_id;

	    $resultado = (new Quadra())->gerarQuadrasUnidades($request->quadras, $request->unidades_quadra, $request->nomenclatura, $request->empreendimento_id, $construtora_id);

	    if ($resultado) {
	    	$empreendimento->gerou_unidades = 'Sim';
	    	$empreendimento->save();

	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Quadras e unidades geradas com sucesso',
	        	'id' => $request->empreendimento_id
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao gerar quadras e unidades'
	        ]);
	    }
	}

	public function indexFotosEmpreendimento($id)
	{
		$empreendimento = Empreendimento::find($id);
		$this->data['entry'] = $empreendimento;
		$this->data['fotos'] = $empreendimento->fotos->where('planta_id', null);
		return view('admin.empreendimentos.desktop.empreendimento.foto.index', $this->data);
	}

	public function salvarFotosEmpreendimento(Request $request)
	{
		$id = $request->id;

		if (!$id) {
			return response()->json([
				'sucesso' => 'false',
				'mensagem' => 'Primeiramente, cadastre os dados do empreendimento'
			]);
		}

		$construtora_id = Auth::user()->construtora_id;

	    $resultado = (new Foto())->salvarFotosEmpreendimento($request, $id, $construtora_id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Fotos cadastradas com sucesso',
	        	'id' => $id
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function alterarFoto($id)
	{
		$foto = Foto::find($id);
		$this->data['entry'] = $foto;

		return view('admin.empreendimentos.desktop.empreendimento.foto.editar', $this->data);
	}

	public function atualizarFoto(Request $request, $id)
	{
		$construtora_id = Auth::user()->construtora_id;

	    $resultado = (new Foto())->atualizar($request, $id, $construtora_id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Fotos atualizada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function excluirFoto(Request $request)
	{
	    $resultado = (new Foto())->excluir($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Fotos excluídas com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function destacarFotoPrincipal(Request $request)
	{
	    $resultado = (new Foto())->destacarFotoPrincipal($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Foto destacada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Já existe uma foto principal para este empreendimento'
	        ]);
	    }
	}

	public function removerDestaquePrincipal(Request $request)
	{
	    $resultado = (new Foto())->removerDestaquePrincipal($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Destaque removido com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function destacarFotoCarrossel(Request $request)
	{
	    $resultado = (new Foto())->destacarFotoCarrossel($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Foto destacada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function removerDestaqueCarrossel(Request $request)
	{
	    $resultado = (new Foto())->removerDestaqueCarrossel($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Destaque removido com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function indexPlantas($id)
	{
		$empreendimento = Empreendimento::find($id);
		$plantas = $empreendimento->plantas;
		$this->data['entry'] = $empreendimento;
		$this->data['plantas'] = $plantas;
		return view('admin.empreendimentos.desktop.empreendimento.planta.index', $this->data);
	}

	public function cadastrarPlanta($id)
	{
		$empreendimento = Empreendimento::find($id);
		$this->data['entry'] = $empreendimento;
		$this->data['caracteristicas'] = (new Planta())->caracteristicasPlanta();

		return view('admin.empreendimentos.desktop.empreendimento.planta.form', $this->data);
	}

	public function salvarPlanta(PlantaRequest $request)
	{
		$id = $request->id;

		$construtora_id = Auth::user()->construtora_id;

	    $resultado = (new Planta())->salvarPlanta($request, $id, $construtora_id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function alterarPlanta($id)
	{
		$planta = Planta::find($id);
		$this->data['entry'] = $planta->empreendimento;
		$this->data['planta'] = $planta;
		$this->data['caracteristicas'] = (new Planta())->caracteristicasPlanta($planta);

		return view('admin.empreendimentos.desktop.empreendimento.planta.form', $this->data);
	}

	public function atualizarPlanta(PlantaRequest $request)
	{
		$id = $request->id;

		$construtora_id = Auth::user()->construtora_id;

		$resultado = (new Planta())->salvarPlanta($request, $id, $construtora_id);

		if ($resultado) {
		    return response()->json([
		    	'sucesso' => 'true',
		    	'mensagem' => 'Planta atualizada com sucesso',
		    	'id' => $resultado
		    ]);
		} else {
		    return response()->json([
		    	'sucesso' => 'false',
		    	'mensagem' => 'Erro ao atualizar dados'
		    ]);
		}
	}

	public function excluirPlanta(Request $request)
	{
	    $resultado = (new Planta())->excluir($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Planta excluída com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function indexTorres($id)
	{
		$empreendimento = Empreendimento::find($id);
		$torres = $empreendimento->torres;
		$this->data['entry'] = $empreendimento;
		$this->data['torres'] = $torres;
		return view('admin.empreendimentos.desktop.empreendimento.torre.index', $this->data);
	}

	public function cadastrarTorre($id)
	{
		$empreendimento = Empreendimento::find($id);
		$this->data['entry'] = $empreendimento;

		return view('admin.empreendimentos.desktop.empreendimento.torre.form', $this->data);
	}

	public function salvarTorre(TorreRequest $request)
	{
		$construtora_id = Auth::user()->construtora_id;

	    $resultado = (new Torre())->salvarTorre($request, null, $construtora_id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Torre cadastrada com sucesso',
	        	'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao cadastrar torre'
	        ]);
	    }
	}

	public function alterarTorre($id)
	{
		$torre = Torre::find($id);
		$this->data['entry'] = $torre->empreendimento;
		$this->data['torre'] = $torre;

		return view('admin.empreendimentos.desktop.empreendimento.torre.form', $this->data);
	}

	public function atualizarTorre(TorreRequest $request)
	{
		$id = $request->id;

		$construtora_id = Auth::user()->construtora_id;

		$resultado = (new Torre())->salvarTorre($request, $id, $construtora_id);

		if ($resultado) {
		    return response()->json([
		    	'sucesso' => 'true',
		    	'mensagem' => 'Torre atualizada com sucesso',
		    	'id' => $resultado
		    ]);
		} else {
		    return response()->json([
		    	'sucesso' => 'false',
		    	'mensagem' => 'Erro ao atualizar dados da torre'
		    ]);
		}
	}

	public function excluirTorre(Request $request)
	{
	    $resultado = (new Torre())->excluir($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Torre excluída com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao excluir torre'
	        ]);
	    }
	}

	public function excluirTorresUnidades(Request $request)
	{
	    $resultado = (new Torre())->excluirTorresUnidades($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Quadras e unidades excluídas com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao excluir quadra'
	        ]);
	    }
	}

	public function indexQuadras($id)
	{
		$empreendimento = Empreendimento::find($id);
		$quadras = $empreendimento->quadras;
		$this->data['entry'] = $empreendimento;
		$this->data['quadras'] = $quadras;
		return view('admin.empreendimentos.desktop.empreendimento.quadra.index', $this->data);
	}

	public function cadastrarQuadra($id)
	{
		$empreendimento = Empreendimento::find($id);
		$this->data['entry'] = $empreendimento;

		return view('admin.empreendimentos.desktop.empreendimento.quadra.form', $this->data);
	}

	public function salvarQuadra(QuadraRequest $request)
	{
		$id = $request->id;

		$construtora_id = Auth::user()->construtora_id;

	    $resultado = (new Quadra())->salvarQuadra($request, $id, $construtora_id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Quadra cadastrada com sucesso',
	        	'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao cadastrar quadra'
	        ]);
	    }
	}

	public function alterarQuadra($id)
	{
		$quadra = Quadra::find($id);
		$this->data['entry'] = $quadra->empreendimento;
		$this->data['quadra'] = $quadra;

		return view('admin.empreendimentos.desktop.empreendimento.quadra.form', $this->data);
	}

	public function atualizarQuadra(QuadraRequest $request)
	{
		$id = $request->id;

		$construtora_id = Auth::user()->construtora_id;

		$resultado = (new Quadra())->salvarQuadra($request, $id, $construtora_id);

		if ($resultado) {
		    return response()->json([
		    	'sucesso' => 'true',
		    	'mensagem' => 'Quadra atualizada com sucesso',
		    	'id' => $resultado
		    ]);
		} else {
		    return response()->json([
		    	'sucesso' => 'false',
		    	'mensagem' => 'Erro ao atualizar dados da quadra'
		    ]);
		}
	}

	public function excluirQuadra(Request $request)
	{
	    $resultado = (new Quadra())->excluir($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Quadra excluída com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao excluir quadra'
	        ]);
	    }
	}

	public function excluirQuadrasUnidades(Request $request)
	{
	    $resultado = (new Quadra())->excluirQuadrasUnidades($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Quadras e unidades excluídas com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao excluir quadra'
	        ]);
	    }
	}

	public function indexUnidades($id)
	{
		$empreendimento = Empreendimento::find($id);

		$this->data['torre_selecionada'] = RequestFacade::input('torre', null);
		$this->data['quadra_selecionada'] = RequestFacade::input('quadra', null);
		$this->data['entry'] = $empreendimento;
		return view('admin.empreendimentos.desktop.empreendimento.unidade.index', $this->data);
	}

	public function alterarUnidade(Request $request, $id)
	{
		$unidade = Unidade::find($id);
		$plantas = $unidade->empreendimento->plantas;

		$this->data['situacao'] = $request->situacao;
		$this->data['plantas'] = $plantas;
		$this->data['entry'] = $unidade;

		return view('admin.empreendimentos.desktop.empreendimento.unidade.editar', $this->data);
	}

	public function atualizarUnidade(Request $request, $id)
	{
	    $resultado = (new Unidade())->atualizar($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Unidade atualizada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function alterarVendaUnidade(Request $request, $id)
	{
		$unidade = Unidade::find($id);
		$plantas = $unidade->empreendimento->plantas;

		$this->data['situacao'] = $request->situacao;
		$this->data['plantas'] = $plantas;
		$this->data['entry'] = $unidade;

		return view('admin.empreendimentos.desktop.empreendimento.unidade.editar_venda', $this->data);
	}

	public function atualizarVendaUnidade(Request $request, $id)
	{
	    $resultado = (new Unidade())->atualizarVendaUnidade($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Venda da unidade atualizada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function alterarReservaUnidade(Request $request, $id)
	{
		$unidade = Unidade::find($id);
		$plantas = $unidade->empreendimento->plantas;

		$this->data['situacao'] = $request->situacao;
		$this->data['plantas'] = $plantas;
		$this->data['entry'] = $unidade;

		return view('admin.empreendimentos.desktop.empreendimento.unidade.editar_reserva', $this->data);
	}

	public function atualizarReservaUnidade(Request $request, $id)
	{
	    $resultado = (new Unidade())->atualizarReservaUnidade($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Venda da unidade atualizada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function atualizarSituacaoUnidade(Request $request, $id)
	{
	    $resultado = (new Unidade())->atualizarSituacao($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Unidade atualizada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
		}

	}

	public function filtrarUnidades(Request $request)
	{
		$unidades = Unidade::query();

		DB::enableQueryLog();

		$empreendimento = Empreendimento::find($request->empreendimento_id);

		$unidades->where('empreendimento_id', $empreendimento->id);
		$unidades->where('construtora_id', $empreendimento->construtora->id);

		$unidades->when($request->torre_id, function ($q) use ($request) {
			if ($request->torre_id && $request->torre_id != 'Todas') {
				$q->where('torre_id', $request->torre_id);
			}
        });

		$unidades->when($request->andar_id, function ($q) use ($request) {
			if ($request->andar_id && $request->andar_id != 'Todas') {
				$andares = Andar::where('numero', $request->andar_id)->pluck('id')->toArray();
				$q->whereIn('andar_id', $andares);
			}
        });

		$unidades->when($request->planta_id, function ($q) use ($request) {
			if ($request->planta_id && $request->planta_id != 'Todas') {
				$q->where('planta_id', $request->planta_id);
			}
        });

		$unidades->when($request->situacao, function ($q) use ($request) {
			if ($request->situacao && $request->situacao != 'Todas') {
				$q->where('situacao', $request->situacao);
			}
        });

		$unidades->when($request->quadra_id, function ($q) use ($request) {
			if ($request->quadra_id && $request->quadra_id != 'Todas') {
				$q->where('quadra_id', $request->quadra_id);
			}
		});

		$this->data['unidades'] = $unidades->get();

		return view('admin.empreendimentos.desktop.empreendimento.unidade.filtrar', $this->data);
	}

	public function atualizarCoordenadasUnidade(Request $request)
	{
	    $resultado = (new Unidade())->atualizarCoordenadas($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Coordenadas da unidade atualizada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar coordenadas da unidade'
	        ]);
	    }
	}

	public function atualizarCoordenadasVaga(Request $request)
	{
	    $resultado = (new Garagem())->atualizarCoordenadas($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Coordenadas da vaga atualizada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar coordenadas da vaga'
	        ]);
	    }
	}

	public function atualizarCoordenadasFoto(Request $request)
	{

		$resultado = (new Foto())->atualizarCoordenadas($request);

		var_dump($resultado);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Coordenadas da foto atualizada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar coordenadas da foto'
	        ]);
	    }
	}

	public function salvarSeo(Request $request)
	{
		$id = $request->id;

		if (!$id) {
			return response()->json([
				'sucesso' => 'false',
				'mensagem' => 'Primeiramente, cadastre os dados do empreendimento'
			]);
		}

	    $resultado = (new Seo())->salvarSeo($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $id
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function salvarTour(Request $request)
	{
		$id = $request->id;

		if (!$id) {
			return response()->json([
				'sucesso' => 'false',
				'mensagem' => 'Primeiramente, cadastre os dados do empreendimento'
			]);
		}

		//Deleta registros
		TourVirtual::where('empreendimento_id', $id)->delete();

		$links = $request->link_tour;
        $count = count($links);

        for ($i = 0; $i < $count; $i++) {
			if(isset($request->link_tour[$i])){
				$tour = new TourVirtual();
				$tour->link = $request->link_tour[$i];
				$tour->titulo = $request->titulo_tour[$i];
				$tour->empreendimento_id = $id;
				$tour->save();
			}

        }

	    if ($tour) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados',
	        	'id' => $id
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}


	public function buscarCep(Request $request)
	{
		$cep = $request->cep;

		if ($cep && !validar_cep($cep)) {
			return response()->json([
				'sucesso' => 'false',
				'retorno' => 'Cep não encontrado'
			]);
		}

		$service = new Cep();

		$response = $service->busca($cep)->getContent();

        //dd($response);

		$json = json_decode($response);

		if (!isset($json[0])) {
			return response()->json([
				'sucesso' => 'false'
			]);
		}

		$json = $json[0];

		if (isset($json->erro)) {
			return response()->json([
				'sucesso' => 'false'
			]);
		}

		$estado = Estado::where('uf', $json->uf)->where('status', 'L')->first();

		if (!$estado) {
			$estado = (new Endereco())->getEstado(null, $json->uf);
		}

		$cidade = Cidade::where('nome', $json->localidade)->where('estado_id', $estado->id)->first();

		if (!$cidade) {
			$cidade = (new Endereco())->getCidade(null, $json->localidade, $estado->id);
		}

		$bairro = Bairro::where('nome', $json->bairro)->where('cidade_id', $cidade->id)->first();

		if (!$bairro) {
			$bairro = (new Endereco())->getBairro(null, $json->bairro, $cidade->id);
		}

		$cidades = $estado->cidades;
		$bairros = $cidade->bairros;
		$estados = Estado::where('status', 'L')->get();
		$cidades_html = (new CidadeController())->getCidadesHtml($cidades);
		$bairros_html = (new CidadeController())->getBairrosHtml($bairros);
		$bairros_comerciais_html = (new CidadeController())->getBairrosHtml($bairros, true);
		$estados_html = (new CidadeController())->getEstadosHtml($estados);

		$latLong = (new Empreendimento())->getLatitudeLongitude([
			'logradouro' => $json->logradouro,
			'complemento' => $json->complemento,
			'numero' => null,
			'bairro' => $bairro,
			'cidade' => $cidade
		]);

		return response()->json([
			'sucesso' => 'true',
			'logradouro' => $json->logradouro,
			'complemento' => $json->complemento,
			'estado_id' => $estado->id,
			'cidade_id' => $cidade->id,
			'bairro_id' => $bairro->id,
			'cidades_html' => $cidades_html,
			'bairros_html' => $bairros_html,
			'bairros_comerciais_html' => $bairros_comerciais_html,
			'estados_html' => $estados_html,
			'json' => $json,
			'latitude' => $latLong['latitude'],
			'longitude' => $latLong['longitude']
		]);
	}

	public function indexPavimentos($id)
	{
		$empreendimento = Empreendimento::find($id);
		$this->data['entry'] = $empreendimento;
		$this->data['pavimentos'] = $empreendimento->pavimentos;
		return view('admin.empreendimentos.desktop.empreendimento.pavimento.index', $this->data);
	}

	public function cadastrarPavimento($id)
	{
		$empreendimento = Empreendimento::find($id);
		$this->data['entry'] = $empreendimento;

		return view('admin.empreendimentos.desktop.empreendimento.pavimento.adicionar', $this->data);
	}

	public function salvarPavimento(PavimentoGaragemRequest $request)
	{
		$construtora_id = Auth::user()->construtora_id;

	    $resultado = (new PavimentoGaragem())->salvarPavimento($request, null, $construtora_id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Pavimento cadastrado com sucesso',
	        	'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao cadastrar torre'
	        ]);
	    }
	}

	public function alterarPavimento($id)
	{
		$pavimento = PavimentoGaragem::find($id);
		$this->data['entry'] = $pavimento->empreendimento;
		$this->data['pavimento'] = $pavimento;

		return view('admin.empreendimentos.desktop.empreendimento.pavimento.form', $this->data);
	}

	public function atualizarPavimento(PavimentoGaragemRequest $request)
	{
		$id = $request->id;

		$construtora_id = Auth::user()->construtora_id;

		$resultado = (new PavimentoGaragem())->salvarPavimento($request, $id, $construtora_id);

		if ($resultado) {
		    return response()->json([
		    	'sucesso' => 'true',
		    	'mensagem' => 'Pavimento atualizado com sucesso',
		    	'id' => $resultado
		    ]);
		} else {
		    return response()->json([
		    	'sucesso' => 'false',
		    	'mensagem' => 'Erro ao atualizar dados do pavimento'
		    ]);
		}
	}

	public function excluirPavimento(Request $request)
	{
	    $resultado = (new PavimentoGaragem())->excluir($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Pavimento excluído com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao excluir torre'
	        ]);
	    }
	}

	public function indexGaragens($id)
	{
		$empreendimento = Empreendimento::find($id);

		$this->data['pavimento_selecionado'] = RequestFacade::input('pavimento', null);
		$this->data['entry'] = $empreendimento;
		return view('admin.empreendimentos.desktop.empreendimento.garagem.index', $this->data);
	}

	public function alterarGaragem(Request $request, $id)
	{
		$garagem = Garagem::find($id);

		$this->data['situacao'] = $request->situacao;
		$this->data['entry'] = $garagem;

		return view('admin.empreendimentos.desktop.empreendimento.garagem.editar', $this->data);
	}

	public function atualizarGaragem(Request $request, $id)
	{
	    $resultado = (new Garagem())->atualizar($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Garagem atualizada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function alterarVendaGaragem(Request $request, $id)
	{
		$garagem = Garagem::find($id);

		$this->data['situacao'] = $request->situacao;
		$this->data['entry'] = $garagem;

		return view('admin.empreendimentos.desktop.empreendimento.garagem.editar_venda', $this->data);
	}

	public function atualizarVendaGaragem(Request $request, $id)
	{
	    $resultado = (new Garagem())->atualizarVendaGaragem($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Venda da garagem atualizada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function atualizarSituacaoGaragem(Request $request, $id)
	{
	    $resultado = (new Garagem())->atualizar($request, $id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Garagem atualizada com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function filtrarGaragens(Request $request)
	{
		$resultado = (new Garagem())->filtrarGaragens($request);

		$this->data['garagens'] = $resultado;
		$this->data['pavimento_selecionado'] = null;

		return view('admin.empreendimentos.desktop.empreendimento.garagem.filtrar', $this->data);
	}

	public function alteracoesEmLote(Request $request)
	{
		$parametros = $request->all();

		$parametros['user_id'] = Auth::user()->id;

	    $resultado = (new Unidade())->alteracoesEmLote($parametros);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Alterações em lote realizadas com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro, tente novamente mais tarde'
	        ]);
	    }
	}

	public function historicoUnidades($id)
	{
		$empreendimento = Empreendimento::find($id);
		$usuario = Auth::user();

		$this->data['entry'] = $empreendimento;
		$this->data['historico'] = $empreendimento->historicoUnidades;

		return view('admin.empreendimentos.desktop.empreendimento.unidade.historico_unidade', $this->data);
	}

	public function imprimirDisponibilidade($id)
	{
		$empreendimento = Empreendimento::find($id);
		$usuario = Auth::user();

		$this->data['empreendimento'] = $empreendimento;

		if($empreendimento->tipo == "Horizontal"):
			$this->data['unidades'] = $empreendimento->getUnidadesDisponiveisQuadra();
		endif;

		if($empreendimento->tipo == "Vertical"):
			$this->data['unidades'] = $empreendimento->getUnidadesDisponiveisTorre();
		endif;


		return view('admin.empreendimentos.desktop.empreendimento.unidade.imprimir_disponibilidade', $this->data);
	}

	public function gerarPdfDisponibilidade($id)
	{
		$empreendimento = Empreendimento::find($id);
		$response = (new Pdf())->gerarPDFUnidade($empreendimento->getUrlDisponibilidade());
		$data = date('Ymd');
		$filename = "Disponibilidade_{$empreendimento->nome}_{$data}.pdf";

        file_put_contents("uploads/pdf/$filename", $response);

		return response()->file("uploads/pdf/".$filename);
	}
}

<?php

namespace App\Http\Controllers\Admin;

use Alert;
use Auth;
use App\Http\Requests\PerfilRequest;
use App\Http\Requests\PerfilRedeSocialRequest;
use App\Http\Requests\PerfilConstrutoraRequest;
use App\Http\Requests\PerfilEnderecoConstrutoraRequest;
use App\Http\Requests\PerfilCanalAtendimentoRequest;
use App\Http\Requests\MembroRequest;
use App\Http\Requests\MembroUpdateRequest;
use App\Models\BackpackUser;
use App\Models\Construtora;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Bairro;
use App\Models\Role;
use App\Models\Assinatura;
use Illuminate\Http\Request;

class PerfilConstrutoraController
{
	public function index()
	{
	    $bairros = null;
	    $cidades = null;
	    $construtora = null;
	    $telefones = null;
	    $assinatura = null;
	    $equipe = [];
	    $endereco = null;
	    $perfil = [];
	    $percentual = 0;
	    $usuario = Auth::user();
	    //$this->loginDomus();

	    if ($usuario->construtora) {
	    	$construtora = $usuario->construtora;
	    	$endereco = $construtora->endereco;

	    	if ($endereco && $endereco->cidade_id) {
	    		$cidade = Cidade::find($endereco->cidade_id);
	    		$cidades = Estado::find($cidade->estado_id)->cidades;
	    		$bairros = $cidade->bairros;
	    	}

	    	$telefones = $construtora->telefones->toArray();
	    	$assinatura = $construtora->assinatura->first();
	    	$equipe = $this->setCargo($construtora->usuarios->toArray());
    		$perfil = $construtora->perfil->toArray();
	    }

		if(Auth::user()->getRoleNames() == '["Corretor"]'){
			$view = 'view';
		}else{
			$view = 'edit';
		}

	    $estados = Estado::where('status', 'L')->get();

	    return view('admin.perfil_construtora.desktop.index', [
	    	'construtora' => $construtora,
	    	'endereco' => $endereco,
	    	'estados' => $estados,
	    	'telefones' => $telefones,
	    	'assinatura' => $assinatura,
	    	'equipe' => $equipe,
	    	'cidades' => $cidades,
	    	'bairros' => $bairros,
	    	'estados' => $estados,
	    	'perfil' => $perfil,
			'view' => $view
	    ]);
	}

	public function setCargo($equipe)
	{
		$equipe = array_filter($equipe, function ($integrante) {
			$user = BackpackUser::find($integrante['id']);

			foreach ($user->roles as $role) {
				if ($role['name'] != 'Administrador') {
					return $integrante;
				}
			}
		});

		foreach ($equipe as $key => $integrante) {
			$user = BackpackUser::find($integrante['id']);
			foreach ($user->getRoleNames() as $cargo) {
				$equipe[$key]['cargo'] = $cargo;
			}
		}

		return $equipe;
	}

	public function salvarPerfilUsuario(PerfilRequest $request)
	{
		$id = Auth::user()->id;

	    $user = (new BackpackUser())->salvarPerfil($request, $id);

	    if ($user) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	public function salvarConstrutora(PerfilConstrutoraRequest $request)
	{
		$id = Auth::user()->construtora->id;

	    $resultado = (new Construtora())->salvarPerfilConstrutora($request, $id);

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

	public function salvarEnderecoConstrutora(PerfilEnderecoConstrutoraRequest $request)
	{
		$id = Auth::user()->construtora->id;

	    $resultado = (new Construtora())->salvarEnderecoConstrutora($request, $id);

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

	public function salvarCanaisAtendimento(PerfilCanalAtendimentoRequest $request)
	{
		$id = Auth::user()->construtora->id;

	    $resultado = (new Construtora())->salvarCanaisAtendimento($request, $id);

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

	public function salvarRedesSociais(PerfilRedeSocialRequest $request)
	{
		$id = Auth::user()->construtora->id;

	    $resultado = (new Construtora())->salvarPerfilRedesSociais($request, $id);

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

	public function novoMembro(Request $request, $id)
	{
	    $this->data['entry'] = null;
	    $this->data['grupos'] = Role::where('name', '<>', 'Administrador')->get();
	    $this->data['rota'] = route('novo-membro', $id);

		return view('admin.perfil_construtora.desktop.membro', $this->data);
	}

	public function cadastrarMembro(MembroRequest $request, $id)
	{
	    $resultado = (new BackpackUser())->salvarDadosMembro($request, $id);

	    if ($resultado) {
	        return response()->json([
	            'sucesso' => 'true',
	            'mensagem' => 'Novo membro cadastrado com sucesso',
	            'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	            'sucesso' => 'false',
	            'mensagem' => 'Erro ao cadastrar novo membro'
	        ]);
	    }
	}

	public function alterarMembro(Request $request, $id)
	{
	    $this->data['entry'] = BackpackUser::find($id);
	    $this->data['grupos'] = Role::all();
	    $this->data['rota'] = route('atualizar-membro', $id);

		return view('admin.perfil_construtora.desktop.membro', $this->data);
	}

	public function atualizarMembro(MembroUpdateRequest $request)
	{
		//$this->handlePasswordInput($request);

	    $resultado = (new BackpackUser())->salvarDadosMembro($request, $request->construtora_id);

	    if ($resultado) {
	        return response()->json([
	            'sucesso' => 'true',
	            'mensagem' => 'Membro atualizado com sucesso',
	            'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	            'sucesso' => 'false',
	            'mensagem' => 'Erro ao atualizar membro'
	        ]);
	    }
	}

	protected function handlePasswordInput($request)
	{
	    // Remove fields not present on the user.
	    $request->request->remove('password_confirmation');

	    // Encrypt password if specified.
	    if ($request->input('password')) {
	        $request->request->set('password', bcrypt($request->input('password')));
	    } else {
	        $request->request->remove('password');
	    }
	}

	public function excluirMembro($id)
	{
	    $resultado = (new BackpackUser())->excluirMembro($id);

	    if ($resultado) {
	        return response()->json([
	            'sucesso' => 'true',
	            'mensagem' => 'Membro excluído com sucesso',
	            'id' => $resultado
	        ]);
	    } else {
	        return response()->json([
	            'sucesso' => 'false',
	            'mensagem' => 'Erro ao excluir membro'
	        ]);
	    }
	}

	public function planos(Request $request)
	{
	    $this->data['assinaturas'] = Assinatura::all();
	    $this->data['construtora_id'] = Auth::user()->construtora_id;

		return view('admin.perfil_construtora.desktop.planos', $this->data);
	}

	public function atualizarPlano(Request $request, $id)
	{
		$usuario_id = Auth::user()->id;
		$construtora_id = $id;

	    $resultado = (new Construtora())->atualizarPlano($request, $construtora_id, $usuario_id);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Dados atualizados'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }
	}

	// public function loginDomus()
	// {
	// 	$user = Auth::user();

 //        if ($user->construtora_id) {
 //            $construtora = Construtora::find($user->construtora_id);

 //            if ($construtora->acesso_domus == 'Sim') {
 //                $dados = [
 //                    'email' => $request->email,
 //                    'senha_usuario' => $request->password,
 //                ];


 //                $client = new Client([
 //                    'request.options' => [
 //                       'timeout' => 6,
 //                       'connect_timeout' => 6
 //                    ]
 //                ]);

 //                $client->post('https://sistema.domuslog.com.br/login2.php', [
 //                    'form_params' => $dados,

 //                ]);

 //                return $next($request);
 //            }
 //        }
	// }
}

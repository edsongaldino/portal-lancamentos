<?php

namespace App\Http\Controllers\Admin;

use Backpack\Base\app\Http\Controllers\Auth\MyAccountController;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PerfilRequest;
use App\Models\BackpackUser;

class PerfilUsuarioController extends MyAccountController
{
	public function index()
	{
		$perfil = Auth::user()->perfil->toArray();

	    return view('admin.perfil_usuario.desktop.index', compact('perfil'));
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
}

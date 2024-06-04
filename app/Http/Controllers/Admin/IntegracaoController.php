<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\BackpackUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\PerfilConstrutoraController;
use App\Http\Controllers\Admin\PerfilUsuarioController;
use App\Traits\ConstrutoraTrait;
use App\Models\Construtora;
use App\Models\User;
use App\Models\Usuario;


class IntegracaoController extends Controller
{
    use ConstrutoraTrait;

    public function domus(Request $request){

        $equipe = [];
        $construtora = $this->getConstrutora();
    	$equipe = (new PerfilConstrutoraController())->setCargo($construtora->usuarios->toArray());
        
        return view('admin.integracao.desktop.domus', compact('construtora','equipe'));

    }

    public function facilita(Request $request){
	    return view('admin.integracao.desktop.facilita');
    }

    public function anapro(Request $request){
	    return view('admin.integracao.desktop.anapro');
    }

    public function atualizarIntegracaoDomus(Request $request){

        $resultado = (new Construtora())->atualizaIntegracao($request);

	    if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Integração removida com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }	 

    }

    public function integrarUsuarioDomus(Request $request){

	    $user = (new BackpackUser())->salvarPerfilDomus($request);

	    if ($user) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Integração removida com sucesso'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
        }	

    }
 
}

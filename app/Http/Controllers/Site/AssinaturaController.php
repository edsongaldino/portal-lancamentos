<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackpackUser;
use App\Models\Construtora;
use App\Models\Estado;
use App\Http\Requests\CadastrarAssinanteRequest;
use \DB;

class AssinaturaController extends Controller
{
    public function index()
    {
        $this->data['estados'] = Estado::all();

        return view('site.seja_membro.index', $this->data);
    }

    public function assinar(CadastrarAssinanteRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = (new BackpackUser())->cadastrarUsuarioAssinante($request->name, $request->email, $request->password);

            $construtora = (new Construtora())->cadastrarConstrutora($request->construtora, $request->cnpj);

            $construtora->cadastrarEnderecoConstrutora($request);

            $user->atribuirConstrutora($construtora->id, $user);

            $user->criarRegistrosPerfis($user->id, $construtora->id);    

            $user->createAsIuguCustomer();

            $urlPagamento = $user->cadastrarAssinatura($construtora, $request->plano, $request->periodo);

            DB::commit();

            return response()->json([
                'sucesso' => 'true',
                'mensagem' => 'Dados cadastrados com sucesso',
                'url' => $urlPagamento
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Erro ao cadastrar',
                'url' => false,
                'erro' => $e->getMessage()
            ]);
        }
    }
}

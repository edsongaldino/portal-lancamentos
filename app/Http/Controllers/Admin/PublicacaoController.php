<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publicacao;
use Carbon\Carbon;

class PublicacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicacoes = Publicacao::all();
        return view('admin.publicacoes.index', compact('publicacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publicacoes.adicionar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      	
        $publicacao = new Publicacao();

        $publicacao->titulo = $request->titulo;
        $publicacao->resumo = $request->resumo;
        $publicacao->fonte = $request->fonte;
        $publicacao->data = Carbon::createFromFormat('d/m/Y', $request->data)->toDateTimeString();
        $publicacao->texto = $request->texto;
        $publicacao->status = $request->status;

        if($request->arquivo){
            $publicacao->arquivo = $request->file('arquivo')->store('publicacoes');
        }

        $resultado = $publicacao->save();

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
        $publicacao = Publicacao::find($id);
        return view('admin.publicacoes.editar', compact('publicacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $publicacao = Publicacao::findOrFail($request->id);

        $publicacao->titulo = $request->titulo;
        $publicacao->resumo = $request->resumo;
        $publicacao->fonte = $request->fonte;
        $publicacao->data = Carbon::createFromFormat('d/m/Y', $request->data)->toDateTimeString();
        $publicacao->texto = $request->texto;
        $publicacao->status = $request->status;

        if($request->arquivo){
            $publicacao->arquivo = $request->file('arquivo')->store('publicacoes');
        }

        $resultado = $publicacao->save();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publicacao = Publicacao::find($id);
        $resultado = $publicacao->delete();

        if ($resultado) {
	        return response()->json([
	        	'sucesso' => 'true',
	        	'mensagem' => 'Publicação Removida'
	        ]);
	    } else {
	        return response()->json([
	        	'sucesso' => 'false',
	        	'mensagem' => 'Erro ao atualizar dados'
	        ]);
	    }

    }
}

<?php

namespace App\Http\Controllers\Corretor;

use App\Models\Corretor\Corretor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CorretorController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->verificaDuplicidade('email', $request->email)){
            return response()->json([
                'error'=>'Erro!'
            ]);
        }

        if($this->verificaDuplicidade('cpf', limpa_campo($request->cpf))){
            return response()->json([
                'error'=>'Erro!'
            ]);
        }

        if($request->senha <> $request->confirmar_senha){
            return response()->json([
                'error'=>'Erro!'
            ]);
        }

        $Corretor = new Corretor();
        $Corretor->cpf = limpa_campo($request->cpf);
        $Corretor->nome = $request->nome;
        $Corretor->creci = $request->creci;
        $Corretor->email = $request->email;
        $Corretor->data_nascimento = data_mysql($request->data_nascimento);
        $Corretor->telefone = limpa_campo($request->telefone);
        $Corretor->password = Hash::make($request->senha);

        if($Corretor->save()){
            return response()->json([
                'success'=>'Dados Salvos!'
            ]);
        }else{
            return response()->json([
                'error'=>'Erro!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Corretor  $corretor
     * @return \Illuminate\Http\Response
     */
    public function show(Corretor $corretor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Corretor  $corretor
     * @return \Illuminate\Http\Response
     */
    public function edit(Corretor $corretor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Corretor  $corretor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $User = Corretor::findOrFail(Session::get('usuario.id'));

        if($request->email <> $User->email){
            if($this->verificaDuplicidade('email', $request->email)){
                return redirect()->back()->with('warning', 'Você não pode alterar seu cadastro para este e-mail, pois ele já consta em nosso banco de dados! Verifique.');
            }
        }

        $User->nome = $request->nome;
        $User->email = $request->email;
        $User->data_nascimento = data_mysql($request->data_nascimento);
        $User->telefone = limpa_campo($request->telefone);

        if ($request->file('imageUpload')) {
        $User->foto = $request->file('imageUpload')->store('user');
        }

        if($request->senha){
            $User->password = Hash::make($request->senha);
        }
        $User->save();

        return redirect()->route('corretor.perfil')->with('success', 'Dados atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Corretor  $corretor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corretor $corretor)
    {
        //
    }

    public function verificaDuplicidade($campo, $valor){

        $Corretor = Corretor::where($campo, $valor)->first();

        if(isset($Corretor)){
            return $Corretor;
        }else{
            return false;
        }
    }
}

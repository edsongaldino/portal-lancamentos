<?php

namespace App\Http\Controllers\Corretor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user();
        return view('perfil')->with(compact('usuario'));
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
        $User = new User();
        $User->cpf = limpa_campo($request->cpf);
        $User->name = $request->nome;
        $User->email = $request->email;
        $User->data_nascimento = data_mysql($request->data_nascimento);
        $User->whatsapp = limpa_campo($request->telefone);
        $User->password = Hash::make($request->senha);
        $User->save();

        return $User;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $User = User::findOrFail(Session::get('usuario.id'));

        if($request->email <> $User->email){
            if($this->verificaDuplicidade('email', $request->email)){
                return redirect()->back()->with('warning', 'Você não pode alterar seu cadastro para este e-mail, pois ele já consta em nosso banco de dados! Verifique.');
            }
        }

        $User->nome = $request->nome;
        $User->email = $request->email;
        $User->data_nascimento = Helper::data_mysql($request->data_nascimento);
        $User->telefone = Helper::limpa_campo($request->telefone);

        if ($request->file('imageUpload')) {
        $User->foto = $request->file('imageUpload')->store('user');
        }

        if($request->senha){
            $User->password = Hash::make($request->senha);
        }
        $User->save();

        return redirect()->route('perfil')->with('success', 'Dados atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //
    }

    public function getFoto($id)
    {
        $user = User::find($id);
        $arquivo = Storage::get($user->foto);
        return $arquivo;
    }


    public function verificaDuplicidade($campo, $valor){

        $User = User::where($campo, $valor)->first();

        if(isset($User)){
            return $User;
        }else{
            return false;
        }
    }
}

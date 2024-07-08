<?php

namespace App\Http\Controllers\Corretor;

use App\Models\Corretor\Corretor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendMailUser;
use App\Models\Empreendimento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $data = []; // the information we send to the view

    public function home(){

        if(Auth::guard("corretor")->check() === true){
            return view('corretor.home');
        }

        return redirect()->route('login')->with('warning', 'Efetue Login para acessar');
    }

    public function LembrarSenha(){

        return view('corretor.lembrar');

    }

    public function Login(Request $request){

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return redirect()->back()->with('warning', 'O e-mail não é válido!');
        }

        $credencials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::guard("corretor")->attempt($credencials)){

            $usuario = Auth::guard("corretor")->user();
            Session::put('usuario', $usuario);
            Session::put('ViewCorretor', 'Sim');

            return response()->json([
                'success'=>'Login Efetuado!'
            ]);
        }else{
            return response()->json([
                'error'=>'Dados incorretos!'
            ]);
        }
    }

    public function Logout(){
        Auth::guard("corretor")->logout();
        return redirect()->route('login')->with('success', 'Logof Efetuado');
    }

    public function ReenviarSenha(Request $request){

        $User = Corretor::where('email', $request->email)->first();

        if($User){

            //ENVIA PARA O USUÁRIO
            $data["assunto"] = "Você solicitou uma nova senha! App Corretor - Lançamentos Online";
            $data["destinatario"] = $User->email;
            $data["nome"] = $User->nome;
            $data["link"] = getenv('APP_URL').'/corretor/nova-senha/'.base64_encode($User->email);

            Mail::to($data["destinatario"])->send(new SendMailUser($data));

            return response()->json([
                'success'=>'success',
                'message'=>'Sua nova senha foi enviada no email de cadastro! Verifique a caixa de SPAM'
            ]);

        }

        return response()->json([
            'error'=>'error',
            'message'=>'Este e-mail não consta em nosso banco de dados! Confira.'
        ]);

    }

    public function FormAlterarSenha($email){
        $email = base64_decode($email);
        return view('corretor.nova-senha')->with(compact('email'));

    }

    public function AlterarSenha(Request $request){

        $user = Corretor::where('email', $request->email)->first();

        if($request->senha == $request->confirmar_senha){
            $user->password = Hash::make($request->senha);
            $user->save();
            return response()->json([
                'success'=>'success',
                'message'=>'Sua nova senha foi cadastrada com sucesso!'
            ]);
        }
        return response()->json([
            'error'=>'error',
            'message'=>'As senhas precisam ser idênticas.'
        ]);


    }
}

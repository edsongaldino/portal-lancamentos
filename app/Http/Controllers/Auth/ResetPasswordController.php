<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    protected $data = []; // the information we send to the view

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function FormAlterarSenha($email){
        $this->data['title'] = "Alterar Senha"; // set the page title
        $this->data['token'] = $email;
        $this->data['email'] = base64_decode($email);
        return view('auth.passwords.reset', $this->data);
    }

    public function reset(Request $request){

        if($request->password == $request->password_confirmation){

            $user = User::where('email', base64_decode($request->token))->first();
            if($user){
                $user->password = Hash::make($request->password);
                $user->save();
                $this->data['status'] = "Sucesso";
                $this->data['email'] = $request->email;
                $this->data['mensagem'] = "Senha alterada com sucesso. Faça login com sua nova senha!";
                return view('auth.login', $this->data);
            }else{
                $this->data['status'] = "Erro";
                $this->data['mensagem'] = "Não encontramos nenhum usuário com este e-mail!";
            }
            
        }else{  
            $this->data['status'] = "Erro";
            $this->data['mensagem'] = "Você digitou senha diferentes. Tente novamente!";
        }

        $this->data['title'] = "Alterar Senha"; // set the page title
        $this->data['token'] = $request->token;
        $this->data['email'] = $request->email;
        return view('auth.passwords.reset', $this->data);

    }
}

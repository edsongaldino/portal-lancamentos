<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Painel\SendMailPanel;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    protected $data = []; // the information we send to the view
    protected $email = []; // the information we send to the view

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request){

        $User = User::where('email', $request->email)->first();

        if($User){

            //ENVIA PARA O USUÁRIO
            $email["template"] = "email.template_senha";
            $email["assunto"] = "Você solicitou uma nova senha! App Explicaí";
            $email["destinatario"] = $User->email;
            $email["email"] = $User->email;
            $email["nome"] = $User->nome;
            $email["link"] = getenv('APP_URL').'/nova-senha/'.base64_encode($User->email);

            Mail::to($email["destinatario"])->send(new SendMailPanel($email));

            $this->data['title'] = trans('backpack::base.login'); // set the page title
            $this->data['status'] = "Sucesso";
            $this->data['mensagem'] = "Sua nova senha foi enviada no email de cadastro! Verifique a caixa de SPAM";

        }else{
            $this->data['title'] = trans('backpack::base.login'); // set the page title
            $this->data['status'] = "Erro";
            $this->data['mensagem'] = "Este e-mail não consta em nosso banco de dados! Confira.";
        }

        return view('auth.passwords.email', $this->data);
    }
}

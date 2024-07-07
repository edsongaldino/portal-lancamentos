<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailUser extends Mailable
{
    use Queueable, SerializesModels;

    public $dados;

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('corretor.layouts.email.template_senha')->from('contato@lancamentosonline.com.br', 'App Corretor - Lançamentos Online')->replyTo('contato@lancamentosonline.com.br', 'Lançamentos Online')->subject('Redefinição de Senha. App Corretor (Lançamentos Online!');
    }
}

<?php

namespace App\Mail\Empreendimento\Proposta;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Administrador extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $proposta;
    public $assunto;

    public function __construct($proposta, $assunto)
    {
        $this->proposta = $proposta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contato@lancamentosonline.com.br', 'Lançamentos Online')
            ->subject('CÓPIA - Proposta Lançamentos Online')
            ->view('emails.empreendimento.proposta');
    }
}

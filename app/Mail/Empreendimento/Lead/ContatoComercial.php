<?php

namespace App\Mail\Empreendimento\Lead;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContatoComercial extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $lead;
    
    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contato@lancamentosonline.com.br', 'Portal Lançamentos Online')
            ->subject("Novo contato comercial recebido!")
            ->view('emails.comercial.contato');
    }
}

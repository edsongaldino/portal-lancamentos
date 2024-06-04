<?php

namespace App\Mail\Safe2Pay;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Cobranca extends Mailable
{
    use Queueable, SerializesModels;

    private $meses = [
        '01' => 'Janeiro',
        '02' => 'Fevereiro',
        '03' => 'Março',
        '04' => 'Abril',
        '05' => 'Maio',
        '06' => 'Junho',
        '07' => 'Julho',
        '08' => 'Agosto',
        '09' => 'Setembro',
        '10' => 'Outubro',
        '11' =>'Novembro',
        '12' => 'Dezembro'
    ];

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $lancamento;

    public function __construct($lancamento)
    {
        $this->lancamento = $lancamento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $nome_construtora = $this->lancamento->construtora->getConstrutoraNome();        
        $vencimento = new \DateTime($this->lancamento->getOriginal('vencimento'));        
        $mes = $this->meses[$vencimento->format('m')];

        return $this->from('financeiro@lancamentosonline.com.br', 'Financeiro - Portal Lançamentos Online')
            ->subject("Portal Lançamentos Online - Construtora {$nome_construtora} - Mensalidade Referente ao mês de {$mes}")
            ->view('emails.safe2pay.cobranca');
    }
}

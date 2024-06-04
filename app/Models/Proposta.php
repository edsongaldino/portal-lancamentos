<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Mail\Empreendimento\Proposta\Proposta as PropostaConstrutora;
use App\Mail\Empreendimento\Proposta\Administrador as EmailAdm;
use App\Models\Oferta;
use Illuminate\Support\Facades\Mail;
use \DB;

class Proposta extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'propostas';
    protected $fillable = ['entrada_proposta', 'saldo_remanescente', 'valor_proposta', 'valor_parcela', 'valor_bens'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvar($request)
    {
        try {
            DB::beginTransaction();

            $cliente = $this->salvarDadosCliente($request);
            $oferta = Oferta::find($request->oferta_id);

            $proposta = $this;
            $proposta->construtora_id = $oferta->construtora_id;
            $proposta->empreendimento_id = $oferta->empreendimento_id;
            $proposta->unidade_id = $oferta->unidade_id;
            $proposta->oferta_id = $oferta->id;
            $proposta->cliente_id = $cliente->id;
            $proposta->valor_proposta = $request->valor_proposta;
            $proposta->entrada_proposta = $request->entrada_proposta;

            if ($request->quantidade_parcela) {
                $proposta->quantidade_parcela = $request->quantidade_parcela;
            }

            if ($request->valor_parcela) {
                $proposta->valor_parcela = $request->valor_parcela;
            }

            if ($request->saldo_remanescente) {
                $proposta->saldo_remanescente = $request->saldo_remanescente;
            }

            if ($request->tipo_negociacao_saldo) {
                $proposta->tipo_negociacao_saldo = $request->tipo_negociacao_saldo;
            }

            if ($request->valor_bens) {
                $proposta->valor_bens = $request->valor_bens;
            }

            if ($request->descricao_bens) {
                $proposta->descricao_bens = $request->descricao_bens;
            }

            if ($request->comentarios) {
                $proposta->comentarios = $request->comentarios;
            }

            $proposta->save();

            if ($request->valor_parcela_balao) {
                (new PropostaBalao())->salvarBaloes($request, $proposta);
            }

            DB::commit();

            $this->enviarEmails($proposta);

            return true;

        } catch (\Exception $e) {
            DB::rollback();
            echo '<pre>';
            var_dump($e->getMessage(), $e->getTraceAsString());
            exit();
            return false;
        }
    }


    public function SalvarProposta($request)
    {
        try {
            DB::beginTransaction();

            $tabela = TabelaVendas::where('empreendimento_id', $request->empreendimento_id)->where('tipo_tabela_id', 1)->first();

            $proposta = $this;
            $proposta->construtora_id = $request->construtora_id;
            $proposta->empreendimento_id = $request->empreendimento_id;
            $proposta->unidade_id = $request->unidade_id;
            $proposta->tabela_id = $tabela->id;
            $proposta->cliente_id = $request->cliente_id;
            $proposta->tipo_proposta = $request->tipo_proposta;


            if($request->tipo_proposta == 'Pagamento à Vista'){
                $proposta->valor_proposta = $request->valor_avista;
            }

            if($request->tipo_proposta == 'Personalizada'){

                $proposta->entrada_proposta = $request->valor_entrada;

                if ($request->qtd_mensal) {
                    $proposta->quantidade_parcela = $request->qtd_mensal;
                }

                if ($request->valor_mensal) {
                    $proposta->valor_parcela = $request->valor_mensal;
                }

                if ($request->saldo_remanescente) {
                    $proposta->saldo_remanescente = $request->saldo_remanescente;
                }

                if ($request->tipo_negociacao_saldo) {
                    $proposta->tipo_negociacao_saldo = $request->tipo_negociacao_saldo;
                }

                if ($request->valor_bens) {
                    $proposta->valor_bens = $request->valor_bens;
                }

                if ($request->descricao_bens) {
                    $proposta->descricao_bens = $request->descricao_bens;
                }

                if ($request->banco_preferencial) {
                    $proposta->banco_preferencial = $request->banco_preferencial;
                }

            }

            if ($request->comentarios) {
                $proposta->comentarios = $request->comentarios;
            }

            $proposta->save();

            if ($request->valor_parcela_balao) {
                (new PropostaBalao())->salvarBaloes($request, $proposta);
            }

            if ($request->data_nascimento) {
                $this->AtualizaDataNascimentoCliente($request);
            }

            DB::commit();

            //$this->enviarEmails($proposta);

            return $proposta;

        } catch (\Exception $e) {
            DB::rollback();
            echo '<pre>';
            var_dump($e->getMessage(), $e->getTraceAsString());
            exit();
            return false;
        }
    }


    public function AtualizarProposta($request)
    {
        try {
            DB::beginTransaction();

            $tabela = TabelaVendas::where('empreendimento_id', $request->empreendimento_id)->where('tipo_tabela_id', 1)->first();

            $proposta = Proposta::find($request->id);
            $proposta->construtora_id = $request->construtora_id;
            $proposta->empreendimento_id = $request->empreendimento_id;
            $proposta->unidade_id = $request->unidade_id;
            $proposta->tabela_id = $tabela->id;
            $proposta->cliente_id = $request->cliente_id;
            $proposta->tipo_proposta = $request->tipo_proposta;


            if($request->tipo_proposta == 'Pagamento à Vista'){
                $proposta->valor_proposta = $request->valor_avista;
            }

            if($request->tipo_proposta == 'Personalizada'){

                $proposta->entrada_proposta = $request->valor_entrada;

                if ($request->qtd_mensal) {
                    $proposta->quantidade_parcela = $request->qtd_mensal;
                }

                if ($request->valor_mensal) {
                    $proposta->valor_parcela = $request->valor_mensal;
                }

                if ($request->saldo_remanescente) {
                    $proposta->saldo_remanescente = $request->saldo_remanescente;
                }

                if ($request->tipo_negociacao_saldo) {
                    $proposta->tipo_negociacao_saldo = $request->tipo_negociacao_saldo;
                }

                if ($request->valor_bens) {
                    $proposta->valor_bens = $request->valor_bens;
                }

                if ($request->descricao_bens) {
                    $proposta->descricao_bens = $request->descricao_bens;
                }

                if ($request->banco_preferencial) {
                    $proposta->banco_preferencial = $request->banco_preferencial;
                }

            }

            if ($request->comentarios) {
                $proposta->comentarios = $request->comentarios;
            }

            $proposta->save();

            if ($request->data_nascimento) {
                $this->AtualizaDataNascimentoCliente($request);
            }

            if ($request->valor_parcela_balao) {
                (new PropostaBalao())->delBaloes($proposta);
                (new PropostaBalao())->salvarBaloes($request, $proposta);
            }

            DB::commit();

            //$this->enviarEmails($proposta);

            return $proposta;

        } catch (\Exception $e) {
            DB::rollback();
            echo '<pre>';
            var_dump($e->getMessage(), $e->getTraceAsString());
            exit();
            return false;
        }
    }

    public function AtualizaPreferencias($request){
        $proposta = Proposta::find($request->proposta_id);
        $proposta->preferencia_contato = $request->preferencia_contato;
        $proposta->preferencia_horario = $request->preferencia_horario;
        $proposta->comentarios = $request->comentarios;
        $proposta->save();
    }

    public function AtualizaDataNascimentoCliente($request){
        $cliente = Cliente::find($request->cliente_id);
        $cliente->data_nascimento = $request->data_nascimento;
        $cliente->save();
    }

    public function VagaExtra($request){
        $proposta = Proposta::find($request->id);
        $proposta->vaga_extra = $request->vaga_extra;
        $proposta->save();
    }


    public function salvarDadosCliente($request)
    {
        $cliente = (new Cliente())->salvar($request);

        if ($request->conjuge_nome && $request->conjuge_cpf) {
            (new Cliente())->salvarConjuge($request, $cliente);
        }

        return $cliente;
    }

    public function enviarEmails($proposta)
    {

        if($proposta->empreendimento->caracteristicas->where('nome', 'email_proposta')->first()){
            $email_proposta_array = $proposta->empreendimento->caracteristicas->where('nome', 'email_proposta')->first()->pivot->valor;
        }else{
            $email_proposta = $proposta->construtora->email;
        }

        //Envia proposta para a construtora
        $assunto = "Você recebeu uma proposta para o empreendimento {$proposta->empreendimento->nome}";

        if($email_proposta_array){

            foreach (explode(',', $email_proposta_array) as $email) {
                Mail::to($email)->send(new PropostaConstrutora($proposta, $assunto));
            }

        }else{
            Mail::to($email_proposta)->send(new PropostaConstrutora($proposta, $assunto));
        }


        $assunto = "Sua proposta para o empreendimento {$proposta->empreendimento->nome} foi enviada para a construtora";

        try {
            Mail::to($proposta->cliente->email)->send(new PropostaConstrutora($proposta, $assunto));
        } catch (\Exception $e) {
            // Se der algum erro no envio da proposta para o cliente
            // Não precisa fazer nada só ignora
        }

        if (env('ambiente') == 'producao') {
            $adms = [];
            $adms[] = 'edson@lancamentosonline.com.br';
            $adms[] = 'contato@lancamentosonline.com.br';
            Mail::to($adms)->send(new EmailAdm($proposta, $assunto));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function baloes()
    {
        return $this->hasMany('App\Models\PropostaBalao', 'proposta_id');
    }

     public function unidade()
     {
        return $this->belongsTo('App\Models\Unidade', 'unidade_id');
     }

     public function tabela()
     {
        return $this->belongsTo('App\Models\TabelaVendas', 'tabela_id');
     }

     public function oferta()
     {
        return $this->belongsTo('App\Models\Oferta', 'oferta_id');
     }

     public function empreendimento()
     {
         return $this->belongsTo('App\Models\Empreendimento');
     }

     public function construtora()
     {
         return $this->belongsTo('App\Models\Construtora');
     }

     public function cliente()
     {
         return $this->belongsTo('App\Models\Cliente');
     }

     public function garagem()
     {
        return $this->hasMany('App\Models\PropostaVaga');

     }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getValorParcelaAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getEntradaPropostaAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getValorPropostaAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getValorBensAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    public function getSaldoRemanescenteAttribute($valor)
    {
        if ($valor) {
            return number_format($valor, 2, ',', '.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setSaldoRemanescenteAttribute($valor)
    {
        $saldo_remanescente = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['saldo_remanescente'] = $saldo_remanescente;
    }

    public function setEntradaPropostaAttribute($valor)
    {
        $valor = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['entrada_proposta'] = $valor;
    }

    public function setValorPropostaAttribute($valor)
    {
        $valor = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor_proposta'] = $valor;
    }

    public function setValorBensAttribute($valor)
    {
        $valor = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor_bens'] = $valor;
    }

    public function setValorParcelaAttribute($valor)
    {
        $valor = str_replace(',','.', str_replace('.','', $valor));
        $this->attributes['valor_parcela'] = $valor;
    }
}

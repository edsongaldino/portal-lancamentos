@extends('site/empreendimento/premium/layout_interno')

@push('meta')
<title>INICIO</title>
@endpush

@section('content')

    <div class="conteudo">

        @include('site.empreendimento.premium.mobile.proposta.dados_unidade')

        @include('site.empreendimento.premium.mobile.proposta.proposta_construtora')

        <div class="dados-proposta">

            @if(isset($proposta))
            <h2><i class="fa fa-edit" aria-hidden="true"></i> {{ $cliente->nome }}, visualize abaixo sua proposta e altere o que for necessário</h2>
            <form action="/proposta/atualizar-dados-proposta" method="POST" name="FormProposta" id="FormProposta">
            <input type="hidden" name="id" id="id" value="{{ $proposta->id }}">  
            @else
            <h2><i class="fa fa-smile-o" aria-hidden="true"></i> {{ $cliente->nome }}, agora vamos montar a sua proposta</h2>
            <form action="/proposta/gravar-dados-proposta" method="POST" name="FormProposta" id="FormProposta">
            @endif
                @csrf
                <input type="hidden" name="valor_unidade" id="valor_unidade" value="{{ valor_unidade($unidade) }}">
                <input type="hidden" name="unidade_id" id="unidade_id" value="{{ $unidade->id }}">
                <input type="hidden" name="construtora_id" id="construtora_id" value="{{ $unidade->construtora_id }}">
                <input type="hidden" name="empreendimento_id" id="empreendimento_id" value="{{ $unidade->empreendimento_id }}">
                <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $cliente->id }}">

                <label for="nome">Qual o formato da sua proposta?</label>
                <select class="form-control select" name="tipo_proposta" id="tipo_proposta">
                    <option value="Pagamento à Vista" @if(isset($proposta)) @if($proposta->tipo_proposta == 'Pagamento à Vista') {{ "selected" }} @endif @endif>Pagamento à Vista</option>
                    <option value="Personalizada" @if(isset($proposta)) @if($proposta->tipo_proposta == 'Personalizada') {{ "selected" }} @endif @endif>Personalizada</option>
                </select>

                <div id="pagamento-avista" style="display: @if(isset($proposta)) @if($proposta->tipo_proposta == 'Personalizada') {{ "none" }} @else {{ "block" }} @endif @endif;">
                    <label for="nome">Qual valor da sua proposta para pagamento à vista?</label>
                    <input type="text" class="form-control valor-avista moeda" name="valor_avista" id="valor_avista" value="{{ $proposta->valor_proposta ?? ''}}">
                </div>

                <div id="entrada" style="display: @if(isset($proposta)) @if($proposta->tipo_proposta == 'Personalizada') {{ "block" }} @else {{ "none" }} @endif @else {{ "none" }} @endif;">
                    <label for="nome">Qual valor vai dar de entrada?</label>
                    <input type="text" class="form-control valor-entrada moeda" name="valor_entrada" id="valor_entrada" value="{{ $proposta->entrada_proposta ?? ''}}">
                </div>

                <div id="mensais" style="display: @if(isset($proposta)) @if($proposta->tipo_proposta == 'Personalizada') {{ "block" }} @else {{ "none" }} @endif @else {{ "none" }} @endif;">
                    <label for="nome">Parcelas Mensais</label>
                    <div class="mensais">
                        <input type="number" class="form-control qtd-mensal" name="qtd_mensal" id="qtd_mensal" value="{{ $proposta->quantidade_parcela ?? ''}}">
                        <input type="text" class="form-control valor-mensal moeda" id="valor_mensal" name="valor_mensal" value="{{ $proposta->valor_parcela ?? ''}}">
                    </div>
                </div>

                <div id="box-baloes" style="display: @if(isset($proposta)) @if($proposta->tipo_proposta == 'Personalizada') {{ "block" }} @else {{ "none" }} @endif @else {{ "none" }} @endif;">

                    <label for="nome">Valor e data das parcelas balões</label>

                    @if(isset($proposta))

                        @foreach ($proposta->baloes as $balao)
                        <div class="linha-balao">
                            <input type="text" class="form-control valor-balao moeda" id="valor_balao" name="valor_parcela_balao[]" value="{{ $balao->valor ?? '' }}">
                            <input type="text" class="form-control data-balao date" name="data_parcela_balao[]" value="{{ $balao->data ?? '' }}">
                            <input type="button" id="add-balao" class="add-balao" value="+">
                            <input type="button" class="delBalao" value="-">
                        </div>
                        @endforeach

                    @else

                    <div class="linha-balao">
                        <input type="text" class="form-control valor-balao moeda" id="valor_balao" name="valor_parcela_balao[]">
                        <input type="text" class="form-control data-balao date" name="data_parcela_balao[]">
                        <input type="button" id="add-balao" class="add-balao" value="+">
                        <input type="button" class="delBalao" value="-">
                    </div>

                    @endif

                </div>

                <div id="saldo-remanescente" style="display: @if(isset($proposta)) @if($proposta->tipo_proposta == 'Personalizada') {{ "block" }} @else {{ "none" }} @endif @else {{ "none" }} @endif;">
                    <label for="nome">Saldo Remanescente</label>
                    <input type="text" class="form-control saldo-remanescente moeda" name="saldo_remanescente" id="saldo_remanescente" value="{{ $proposta->saldo_remanescente ?? '' }}" readonly>
                </div>

                <div id="tipo_negociacao" style="display: @if(isset($proposta)) @if($proposta->tipo_proposta == 'Personalizada') {{ "block" }} @else {{ "none" }} @endif @else {{ "none" }} @endif;">
                    <label for="nome">Como deseja negociar o saldo?</label>
                    <select class="form-control select" name="tipo_negociacao_saldo" id="tipo_negociacao_saldo">
                        <option value="">Selecione</option>
                        <option value="Mediante Financiamento" @if(isset($proposta)) @if($proposta->tipo_negociacao_saldo == 'Mediante Financiamento') {{ "selected" }} @endif @endif>Mediante Financiamento</option>
                        <option value="Bens Negociáveis" @if(isset($proposta)) @if($proposta->tipo_negociacao_saldo == 'Bens Negociáveis') {{ "selected" }} @endif @endif>Bens Negociáveis</option>
                        <option value="Recursos Próprios" @if(isset($proposta)) @if($proposta->tipo_negociacao_saldo == 'Recursos Próprios') {{ "selected" }} @endif @endif>Recursos Próprios</option>
                    </select>
                </div>

                <div id="financiamento" style="display: @if(isset($proposta)) @if($proposta->tipo_negociacao_saldo == 'Mediante Financiamento') {{ "block" }} @else {{ "none" }} @endif @else {{ "none" }} @endif;">
                    <label for="nome">Selecione o banco preferencial p/ financiar</label>
                    <select class="form-control select" name="banco_preferencial" id="banco_preferencial">
                        <option value="Banco do Brasil" @if(isset($proposta)) @if($proposta->banco_preferencial == 'Banco do Brasil') {{ "selected" }} @endif @endif>Banco do Brasil</option>
                        <option value="Caixa Econômica Federal" @if(isset($proposta)) @if($proposta->banco_preferencial == 'Caixa Econômica Federal') {{ "selected" }} @endif @endif>Caixa Econômica Federal</option>
                        <option value="Bradesco" @if(isset($proposta)) @if($proposta->banco_preferencial == 'Bradesco') {{ "selected" }} @endif @endif>Bradesco</option>
                        <option value="Itaú" @if(isset($proposta)) @if($proposta->banco_preferencial == 'Itaú') {{ "selected" }} @endif @endif>Itaú</option>
                        <option value="Santander" @if(isset($proposta)) @if($proposta->banco_preferencial == 'Santander') {{ "selected" }} @endif @endif>Santander</option>
                    </select>

                    <label for="nome">Para esta proposta, precisamos da sua data de nascimento</label>
                    <input type="text" class="form-control data-nascimento date" name="data_nascimento" id="data_nascimento" value="{{ $cliente->data_nascimento ?? '' }}">
                </div>

                <div id="bens" style="display: @if(isset($proposta)) @if($proposta->tipo_negociacao_saldo == 'Bens Negociáveis') {{ "block" }} @else {{ "none" }} @endif @else {{ "none" }} @endif;">
                    <label for="nome">Descreva o que desja incluir no negócio e seus respectivos valores</label>
                    <textarea class="form-control" name="descricao_bens" id="descricao_bens" cols="30" rows="5"></textarea>
                </div>

            </form>

        </div>
        
    </div>

    @include('site.empreendimento.premium.mobile.proposta.modal_unidade')
    @include('site.empreendimento.premium.mobile.proposta.modal_garagem')
@endsection

@push('rodape')
<div class="rodape">

    <div class="btn-voltar" onclick='history.go(-1)'><i class="fa fa-reply-all" aria-hidden="true"></i></div>
        
    @if(isset($proposta))
        <div class="btn-gravar-dados" onclick="EnviarFormProposta();"><i class="fa fa-edit" aria-hidden="true"></i> Atualizar Proposta</div>
    @else
        <div class="btn-gravar-dados" onclick="EnviarFormProposta();"><i class="fa fa-paper-plane" aria-hidden="true"></i> Próxima Etapa</div>
    @endif
</div>

@endpush
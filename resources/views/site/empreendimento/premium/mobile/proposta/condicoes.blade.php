@extends('site/empreendimento/premium/layout_interno')

@push('meta')
    <title>INICIO</title>
@endpush

@section('content')

    <div class="conteudo">

        @include('site.empreendimento.premium.mobile.proposta.dados_unidade')

        <div class="condicoes-construtora">

            @if(isset($tabela))
                <h2><i class="fas fa-clipboard-list" aria-hidden="true"></i> Condições da Construtora</h2>

                @if(isset($tabela->percentual_entrada))
                <div class="item">
                    <div class="titulo">Entrada</div>
                    <div class="valor">{{ converte_valor_real(calcular_valor(valor_unidade($unidade), $tabela->percentual_entrada, 'Entrada', $tabela)) }}</div>
                    <div class="percentual"><strong>{{ $tabela->percentual_entrada }}%</strong></div>
                </div>
                @endif

                @if(isset($tabela->qtd_mensais))
                <div class="item">
                    <div class="titulo">Parcelas Mensais</div>
                    <div class="valor"><strong>{{ $tabela->qtd_mensais }}x</strong> {{ converte_valor_real(calcular_valor(valor_unidade($unidade), $tabela->percentual_mensais, 'Mensal', $tabela)) }}</div>
                    <div class="percentual linha-dupla"><strong>{{ $tabela->percentual_mensais }}%</strong><br/> R$ {{ converte_valor_real(calcular_valor(valor_unidade($unidade), $tabela->percentual_mensais, 'Mensal', $tabela)*$tabela->qtd_mensais) }}</div>
                </div>
                @endif

                @if(isset($tabela->baloes))
                @if($tabela->baloes->count() > 0)
                <div class="item">
                    <div class="titulo">Parcelas Balões</div>
                    @foreach ($tabela->baloes as $balao)
                    <div class="valor">{{ converte_valor_real(calcular_valor(valor_unidade($unidade), $tabela->percentual_baloes, 'Balao', $tabela)) }}</div><div class="data">{{ data_br($balao->data_balao) }}</div>
                    @endforeach
                </div>

                <div class="item">
                    <div class="valor total-balao">{{ converte_valor_real(calcular_valor(valor_unidade($unidade), $tabela->percentual_baloes, 'TotalBalao', $tabela)) }}</div>
                    <div class="percentual"><strong>{{ $tabela->percentual_baloes }}%</strong></div>
                </div>
                @endif
                @endif

                @if($tabela->percentual_parcela_unica > 0)
                <div class="item">
                    <div class="titulo">Parcela Única <span class="subtitulo">(Entrega das Chaves)</span> <span class="percentual">{{ $tabela->percentual_parcela_unica }}%</span></div>
                    <div class="valor"><strong>{{ converte_valor_real(calcular_valor(valor_unidade($unidade), $tabela->percentual_parcela_unica, 'Chaves', $tabela)) }}</strong></div><div class="data">{{ data_br($tabela->data_parcela_unica ?? '') }}</div>
                </div>
                @endif


                @php
                $percentual_remanescente = 100 - ($tabela->percentual_parcela_unica + $tabela->percentual_baloes + $tabela->percentual_entrada + $tabela->percentual_mensais)
                @endphp
                @if($percentual_remanescente > 0)
                <div class="item">
                    <div class="titulo">Saldo Remanescente <span class="subtitulo">(Financiamento/Quitação)</span></div>
                    <div class="saldo-remanescente">R$ {{ converte_valor_real(calcular_valor(valor_unidade($unidade), $percentual_remanescente, 'Saldo', $tabela)) }}</div>
                    <div class="percentual-remanescente">{{ $percentual_remanescente }}%</div>
                </div>
                @endif

                <div class="descricao-condicao">
                    @if($tabela->desconto_avista > 0) Desconto à vista: <span class="desconto">{{ $tabela->desconto_avista }}% (-{{ converte_valor_real(calcular_valor(valor_unidade($unidade), $tabela->desconto_avista, 'DescontoAvista', $tabela)) }})</span><br> @endif
                    @if($tabela->correcao_obra) Correção na Obra: <strong>{{ $tabela->correcao_obra }}</strong><br>@endif
                    @if($tabela->correcao_poschave) Correção Pós Chave: <strong>{{ $tabela->correcao_poschave }}</strong><br>@endif
                    Aceita Bens/Pagamento: <strong>{{ $tabela->aceita_bens }}</strong><br>
                    @if($tabela->valor_vaga_extra > 0) Valor da Vaga Extra: <span class="desconto">{{ converte_valor_real($tabela->valor_vaga_extra) }}</span><br>@endif
                    Previsão de Entrega: <span class="desconto">{{ get_previsao_entrega($empreendimento) }}</span><br>
                </div>
            @else
            <div class="mensagem"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br/>Não é possível formular proposta para esta unidade porque não existe nenhuma tabela de preço vigente.</div>
            @endif

        </div>

    </div>

    @include('site.empreendimento.premium.mobile.proposta.modal_unidade')

@endsection

@push('rodape')
<div class="rodape">
    <div class="btn-voltar" onclick='history.go(-1)'><i class="fa fa-reply-all" aria-hidden="true"></i></div>
    @if(isset($proposta))
    <a href="/proposta/{{ $proposta->id }}/editar-proposta"><div class="btn-proposta"><i class="fa fa-reply-all" aria-hidden="true"></i> Voltar à Proposta</div></a>
    @else

        @if(isset($tabela))
        <a href="/unidade/{{ $unidade->id }}/formular-proposta"><div class="btn-proposta"><i class="fa fa-key" aria-hidden="true"></i> Formular Proposta</div></a>
        @else
        <div class="btn-proposta proposta-block"><i class="fa fa-key" aria-hidden="true"></i> Formular Proposta</div>
        @endif

    @endif
</div>
@endpush

@extends('site/empreendimento/premium/layout_interno')

@push('meta')
<title>INICIO</title>
@endpush

@section('content')

    <div class="conteudo">

        @include('site.empreendimento.premium.mobile.proposta.dados_unidade')

        @include('site.empreendimento.premium.mobile.proposta.proposta_construtora')

        <div class="confirma">
            <i class="fas fa-exclamation-circle" aria-hidden="true"></i><br/>Antes de enviar para a construtora, confira a sua proposta
        </div>

        <div class="botoes">
            <div class="btn-minha-propostra mostrarProposta"><i class="fas fa-chevron-down" aria-hidden="true"></i> Minha Proposta</div>
            <div class="btn-minha-propostra ocultarProposta" style="display: none;"><i class="fas fa-chevron-up" aria-hidden="true"></i> Minha Proposta</div>
        </div>

        <div class="condicoes-construtora minha-proposta" id="minhaProposta" style="display: none;">

            @if($proposta->tipo_proposta == 'Pagamento à Vista')

            <div class="item">
                <div class="titulo avista">Pagamento à Vista</div>
                <div class="pagamento-avista">R$ {{ $proposta->valor_proposta }}</div>
            </div>

            @else

                <div class="item">
                    <div class="titulo">Entrada</div>
                    <div class="valor">{{ $proposta->entrada_proposta }}</div>
                    <div class="percentual"><strong>{{ converte_valor_real(calcular_percentual(valor_unidade($unidade), converte_reais_to_mysql($proposta->entrada_proposta), '', $tabela)) }}%</strong></div>
                </div>

                <div class="item">
                    <div class="titulo">Parcelas Mensais</div>
                    <div class="valor"><strong>{{ $proposta->quantidade_parcela }}x</strong> {{ $proposta->valor_parcela }}</div>
                    <div class="percentual"><strong>{{ converte_valor_real(calcular_percentual(valor_unidade($unidade), $proposta->quantidade_parcela*converte_reais_to_mysql($proposta->valor_parcela), '', $tabela)) }}%</strong> R$ {{ converte_valor_real($proposta->quantidade_parcela*converte_reais_to_mysql($proposta->valor_parcela)) }}</div>
                </div>

                <div class="item">
                    <div class="titulo">Parcelas Balões</div>
                    @php $total_balao = 0; @endphp
                    @foreach ($proposta->baloes as $balao)
                    @php $total_balao += converte_reais_to_mysql($balao->valor); @endphp
                    <div class="valor">{{ $balao->valor }}</div><div class="data">{{ $balao->data }}</div>
                    @endforeach
                </div>

                <div class="item">
                    <div class="valor total-balao">{{ converte_valor_real($total_balao) }}</div>
                    <div class="percentual"><strong>{{ converte_valor_real(calcular_percentual(valor_unidade($unidade), converte_reais_to_mysql($total_balao), '', $tabela)) }}%</strong></div>
                </div>

                @if($proposta->vaga_extra == 'Padrão')

                <div class="item">
                    <div class="titulo">Vaga Extra (Padrão))</div>
                    <div class="valor">R$ {{ converte_valor_real($tabela->valor_vaga_extra) }}</div>
                    <div class="percentual"><strong><i class="fas fa-car" aria-hidden="true"></i></strong></div>
                </div>

                @php $total_vaga_extra = $tabela->valor_vaga_extra; @endphp
                @elseif($proposta->vaga_extra == 'Gaveta Dupla')

                <div class="item">
                    <div class="titulo">Vaga Extra (Gaveta Dupla))</div>
                    <div class="valor">R$ {{ converte_valor_real($tabela->valor_vaga_extra_gaveta) }}</div>
                    <div class="percentual"><strong><i class="fas fa-car" aria-hidden="true"></i><i class="fas fa-car" aria-hidden="true"></i></strong></div>
                </div>

                @php $total_vaga_extra = $tabela->valor_vaga_extra_gaveta; @endphp
                @else
                @php $total_vaga_extra = 0; @endphp
                @endif

                <div class="item">
                    <div class="titulo">Saldo Remanescente</div>
                    <div class="saldo-remanescente">R$ {{ converte_valor_real(converte_reais_to_mysql($proposta->saldo_remanescente)+($total_vaga_extra)) }}</div>
                    <div class="percentual-remanescente">{{ converte_valor_real(calcular_percentual((valor_unidade($unidade)+$total_vaga_extra), converte_reais_to_mysql($proposta->saldo_remanescente), '', $tabela)) }}%</div>
                </div>

                <div class="item">
                    <div class="titulo">Formato de Negociação (Saldo Devedor):</div>
                    <div class="saldo-liquidar">{{ $proposta->tipo_negociacao_saldo }}</div>
                </div>

                @if($proposta->tipo_negociacao_saldo == 'Mediante Financiamento')
                <div class="item">
                    <div class="titulo">Banco Preferencial:</div>
                    <div class="saldo-liquidar">{{ $proposta->banco_preferencial }}</div>
                </div>
                @endif

                @if($proposta->tipo_negociacao_saldo == 'Bens Negociáveis')
                <div class="item">
                    <div class="titulo">Bens Negociáveis</div>
                    <div class="saldo-liquidar">{{ $proposta->descricao_bens }}</div>
                </div>
                @endif

            @endif

        </div>

        <div class="preferencias">
            <form action="/proposta/enviar-proposta" method="POST" name="FormPreferencias" id="FormPreferencias">
                @csrf
                <input type="hidden" name="proposta_id" value="{{ $proposta->id }}">
                <label for="nome"><span class="nome">{{ $proposta->cliente->nome }}</span>,<br/> como você prefere ser atendimento?</label>
                <select class="form-control select" name="preferencia_contato" id="preferencia_contato">
                    <option value="">Selecione</option>
                    <option value="Telefone">Telefone</option>
                    <option value="Whatsapp">Whatsapp</option>
                    <option value="E-mail">E-mail</option>
                    <option value="Qualquer Opção">Qualquer opção</option>
                </select>

                <label for="nome">Qual o melhor horário?</label>
                <select class="form-control select" name="preferencia_horario" id="preferencia_horario">
                    <option value="">Selecione um horário</option>
                    <option value="Manhã">Manhã</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Horário de Almoço">Horário de Almoço</option>
                    <option value="Horário Comercial">Horário Comercial</option>
                    <option value="Noite">Noite</option>
                    <option value="Qualquer">Qualquer</option>
                </select>

                <label for="nome">Dúvidas, sugestões, etc (Opcional)</label>
                <textarea name="comentarios" class="form-control" id="comentarios" cols="30" rows="4"></textarea>

            </form>
        </div>

    </div>

    @include('site.empreendimento.premium.mobile.proposta.modal_unidade')

@endsection

@push('rodape')
<div class="rodape">
    <a href="/proposta/{{ $proposta->id }}/editar-proposta"><div class="btn-voltar"><i class="fa fa-edit" aria-hidden="true"></i></div></a>
    <div class="btn-gravar-dados" onclick="EnviarProposta();"><i class="fa fa-send" aria-hidden="true"></i> Enviar Proposta</div>
</div>
@endpush


<div class="detalhe-unidade proposta-construtora">

    <h2><i class="fas fa-info-circle" aria-hidden="true"></i> Proposta da Construtora</h2>

    <div class="btn-info-unidade mostrarC"><i class="fas fa-chevron-down" aria-hidden="true"></i> Mostrar</div>
    <div class="btn-info-unidade ocultarC" style="display: none;"><i class="fas fa-chevron-up" aria-hidden="true"></i> Ocultar</div>

    <div id="PropostaConstrutora" class="condicoes-construtora abaResumo" style="display: none;">

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

    </div>

</div>

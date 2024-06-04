@if($empreendimento->caracteristicas->where('nome', 'ocultar_valor')->first() && $empreendimento->caracteristicas->where('nome', 'ocultar_valor')->first()->pivot->valor == 'S')
    <div class="details-parameters-price detalhe" title="Unidades à partir de:">
        <div class="title-price">
        Valores somente com a construtora
        </div>
        <div class="price">Consulte</div>
    </div>
@else
    <div class="details-parameters-price detalhe" title="Unidades à partir de:">
        <div class="title-price">
        Unidades à partir de:
        </div>

        @if ($empreendimento->ofertasAtivas->count() > 0)
        <div class="price">
        R$ {{ $empreendimento->ofertaPrincipal('valor-por') }}
        </div>
        @else
        <div class="price">
        R$ {{ $empreendimento->valor_inicial }}
        </div>
        @endif

    </div>
@endif

@php
$renda_familiar = $empreendimento->caracteristicas->where('nome', 'renda_familiar')->first();

if ($renda_familiar) {
    $renda_familiar = $renda_familiar->pivot->valor;
}

$previsao_condominio = $empreendimento->caracteristicas->where('nome', 'previsao_condominio')->first();

if ($previsao_condominio) {
    $previsao_condominio = $previsao_condominio->pivot->valor;
}
@endphp

<div class="valores-renda">
@if ($renda_familiar and $renda_familiar <> '0')
<div class="item-valores">
    <div class="titulo-item">
    Renda mínima
    </div>
    <div class="valor-item">
    R$ {{ $renda_familiar }}
    </div>
    <div class="info-item">
    <i class="fa fa-info-circle" aria-hidden="true"></i>
    </div>
</div>
@endif

@if ($previsao_condominio and $previsao_condominio <> '0')
    <div class="item-valores">
    <div class="titulo-item">
        Previsão de condomínio
    </div>
    <div class="valor-item">
        R$ {{ $previsao_condominio }}
    </div>
    <div class="info-item">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
    </div>
    </div>
@endif
</div>

<!-- Caso existam tabelas ativas mostra QRCode da Proposta Online e oculta o formulário  -->
@if($empreendimento->TabelaAtiva->count() > 0)

    <div class="box-proposta-online">
        <img src="/site/imagens/qr-code-proposta/proposta-{{ $empreendimento->id }}.png" alt="" class="qrcode">
    </div>

@else
    <form id="form-contato-construtora">
    <input name="nome" type="text" class="main-input campo-form-topo" placeholder="Nome completo" value="" required/>
    <input name="telefone" type="text" class="main-input campo-form-topo telefone" placeholder="Telefone" value="" required/>
    <input name="email" type="email" class="main-input campo-form-topo" placeholder="E-mail" value="" required/>

    <select name="previsao" class="main-input form-topo" required>
        <option class="item" value="" selected="selected">Qual a sua previsão de compra?</option>
        <option class="item" value="Imediata">Imediata</option>
        <option class="item" value="Até 90 dias">Até 90 dias</option>
        <option class="item" value="6 meses à 1 ano">6 meses à 1 ano</option>
        <option class="item" value="1 ano ou mais">1 ano ou mais</option>
    </select>

    <select name="interesse" class="main-input form-topo" required>
        <option class="item" value="" selected="selected">O que mais te agradou neste produto?</option>
        <option class="item" value="Preço">Preço</option>
        <option class="item" value="Localização">Localização</option>
        <option class="item" value="Área de Lazer">Área de Lazer</option>
        <option class="item" value="Planta do imóvel">Planta do imóvel</option>
        <option class="item" value="Previsão de entrega">Previsão de entrega</option>
    </select>

    <select name="renda" class="main-input form-topo" required>
        <option class="item" value="" selected="selected">Qual a sua renda? R$</option>
        <option class="item" value="Até 3.000,00">Até 3.000</option>
        <option class="item" value="de 3.000 à 5.000">de 3.000 à 5.000</option>
        <option class="item" value="de 5.000 à 7.000">de 5.000 à 7.000</option>
        <option class="item" value="de 7.000 à 10.000">de 7.000 à 10.000</option>
        <option class="item" value="de 10.000 à 15.000">de 10.000 à 15.000</option>
        <option class="item" value="Acima de 15.000">Acima de 15.000</option>
    </select>

    <textarea name="mensagem" id="mensagem_contato" class="main-input mensagem-form-topo" placeholder="Mensagem">Olá, tenho interesse no empreendimento {{ $empreendimento->nome }}. Aguardo o contato. Obrigado.</textarea>
    <input type="hidden" placeholder="" name="empreendimento_id" value="{{ $empreendimento->id }}">
    <div class="loadingImg" style="display:none;"><img src="/site/imagens/loader2.gif" alt=""></div>
    <div class="form-submit-cont-topo enviar-formulario" style="display:block;">
        <a href="javascript:void(0);" class="button-primary pull-right enviar-novo-topo botao-enviar" data-form="#form-contato-construtora">
        <span>ENVIAR PARA A CONSTRUTORA</span>
        <div class="button-triangle"></div>
        <div class="button-triangle2 novo"></div>
        <div class="button-icon"><i class="fa fa-paper-plane icon-send-novo"></i></div>
        </a>
        <div class="clearfix"></div>
    </div>
    </form>

    <div class="texto-envio">
    Ao contatar a construtora, você concorda com os
    <a href="https://www.lancamentosonline.com.br/termos-de-uso-lancamentos-online.html" target="blank">
        Termos de Uso
    </a> e
    <a href="https://www.lancamentosonline.com.br/politica-de-privacidade-lancamentos-online.html" target="blank">
        Política de Privacidade
    </a>.
    </div>
@endif

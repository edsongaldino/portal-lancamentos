@if ($empreendimento->ofertasAtivas->count() > 0)

<div class="box-oferta margin-top-45">
  <div class="col-xs-12 col-sm-9">
    <h5 class="subtitle-margin">
      Confira nossas
    </h5>
    <h2>
      Unidades em Oferta
    </h2>
  </div>
  <div class="col-xs-12 col-sm-3">
    <a href="#" class="navigation-box navigation-box-next" id="grid-offers-owl-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
    <a href="#" class="navigation-box navigation-box-prev" id="grid-offers-owl-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
  </div>
  <div class="col-xs-12">
    <div class="title-separator-primary"></div>
  </div>
</div>

<div class="owl-carousel" id="grid-offers-owl">  
    @foreach($empreendimento->ofertasAtivas as $oferta)            
      <div class="grid-offer-col">
        <div class="item-oferta">
          <div class="dados-unidade-oferta">
            @if($empreendimento->subtipo->id == 3 || $empreendimento->subtipo->id == 4)

              <div class="topo-oferta">
                <div class="icone"><img src="/site/imagens/icones/icone-empreendimento-1.png" alt=""></div>
                <div class="unidade">Unidade {{ $oferta->unidade->nome }}</div>
                <div class="info-torre">{{ $oferta->unidade->quadra->nome }}</div>
              </div>
              <div class="conteudo-oferta">
                <div class="oferta-icone"><img src="/site/imagens/icones/icone-oferta.png" alt=""></div>
                <div class="oferta-valor-de">R$ {{ $oferta->preco_tabela }}</div>
                <div class="oferta-valor-desconto">(-{{ $oferta->percentual_desconto }}%) R$ {{ $oferta->valor_desconto }}</div>
                <div class="oferta-valor">R$ {{ $oferta->preco_oferta }}</div>
              </div>

              @if ($oferta->unidade->planta)
                <div class="box-planta imagem-planta gallery-oferta {{ $oferta->unidade->planta->id }}">
                  <img src="/site/imagens/icones/icone-planta.png" alt="">
                  {{ $oferta->unidade->planta->area_privativa }}m²                                                 
                </div>
              @endif
              
              <div class="box-info"><img src="/site/imagens/icones/icone-info.png" alt=""> + Info</div>
              <button type="button" data-toggle="modal" data-target="#modal-oferta" data-id="{{ $oferta->id }}"data-tipo="Horizontal" class="negociar-unidade"> Negociar Unidade</button>
            @else
                <div class="topo-oferta">
                  <div class="icone"><img src="/site/imagens/icones/icone-empreendimento-1.png" alt=""></div>
                  <div class="unidade">{{ $oferta->unidade->torre->nome }}</div>
                  <div class="info-torre">Unidade {{ $oferta->unidade->nome }}</b> @if ($oferta->unidade->andar)Andar: {{ $oferta->unidade->andar->numero }}º @endif</div>
                </div>
                <div class="conteudo-oferta">
                  <div class="oferta-icone"><img src="/site/imagens/icones/icone-oferta.png" alt=""></div>
                  <div class="oferta-valor-de">R$ {{ $oferta->preco_tabela }}</div>
                  <div class="oferta-valor-desconto">(-{{ $oferta->percentual_desconto }}%) R$ {{ $oferta->valor_desconto }}</div>
                  <div class="oferta-valor">R$ {{ $oferta->preco_oferta }}</div>
                </div>
                <div class="box-planta imagem-planta gallery-oferta {{ $oferta->unidade->planta->id }}">
                  <img src="/site/imagens/icones/icone-planta.png" alt="">
                  {{ $oferta->unidade->planta->area_privativa }}m²  
                </div>
                <div class="box-info"><img src="/site/imagens/icones/icone-info.png" alt=""> + Info</div>
                <button type="button" data-toggle="modal" data-target="#modal-oferta" data-id="{{ $oferta->id }}"data-tipo="Vertical" class="negociar-unidade"> Negociar Unidade</button>
            @endif 
          </div>
        </div>
      </div>
    @endforeach
  </div>

<div class="modal fade" id="modal-oferta" tabindex="-1" role="dialog" aria-labelledby="modalOfertaLabel" aria-hidden="true">
<div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalOfertaLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"></button>
        <button type="button" class="btn btn-primary"></button>
    </div>
    </div>
</div>
</div>
@endif
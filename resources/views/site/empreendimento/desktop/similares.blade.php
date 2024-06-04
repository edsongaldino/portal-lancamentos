<div class="row margin-top-90">
  <div class="col-xs-12 col-sm-9">
    <h5 class="subtitle-margin">
      Empreendimentos
    </h5>
    <h2>
      Similares
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

<div class="grid-offers-container">
  <div class="owl-carousel" id="grid-offers-owl">
    @php
      $empreendimentos_similares = $empreendimento->similares();
      
      if (!count($empreendimentos_similares)) {
        $empreendimentos_similares = $empreendimento->similares2();
      }

      if (!count($empreendimentos_similares)) {
        $empreendimentos_similares = $empreendimento->similares3();
      }

      if (!count($empreendimentos_similares)) {
        $empreendimentos_similares = $empreendimento->similares4();
      }

      if (!count($empreendimentos_similares)) {
        $empreendimentos_similares = $empreendimento->similares5();
      }

      if (!count($empreendimentos_similares)) {
        $empreendimentos_similares = $empreendimento->similares6();
      }

    @endphp
    @foreach($empreendimentos_similares as $emp)
      <div class="grid-offer-col">
        <div class="grid-offer">
          <div class="grid-offer-front">
            <div class="grid-offer-photo">
              <a href="empreendimento/{{ url_amigavel($emp->nome) }}-{{ $emp->id }}.html">
                <img src="{{ $emp->getFoto('destaque_principal') }}" alt="" />
              </a>
              <div class="type-container">
                @if ($emp->subtipo->id == 1)
                  <div class="estate-type">
                    <i class="fa fa-building" aria-hidden="true" title="Apartamento"></i>
                  </div>
                @elseif ($emp->subtipo->id == 2)
                  <div class="estate-type">
                    <i class="fa fa-briefcase" aria-hidden="true" title="Salas Comerciais"></i>
                  </div>
                @else
                  <div class="estate-type">
                    <i class="fa fa-home" aria-hidden="true" title="Casas em Condomínio"></i>
                  </div>
                @endif

                @if ($emp->modalidade == 'Lançamento')
                  <div class="transaction-type lancamento" title="Lançamento">
                    L
                  </div>
                @elseif ($emp->modalidade == 'Em obra')
                  <div class="transaction-type obra" title="Em Obra">
                    O
                  </div>
                @else
                  <div class="transaction-type mude-ja" title="Pronto para Morar">
                    P
                  </div>
                @endif
              </div>
            </div>
            <div class="grid-offer-text">
              <div class="grid-offer-h4">
                <h4 class="grid-offer-title">
                  {{ $emp->nome }}
                </h4>
              </div>
              <div class="list-offer-localization">
                <i class="fa fa-map-marker" aria-hidden="true"></i> 
                @if ($emp->endereco)
                {{ $emp->endereco->bairro->nome }},
                @endif 
                @if ($emp->endereco)
                {{ $emp->endereco->cidade->nome }} - 
                @endif
                @if ($emp->endereco)
                {{ $emp->endereco->cidade->estado->nome }}
                @endif
              </div>
            </div>
            <div class="price-grid-cont">
              @if ($emp->ocultar_valor == 'S')
                <div class="grid-price pull-left">
                  <i class="fa fa-angle-double-up" aria-hidden="true" title="À partir de:"></i> 
                  Consultar
                </div>
              @else
                <div class="grid-price pull-left">
                  <i class="fa fa-angle-double-up" aria-hidden="true" title="À partir de:"></i> 
                  @if ($emp->valor_inicial)
                  R$ {{ $emp->valor_inicial }}
                  @else
                  Consultar
                  @endif
                </div>              
              @endif
              
              <div class="grid-construtora pull-right">
                <img class="logo-right" src="{{ $emp->construtora->getLogoUrl() }}" width="60" alt="">
              </div>
              <div class="clearfix"></div>
            </div>
            @if ($emp->subtipo->id == 1)
              <div class="grid-offer-params">
                <div class="grid-area">
                  <img src="/site/images/area-icon.png" alt="" />
                  {!! qtd_metragem($emp, true) !!}m<sup>2</sup>
                </div>
                <div class="grid-rooms">
                  <img src="/site/images/rooms-icon.png" alt="" />
                  {!! qtd_dormitorio($emp) !!}
                </div>
                <div class="grid-baths">
                  <img src="/site/images/bathrooms-icon.png" alt="" />
                  {!! qtd_suites($emp) !!}
                </div>							
              </div>
            @elseif ($emp->subtipo->id == 2)
              <div class="grid-offer-params">
                <div class="grid-area-comercial">
                  <img src="/site/images/area-icon.png" alt="" />Salas à partir de {{ $emp->getCaracteristica('area_privativa_real', 'minimo_planta') }}m<sup>2</sup>
                </div>
                <div class="grid-estacionamento">
                  <img src="/site/images/estacionamento-icon.png" alt="" title="
                    @if ($emp->getCaracteristica('estacionamento_rotativo') == 'S')
                    Possui estacionamento rotativo
                    @else
                    Não possui estacionamento rotativo
                    @endif
                  " />
                </div>						
              </div>
            @elseif ($emp->subtipo->id == 3)
              @if($emp->getCaracteristica('tipo_condominio') == "Lotes")
                <div class="grid-offer-params">
                  <div class="grid-area-lotes">
                    <img src="/site/images/area-icon.png" alt="" />Lotes de {{ $emp->getCaracteristica('area_unidade_min') }} à {{ $emp->getCaracteristica('area_unidade_max') }}m<sup>2</sup>
                  </div>						
                </div>
              @else
                <div class="grid-offer-params">
                  <div class="grid-area">
                    <img src="/site/images/area-icon.png" alt="" />
                    {{ $emp->getCaracteristica('area_privativa_real', 'maximo_planta') }}m<sup>2</sup>
                  </div>
                  <div class="grid-rooms">
                    <img src="/site/images/rooms-icon.png" alt="" />
                    {!! qtd_dormitorio($emp, true) !!}
                  </div>
                  <div class="grid-baths">
                    <img src="/site/images/bathrooms-icon.png" alt="" />
                  {!! qtd_suites($emp) !!}
                  </div>							
                </div>
              @endif
            @elseif ($emp->subtipo->id == 4)              
              @if($emp->variacao && $emp->variacao->id == 10)
                <div class="grid-offer-params">
                  <div class="grid-area-lotes">
                    <img src="/site/images/area-icon.png" alt="" />Lotes de {{ $emp->getCaracteristica('area_unidade_min') }} à {{ $emp->getCaracteristica('area_unidade_max') }}m<sup>2</sup>
                  </div>						
                </div>
              @else
                <div class="grid-offer-params">
                  <div class="grid-area">
                    <img src="/site/images/area-icon.png" alt="" />
                    {{ $emp->getCaracteristica('area_privativa_real', 'maximo_planta') }}m<sup>2</sup>
                  </div>
                  <div class="grid-rooms">
                    <img src="/site/images/rooms-icon.png" alt="" />
                    {!! qtd_dormitorio($emp, true) !!}
                  </div>
                  <div class="grid-baths">
                    <img src="/site/images/bathrooms-icon.png" alt="" />
                    {!! qtd_suites($emp) !!}
                  </div>							
                </div>
              @endif
            @else
              <div class="grid-offer-params">
                <div class="grid-area">
                  <img src="/site/images/area-icon.png" alt="" />
                  {{ $emp->getCaracteristica('area_privativa_real', 'maximo_planta') }}m<sup>2</sup>
                </div>
                <div class="grid-rooms">
                  <img src="/site/images/rooms-icon.png" alt="" />
                  {!! qtd_dormitorio($emp, true) !!}
                </div>
                <div class="grid-baths">
                  <img src="/site/images/bathrooms-icon.png" alt="" />
                  {!! qtd_suites($emp) !!}
                </div>							
              </div>
            @endif
          </div>	
        </div>
      </div>
    @endforeach
  </div>
</div>
<div class="margin-top-45"></div>
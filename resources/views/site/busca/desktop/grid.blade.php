<div class="row grid-offer-row" id="empreendimentos_grid">
	@foreach($empreendimentos as $empreendimento)
    @php
    $area_unidade_min = 0;
    $area_unidade_max = 0;

    if ($c = $empreendimento->caracteristicas->where('nome', 'area_unidade_min')->first()) {
      $area_unidade_min = $c->pivot->valor;
    }

    if ($c = $empreendimento->caracteristicas->where('nome', 'area_unidade_max')->first()) {
      $area_unidade_max = $c->pivot->valor;
    }
    @endphp

		<div class="col-xs-12 col-sm-6 col-lg-4 grid-offer-col">
			<div class="grid-offer">
				<div class="grid-offer-front">
                @if($empreendimento->TabelaAtiva->count() > 0)
            <div class="selo-oferta-grid">
                <img src="/site/images/selo_proposta_online.png" alt="">
            </div>
            @elseif($empreendimento->selo_oferta)
            <div class="selo-oferta-grid">
              <img src="/site/images/selos/{{ $empreendimento->selo_oferta }}" alt="">
            </div>
            @elseif ($empreendimento->ofertasAtivas->count() > 0)
                @if ($empreendimento->construtora_id == 13)
                <div class="selo-oferta-grid"><a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html"><img src="/site/images/selo_oferta_13.png" alt=""></a></div>
                @else
                <div class="selo-oferta-grid"><a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html"><img src="/site/images/selo-black-friday-list.png" alt=""></a></div>
                @endif
          @endif

          <div class="grid-offer-photo">
            <a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome) }}-{{ url_amigavel($empreendimento->nome) }}-{{ $empreendimento->id }}.html">
                <img src="{{ $empreendimento->getFoto('destaque_principal') }}" alt="" />
            </a>
            <div class="type-container">
              @if ($empreendimento->subtipo_id == 1)
                <div class="estate-type"><i class="fa fa-building" aria-hidden="true" title="Apartamento"></i></div>
              @elseif ($empreendimento->subtipo_id  == 2)
                <div class="estate-type"><i class="fa fa-briefcase" aria-hidden="true" title="Salas Comerciais"></i></div>
              @else
                <div class="estate-type"><i class="fa fa-home" aria-hidden="true" title="Casas em Condomínio"></i></div>
              @endif

              @if ($empreendimento->modalidade =='Lançamento')
                <div class="transaction-type lancamento" title="Lançamento">L</div>
              @elseif ($empreendimento->modalidade == 'Em obra')
                <div class="transaction-type obra" title="Em Obra">O</div>
              @else
                <div class="transaction-type mude-ja" title="Pronto para Morar">P</div>
              @endif
           </div>

            @php
              $previsao =  get_previsao_entrega($empreendimento);
            @endphp

            @if ($previsao == 'Pronto')
              <div class="grid-entrega"><i class="fa fa-key" aria-hidden="true"></i> PRONTO</div>
            @else
              <div class="grid-entrega aguardando">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                {{ $previsao }}
              </div>
            @endif
          </div>

          <div class="grid-offer-text">
            <div class="grid-offer-h4">
              <h4 class="grid-offer-title">{{ $empreendimento->nome }}</h4>
            </div>
            <div class="list-offer-localization">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              @if ($empreendimento->endereco)
                {{ $empreendimento->endereco->bairro->nome }},
              @endif
              @if ($empreendimento->endereco)
                {{ $empreendimento->endereco->cidade->nome }} -
              @endif
              @if ($empreendimento->endereco)
                {{ $empreendimento->endereco->cidade->estado->nome }}
              @endif
            </div>
          </div>
          <div class="price-grid-cont">

              @if ($empreendimento->ofertasAtivas->count() > 0)

              <div class="grid-price blackfriday pull-left" title="À partir de:">
                De <span class="valor-de">{{ $empreendimento->ofertaPrincipal('valor-de') }}</span> por <span class="valor-por">{{ $empreendimento->ofertaPrincipal('valor-por') }}*</span>
              </div>

              @else

              @if($empreendimento->caracteristicas->where('nome', 'ocultar_valor')->first() && $empreendimento->caracteristicas->where('nome', 'ocultar_valor')->first()->pivot->valor == 'S')
                <div class="grid-price pull-left">
                  <i class="fa fa-angle-double-up" aria-hidden="true" title="À partir de:"></i>
                  Consultar
                </div>
              @else
                <div class="grid-price pull-left">
                  <i class="fa fa-angle-double-up" aria-hidden="true" title="À partir de:"></i>
                  R$ {{ $empreendimento->valor_inicial }}
                </div>
              @endif

            @endif


            <div class="grid-construtora pull-right">
              <img class="logo-right" src="{{ $empreendimento->construtora->getLogoUrl('125x95') }}" width="60" alt=""></div>
            <div class="clearfix"></div>
          </div>

          @if ($empreendimento->subtipo_id == 1)
            <div class="grid-offer-params">
              <div class="grid-area">
                <img src="/site/images/area-icon.png" alt="" />
                {!! qtd_metragem($empreendimento) !!} m<sup>2</sup>
             </div>
             <div class="grid-rooms">
               <img src="/site/images/rooms-icon.png" alt="" />
               {!! qtd_dormitorio($empreendimento, true) !!}
             </div>
             <div class="grid-baths">
               <img src="/site/images/bathrooms-icon.png" alt="" />
               {!! qtd_suites($empreendimento) !!}
             </div>
           </div>
          @elseif ($empreendimento->subtipo_id == 2)
            <div class="grid-offer-params">
              <div class="grid-area-comercial">
                <img src="/site/images/area-icon.png" alt="" />Salas à partir de {{ qtd_metragem($empreendimento, true) }} m<sup>2
              </div>
              <div class="grid-estacionamento">
                @php
                $estacionamento = $empreendimento->caracteristicas->where('nome', 'estacionamento_rotativo')->first();

                if ($estacionamento) {
                  $estacionamento = $estacionamento->pivot->valor;
                }
                @endphp
                <img src="/site/images/estacionamento-icon.png" alt="" title="
                  @if($estacionamento && $estacionamento == 'S')
                    Possui estacionamento rotativo
                  @else
                    Não possui estacionamento rotativo
                  @endif
                  " />
              </div>
            </div>
          @elseif ($empreendimento->subtipo_id == 3)
            @php
            $variacao = $empreendimento->caracteristicas->where('nome', 'tipo_condominio')->first();

            if ($variacao) {
              $variacao = $variacao->pivot->valor;
            }
            @endphp
            @if($variacao && $variacao == "Lotes")
              <div class="grid-offer-params">
                <div class="grid-area-lotes">
                  <img src="/site/images/area-icon.png" alt="" />
                  Lotes de {{ $area_unidade_min }} à {{ $area_unidade_max }} m<sup>2</sup>
                </div>
              </div>
            @else
              <div class="grid-offer-params">
                <div class="grid-area">
                  <img src="/site/images/area-icon.png" alt="" />
                  {!! qtd_metragem($empreendimento) !!} m<sup>2</sup>
                </div>
                <div class="grid-rooms">
                  <img src="/site/images/rooms-icon.png" alt="" />
                  {!! qtd_dormitorio($empreendimento, true) !!}
                </div>
                <div class="grid-baths">
                  <img src="/site/images/bathrooms-icon.png" alt="" />
                  {!! qtd_suites($empreendimento) !!}
                </div>
              </div>
            @endif

          @elseif ($empreendimento->subtipo_id == 4)
            @if($empreendimento->variacao_id == 10)
              <div class="grid-offer-params">
                <div class="grid-area-lotes">
                  <img src="/site/images/area-icon.png" alt="" />Lotes de {{ $area_unidade_min }} à {{ $area_unidade_max }} m<sup>2</sup>
                </div>
              </div>
            @else
              <div class="grid-offer-params">
                <div class="grid-area">
                 <img src="/site/images/area-icon.png" alt="" />
                 {{ $area_unidade_min }} m<sup>2</sup>
               </div>
               <div class="grid-rooms">
                 <img src="/site/images/rooms-icon.png" alt="" />
                 {!! qtd_dormitorio($empreendimento, true) !!}
               </div>
               <div class="grid-baths">
                 <img src="/site/images/bathrooms-icon.png" alt="" />
                 {!! qtd_suites($empreendimento) !!}
               </div>
              </div>
            @endif
          @else
            <div class="grid-offer-params">
              <div class="grid-area">
               <img src="/site/images/area-icon.png" alt="" />
               {!! qtd_metragem($empreendimento) !!} m<sup>2</sup>
             </div>
             <div class="grid-rooms">
               <img src="/site/images/rooms-icon.png" alt="" />
               {!! qtd_dormitorio($empreendimento, true) !!}
             </div>
             <div class="grid-baths">
               <img src="/site/images/bathrooms-icon.png" alt="" />
               {!! qtd_suites($empreendimento) !!}
             </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  @endforeach
</div>

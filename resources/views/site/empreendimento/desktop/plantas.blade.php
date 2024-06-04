  <div class="container">
      <div class="col-xs-12 col-sm-9 margin-top-60">
        <h2 class="title-negative-margin title-color">
          <i class="fa fa-object-group" aria-hidden="true"></i> Plantas
        </h2>
        <h5 class="subtitle-color">
          Plantas disponíveis para este empreendimento
        </h5>
      </div>
      <div class="col-xs-12 col-sm-3 margin-top-60">
        <a href="#" class="navigation-box navigation-box-next" id="featured-offers-owl-next">
          <div class="navigation-triangle"></div>
          <div class="navigation-box-icon">
            <i class="jfont">&#xe802;</i>
          </div>
        </a>
        <a href="#" class="navigation-box navigation-box-prev" id="featured-offers-owl-prev">
          <div class="navigation-triangle"></div>
          <div class="navigation-box-icon">
            <i class="jfont">&#xe800;</i>
          </div>
        </a>                
      </div>
      <div class="col-xs-12">
        <div class="title-separator-secondary"></div>
      </div>
    </div>
  </div>          

  <div class="container featured-offers-container">
    <div class="owl-carousel" id="featured-offers-owl">
      @php
        $plantas_empreendimento = $empreendimento->plantasComFotos;
      @endphp
      @foreach($plantas_empreendimento as $planta_empreendimento)
        <div class="featured-offer-col">
          <div class="featured-offer-planta planta">
            <div class="featured-planta-title">
              <h3 class="featured-offer-title nome-planta"><i class="fa fa-object-group" aria-hidden="true"></i> {{ $planta_empreendimento->nome }}</h3>
            </div>
            <div class="featured-offer-photo gallery-grid-lg planta">
              @php
                $planta_tipo = $planta_empreendimento->caracteristicas->where('nome', 'planta_tipo')->first();

                if ($planta_tipo) {
                  $planta_tipo = $planta_tipo->pivot->valor;
                }

                $metragem = $planta_empreendimento->area_privativa;

                $dormitorio = $planta_empreendimento->caracteristicas->where('nome', 'qtd_dormitorio')->first();          
                if ($dormitorio) {
                  $dormitorio = $dormitorio->pivot->valor;
                }

                $suites = $planta_empreendimento->caracteristicas->where('nome', 'qtd_suite')->first();

                if ($suites) {
                  $suites = $suites->pivot->valor;
                }

                $foto_planta = $planta_empreendimento->getFotoDestaque();
              @endphp
              
              <a                
                href="{{ $foto_planta->getUrl('original') }}" 
                class="{{ url_amigavel($foto_planta->nome.$foto_planta->id)}}" 
                data-sub-html="{{ $foto_planta->nome }} - Área Privativa ({{ $metragem }} m²)">
                  <img data-id="{{ $foto_planta->id }}" data-planta="{{ $foto_planta->planta->id }}" src="{{ $foto_planta->getUrl('400x300') }}" class="center-block img-planta" alt="" />
              </a>
            </div>      

            <div class="featured-planta-description" id="planta-description{{ $planta_empreendimento->id }}" style="display: none;">
                <ul class="details-ticks">                    
                    @foreach($planta_empreendimento->caracteristicas->where('exibir', 'Sim') as $item_planta)
                      <li>
                        <i class="jfont">&#xe815;</i>
                        {{ $item_planta->nome }}
                      </li>
                    @endforeach
                                        
                    @if($planta_empreendimento->caracteristicas->where('nome', 'vagas_garagem')->first())
                      @php
                        $vagas = $planta_empreendimento->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor;
                      @endphp

                      <li class="destaque">
                        <i class="jfont">&#xe815;</i>
                        {{  $vagas }} Vagas de garagem
                      </li>
                    @endif                            
                </ul>
            </div>                            

            @if($empreendimento->subtipo->id == 1 || $empreendimento->subtipo->id == 3)
              <div class="featured-offer-params info">
                <div class="featured-area">
                  <img src="/site/images/area-icon.png" alt="" title="Área Privativa da Planta" />{{ $metragem }}m<sup>2</sup>
                </div>
                <div class="featured-rooms">
                  <img src="/site/images/rooms-icon.png" alt="" title="Quantidade de Dormitórios" />{{ $dormitorio }}
                </div>
                <div class="featured-baths">
                  <img src="/site/images/bathrooms-icon.png" alt="" title="Quantidade de Suítes" />{{ $suites }}
                </div>              
              </div>
            @elseif($empreendimento->subtipo->id == 2)
              <div class="featured-offer-params info">
                <div class="featured-area">
                  <img src="/site/images/area-icon.png" alt="" title="Área Privativa da Planta" />
                  {{ $planta_empreendimento->area_privativa }} m<sup>2</sup>
                </div>                
              </div>
            @else
              <div class="featured-offer-params info">
                <div class="featured-area">
                  <img src="/site/images/area-icon.png" alt="" title="Área Privativa da Planta" />{{ $metragem }}m<sup>2</sup>
                </div>
                <div class="featured-rooms">
                  <img src="/site/images/rooms-icon.png" alt="" title="Quantidade de Dormitórios" />{{ $dormitorio }}
                </div>
                <div class="featured-baths">
                  <img src="/site/images/bathrooms-icon.png" alt="" title="Quantidade de Suítes" />{{ $suites }}
                </div>              
              </div>
            @endif

            <a href="javascript:void(0);" onclick="javascript:abreFecha('#planta-description{{ $planta_empreendimento->id }}');">
              <div class="featured-price mais-info">
                +
              </div>
            </a>
          </div>

          <div class="featured-offer-back">
            <div id="featured-map1" class="featured-offer-map"></div>
            <div class="button">  
              <a href="javascript:void(0);" class="button-primary">
                <span>+ Detalhes</span>
                <div class="button-triangle"></div>
                <div class="button-triangle2"></div>
                <div class="button-icon"><i class="fa fa-search"></i></div>
              </a>
            </div>
          </div>                                
        </div> 
      @endforeach
</div>
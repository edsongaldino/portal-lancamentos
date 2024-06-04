<div class="row margin-top-45 tab-mapa">
  <div class="col-xs-12 apartment-tabs margin-top-45">
    @php
      $mostra_mapa = $empreendimento->caracteristicas->where('nome', 'mostra_mapa')->first();

      if ($mostra_mapa) {
        $mostra_mapa = $mostra_mapa->pivot->valor;  
      }

      $active_google = null;
    @endphp

    @if($tour360->count() > 0) 
      @php
        $active_tour = "active"; 
        $active_mapa = ''; 
      @endphp
    @elseif($mostra_mapa == 'S') 
      @php
        $active_tour = ""; 
        $active_mapa = 'active'; 
      @endphp
    @else 
      @php
        $active_tour = ""; 
        $active_mapa = ''; 
        $active_google = 'active';
      @endphp
    @endif
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      @if($mostra_mapa == 'S')
        <li role="mapa_vendas" class="{{ $active_mapa}}">
            <a href="#tab-map-venda" aria-controls="tab-map-venda" role="tab" data-toggle="tab">
                <span>Mapa de Vendas</span>
                <div class="button-triangle2"></div>
            </a>
        </li>
      @endif

      @if($tour360->count() > 0) 
        @php $i = 0; @endphp
        @foreach ($tour360 as $tour)
        @php $i++;@endphp
        @if ($i == 1)
        <li role="tour-virtual" class="{{ $active_tour}}">
        @else
        <li role="tour-virtual" class="">
        @endif
          <a href="#tab-tour-{{ $tour->id }}" aria-controls="tab-tour" role="tab" data-toggle="tab">
            <span><i class="fa fa-circle-o-notch" aria-hidden="true"></i> {{ $tour->titulo }}</span>
            <div class="button-triangle2"></div>
          </a>
        </li>
        @endforeach
      @endif

      <li role="localizacao" class="{{ $active_google}}">
          <a href="#tab-map" aria-controls="tab-map" role="tab" data-toggle="tab">
            <span><i class="fa fa-map-marker" aria-hidden="true"></i> Localização</span>
            <div class="button-triangle2"></div>
          </a>
      </li>
      <li role="presentation">
        <a href="#tab-street-view" aria-controls="tab-street-view" role="tab" data-toggle="tab">
          <span><i class="fa fa-map-pin" aria-hidden="true"></i> Street view</span>
          <div class="button-triangle2"></div>
        </a>
      </li>
    </ul>

    <div class="tab-content tab-content-map">
      @if($mostra_mapa == 'S')
        <div role="tabpanel" class="tab-pane {{ $active_mapa}}" id="tab-map-venda">
          <div class="move-mouse"></div>
          <div id="mapa-vendas" class="details-map">
          <iframe src="/empreendimento/{{ $empreendimento->id }}/{{ $empreendimento->id*37 }}/visualizar-mapa/pdf" id="mapa-vendas-condominio" width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true"></iframe>
          </div>
          <div class="info">
            *Valores e disponibilidade podem sofrer alterações sem aviso prévio.
          </div>
        </div>
      @endif

      @if($tour360->count() > 0) 
        @php $i = 0; @endphp
        @foreach ($tour360 as $tour)
        @php $i++;@endphp
        @if ($i == 1)
        <div role="tabpanel" class="tab-pane {{ $active_tour}}" id="tab-tour-{{ $tour->id }}">
        @else
        <div role="tabpanel" class="tab-pane" id="tab-tour-{{ $tour->id }}">
        @endif
          <div id="mapa-tour" class="details-map">
            <iframe id="mapa-tour-virtual" width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true" src="{{ $tour->link }}"></iframe>
          </div>
        </div>
        @endforeach
      @endif

      <div role="tabpanel" class="tab-pane {{ $active_google}}" id="tab-map">
        <div id="estate-map" class="details-map"></div>
      </div>
      <div role="tabpanel" class="tab-pane" id="tab-street-view">
        <div id="estate-street-view" class="details-map"></div>
      </div>
    </div>
  </div>
</div>
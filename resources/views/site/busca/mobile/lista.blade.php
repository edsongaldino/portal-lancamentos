@foreach ($empreendimentos as $empreendimento)
  @php
    $icone_tipo = '';
    switch($empreendimento->subtipo_id):
      case 1:
        $icone_tipo = '<i class="fa fa-building"></i>';
      break;
      case 2:
        $icone_tipo = '<i class="fa fa-briefcase"></i>';
      break;
      case 3:
        $icone_tipo = '<i class="fa fa-home"></i>';
      break;
      case 4:
        $icone_tipo = '<i class="fa fa-tree"></i>';
      break;
    endswitch;
  @endphp

  <!-- Imovel Busca -->
  <div class="imovel-busca">
    <div class="entry-main01">
      <h1 class="entry-title">
        {{ $empreendimento->nome }}
      </h1>
      <div class="box-icone-tipo-{{ $empreendimento->subtipo_id }}" title="{{ $empreendimento->subtipo->nome }}">
        <?php echo $icone_tipo;?>
      </div>
      <span class="box-status-{{ url_amigavel($empreendimento->modalidade) }}">
        {{ $empreendimento->modalidade }}
      </span>
    </div>

    @php
      if($empreendimento->subtipo_id == 1) {
        $classe="apartamento";
      } elseif($empreendimento->subtipo_id == 2) {
        $classe="sala";
      } elseif($empreendimento->subtipo_id == 3) {
        $classe="condominio";
      } elseif($empreendimento->subtipo_id == 4) {
        $classe="residencial";
      } else{
        $classe= strtolower($empreendimento->getCaracteristica("tipo_condominio"));
      }
    @endphp
    <div class="post-featured animated fadeInRight">
      <div class="icones">
        <a href="https://facebook.com/sharer.php?u={{ $empreendimento->getUrlCompleta() }}" target="_blank" class="facebook">
          <div class="icone-compartilhar">
            <i class="fa fa-share-alt"></i>
          </div>
        </a>

        @if(false)
          @if(in_array($empreendimento->id, $array_empreendimentos_favoritos))
            <div class="icone-favoritar active" onclick="removeFavorito('{{ $empreendimento->id }}');">
              <i class="fa fa-heart"></i>
            </div>
          @else
            <div class="icone-favoritar" onclick="addFavorito('{{ $empreendimento->id }}');">
              <i class="fa fa-heart"></i>
            </div>
          @endif
        @else
          <a href="#">
            <div class="icone-favoritar">
              <i class="fa fa-heart"></i></div>
          </a>
        @endif
      </div>

      @if($empreendimento->TabelaAtiva->count() > 0)
      <div class="selo-oferta">
          <img src="/site/images/selo_proposta_online.png" alt="">
      </div>
      @elseif($empreendimento->selo_oferta)
        <div class="selo-oferta">
          <img src="/site/images/selos/{{ $empreendimento->selo_oferta }}" alt="">
        </div>
      @elseif($empreendimento->ofertasAtivas->count())
        <div class="selo-oferta">
          @if ($empreendimento->construtora_id == 13)
          <img src="/site/images/selo_oferta_13.png" alt="">
          @else
          <img src="/site/images/selo-black-friday.png" alt="">
          @endif
        </div>
      @else
        @if($empreendimento->subtipo_id == 3)
          <div class="tipo_empreendimento_{{ $classe }}">
            Condomínio
            @if($empreendimento->getCaracteristica('tipo_condominio'))
              ({{ $empreendimento->getCaracteristica('tipo_condominio') }})
            @endif
          </div>
        @else
          <div class="tipo_empreendimento_{{ $classe }}">
            {{ $empreendimento->subtipo->nome }}
          </div>
        @endif
      @endif

      <!-- Slide -->
      <div class="featured-gallery-slider animated fadeInRight">
        @foreach ($empreendimento->getFotosCarrossel() as $foto)
          <div class="featured-item">
            <div class="thumb">
              <a href="{{ $empreendimento->getUrl() }}">
                <img src="{{ $foto->getUrl() }}">
              </a>
            </div>
          </div>
        @endforeach
      </div>
      <!-- /Slide -->

      <!-- Detalhes -->
      <div class="linha">
        @if($empreendimento->subtipo_id == 2)
          <div class="esquerda">
            <span>
              Unidades
            </span>
            <p>
              {{ $empreendimento->unidades->count() }}
            </p>
          </div>
          <div class="meio">
            <span>
              Área (m²)
            </span>
            <p>
              {{ qtd_metragem($empreendimento)}} m<sup>2</sup>
            </p>
          </div>
        @elseif($empreendimento->subtipo->id == 3)
          <div class="esquerda">
            <span>
              Unidades
            </span>
            <p>
              {{ $empreendimento->unidades->count() }}
            </p>
          </div>
          <div class="meio">
            <span>
              Área (m²)
            </span>
            <p>
              {{ qtd_metragem($empreendimento) }} m<sup>2</sup>
            </p>
          </div>
        @elseif($empreendimento->variacao)
          @if ($empreendimento->variacao->nome == 'Lote')
            <div class="esquerda">
              <span>
                Unidades
              </span>
              <p>
                {{ $empreendimento->unidades->count() }}
              </p>
            </div>
            <div class="meio">
              <span>
                Área (m²)
              </span>
              <p>
                {{ $empreendimento->getCaracteristica("area_unidade_min") }} à {{ $empreendimento->getCaracteristica("area_unidade_max") }} m<sup>2</sup>
              </p>
            </div>
          @else
            <div class="esquerda">
              <span>
                Unidades
              </span>
              <p>
                {{ $empreendimento->unidades->count() }}
              </p>
            </div>
            <div class="meio">
              <span>
                Área (m²)
              </span>
              <p>
                {{ qtd_metragem($empreendimento) }} m<sup>2</sup>
              </p>
            </div>
          @endif
        @else
          <div class="esquerda">
            <span>
              Quartos
            </span>
            <p>
              {{ qtd_dormitorio($empreendimento, false, false) }}
            </p>
          </div>
          <div class="meio">
            <span>
              Área (m²)
            </span>
            <p>
              {!! qtd_metragem($empreendimento)!!} m<sup>2</sup>
            </p>

          </div>
        @endif

        <div class="direita">
          <span>À partir de</span>
          <p>
            @if ($empreendimento->ofertasAtivas->count() > 0)
              {{ $empreendimento->ofertaPrincipal('valor-por') }}
            @else
              @if($empreendimento->valor_inicial == 0 || ($empreendimento->caracteristicas->where('nome', 'ocultar_valor')->first() && $empreendimento->caracteristicas->where('nome', 'ocultar_valor')->first()->pivot->valor == 'S'))
                <span class="consultar-valores">Consultar</span>
              @else
                {{ $empreendimento->valor_inicial }}
              @endif
            @endif
          </p>
        </div>
      </div>
      <!-- /Detalhes -->
    </div>

    @if ($empreendimento->endereco)
    <div class="endereco-empreendimento">
        <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $empreendimento->endereco->bairro->nome }},{{ $empreendimento->endereco->cidade->nome }} - {{ $empreendimento->endereco->cidade->estado->nome }}
    </div>
    @endif

    @if($empreendimento->ofertasAtivas->count() > 0)
    <div class="info-oferta-site">
      De <span class="valor-de">{{ $empreendimento->ofertaPrincipal('valor-de') }}</span> por <span class="valor-por">{{ $empreendimento->ofertaPrincipal('valor-por') }}*</span>
    </div>
    <div class="button-field">
      <button type="button" name="submit" class="button-form oferta-mobile">
        <a class="botao" href="{{ $empreendimento->getUrl() }}">Mais Detalhes</a>
      </button>
    </div>
    @else
    <div class="button-field">
      <button type="button" name="submit" class="button-form">
        <a class="botao" href="{{ $empreendimento->getUrl() }}">Mais Detalhes</a>
      </button>
    </div>
    @endif
  </div>
  <!-- /Imovel Busca -->
@endforeach
@if(isset($ocultarLinks))
  <!-- -->
@else
    @include('site/busca/mobile/paginacao')
@endif

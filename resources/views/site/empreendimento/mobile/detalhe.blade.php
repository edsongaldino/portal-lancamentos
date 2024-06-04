<!-- Content Detalhes -->
<section id="conteudo-caracteristicas">
  <div class="content-container animated fadeInUp">
    <div class="widget-box">
      <h2 class="widget-description">
        <span class="descricao">{{ $empreendimento->descricao }}</span>
      </h2>

      <h3 class="widget-title">
        <span class="perfil">Características do Empreendimento</span>
      </h3>

      @if($empreendimento->variacao->id == 6 || $empreendimento->variacao->id == 10 || $empreendimento->variacao->id == 11)
        @include('site/empreendimento/mobile/lote2')
      @else
        <div class="small-listing-item">
          @if($empreendimento->subtipo_id == 3 || $empreendimento->subtipo_id == 4)
            @include('site/empreendimento/mobile/casa')
          @else
            
            @include('site/empreendimento/mobile/torre')
            
            @if($empreendimento->subtipo_id == 2)
              @include('site/empreendimento/mobile/comercial')
            @endif
            
            @if($empreendimento->subtipo_id == 1)
              @include('site/empreendimento/mobile/apartamento')
            @endif
          @endif
        </div>
        
        @if ($empreendimento->variacao)
          @if($empreendimento->variacao->id != 6 || $empreendimento->variacao->id != 10)
            @include('site/empreendimento/mobile/plantas')
          @endif
        @endif

      @endif      

      <div class="small-listing-item">
        <div class="entry-thumb1">
          <img src="/site/m/images/calendario-icon.png" alt="Entrega" title="Previsão de entrega">
        </div>
        <div class="entry-content1">
          <h2>
            Previsão de Entrega
            <br/>
            <span class="previsao-entrega">
              {{ get_previsao_entrega($empreendimento) }}
            </span>
          </h2>
        </div>
      </div>
  
      <div class="small-listing-item">
        <div class="entry-thumb1">
          <img src="/site/m/images/money-icon.png" alt="Valor" title="Valor da unidade">
        </div>
        <div class="entry-content1">


          @if($empreendimento->caracteristicas->where('nome', 'ocultar_valor')->first() && $empreendimento->caracteristicas->where('nome', 'ocultar_valor')->first()->pivot->valor == 'S')
          <h2>
            Valores somente com a construtora
            <br/>
            Consulte
          </h2>
          @else

          <h2>
            Valor à partir de:
            <br/>

             @if ($empreendimento->ofertasAtivas->count() > 0)
            <div class="valor-empreendimento">
              R$ {{ $empreendimento->ofertaPrincipal('valor-por') }}
            </div>
            @else
            <span class="valor-empreendimento">
              R$ {{ $empreendimento->valor_inicial }}
            </span>
            @endif
            
          </h2>

          @endif



        </div>
      </div>

    </div>      
  </div>
</section>
<!-- /Content Detalhes -->
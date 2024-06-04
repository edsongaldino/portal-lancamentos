<div class="small-listing-item">          
  <div class="entry-thumb1">
    <img src="/site/m/images/icones/planta-icon.png" alt="Plantas" title="Metragem das plantas">
  </div>

  <div class="entry-content1">
    <h2>
      {{ $empreendimento->plantas->count() }} Planta(s)
      <br/>
      <span class="previsao-entrega">
        @if (qtd_metragem($empreendimento, false))
        {{ qtd_metragem($empreendimento, false) }}m²   
        @else
        <span class="previsao-entrega">0,00 <span class="texto_previsao">m²</span></span>
        @endif
      </span>
    </h2>
  </div>

  <div id="demo-test-gallery" class="fotos-planta gallery-plantas">
    @php
      $plantas = $empreendimento->plantas;                
    @endphp

    @if ($plantas)      
      @foreach ($plantas as $planta)
        @php
          $foto = $planta->getFotoDestaque();
          $original = null;
          $media = null;

          if ($foto) {
            $original = $foto->getUrl('original');
            $media = $foto->getUrl('400x300');
            $tamanho = $foto->getTamanho('original');
          }
        @endphp

        <a href="{{ $original ?? '' }}" data-size="{{ $tamanho ?? '' }}" data-med="{{ $media ?? '' }}" data-med-size="{{ $tamanho ?? '' }}" data-author="Lançamentos Online">
          <div class="icone-foto-planta"></div>
          <figure class="texto">
            {{ $planta->nome }} - {{ $planta->area_privativa }}                  
          </figure>
        </a>
      @endforeach
    @endif
  </div>
</div>
<div class="icone-tipo">
  <i class="fa fa-home" aria-hidden="true"></i>
</div>
<div class="unidade-oferta">
  <div class="nome-torre">
    {{ $oferta->unidade->quadra->nome }}
  </div>
  <div class="dados-unidade">
    Unidade {{ $oferta->unidade->nome }}
  </div>
</div>                                        
@if($empreendimento->variacao->nome == "Lote")
  <div class="planta-oferta">
    <div class="texto-planta">
      <div class="nome-planta">
        Lote (M²)
      </div>
      <div class="metragem-planta">
        @php 
          $metragem = $oferta->unidade->caracteristicas->where('nome', 'metragem_total')->first();               
        @endphp
        @if ($metragem)
        {{ $metragem->pivot->valor }}m²
        @endif
      </div>
    </div>
    <div class="imagem-planta gallery-oferta">    
      @php 
        $foto_implantacao = $empreendimento->getFotoTipo('Implantação');
      @endphp
      <a @if ($foto_implantacao)
          href="/imagens/empreendimento/{{$empreendimento->id}}/original/{{ $foto_implantacao->arquivo }}"
        @else
          href="" 
        @endif
        class="{{ url_amigavel($foto_implantacao->tipo.$foto_implantacao->id)}}" 
        data-sub-html="{{ $foto_implantacao->tipo }}"
      >
        <img src="/site/images/icone-lote.png" alt="">
      </a>                                                
    </div>
  </div>
@else
  <div class="planta-oferta">
    <div class="texto-planta">
      <div class="nome-planta">
        @php 
          $dormitorios = $oferta->unidade->planta->caracteristicas->where('nome', 'qtd_dormitorio')->first();                 
        @endphp
        @if ($dormitorios)
          {{ $dormitorios->pivot->valor }}
        @endif
        Quarto(s)
      </div>
      <div class="metragem-planta">
        @php 
          $metragem = $oferta->unidade->caracteristicas->where('nome', 'metragem_total')->first();               
        @endphp
        @if ($metragem)
          {{ $metragem->pivot->valor }}
        @endif                                                  
        m²
      </div>
    </div>
    <div class="imagem-planta gallery-oferta {{ $oferta->unidade->planta->id }}">
      @php
      $oferta_fotos_planta = $oferta->unidade->planta->fotos;
      @endphp

      @foreach($oferta_fotos_planta as $oferta_foto_planta)
        @php           
          $metragem = $oferta_foto_planta->planta->area_privativa;          

          if ($metragem) {
            $metragem = $metragem->pivot->valor;
          }

          $planta_tipo = $oferta->unidade->planta->caracteristicas->where('nome', 'planta_tipo')->first();
        @endphp
        <a
          @if ($planta_tipo && $planta_tipo->pivot->valor == 3 && $loop->iteration > 1)
            style="display:none;"
          @endif 
          href="/imagens/empreendimento/{{ $empreendimento->id}}/original/{{ $oferta_foto_planta->arquivo }}" class="{{ url_amigavel($oferta_foto_planta->nome.$oferta->id)}}" data-sub-html="{{ $oferta_foto_planta->nome }} - Área Privativa ({{ converte_valor_real($metragem)}} m²)">
            <img src="/site/images/icone-planta.png" alt="">
        </a>
      @endforeach
    </div>
  </div>
@endif
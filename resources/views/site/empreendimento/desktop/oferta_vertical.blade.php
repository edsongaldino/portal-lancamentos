<div class="icone-tipo">
  <i class="fa fa-building" aria-hidden="true"></i>
</div>
<div class="unidade-oferta">
  <div class="nome-torre">
    {{ $oferta->unidade->torre->nome }}
  </div>
  <div class="dados-unidade">
    Unidade {{ $oferta->unidade->nome }}</b> 
    @if ($oferta->unidade->andar)
    Andar: {{ $oferta->unidade->andar->numero }}º
    @endif
  </div>
</div>
<div class="planta-oferta">
  <div class="texto-planta">
    <div class="nome-planta">
      @php 
        $dormitorios = $oferta->unidade->planta->caracteristicas->where('nome', 'planta_tipo')->first();
      @endphp
      @if ($dormitorios)
      {{ $dormitorios->pivot->valor }} Quarto(s)
      @endif  
    </div>
    <div class="metragem-planta">
      {{ $oferta->unidade->planta->area_privativa }}m²
    </div>
  </div>                                        
  <div class="imagem-planta gallery-oferta {{ $oferta->unidade->planta->id }}">  
    @php
      $fotos_planta = null;
      
      if ($oferta->unidade->planta) {
        $fotos_planta = $oferta->unidade->planta->fotos;  
      }      

      $planta_tipo = $oferta->unidade->planta->caracteristicas->where('nome', 'planta_tipo')->first();
      
    @endphp   
    @if ($fotos_planta)                         
      @foreach($fotos_planta as $foto)
        <a
        @if ($planta_tipo && $planta_tipo->pivot->valor == 3 && $loop->iteration > 1)
          style="display:none;"
        @endif 
        href="/imagens/empreendimento/{{ $empreendimento->id}}/original/{{ $foto->arquivo }}" class="{{ url_amigavel($foto->nome.$oferta->id)}}" data-sub-html="{{ $foto->nome }} - Área Privativa ({{ $metragem }} m²)">
          <img src="/site/images/icone-planta.png" alt="">
        </a>
      @endforeach
    @endif
  </div>                                          
</div>
<div class="desconto-oferta">
  <div class="icone-desconto"></div>
  <div class="valor-desconto">{{ $oferta->percentual_desconto}}%</div>
  <div class="info-desconto" title="Mais informações sobre os valores">
    <button type="button" class="btn btn-invisible" data-toggle="tooltip" data-html="true" title="<span class='valor-antigo'>De R$ <strike>{{ $oferta->preco_tabela }}</strike></span> <br/> <span class='valor-promocional'>Por R$ {{ $oferta->preco_oferta }}</span>">
      <i class="fa fa-info-circle" aria-hidden="true"></i>
    </button>                                   
  </div>
</div>                                    

<button type="button" 
  data-toggle="modal" 
  data-target="#modal-oferta" 
  data-id="{{ $oferta->id }}"
  data-tipo="Vertical"
  style="background: none; border: 0; padding: 0; margin-left: 10px">
    <div class="negociar-unidade">
      <img src="/site/images/negociar-unidade.png" alt="" title="Negociar esta unidade">
    </div>  
  </button>
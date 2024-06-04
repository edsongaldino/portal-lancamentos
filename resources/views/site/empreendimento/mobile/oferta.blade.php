@if ($empreendimento->ofertasAtivas->count() > 0)               
<section class="black-friday">
  <div class="topo">
    <div class="selo"><img src="/site/m/images/selo_blackmonth.png" alt=""></div>
    <div class="titulo-black">Confira abaixo as ofertas disponíveis para este empreendimento</div>
  </div>

  @foreach($empreendimento->ofertasAtivas as $oferta)
    <div class="item-oferta">
      @if($empreendimento->subtipo_id == 3 || $empreendimento->subtipo_id == 4)
        <div class="unidade-oferta">
          <div class="dados-unidade-oferta">
            <div class="icone-tipo">
              <i class="fa fa-home" aria-hidden="true"></i>
            </div>
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
                <div class="nome-planta">Metragem</div>
                <div class="metragem-planta">
                  @php 
                    $metragem = $oferta->unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor;
                  @endphp
                  {{ $metragem }}m²
                </div>
              </div>                      
              <div class="imagem-planta">
                <img src="/site/images/icone-lote.png" alt="">
              </div>
            </div>
          @else
            <div class="planta-oferta">
              <div class="texto-planta">
                <div class="nome-planta">
                  @php 
                    $qtd_quartos = $oferta->unidade->planta->caracteristicas->where('nome', 'qtd_dormitorio')->first();
                    if($qtd_quartos):
                      $quartos = $qtd_quartos->pivot->valor;
                    else:
                      $quartos = 0;
                    endif;
                  @endphp
                  <i class="fa fa-bed" aria-hidden="true" rel="tooltip" data-original-title="Quantidade de Dormitórios"></i> {{ $quartos }}
                </div>
                <div class="metragem-planta">                          
                  {{ $oferta->unidade->planta->area_privativa }}m²
                </div>
              </div>

              <div class="imagem-planta gallery-oferta {{ $oferta->unidade->planta->id }}">
                @php
                  $planta_tipo = $oferta->unidade->planta->caracteristicas->where('nome', 'planta_tipo')->first();

                  $planta_tipo2 = $oferta->unidade->planta->caracteristicas->where('nome', 'Tipo de Planta')->first();

                  $fotos_planta = null;
                  
                  if ($oferta->unidade->planta) {
                    $fotos_planta = $oferta->unidade->planta->fotos;  
                  }                          
                @endphp   
                @if ($fotos_planta)                         
                  @foreach($fotos_planta as $foto)
                    <a
                    @if ($planta_tipo && $planta_tipo->pivot->valor == 3 && $loop->iteration > 1)
                      style="display:none;"
                    @endif 
                    href="{{ $foto->getUrl() }}" class="{{ url_amigavel($foto->nome.$oferta->id)}}" data-sub-html="{{ $foto->nome }} - Área Privativa ({{ $oferta->unidade->planta->area_privativa }} m²)">
                      <img src="/site/m/images/icone-planta.png" alt="">
                    </a>
                  @endforeach
                @endif
              </div>
            </div>
          @endif
        </div>
      @else
        <div class="unidade-oferta">
          <div class="dados-unidade-oferta">
            <div class="icone-tipo">
              <i class="fa fa-building" aria-hidden="true"></i>
            </div>
            <div class="nome-torre">
              {{ $oferta->unidade->torre->nome }}                  
            </div>
            <div class="dados-unidade">
              Unidade {{ $oferta->unidade->nome }}
              Andar: {{ $oferta->unidade->andar->numero }}º
            </div>
          </div>
          <div class="planta-oferta">
            <div class="texto-planta">

              <div class="nome-planta">
                  @php 
                    $qtd_quartos = $oferta->unidade->planta->caracteristicas->where('nome', 'qtd_dormitorio')->first();
                    if($qtd_quartos):
                      $quartos = $qtd_quartos->pivot->valor;
                    else:
                      $quartos = 0;
                    endif;
                  @endphp
                  <i class="fa fa-bed" aria-hidden="true" rel="tooltip" data-original-title="Quantidade de Dormitórios"></i> {{ $quartos }}                                     
              </div>
              <div class="metragem-planta">
               {{ $oferta->unidade->planta->area_privativa }}m²                    
              </div>


            </div>                
          </div>
        </div>
      @endif
      <div class="valores-oferta">
        <div class="desconto-oferta">
          <div class="icone-desconto"></div>
          <div class="valor-desconto">
            {{ $oferta->percentual_desconto }}%
          </div>
        </div>
        <div class="valor-blackfriday">
          <div class="valor-tabela">
            De R$ {{ $oferta->preco_tabela }}
          </div>
          <div class="valor-oferta">
            Por R$ {{ $oferta->preco_oferta }}
          </div>
        </div>
            
        <a href="/empreendimento/proposta/{{ $oferta->id }}">
          <div class="negociar-unidade">
            <img src="https://www.lancamentosonline.com.br/site/images/negociar-unidade.png" alt="" title="Negociar esta unidade">
          </div>
        </a>
      </div>
    </div>
  @endforeach
</section>
@endif
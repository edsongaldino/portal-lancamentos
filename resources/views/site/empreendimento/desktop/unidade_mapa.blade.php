<div id="dados-unidade-reserva">

  @php
    $ocultar = $unidade->empreendimento->caracteristicas->where('nome', 'ocultar_valor')->first()->pivot->valor ?? '';
  @endphp

  <div class="unidade-lote">

    <div class="dados-lote">
      <div class="quadra">
          <div class="titulo">{{ $unidade->quadra->nome }}</div>
          <div class="valor">
            {{ $unidade->empreendimento->variacao->nome }} - <strong>{{ $unidade->nome }}</strong>
          </div>
      </div>
      <div class="lote">
          <div class="titulo">Terreno <a href="#" class="DimensoesLote" data-idunidade="{{ $unidade->id }}"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
          <div class="valor">
            {{ $unidade->getCaracteristica('metragem_total') ?? '' }}m²
          </div>
      </div>


      @if(isset($ocultar))

        @if($unidade->situacao == 'Vendida')
          <div class="terreno">
            <div class="titulo">Valor (M²)</div>
            <div class="valor">
              -
            </div>
          </div>
        @else
          @if($ocultar <> 'S' && $ocultar <> 'OD')

            @if($unidade->getCaracteristica('valor_m2'))
            <div class="terreno">
              <div class="titulo">Valor (M²)</div>
              <div class="valor">
                R$ {{ $unidade->getCaracteristica('valor_m2') ?? '' }}
              </div>
            </div>
            @else

              @if($unidade->getCaracteristica('valor_m2'))
              <div class="terreno">
                <div class="titulo">Valor (M²)</div>
                <div class="valor">
                  R$ {{ round($unidade->getCaracteristica('metragem_total')/$unidade->getCaracteristica('valor_m2')) }}
                </div>
              </div>
              @else
              <div class="terreno">
                <div class="titulo">Valor (M²)</div>
                <div class="valor">
                  Consulte
                </div>
              </div>
              @endif

            @endif

          @else

            <div class="terreno">
              <div class="titulo">Valor (M²)</div>
              <div class="valor">
                Consulte
              </div>
            </div>

          @endif

        @endif

      @endif

    </div>

    @if(isset($unidade->planta))
    <div class="dados-planta">

      <div class="planta">
        {{ $unidade->planta->nome }}
      </div>
      <div class="area_privativa">
          <div class="titulo">
          <img src="/site/imagem/icone/icone_planta.png" width="40" title="Área Privativa" alt="">
          </div>
          <div class="valor">
            {{ $unidade->planta->area_privativa }}m²
          </div>
      </div>

      <div class="quartos">
          <div class="titulo"><img src="/site/imagem/icone/icone_dormitorios.png" title="Quartos" width="40" alt=""></div>
          <div class="valor">
            {{  $unidade->planta->caracteristicas->where('nome', 'qtd_dormitorio')->first()->pivot->valor ?? ''}}
          </div>
      </div>

      <div class="suites">
          <div class="titulo"><img src="/site/imagem/icone/icone_suites_40x40.png" title="Suítes" width="40" alt=""></div>
          <div class="valor">
            {{ $unidade->planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor ?? ''}}
          </div>
      </div>

      <div class="garagem">
          <div class="titulo"><img src="/site/imagem/icone/icone_garagem2_40x40.png" title="Vagas de garagem" width="40" alt=""></div>
          <div class="valor">
            {{ $unidade->planta->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor ?? ''}}
          </div>
      </div>

    </div>
    @endif

    @if(isset($ocultar))
    @if($ocultar <> 'S' && $ocultar <> 'OD')
    @if($unidade->situacao == 'Disponível')
      <div class="valor-unidade">
        <div class="icone">
          <img src="/site/imagem/icone/icone_valor.png" width="40" alt="">
        </div>
        <div class="valor">
          <div class="info-valor">
            Valor desta unidade:
          </div>
          <div class="valor-item">
            @if($unidade->caracteristicas->where('nome', 'valor_unidade')->first() && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '' && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '0')
                R$ {{ converte_valor_real($unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor ?? '') }}
            @else
                @if($unidade->caracteristicas->where('nome', 'valor_m2')->first() && $unidade->caracteristicas->where('nome', 'metragem_total')->first())
                    @php
                        $valor_m2 = $unidade->caracteristicas->where('nome', 'valor_m2')->first()->pivot->valor ?? '';
                        $metragem = $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor ?? '';
                        $valor_unidade = $valor_m2 * $metragem;
                    @endphp

                    @if($valor_unidade <> '0')
                    R$ {{ converte_valor_real($valor_unidade) }}
                    @else
                    Consulte
                    @endif
                @else
                Consulte
                @endif
            @endif
          </div>
        </div>
      </div>
    @endif
    @endif
    @endif




    <div class="info">*Valores e disponibilidade podem sofrer alterações sem aviso prévio.</div>
  </div>
</div>


<script>
    $(".DimensoesLote").click(function (e) {

        ajaxRequest({
        url: '/unidade/dimensao-lote',
        metodo: 'POST',
        dados: {
            unidade: $(this).attr("data-idunidade"),
            ocultar: 'N'
        },
        feedback: false,
        resultado: '#box_tamanho_lote'
        });

        $("#modalTamanhoLote").modal("show");

    });
</script>

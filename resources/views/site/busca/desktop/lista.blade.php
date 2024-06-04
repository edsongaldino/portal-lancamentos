<div class="col-xs-12" id="empreendimentos_lista">
  <div class="sessao-busca">
      <div class="item-sessao-busca" id="sessao_busca_construtoras" style="display: none">Construtora(s) <i class="fa fa-close close remover-parametro" data-id="construtora_id_multiplo" data-complemento="sessao_busca_construtoras" aria-hidden="true" title="Remover parâmetro"></i></div>

      <div class="item-sessao-busca" id="sessao_busca_subtipos" style="display: none">Tipo(s): <i class="fa fa-close close remover-parametro" data-id="subtipo_id_multiplo" data-complemento="sessao_busca_subtipos" aria-hidden="true" title="Remover parâmetro"></i></div>

      <div class="item-sessao-busca" id="sessao_busca_modalidades" style="display: none">Etapa(s): <i class="fa fa-close close remover-parametro" data-id="modalidade_id_multiplo" data-complemento="sessao_busca_modalidades" aria-hidden="true" title="Remover parâmetro"></i></div>

      <div class="item-sessao-busca cidade_id_multiplo" id="sessao_busca_cidades" style="display: none">Cidade <i class="fa fa-close close remover-parametro" data-id="cidade_id_multiplo" data-complemento="sessao_busca_cidades" aria-hidden="true" title="Remover parâmetro"></i></div>

      <div class="item-sessao-busca bairro_id_multiplo" id="sessao_busca_bairros" style="display: none">Bairro <i class="fa fa-close close remover-parametro" data-id="bairro_id_multiplo" data-complemento="sessao_busca_bairros" aria-hidden="true" title="Remover parâmetro"></i></div>

      <div class="item-sessao-busca" id="sessao_busca_valor" style="display: none">Valor: <i class="fa fa-close close remover-parametro" data-id="valor" aria-hidden="true" title="Remover parâmetro"></i></div>

      <div class="item-sessao-busca" id="sessao_busca_quarto" style="display: none">Quartos: <i class="fa fa-close close remover-parametro" data-id="quarto" aria-hidden="true" title="Remover parâmetro"></i></div>

      <div class="item-sessao-busca" id="sessao_busca_area" style="display: none">Área: <i class="fa fa-close close remover-parametro" data-id="area" aria-hidden="true" title="Remover parâmetro"></i></div>
  </div>
  <div style="clear: both;"></div>

  @foreach($empreendimentos AS $empreendimento)
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

    <div class="list-offer">
      <div class="list-offer-left">
        <div class="list-offer-front">
          @if($empreendimento->TabelaAtiva->count() > 0)
            <div class="selo-oferta-list">
                <img src="/site/images/selo_proposta_online.png" alt="">
            </div>
          @elseif($empreendimento->selo_oferta)
            <div class="selo-oferta-list">
              <img src="/site/images/selos/{{ $empreendimento->selo_oferta }}" alt="">
            </div>
          @elseif ($empreendimento->ofertasAtivas->count() > 0)
            @if ($empreendimento->construtora_id == 13)
            <div class="selo-oferta-list"><a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html"><img src="/site/images/selo_oferta_13.png" alt=""></a></div>
            @else
            <div class="selo-oferta-list"><a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html"><img src="/site/images/selo-black-friday-list.png" alt=""></a></div>
            @endif
          @endif

          <div class="list-offer-photo">
            <a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html">
              <img src="{{ $empreendimento->fotoPrincipal() }}" alt="" />
            </a>
            <div class="type-container">
              @if ($empreendimento->subtipo_id == 1)
                <div class="estate-type"><i class="fa fa-building" aria-hidden="true" title="Apartamento"></i></div>
              @elseif ($empreendimento->subtipo_id == 2)
                <div class="estate-type"><i class="fa fa-briefcase" aria-hidden="true" title="Salas Comerciais"></i></div>
              @else
                <div class="estate-type"><i class="fa fa-home" aria-hidden="true" title="Casas em Condomínio"></i></div>
              @endif

              @if ($empreendimento->modalidade == 'Lançamento')
                <div class="transaction-type lancamento" title="Lançamento">L</div>
              @elseif ($empreendimento->modalidade == 'Em Obra')
                <div class="transaction-type obra" title="Em Obra">O</div>
              @elseif ($empreendimento->modalidade == 'Breve')
                <div class="transaction-type breve" title="Breve Lançamento">B</div>
              @else
                <div class="transaction-type mude-ja" title="Pronto para Morar">P</div>
              @endif
            </div>
          </div>

          @php
            $suites = qtd_suites($empreendimento);
          @endphp

          @if($empreendimento->subtipo_id == 1)
            <div class="list-offer-params">
              <div class="list-area">
                <img src="/site/images/area-icon.png" alt="" title="Metragem das Plantas" />
                {!! qtd_metragem($empreendimento) !!}m<sup>2</sup>
              </div>
              <div class="list-rooms">
                <img src="/site/images/rooms-icon.png" alt="" title="Quantidade de Dormitórios" />
                {!! qtd_dormitorio($empreendimento, true) !!}
              </div>

              @if (qtd_suites($empreendimento) > 0)
                <div class="list-baths" data-suite="{{ $suites }}">
                  <img src="/site/images/bathrooms-icon.png" alt="" title="Quantidade de Suítes" />
                  {!! qtd_suites($empreendimento) !!}
                </div>
              @endif
            </div>

          @elseif($empreendimento->subtipo_id == 2)
            <div class="list-offer-params">
              <div class="list-area-comercial">
                <img src="/site/images/area-icon.png" alt="" />Salas à partir de {{qtd_metragem($empreendimento, true) }} m<sup>2</sup>
              </div>
              <div class="list-estacionamento">
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
                  "/>
              </div>
            </div>
          @elseif ($empreendimento->subtipo_id == 3)
            @if ($empreendimento->variacao_id == 6)
              <div class="list-offer-params">
                <div class="list-area-lotes">
                  <img src="/site/images/area-icon.png" alt="" />Lotes de {{ $area_unidade_min }} à {{ $area_unidade_max }} m<sup>2</sup>
                </div>
              </div>
            @else
              <div class="list-offer-params">
                <div class="list-area">
                  <img src="/site/images/area-icon.png" alt="" />
                  {{ qtd_metragem($empreendimento)}} m<sup>2</sup>
                </div>
                <div class="list-rooms">
                  <img src="/site/images/rooms-icon.png" alt="" />
                  {!! qtd_dormitorio($empreendimento) !!}
                </div>
                @if ($suites)
                  <div class="list-baths">
                    <img src="/site/images/bathrooms-icon.png" alt="" />
                    {{ $suites }}
                  </div>
                @endif
              </div>
            @endif
          @elseif ($empreendimento->subtipo_id == 4)
            @if ($empreendimento->variacao_id == 10)
              <div class="list-offer-params">
                <div class="list-area-lotes">
                  <img src="/site/images/area-icon.png" alt="" />Lotes de {{ $area_unidade_min }} à {{ $area_unidade_max }} m<sup>2</sup>
                </div>
              </div>
            @else
              <div class="list-offer-params">
                <div class="list-area">
                  <img src="/site/images/area-icon.png" alt="" />
                  {{ $area_unidade_min }} m<sup>2</sup>
                </div>
                <div class="list-rooms">
                  <img src="/site/images/rooms-icon.png" alt="" />
                  {!! qtd_dormitorio($empreendimento, true) !!}
                </div>
                @if ($suites)
                  <div class="list-baths">
                    <img src="/site/images/bathrooms-icon.png" alt="" />
                    {{ $suites }}
                  </div>
                @endif
              </div>
            @endif
          @else
            <div class="list-offer-params">
              <div class="list-area">
                <img src="/site/images/area-icon.png" alt="" />
                {{ qtd_metragem($empreendimento)}} m<sup>2</sup>
              </div>

              <div class="list-rooms">
                <img src="/site/images/rooms-icon.png" alt="" />
                {!! qtd_dormitorio($empreendimento, true) !!}
              </div>
              @if ($suites)
                <div class="list-baths">
                  <img src="/site/images/bathrooms-icon.png" alt="" />
                  {{ $suites }}
                </div>
              @endif
            </div>
          @endif
        </div>
        <div class="list-offer-back">
          <div id="list-map1" class="list-offer-map"></div>
        </div>
      </div>
      <div class="list-offer-right @if(isset($pagina)){{ $pagina }}@endif">
        <div class="list-offer-text">
          @if(isset($_SESSION['fb_user_name']))
            @if(in_array($empreendimento->id, $array_empreendimentos_favoritos))
              <div class="list-favorite active" onclick="removeFavorito('{{ $empreendimento->id}}')"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></div>
            @else
              <div class="list-favorite" onclick="addFavorito('{{ $empreendimento->id }}')"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></div>
            @endif
          @else
            <div class="list-favorite" data-toggle="modal" data-target="#login-modal"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></div>
          @endif
            <a href="http://facebook.com/sharer.php?u=https://www.lancamentosonline.com.br/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html" target="_blank" class="facebook"><div class="list-share">
              <i class="fa fa-share-alt fa-2x" aria-hidden="true"></i></div>
            </a>
            <div class="list-offer-h4">
              <h4 class="list-offer-title">{{ $empreendimento->nome }}</h4>
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

          <div class="list-offer-resumo">
            <a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html">{{ substr($empreendimento->descricao, 0, 200)}}</a>
          </div>

          <div class="list-offer-construtora">
            <img src="{{ $empreendimento->construtora->getLogoUrl('125x95') }}" width="80" alt="">
          </div>

          <div class="clearfix"></div>
        </div>
        <div class="profile-list-footer">

          @if ($empreendimento->ofertasAtivas->count() > 0)
          <div class="list-price profile-list-price blackfriday" title="À partir de:">
            De <span class="valor-de">{{ $empreendimento->ofertaPrincipal('valor-de') }}</span> por <span class="valor-por">{{ $empreendimento->ofertaPrincipal('valor-por') }}*</span>
          </div>
          @else
          <div class="list-price profile-list-price" title="À partir de:">
            @if($empreendimento->caracteristicas->where('nome', 'ocultar_valor')->first() && $empreendimento->caracteristicas->where('nome', 'ocultar_valor')->first()->pivot->valor == 'S')
              <i class="fa fa-angle-double-up" aria-hidden="true" title="À partir de:"></i> Consultar
            @else
              <i class="fa fa-angle-double-up" aria-hidden="true" title="À partir de:"></i> R$ {{ $empreendimento->valor_inicial }}
            @endif
          </div>
          @endif

          @php
            $previsao = get_previsao_entrega($empreendimento);
          @endphp

          @if ($previsao == 'Pronto')
            <a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html" class="profile-list-entrega" title="Previsão de entrega">
            <i class="fa fa-key" aria-hidden="true"></i>
            PRONTO
          @else
            <a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html" class="profile-list-entrega aguardando" title="Previsão de entrega">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            {{ $previsao }}
          @endif
          </a>
          <div class="profile-list-info hidden-xs">

          </div>
          <div class="profile-list-info hidden-xs hidden-sm hidden-md">

          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  @endforeach
</div>

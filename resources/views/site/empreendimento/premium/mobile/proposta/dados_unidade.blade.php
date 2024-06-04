@if($empreendimento->subtipo_id == 1 || $empreendimento->subtipo_id == 2)
    <div class="detalhe-unidade condicoes">
        <h2><i class="fas fa-info-circle" aria-hidden="true"></i> Dados da Unidade</h2>

        <div class="btn-info-unidade mostrar"><i class="fas fa-chevron-down" aria-hidden="true"></i> Mostrar</div>
        <div class="btn-info-unidade ocultar" style="display: none;"><i class="fas fa-chevron-up" aria-hidden="true"></i> Ocultar</div>

        <div id="dadosUnidade" style="display: none;">
            <div class="caracteristicas">
                <div class="item">
                    <div class="icone-caracteristica"><i class="fa fa-building" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">{{ $unidade->andar->numero ?? '' }}º Andar</div>
                    <div class="valor-caracteristica">{{ $unidade->nome ?? '' }}</div>
                </div>
                <div class="item">
                    <div class="icone-caracteristica"><i class="fa fa-object-group" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">{{ $unidade->planta->nome ?? '' }}</div>
                    <div class="valor-caracteristica">{{ $unidade->planta->area_privativa ?? '' }}m²</div>
                </div>
                @if(isset($unidade->garagem))
                <div class="item">
                    <div class="icone-caracteristica"><i class="fa fa-car" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">
                        @if(isset($unidade->garagem->first()->tipo_vaga) && ($unidade->garagem->first()->tipo_vaga == 'Gaveta Coberta' || $unidade->garagem->first()->tipo_vaga == 'Gaveta Descoberta'))
                            {{ $unidade->garagem->count()*2 ?? '' }} Vaga(s)
                        @else
                            {{ $unidade->garagem->count() ?? '' }} Vaga(s)
                        @endif
                    </div>
                    <div class="valor-caracteristica">{{ unidade_vagas($unidade->id) }}</div>
                </div>
                @else
                    @if (isset($unidade->planta))
                        <div class="item">
                            <div class="icone-caracteristica"><i class="fa fa-car" aria-hidden="true"></i></div>
                            <div class="titulo-caracteristica">
                                {{ $unidade->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor ?? '' }} Vagas
                            </div>
                            <div class="valor-caracteristica">-</div>
                        </div>
                    @else

                    @endif
                @endif
                @if (isset($unidade->planta))


                @if ($unidade->planta->caracteristicas->where('nome', 'laje_tecnica')->first())
                <div class="item">
                    <div class="icone-caracteristica"><i class="fas fa-border-style" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Laje Téc.</div>
                    <div class="valor-caracteristica">{{  $unidade->planta->caracteristicas->where('nome', 'laje_tecnica')->first()->pivot->valor ?? '' }}m²</div>
                </div>
                @endif


                <div class="item">
                    <div class="icone-caracteristica"><i class="fa fa-bed" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">
                        @if($unidade->planta->caracteristicas->where('nome', 'qtd_dormitorio')->first() <> null)
                            {{ $unidade->planta->caracteristicas->where('nome', 'qtd_dormitorio')->first()->pivot->valor ?? '' }} Quartos</div>
                            @if($unidade->planta->caracteristicas->where('nome', 'qtd_suite')->first() && $unidade->planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor <> '')
                            <div class="valor-caracteristica">{{ $unidade->planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor ?? '' }} Suítes</div>
                            @else
                            <div class="valor-caracteristica">-</div>
                            @endif
                        @else
                        <div class="valor-caracteristica">-</div>
                        @endif
                </div>

                @endif
                <div class="item">
                    <div class="icone-caracteristica"><i class="fab fa-uncharted" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Posição</div>
                    <div class="valor-caracteristica">{{ $unidade->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor ?? '' }}</div>
                </div>
                <div class="item">
                    <div class="icone-caracteristica {{ url_amigavel($unidade->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor ?? '') }}"><i class="fas fa-cloud-sun" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Tipo Sol</div>
                    <div class="valor-caracteristica">{{ $unidade->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor ?? '' }}</div>
                </div>
            </div>

            @if (isset($unidade->planta))
            @php
            $foto_planta = $unidade->planta->getFotoDestaque();
            @endphp
            @if(isset($foto_planta))
            <a data-toggle="modal" data-target="#ModalPlanta">

                <div class="planta-unidade" style="background-image: url({{ $foto_planta->getUrl('400x300') ?? '' }});">
                    <div class="titulo-planta">Detalhes da Planta</div>
                </div>

            </a>
            @endif
            @endif


            @php
            $foto = $empreendimento->fotos->where('tipo', '<>', 'Implantação')->where('status', 'Liberada')->first();
            $fotos_decorado = $empreendimento->fotos->where('tipo', 'Decorado')->where('status', 'Liberada');
            $primeira_foto = $fotos_decorado->first();
            @endphp

            @if(isset($primeira_foto))
            <a data-fancybox="galleryDecorado" href="{{ $primeira_foto->getUrl('original') }}" data-caption="{{ $primeira_foto->nome }}">
                <div class="fotos-decorado" style="background-image: url({{ $primeira_foto->getUrl('400x300') }});">
                    <div class="titulo-decorado">Unidade Decorada </div>
                </div>
            </a>
            @else
            <a data-fancybox="gallery" href="{{ $foto->getUrl('original') }}" data-caption="{{ $foto->nome }}">
                <div class="fotos-decorado" style="background-image: url({{ $foto->getUrl('400x300') }});">
                    <div class="titulo-decorado">Fotos </div>
                </div>
            </a>
            @endif

            <div class="valor-unidade-topo">
                <span class="titulo">Valor da Unidade</span><br/>
                @if($unidade->caracteristicas->where('nome', 'valor_unidade')->first() && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '' && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '0')
                    R$ {{ converte_valor_real($unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor) }}
                @else
                    @if($unidade->caracteristicas->where('nome', 'valor_m2')->first() && $unidade->caracteristicas->where('nome', 'metragem_total')->first())
                        @php
                            $valor_m2 = $unidade->caracteristicas->where('nome', 'valor_m2')->first()->pivot->valor;
                            $metragem = $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor;
                        @endphp
                        R$ {{ converte_valor_real($valor_m2 * $metragem) }}
                    @else
                        Consulte
                    @endif
                @endif

                <div class="descricao-valor">

                    @if(isset($tabela->desconto_avista))
                    Pagamento à vista: <strong>{{ converte_valor_real(calcular_valor(valor_unidade($unidade), $tabela->desconto_avista, 'ValorComDesconto', $tabela)) }}</strong><span class="desconto-avista"> (Desconto de {{ $tabela->desconto_avista }}%)</span><br/>
                    @endif

                    @if(isset($tabela->correcao_obra))
                        @if($tabela->correcao_obra == 'Não' || $tabela->correcao_obra == '')
                            Correção (Período de obra): <strong>S/ Correção</strong>
                        @else
                            Correção (Período de obra): <strong>{{ $tabela->correcao_obra ?? '' }}</strong>
                        @endif
                    @endif

                </div>

            </div>

        </div>
    </div>
@elseif($empreendimento->subtipo_id == 3)

    @if($empreendimento->variacao->nome == "Lote")

        <div class="detalhe-unidade condicoes">

            <h2><i class="fas fa-info-circle" aria-hidden="true"></i> Dados da Unidade</h2>

            <div class="btn-info-unidade mostrar"><i class="fas fa-chevron-down" aria-hidden="true"></i> Mostrar</div>
            <div class="btn-info-unidade ocultar" style="display: none;"><i class="fas fa-chevron-up" aria-hidden="true"></i> Ocultar</div>

            <div id="dadosUnidade" style="display: none;">

                <div class="caracteristicas lote">
                    <div class="item">
                        <div class="icone-caracteristica"><i class="fa fa-building" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">{{ $unidade->quadra->nome }}</div>
                        <div class="valor-caracteristica">{{ $unidade->empreendimento->variacao->nome }} - <strong>{{ $unidade->nome }}</strong></div>
                    </div>
                    @if($unidade->getCaracteristica('valor_m2'))
                    <div class="item">
                        <div class="icone-caracteristica"><i class="fas fa-border-style" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Valor (M²)</div>
                        <div class="valor-caracteristica">R$ {{ converte_valor_real($unidade->getCaracteristica('valor_m2') ?? '') }}</div>
                    </div>
                    @else
                    <div class="item">
                        <div class="icone-caracteristica"><i class="fab fa-uncharted" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Valor (M²)</div>
                        <div class="valor-caracteristica">R$ {{ converte_valor_real($unidade->getCaracteristica('metragem_total')/$unidade->getCaracteristica('valor_m2')) }}</div>
                    </div>
                    @endif
                    <div class="item">
                        <div class="icone-caracteristica"><i class="fa fa-object-group" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Terreno</div>
                        <div class="valor-caracteristica">{{ $unidade->getCaracteristica('metragem_total') ?? '' }}m²</div>
                    </div>
                    <div class="item">
                        <div class="icone-caracteristica"><i class="fa fa-object-group" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica" title="">Dimensões (P.F.F)</div>
                        <div class="valor-caracteristica">44,5x55,25/50,45</div>
                    </div>
                </div>

                <div class="valor-unidade-topo">
                    <span class="titulo">Valor da Unidade</span><br/>

                    @if($unidade->caracteristicas->where('nome', 'valor_unidade')->first() && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '' && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '0')
                        R$ {{ converte_valor_real($unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor) }}
                    @else
                        @if($unidade->caracteristicas->where('nome', 'valor_m2')->first() && $unidade->caracteristicas->where('nome', 'metragem_total')->first())
                            @php
                                $valor_m2 = $unidade->caracteristicas->where('nome', 'valor_m2')->first()->pivot->valor;
                                $metragem = $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor;
                            @endphp
                            R$ {{ converte_valor_real($valor_m2 * $metragem) }}
                        @else
                            Consulte
                        @endif
                    @endif

                    <div class="descricao-valor">

                        @if(isset($tabela->desconto_avista))
                        Pagamento à vista: <strong>{{ converte_valor_real(calcular_valor(valor_unidade($unidade), $tabela->desconto_avista, 'ValorComDesconto', $tabela)) }}</strong><span class="desconto-avista"> (Desconto de {{ $tabela->desconto_avista }}%)</span><br/>
                        @endif

                        @if(isset($tabela->correcao_obra))
                            @if($tabela->correcao_obra == 'Não' || $tabela->correcao_obra == '')
                                Correção (Período de obra): <strong>S/ Correção</strong>
                            @else
                                Correção (Período de obra): <strong>{{ $tabela->correcao_obra ?? '' }}</strong>
                            @endif
                        @endif

                    </div>

                </div>
            </div>
        </div>

    @else

        <div class="detalhe-unidade condicoes">
            <h2><i class="fas fa-info-circle" aria-hidden="true"></i> Dados da Unidade</h2>

            <div class="btn-info-unidade mostrar"><i class="fas fa-chevron-down" aria-hidden="true"></i> Mostrar</div>
            <div class="btn-info-unidade ocultar" style="display: none;"><i class="fas fa-chevron-up" aria-hidden="true"></i> Ocultar</div>

            <div id="dadosUnidade" style="display: none;">

                <div class="caracteristicas">
                    <div class="item">
                        <div class="icone-caracteristica"><i class="fa fa-building" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">{{ $unidade->quadra->nome }}</div>
                        <div class="valor-caracteristica">{{ $unidade->empreendimento->variacao->nome }} - <strong>{{ $unidade->nome }}</strong></div>
                    </div>
                    <div class="item">
                        <div class="icone-caracteristica"><i class="fa fa-object-group" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">{{ $unidade->planta->nome ?? '' }}</div>
                        <div class="valor-caracteristica">{{ $unidade->planta->area_privativa ?? '' }}m²</div>
                    </div>
                    <div class="item">
                        <div class="icone-caracteristica"><i class="fab fa-uncharted" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Posição</div>
                        <div class="valor-caracteristica">{{ $unidade->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor ?? '' }}</div>
                    </div>
                    <div class="item">
                        <div class="icone-caracteristica {{ url_amigavel($unidade->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor ?? '') }}"><i class="fas fa-cloud-sun" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Tipo Sol</div>
                        <div class="valor-caracteristica">{{ $unidade->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor ?? '' }}</div>
                    </div>
                </div>

                @if (isset($unidade->planta))
                @php
                $foto_planta = $unidade->planta->getFotoDestaque();
                @endphp
                @if(isset($foto_planta))
                <a data-toggle="modal" data-target="#exampleModal">

                    <div class="planta-unidade" style="background-image: url({{ $foto_planta->getUrl('400x300') ?? '' }});">
                        <div class="titulo-planta">Detalhes da Planta</div>
                    </div>

                </a>
                @endif
                @endif


                @php
                $foto = $empreendimento->fotos->where('tipo', '<>', 'Implantação')->where('status', 'Liberada')->first();
                $fotos_decorado = $empreendimento->fotos->where('tipo', 'Decorado')->where('status', 'Liberada');
                $primeira_foto = $fotos_decorado->first();
                @endphp

                @if(isset($primeira_foto))
                <a data-fancybox="galleryDecorado" href="{{ $primeira_foto->getUrl('original') }}" data-caption="{{ $foto->nome }}">
                    <div class="fotos-decorado" style="background-image: url({{ $primeira_foto->getUrl('400x300') }});">
                        <div class="titulo-decorado">Unidade Decorada </div>
                    </div>
                </a>
                @else
                <a data-fancybox="gallery" href="{{ $foto->getUrl('original') }}" data-caption="{{ $foto->nome }}">
                    <div class="fotos-decorado" style="background-image: url({{ $foto->getUrl('400x300') }});">
                        <div class="titulo-decorado">Fotos </div>
                    </div>
                </a>
                @endif

                <div class="valor-unidade-topo">
                    <span class="titulo">Valor da Unidade</span><br/>
                    {{ valor_unidade($unidade) }}

                    <div class="descricao-valor">

                        @if(isset($tabela->desconto_avista))
                        Pagamento à vista: <strong>{{ converte_valor_real(calcular_valor(valor_unidade($unidade), $tabela->desconto_avista, 'ValorComDesconto', $tabela)) }}</strong><span class="desconto-avista"> (Desconto de {{ $tabela->desconto_avista }}%)</span><br/>
                        @endif

                        @if(isset($tabela->correcao_obra))
                            @if($tabela->correcao_obra == 'Não' || $tabela->correcao_obra == '')
                                Correção (Período de obra): <strong>S/ Correção</strong>
                            @else
                                Correção (Período de obra): <strong>{{ $tabela->correcao_obra ?? '' }}</strong>
                            @endif
                        @endif

                    </div>

                </div>
            </div>
        </div>

    @endif

@endif

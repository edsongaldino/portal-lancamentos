@extends('site/empreendimento/premium/layout_interno')

@push('meta')
<title>INICIO</title>
@endpush

@section('content')

    <div class="conteudo">

        @if($empreendimento->subtipo_id == 1)

        @php
        $fotoUnidadeMapa = getImplantacaoUnidade($unidade->id);
        @endphp

        <a data-fancybox="galleryMapa" href="{{ $fotoUnidadeMapa ?? '' }}" data-caption="Localização da Unidade">
            <div class="implantacao-3d">
                <img id="myMap" src="{{ $fotoUnidadeMapa ?? '' }}" class="img-responsive" usemap="#Map" alt="Image"/>
                <div class="titulo-mapa-horizontal"><i class="fab fa-uncharted" aria-hidden="true"></i> Clique aqui para ampliar</div>
            </div>
        </a>

        <div class="detalhe-unidade">

            <div class="valor-unidade">
                <i class="fa fa-usd" aria-hidden="true"></i>
                {{ get_valor_unidade($unidade) }}
                <br/>
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
                @if(isset($unidade->planta))
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

                @if(isset($unidade->garagem))
                @if($unidade->garagem->count() > 0)
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
                <div class="item">
                    <div class="icone-caracteristica"><i class="fa fa-car" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">
                        {{  $unidade->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor ?? '' }} Vagas
                    </div>
                    <div class="valor-caracteristica">-</div>
                </div>
                @endif
                @else
                    @if ($unidade->planta)
                        <div class="item">
                            <div class="icone-caracteristica"><i class="fa fa-car" aria-hidden="true"></i></div>
                            <div class="titulo-caracteristica">
                                {{ $unidade->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor ?? '' }} Vagas
                            </div>
                            <div class="valor-caracteristica">-</div>
                        </div>
                    @else
                    <div class="item">
                        <div class="icone-caracteristica"><i class="fa fa-car" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">
                            {{ $unidade->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor ?? '' }} Vagas
                        </div>
                        <div class="valor-caracteristica">-</div>
                    </div>
                    @endif
                @endif

                <div class="item">
                    <div class="icone-caracteristica"><i class="fab fa-uncharted" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Posição</div>
                    @if($unidade->caracteristicas->where('nome', 'posicao_unidade_torre')->first() <> '')
                    <div class="valor-caracteristica uppercase">{{ $unidade->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor ?? '' }}</div>
                    @else
                    <div class="valor-caracteristica">-</div>
                    @endif
                </div>
                <div class="item">
                    <div class="icone-caracteristica {{ url_amigavel($unidade->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor ?? '') }}"><i class="fas fa-cloud-sun" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Tipo Sol</div>
                    <div class="valor-caracteristica">{{ $unidade->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor ?? '' }}</div>
                </div>

            </div>
            @if ($unidade->planta)
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

        </div>

        @elseif($empreendimento->subtipo_id == 2)

        @php
        $fotoUnidadeMapa = getImplantacaoUnidade($unidade->id);
        @endphp

        <a data-fancybox="galleryMapa" href="{{ $fotoUnidadeMapa ?? '' }}" data-caption="Localização da Unidade">
            <div class="implantacao-3d">
                <img id="myMap" src="{{ $fotoUnidadeMapa ?? '' }}" class="img-responsive" usemap="#Map" alt="Image"/>
                <div class="titulo-mapa-horizontal"><i class="fab fa-uncharted" aria-hidden="true"></i> Clique aqui para ampliar</div>
            </div>
        </a>

        <div class="detalhe-unidade">

            <div class="valor-unidade">
                <i class="fa fa-usd" aria-hidden="true"></i>
                    @if($unidade->caracteristicas->where('nome', 'valor_unidade')->first() && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '')
                        {{ converte_valor_real($unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor) }}
                    @else
                        @if($unidade->caracteristicas->where('nome', 'valor_m2')->first() && $unidade->caracteristicas->where('nome', 'metragem_total')->first())
                            @php
                                $valor_m2 = $unidade->caracteristicas->where('nome', 'valor_m2')->first()->pivot->valor;
                                $metragem = $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor;
                            @endphp
                            {{ converte_valor_real(($valor_m2 || '0') * ($metragem || '0')) }}
                        @else
                            Consulte
                        @endif
                    @endif
                <br/>
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
                @if($unidade->garagem->count() > 0)
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
                <div class="item">
                    <div class="icone-caracteristica"><i class="fa fa-car" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">
                        {{  $unidade->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor ?? '' }} Vagas
                    </div>
                    <div class="valor-caracteristica">-</div>
                </div>
                @endif
                @else
                    @if ($unidade->planta)
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


                @if($unidade->planta->caracteristicas->where('nome', 'laje_tecnica')->first())
                <div class="item">
                    <div class="icone-caracteristica"><i class="fas fa-border-style" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Laje Téc.</div>
                    <div class="valor-caracteristica">{{  $unidade->planta->caracteristicas->where('nome', 'laje_tecnica')->first()->pivot->valor ?? '' }}m²</div>
                </div>
                @endif

                <div class="item">
                    <div class="icone-caracteristica"><i class="fab fa-uncharted" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Posição</div>
                    @if($unidade->caracteristicas->where('nome', 'posicao_unidade_torre')->first() <> '')
                    <div class="valor-caracteristica uppercase">{{ $unidade->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor ?? '' }}</div>
                    @else
                    <div class="valor-caracteristica">-</div>
                    @endif
                </div>
                <div class="item">
                    <div class="icone-caracteristica {{ url_amigavel($unidade->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor ?? '') }}"><i class="fas fa-cloud-sun" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Tipo Sol</div>
                    <div class="valor-caracteristica">{{ $unidade->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor ?? '' }}</div>
                </div>

            </div>
            @if ($unidade->planta)
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

        </div>

        @elseif($empreendimento->subtipo_id == 3 || $empreendimento->subtipo_id == 4)

            @php
            $fotoUnidadeMapa = getMapaUnidade($unidade->id);
            @endphp

            <a data-fancybox="galleryMapa" href="{{ $fotoUnidadeMapa ?? '' }}" data-caption="Localização da Unidade">
            <div class="implantacao-3d">
                <img id="myMap" src="{{ $fotoUnidadeMapa ?? '' }}" class="img-responsive" usemap="#Map" alt="Image"/>
                <div class="titulo-mapa-horizontal"><i class="fab fa-uncharted" aria-hidden="true"></i> Clique aqui para ampliar</div>
            </div>
            </a>

            <div class="detalhe-unidade">

                <div class="valor-unidade">
                    <i class="fa fa-usd" aria-hidden="true"></i>
                        @if($unidade->caracteristicas->where('nome', 'valor_unidade')->first() && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '' && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '0')
                            {{ converte_valor_real($unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor) }}
                        @else
                            @if($unidade->caracteristicas->where('nome', 'valor_m2')->first() && $unidade->caracteristicas->where('nome', 'metragem_total')->first())
                                @php
                                    $valor_m2 = $unidade->caracteristicas->where('nome', 'valor_m2')->first()->pivot->valor;
                                    $metragem = $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor;
                                @endphp
                                {{ converte_valor_real(($valor_m2 || '0') * ($metragem || '0')) }}
                            @else
                                Consulte
                            @endif
                        @endif
                    <br/>

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

                    @if($empreendimento->variacao->nome == "Lote")
                    <div class="caracteristicas lote">
                        <div class="item">
                            <div class="icone-caracteristica"><i class="fa fa-map" aria-hidden="true"></i></div>
                            <div class="titulo-caracteristica">{{ $unidade->quadra->nome }}</div>
                            <div class="valor-caracteristica">{{ $unidade->empreendimento->variacao->nome }} - <strong>{{ $unidade->nome }}</strong></div>
                        </div>
                        @if($unidade->getCaracteristica('valor_m2'))
                        <div class="item">
                            <div class="icone-caracteristica"><i class="fas fa-dollar" aria-hidden="true"></i></div>
                            <div class="titulo-caracteristica">Valor (M²)</div>
                            <div class="valor-caracteristica">R$ {{ converte_valor_real($unidade->getCaracteristica('valor_m2') ?? '') }}</div>
                        </div>
                        @else
                        <div class="item">
                            <div class="icone-caracteristica"><i class="fab fa-dollar" aria-hidden="true"></i></div>
                            <div class="titulo-caracteristica">Valor (M²)</div>
                            <div class="valor-caracteristica">R$ {{ converte_valor_real(($unidade->getCaracteristica('metragem_total'))/$unidade->getCaracteristica('valor_unidade')) }}</div>
                        </div>
                        @endif
                        <div class="item">
                            <div class="icone-caracteristica"><i class="fa fa-object-group" aria-hidden="true"></i></div>
                            <div class="titulo-caracteristica">Terreno</div>
                            <div class="valor-caracteristica">{{ $unidade->getCaracteristica('metragem_total') ?? '' }}m²</div>
                        </div>

                        <div class="item">
                            <div class="icone-caracteristica"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            <div class="titulo-caracteristica">Entrega</div>
                            <div class="valor-caracteristica">{{ get_previsao_entrega($empreendimento) }}</div>
                        </div>

                    </div>
                    @else
                    <div class="caracteristicas">
                        <div class="item">
                            <div class="icone-caracteristica"><i class="fa fa-home" aria-hidden="true"></i></div>
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
                            @if($unidade->caracteristicas->where('nome', 'posicao_unidade_torre')->first() <> '')
                            <div class="valor-caracteristica uppercase">{{ $unidade->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor ?? '' }}</div>
                            @else
                            <div class="valor-caracteristica">-</div>
                            @endif
                        </div>
                        <div class="item">
                            <div class="icone-caracteristica {{ url_amigavel($unidade->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor ?? '') }}"><i class="fas fa-cloud-sun" aria-hidden="true"></i></div>
                            <div class="titulo-caracteristica">Tipo Sol</div>
                            <div class="valor-caracteristica">{{ $unidade->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor ?? '' }}</div>
                        </div>
                    </div>
                    @endif

                @if(isset($unidade->planta))
                @php
                $foto_planta = $unidade->planta->getFotoDestaque();
                @endphp
                <a data-toggle="modal" data-target="#exampleModal">

                    <div class="planta-unidade" style="background-image: url({{ $foto_planta->getUrl('400x300') ?? '' }});">
                        <div class="titulo-planta">Detalhes da Planta</div>
                    </div>

                </a>
                @else

                <a data-toggle="modal" data-target="#ModalLote">

                    <div class="planta-unidade" style="background-image: url(/assets/premium/img/fundo-dimensoes.png);">
                        <div class="titulo-planta">Dimensões do Lote</div>
                    </div>

                </a>

                @endif


                @php
                $foto = $empreendimento->fotos->where('tipo', '<>', 'Implantação')->where('status', 'Liberada')->first();
                @endphp

                @if(isset($foto))
                <a data-fancybox="gallery" href="{{ $foto->getUrl('original') }}" data-caption="{{ $foto->nome }}">
                    <div class="fotos-decorado" style="background-image: url({{ $foto->getUrl('400x300') }});">
                        <div class="titulo-decorado">Fotos </div>
                    </div>
                </a>
                @endif

            </div>


            <div class="modal fade" id="ModalMapaUnidades" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Implantação</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe class="conteudo-mapa" zooming="true" id="iframe" src="{{ env('APP_URL') }}/unidade/{{ $unidade->id }}/{{ $unidade->id*37 }}/visualizar-mapa/mobile" title="Mapa"></iframe>
                        <!-- Trigger -->
                        <ul id="zoom_triggers">
                            <li><a id="zoom_in"><i class="fas fa-plus-square" aria-hidden="true"></i></a></li>
                            <li><a id="zoom_out"><i class="fas fa-minus-square" aria-hidden="true"></i></a></li>
                            <li><a id="zoom_reset"><i class="fas fa-sync-alt" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        @endif

    </div>

    @include('site.empreendimento.premium.mobile.proposta.modal_unidade')

@endsection

@push('rodape')
<div class="rodape">
    <a href="{{ $_SERVER['HTTP_REFERER'] }}"><div class="btn-voltar"><i class="fa fa-reply-all" aria-hidden="true"></i></div></a>
    <a href="/unidade/{{ $unidade->id }}/condicoes-construtora"><div class="btn-condicoes-pagamento"><i class="fa fa-handshake-o" aria-hidden="true"></i> Condições de Pagamento</div></a>
</div>
@endpush
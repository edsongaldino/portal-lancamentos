@extends('site/empreendimento/premium/layout_interno')

@push('meta')
<title>INICIO</title>
@endpush

@push('includes_head')
<!-- Bootstrap -->
<link rel="stylesheet" href="/site/ferramenta/apartment-font/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/site/css/plugins.css">
<link rel="stylesheet" type="text/css" href="/site/css/apartment-layout.css?v=02">
<link rel="stylesheet" type="text/css" href="/site/css/empreendimento.css">
<link rel="stylesheet" href="/assets/sweetalert/dist/sweetalert.css">

<script src="/site/ferramenta/js/swiper.js"></script>
<script src="/site/ferramenta/mail/validate.js"></script>
<script src="/site/ferramenta/js/apartment.js?v=06"></script>
<script src="/site/ferramenta/js/funcao_javascript.js" type="text/javascript"></script>
<script src="/site/ferramenta/bootstrap/bootstrap3-typeahead.min.js"></script>
<script src="/assets/javascripts/sweetalert2.8.js"></script>
<script src="/site/ferramenta/zoom/src/panzoom.js"></script>
<script src="/site/ferramenta/zoom/test/libs/jquery.mousewheel.js"></script>
<link href="/assets/premium/fontawesome/css/all.css" rel="stylesheet">

@endpush

@section('content')

<div class="conteudo">

    <!-- Slider main container -->
    <div id="swiper2" class="swiper-container">

    <div class="container swiper2-navigation">
        <div class="row">
            <div class="col-xs-2">
            <a href="#" class="navigation-box2 navigation-box-prev slide-prev"><div class="navigation-box-icon2"><i class="jfont">&#xe800;</i></div></a>
            </div>
            <div class="col-xs-2 col-xs-offset-8">
            <a href="#" class="navigation-box2 navigation-box-next slide-next"><div class="navigation-box-icon2"><i class="jfont">&#xe802;</i></div></a>
            </div>
        </div>
    </div>

    <!-- Additional required wrapper -->

    <div class="swiper-wrapper">

        @php $fotos = $empreendimento->getFotosCarrossel();@endphp
        @foreach($fotos AS $foto)
        @if(isset($foto->arquivo))
        <div class="swiper-slide swiper-lazy banner-index" onclick="location.href='/empreendimento/{{ $empreendimento->id }}/fotos';" data-background="{{ $foto->getUrl('original') }}">
            <div class="container">

                <div class="link-banner"></div>

            </div>
        </div>
        @endif
        @endforeach

    </div>

    </div>

    <div id="detalhes-empreendimento">

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
        

        <h1 class="nome-empreendimento"><?php echo $icone_tipo;?> {{ $empreendimento->nome }}</h1>
        <h2 class="subtitulo-empreendimento">{{ $empreendimento->subtipo->nome }}, {{ $empreendimento->endereco->cidade->nome }} - {{ $empreendimento->endereco->estado->uf }}</h2>


        <div class="caracteristicas">
            <div class="titulo"></div>
            @if($empreendimento->subtipo_id == 1 || $empreendimento->subtipo_id == 2)

                <div class="item">
                    <div class="icone-caracteristica"><i class="fa fa-building" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">{{ $empreendimento->torres->count() }} Torre(s)</div>
                    <div class="valor-caracteristica">{{ $empreendimento->unidades->count() }} Unidades</div>
                </div>

                <div class="item">
                    <div class="icone-caracteristica"><i class="fa fa-object-group" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">{{ $empreendimento->plantas->count() }} Planta(s)</div>
                    <div class="valor-caracteristica">{!! qtd_metragem($empreendimento) !!}m²</div>
                </div>

                @if($empreendimento->subtipo_id == 1)

                <div class="item">
                    <div class="icone-caracteristica"><i class="fa fa-bed" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">{!! qtd_dormitorio($empreendimento, true) !!} Quartos</div>
                    <div class="valor-caracteristica">{!! qtd_suites($empreendimento, true) !!} Suíte(s)</div>
                </div>

                @endif

                <div class="item">
                    <div class="icone-caracteristica"><i class="fa fa-car" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Garagem</div>
                    <div class="valor-caracteristica">{!! vagas_empreendimento($empreendimento) !!} Vaga(s)</div>
                </div>

                @if($empreendimento->getCaracteristica('estacionamento_rotativo') == 'S')
                <div class="item">
                    <div class="icone-caracteristica"><i class="fas fa-parking" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Estacionamento</div>
                    <div class="valor-caracteristica">Rotativo</div>
                </div>
                @endif

                <div class="item">
                    <div class="icone-caracteristica"><i class="far fa-calendar-alt" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Previsão de Entrega</div>
                    <div class="valor-caracteristica">{{ get_previsao_entrega($empreendimento) }}</div>
                </div>

                <div class="item">
                    <div class="icone-caracteristica"><i class="fas fa-columns" aria-hidden="true"></i></div>
                    <div class="titulo-caracteristica">Elevadores</div>
                    <div class="valor-caracteristica">{{ get_elevadores($empreendimento->id) }}</div>
                </div>

            @elseif($empreendimento->subtipo_id == 3 || $empreendimento->subtipo_id == 4)

                @if($empreendimento->variacao->nome == "Lote")

                    <div class="item">
                        <div class="icone-caracteristica"><i class="fas fa-columns" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Quadras</div>
                        <div class="valor-caracteristica">{{ $empreendimento->quadras->count() }}</div>
                    </div>

                    <div class="item">
                        <div class="icone-caracteristica"><i class="fab fa-buromobelexperte" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Unidades</div>
                        <div class="valor-caracteristica">{{ $empreendimento->unidades->count() }}</div>
                    </div>

                    <div class="item">
                        <div class="icone-caracteristica"><i class="far fa-map" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Lotes (Metragem)</div>
                        <div class="valor-caracteristica">{{ converte_valor_real_semdecimal($empreendimento->getCaracteristica('area_unidade_min')) }} à {{ converte_valor_real_semdecimal($empreendimento->getCaracteristica('area_unidade_max')) }}m²</div>
                    </div>

                    <div class="item">
                        <div class="icone-caracteristica"><i class="fas fa-tree" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Área Verde</div>
                        <div class="valor-caracteristica">{{ converte_valor_real_semdecimal($empreendimento->getCaracteristica('area_verde')) }}m²</div>
                    </div>

                    <div class="item">
                        <div class="icone-caracteristica"><i class="fas fa-crop-alt" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">APP</div>
                        <div class="valor-caracteristica">{{ converte_valor_real_semdecimal($empreendimento->getCaracteristica('area_preservacao')) }}m²</div>
                    </div>

                    <div class="item">
                        <div class="icone-caracteristica"><i class="far fa-calendar-alt" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Previsão de Entrega</div>
                        <div class="valor-caracteristica">{{ get_previsao_entrega($empreendimento) }}</div>
                    </div>

                @else

                    <div class="item">
                        <div class="icone-caracteristica"><i class="fa fa-building" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">{{ $empreendimento->quadras->count() }} Quadras(s)</div>
                        <div class="valor-caracteristica">{{ $empreendimento->unidades->count() }} Unidades</div>
                    </div>

                    <div class="item">
                        <div class="icone-caracteristica"><i class="fa fa-object-group" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">{{ $empreendimento->plantas->count() }} Planta(s)</div>
                        <div class="valor-caracteristica">{!! qtd_metragem($empreendimento) !!}m²</div>
                    </div>

                    <div class="item">
                        <div class="icone-caracteristica"><i class="fa fa-car" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Garagem</div>
                        <div class="valor-caracteristica">{!! vagas_empreendimento($empreendimento) !!} Vaga(s)</div>
                    </div>

                    <div class="item">
                        <div class="icone-caracteristica"><i class="far fa-calendar-alt" aria-hidden="true"></i></div>
                        <div class="titulo-caracteristica">Previsão de Entrega</div>
                        <div class="valor-caracteristica">{{ get_previsao_entrega($empreendimento) }}</div>
                    </div>

                @endif

            @else

            @endif

        </div>

        <div class="descricao">{{ $empreendimento->descricao }}</div>

        <div id="botoes">

            @if($empreendimento->TabelaAtiva->count() > 0)
            <a href="/empreendimento/{{ $empreendimento->id }}/unidades"><div class="unidades-disponiveis"><i class="far fa-check-square" aria-hidden="true"></i> Escolha sua Unidade</div></a>
            @endif

            @if($empreendimento->variacao->nome <> "Lote")
            <a href="/empreendimento/{{ $empreendimento->id }}/plantas"><div class="plantas-disponiveis"><i class="fa fa-object-group" aria-hidden="true"></i> Plantas </div></a>
            @endif

            @if ($empreendimento->tipo == 'Horizontal' && $empreendimento->getFotoTipo('Implantação') && $empreendimento->unidades->count() > 0)
            <a href="{{ URL::to('/') }}/empreendimento/{{ $empreendimento->id }}/{{ $empreendimento->id*37 }}/visualizar-mapa/construtora" target="_blank"><div class="vagas-disponiveis"><i class="fa fa-check" aria-hidden="true"></i> Mapa do Empreendimento</div></a>
            @endif

            @if ($empreendimento->getFotoTipo('Mapa de Vagas') && $empreendimento->garagens->count() > 0)
            <a href="{{ URL::to('/') }}/empreendimento/{{ $empreendimento->id }}/{{ $empreendimento->id*37 }}/visualizar-garagens/view" target="_blank"><div class="vagas-disponiveis"><i class="fa fa-car" aria-hidden="true"></i> Mapa de Garagens</div></a>
            @endif

            <a href="/empreendimento/{{ $empreendimento->id }}/fotos"><div class="galeria-fotos"><i class="fa fa-camera" aria-hidden="true"></i> Galeria de Fotos</div></a>

            @if ($empreendimento->tour->count() > 0)
            <a href="/empreendimento/{{ $empreendimento->id }}/tour360"><div class="tour-360"><i class="fas fa-circle-notch" aria-hidden="true"></i> Tour Virtual 360º</div></a>
            @endif

            @if($empreendimento->arquivos->where('tipo', 'Memorial Descritivo')->first())
            <a href="/uploads/arquivos/{{  $empreendimento->arquivos->where('tipo', 'Memorial Descritivo')->first()->arquivo ?? '' }}" target="_blank"><div class="memorial-descritivo"><i class="fas fa-clipboard-list" aria-hidden="true"></i> Memorial Descritivo</div></a>
            @endif

        </div>

        @php
        $video = $empreendimento->caracteristicas->where('nome', 'video')->first();
        @endphp
        @if($video)
        @if ($video->pivot->valor != null)
        <div class="video">
            <div class="titulo-video"><i class="fab fa-youtube" aria-hidden="true"></i> Vídeo do Empreendimento</div>
            <iframe class="video-youtube" src="{{ $empreendimento->caracteristicas->where('nome', 'video')->first()->pivot->valor }}" title="Vídeo - {{ $empreendimento->nome }}"></iframe>
            <!--<div class="outros-videos"><i class="fas fa-video" aria-hidden="true"></i> + Vídeos</div>-->
        </div>
        @endif
        @endif

        @php
        $itens_lazer = $empreendimento->itensLazer;
        $infra_estrutura = $empreendimento->caracteristicas
                ->where('tipo', 'Empreendimento')
                ->where('exibir', 'Sim');
        @endphp

        <nav class="abas">
            @if($itens_lazer->count() > 0)
            <div class="nav-item active" id="itensLazer"><i class="fas fa-swimming-pool" aria-hidden="true"></i> Itens de Lazer</div>
            @endif
            @if($infra_estrutura->count() > 0)
            <div class="nav-item" id="infraEstrutura"><i class="fas fa-clipboard-list" aria-hidden="true"></i> Ficha Técnica</div>
            @endif
        </nav>

        <div id="itens-lazer" style="display: block;">

            @foreach($itens_lazer->all() as $item_lazer)
                <div class="item"><i class="far fa-check-circle" aria-hidden="true"></i> {{ $item_lazer->nome }}</div>
            @endforeach

        </div>

        <div id="infra-estrutura" style="display: none;">

            @foreach($infra_estrutura->all() as $item_infra)
                <div class="item"><i class="far fa-check-circle" aria-hidden="true"></i> {{ $item_infra->nome }}</div>
            @endforeach

        </div>

        <div class="localizacao">
            <div class="titulo-mapa"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Localização</div>
            <div class="mapa-google" id="MapaLocalizacao"></div>
        </div>

        <script>
            var map;
            function initMap() {
              map = new google.maps.Map(document.getElementById('MapaLocalizacao'), {
                center: {lat: {{ $empreendimento->endereco->latitude }}, lng: {{ $empreendimento->endereco->longitude }}},
                zoom: 15
              });

              var marker = new google.maps.Marker({
                position: {lat: {{ $empreendimento->endereco->latitude }}, lng: {{ $empreendimento->endereco->longitude }}},
                map: map,
                title: 'Meu marcador'
              });
            }

          </script>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzzfaZRQcQvaSDOtK3hyLoeY9YVUKedjQ&callback=initMap" async defer></script>

    </div>

</div>

@include('site.empreendimento.premium.mobile.proposta.modal_garagem')
@include('site.empreendimento.premium.modal_contato')

@endsection

@push('rodape')

    <div class="rodape detalhes">
        <div class="valor">
            @if($empreendimento->valor_inicial == 0 || $empreendimento->valor_inicial == null)
            <span class="inicial">Consulte<br/>
            @else
            <span class="inicial"><i class="fas fa-dollar-sign" aria-hidden="true"></i> {{ $empreendimento->valor_inicial }}</span><br/>
            @endif
            <span class="texto">Unidades à partir de</span>
        </div>

        @if($empreendimento->TabelaAtiva->count() > 0)
        <a href="/empreendimento/{{ $empreendimento->id }}/unidades"><div class="negociar"><i class="fas fa-cart-plus" aria-hidden="true"></i> Negociar Unidade</div></a>
        @else
            @if(Session::get('ViewCorretor') <> null)
                <a href="#openModal" id="ModalChat"><div class="negociar fale-com-o-corretor"><i class="fab fa-whatsapp" aria-hidden="true"></i> Fale com o Corretor</div></a>
            @else
                <a data-toggle="modal" data-target="#ModalContatoConstrutora"><div class="negociar fale-com-a-construtora"><i class="fas fa-envelope" aria-hidden="true"></i> Fale com a Construtora</div></a>
            @endif
        @endif
    </div>



    <script src="/assets/vendor/pnotify/pnotify.custom.js"></script>
    <script src="/assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="/site/painel/assets/javascripts/ui-elements/examples.modals.js"></script>
    <script src="/site/painel/assets/javascripts/ui-elements/examples.lightbox.js"></script>

    <script type="text/javascript" src="{{ asset('assets/javascripts/sweetalert2.8.js') }}" ></script>

    <script>

        $('#itensLazer').click(function (){
            $("#itens-lazer").css("display", "block");
            $("#infra-estrutura").css("display", "none");
            $('#infraEstrutura').removeClass('active');
            $('#itensLazer').addClass('active');
        });

        $('#infraEstrutura').click(function (){
            $("#itens-lazer").css("display", "none");
            $("#infra-estrutura").css("display", "block");
            $('#itensLazer').removeClass('active');
            $('#infraEstrutura').addClass('active');
        });

    </script>

@endpush

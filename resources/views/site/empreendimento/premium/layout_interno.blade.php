<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $empreendimento->nome }}</title>

    @if ($empreendimento->seo)
    <meta name='description' content="{{ $empreendimento->seo->descricao }}"/>
    <meta name='keywords' content='{{ $empreendimento->seo->palavra_chave }}' />
    <meta property="og:description" content="{{ $empreendimento->seo->descricao }}" />
    @endif

    @if($empreendimento->TabelaAtiva->count() > 0)
    <meta property="og:url" content="https://www.lancamentosonline.com.br/proposta-online/{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html" />
    @else
    <meta property="og:url" content="https://www.lancamentosonline.com.br/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html"/>
    @endif

    <meta property="og:title" content="{{ $empreendimento->nome }}" />

    @if($empreendimento->TabelaAtiva->count() > 0)
    <meta name="twitter:image" content="https://www.lancamentosonline.com.br/site/imagens/proposta_online/foto-propostaonline-{{ $empreendimento->id }}.jpg">
    <meta property="og:image" content="https://www.lancamentosonline.com.br/site/imagens/proposta_online/foto-propostaonline-{{ $empreendimento->id }}.jpg"/>
    @else
    <meta name="twitter:image" content="{{ $empreendimento->fotoPrincipal() }}">
    <meta property="og:image" content="{{ $empreendimento->fotoPrincipal() }}"/>
    @endif

    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1067">
    <meta property="og:image:height" content="600">
    <meta property="og:type" content="website">

    @stack('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="/site/ferramenta/js/jQuery/jquery.min.js"></script>
    <script src="/site/ferramenta/js/jQuery/jquery-ui.min.js"></script>

    <!-- Bootstrap-->
    <script src="/assets/premium/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>

    <!-- Google font -->
	<link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />
	<!-- Bootstrap -->
	<link rel="stylesheet" href="/assets/premium/bootstrap-4.6.0-dist/css/bootstrap.min.css">

    <link href="/assets/premium/fontawesome/css/all.css" rel="stylesheet">

	<!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="/assets/premium/css/custom.css?v={{ filemtime('assets/premium/css/custom.css') }}" />
	<link type="text/css" rel="stylesheet" href="/assets/premium/css/style.css?v={{ filemtime('assets/premium/css/style.css') }}" />
    <link href="/assets/premium/js/lightbox/ekko-lightbox.css" rel="stylesheet">

    @stack('includes_head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
    <style>
        a[data-fancybox] img {
            cursor: zoom-in;
        }

        .fancybox__caption {
            text-align: center;
        }

    </style>
</head>
<body>

    @if(Session::get('ViewCorretor') <> null)

        <div class="topo">
            <a href="/corretor/empreendimentos"><div class="logo"><img src="{{ url($empreendimento->construtora->getLogoPremium()) }}" alt="" class="img-responsive center-block d-block mx-auto"></div></a>
            <div class="logo-empreendimento"><img src="{{ url($empreendimento->getLogo()) }}" class="img-responsive center-block d-block mx-auto" alt="" width="100" height="76"></div>

            <a href="#openModal" id="ModalChat">
                <div class="chat-corretor">
                    @if(Session::get('usuario.foto') <> null)
                    <img class="img-circle border-effect" src="{{ url('corretor/usuario/'.Session::get('usuario.id').'/foto') }}" alt=" ">
                    @else
                    <img class="img-circle border-effect" src="{{ asset('corretor/app-assets/images/userFoto.png') }}" alt=" ">
                    @endif
                    <i class="fab fa-whatsapp" aria-hidden="true"></i>
                    <br/><span class="corretor-on">Corretor <strong>ON</strong>
                </div>
            </a>

        </div>

    @else
    <div class="topo">
        <a href="/pagina-inicial.html"><div class="logo"><img src="{{ url($empreendimento->construtora->getLogoPremium()) }}" alt="" class="img-responsive center-block d-block mx-auto"></div></a>
        <div class="logo-empreendimento"><img src="{{ url($empreendimento->getLogo()) }}" class="img-responsive center-block d-block mx-auto" alt="" width="100" height="76"></div>

        <a href="#openModal" id="ModalChat">
            <div class="chat"><i class="fab fa-whatsapp" aria-hidden="true"></i><br/><span class="corretor-on">Corretor <strong>ON</strong></span></div>
        </a>

    </div>
    @endif

    <div id="loader" class="loader"></div>

    @yield('content')

    @stack('rodape')
    @include('site/empreendimento/mobile/modalChatDados')
    @include('site.empreendimento.premium.mobile.fotos_empreendimento')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            caption: function (fancybox, carousel, slide) {
                return (
                `${slide.index + 1} / ${carousel.slides.length} <br />` + slide.caption
                );
            },
        });

        Fancybox.bind('[data-fancybox="galleryMapa"]', {
            caption: function (fancybox, carousel, slide) {
                return (
                `${slide.index + 1} / ${carousel.slides.length} <br />` + slide.caption
                );
            },
        });

    </script>
    <script src="/global/js/loader/index.js"></script>

    <script src="/global/js/ajax/index.js"></script>
    <script src="/assets/premium/js/index.js?v={{ filemtime('assets/premium/js/index.js') }}"></script>

    <script src="/assets/javascripts/sweetalert2.8.js"></script>

    <script src="{{ asset('/assets/javascripts/mascaras/jquery.mask.js') }}"></script>
    <script src="{{ asset('/assets/javascripts/mascaras/jquery.maskMoney.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.date').mask('00/00/0000');
            $('.cpf').mask('000.000.000-00', {reverse: false});
            $('.moeda').maskMoney({thousands: '.', decimal: ','});
            $('.moeda2').maskMoney({thousands: '', decimal: '.'});
            $('.money').mask('#.##0,00', {reverse: true});

            var options =  {
                onKeyPress: function(phone, e, field, options) {
                    var masks = ['(00) 0000-00000', '(00) 00000-0000'];
                    var mask = (phone.length>14) ? masks[1] : masks[0];
                    $('.telefone').mask(mask, options);
                }
            };

            $('.telefone').mask('(00) 0000-00000', options);
        });

        $(".marcarVaga").on('click', function () {
            Swal.fire(
                'Por favor, selecione no mínimo uma vaga!',
                '',
                'error'
            )
        });

        jQuery(document).ready(function($) {
            // Set initial zoom level
            var zoom_level = 100;

            // Click events
            $('#zoom_in').click(function() {
                zoom_page(10, $(this))
            });
            $('#zoom_out').click(function() {
                zoom_page(-10, $(this))
            });
            $('#zoom_reset').click(function() {
                zoom_page(0, $(this))
            });

            // Zoom function
            function zoom_page(step, trigger) {
                // Zoom just to steps in or out
                if (zoom_level >= 120 && step > 0 || zoom_level <= 80 && step < 0) return;

                // Set / reset zoom
                if (step == 0) zoom_level = 100;
                else zoom_level = zoom_level + step;

                // Set page zoom via CSS
                $('.conteudo-mapa').css({
                    transform: 'scale(' + (zoom_level / 100) + ')', // set zoom
                    transformOrigin: '50% 0' // set transform scale base
                });

                // Adjust page to zoom width
                if (zoom_level > 100) $('.conteudo-mapa').css({
                    width: (zoom_level * 1.2) + '%'
                });
                else $('.conteudo-mapa').css({
                    width: '100%'
                });

                // Activate / deaktivate trigger (use CSS to make them look different)
                if (zoom_level >= 120 || zoom_level <= 80) trigger.addClass('disabled');
                else trigger.parents('ul').find('.disabled').removeClass('disabled');
                if (zoom_level != 100) $('#zoom_reset').removeClass('disabled');
                else $('#zoom_reset').addClass('disabled');
            }
        });

        jQuery(window).load(function () {
            $(".loader").delay(1500).fadeOut("slow");
        });


        $('.linha-unidade').click(function() {
            $(".loader").show("fast");
        });

    </script>

</body>
</html>

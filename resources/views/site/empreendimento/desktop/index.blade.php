@extends('site/layout')

@section('title')
{{ strtoupper($empreendimento->nome) }}
@endsection

@push('meta')
@if ($empreendimento->seo)
  <meta name='description' content="{{ $empreendimento->seo->descricao }}"/>
  <meta name='keywords' content='{{ $empreendimento->seo->palavra_chave }}' />
  <meta property="og:description" content="{{ $empreendimento->seo->descricao }}" />
@endif

@if($empreendimento->TabelaAtiva->count() > 0)
<meta name="twitter:image" content="https://www.lancamentosonline.com.br/site/imagens/proposta_online/foto-propostaonline-{{ $empreendimento->id }}.jpg">
<meta property="og:image" content="https://www.lancamentosonline.com.br/site/imagens/proposta_online/foto-propostaonline-{{ $empreendimento->id }}.jpg"/>
@else
<meta name="twitter:image" content="{{ $empreendimento->fotoPrincipal() }}">
<meta property="og:image" content="{{ $empreendimento->fotoPrincipal() }}"/>
@endif
<meta property="og:url" content="https://www.lancamentosonline.com.br/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html" />
<meta property="og:title" content="{{ $empreendimento->nome }}" />
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1067">
<meta property="og:image:height" content="600">
<meta property="og:type" content="website">
@endpush

@push('css')
<!-- Bootstrap -->
<link rel="stylesheet" href="/site/ferramenta/bootstrap/bootstrap.min.css">
<!-- Font awesome styles -->
<link rel="stylesheet" href="/site/ferramenta/apartment-font/css/font-awesome.min.css">
<!-- Custom styles -->
<link rel="stylesheet" type="text/css" href="/site/css/plugins.css">
<link rel="stylesheet" type="text/css" href="/site/css/apartment-layout.css?v=02">
<link id="skin" rel="stylesheet" type="text/css" href="/site/css/apartment-colors-blue.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/site/css/empreendimento.css">
<link rel="stylesheet" href="/assets/sweetalert/dist/sweetalert.css">
@endpush

@push('js_header')
<script src="/site/ferramenta/js/jQuery/jquery.min.js"></script>
<script src="/site/ferramenta/js/jQuery/jquery-ui.min.js"></script>
<script src="/site/ferramenta/bootstrap/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzzfaZRQcQvaSDOtK3hyLoeY9YVUKedjQ&amp;libraries=places"></script>
<script src="/site/ferramenta/js/plugins.js"></script>
<script src="/site/ferramenta/mail/validate.js"></script>
<script src="/site/ferramenta/js/apartment.js?v=06"></script>
<script src="/site/ferramenta/js/funcao_javascript.js" type="text/javascript"></script>
<script src="/site/ferramenta/bootstrap/bootstrap3-typeahead.min.js"></script>
<script src="/assets/javascripts/sweetalert2.8.js"></script>
<script src="/site/ferramenta/zoom/src/panzoom.js"></script>
<script src="/site/ferramenta/zoom/test/libs/jquery.mousewheel.js"></script>
<script src="/site/m/js/jquery.mask.js"></script>
<script src="/site/js/ajax/index.js"></script>
<script src="/site/js/empreendimento/formulario.js"></script>
<script src="/site/js/empreendimento/oferta.js"></script>
<script src="/site/js/empreendimento/index.js"></script>

<!-- Event snippet for Website lead conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-791268609/XYF3COGT5OsBEIGap_kC'});
</script>

@endpush

@push('js_footer')
  <script src="/assets/vendor/pnotify/pnotify.custom.js"></script>
  <script src="/assets/vendor/magnific-popup/magnific-popup.js"></script>
  <script src="/site/painel/assets/javascripts/ui-elements/examples.modals.js"></script>
  <script src="/site/painel/assets/javascripts/ui-elements/examples.lightbox.js"></script>
@endpush

@section('content')
  @include('site/empreendimento/desktop/modal')
  @include('site/empreendimento/desktop/carrossel')

  @if($empreendimento->construtora_id == 58)
  <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '576443426940162'); // Insert your pixel ID here.
    fbq('track', 'PageView');
  </script>
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=576443426940162&ev=PageView&noscript=1"/>
  </noscript>
  @endif

  <section class="section-light no-bottom-padding">
    <div class="container">
      <div class="col-xs-12">
        <div class="row info-empreendimento">
          <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8">
            @include('site/empreendimento/desktop/descricao')
            <div class="details-parameters detalhe">
              @if($empreendimento->subtipo->id == 1)
                @include('site/empreendimento/desktop/apartamento')
              @elseif($empreendimento->subtipo->id==2)
                @include('site/empreendimento/desktop/comercial')
              @elseif($empreendimento->subtipo->id==5)
                @include('site/empreendimento/desktop/lote_comercial')
              @elseif ($empreendimento->subtipo->id == 3)
                @if($empreendimento->variacao)
                  @if($empreendimento->variacao->nome == "Lote")
                    @include('site/empreendimento/desktop/lote')
                  @else
                    @include('site/empreendimento/desktop/condominio')
                  @endif
                @endif
              @elseif ($empreendimento->subtipo)
                @if($empreendimento->subtipo->id == 4)
                  @if($empreendimento->variacao)
                    @if($empreendimento->variacao->nome == "Lote")
                      @include('site/empreendimento/desktop/lote2')
                    @else
                      @include('site/empreendimento/desktop/residencial')
                    @endif
                  @endif
                @endif
              @else
                @include('site/empreendimento/desktop/desconhecido')
              @endif
              </div>

              @include('site/empreendimento/desktop/descricao_footer')

              @include('site/empreendimento/desktop/banner_gms')

          </div>
          <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
            @include('site/empreendimento/desktop/formulario_lateral')
          </div>
        </div>
      </div>
      @include('site/empreendimento/desktop/oferta')
      @include('site/empreendimento/desktop/itens_empreendimento')

      @if($empreendimento->subtipo && $empreendimento->variacao)
        @if($empreendimento->subtipo->id <> 4 && $empreendimento->variacao->nome <> "Lote")
          @include('site/empreendimento/desktop/plantas')
        @endif
      @endif

      @include('site/empreendimento/desktop/video')
      @include('site/empreendimento/desktop/localizacao')
      @include('site/empreendimento/desktop/fotos')
      @include('site/empreendimento/desktop/formulario_rodape')
      @include('site/empreendimento/desktop/similares')

      <!-- google maps initialization -->
      <script type="text/javascript">

        @if ($empreendimento->subtipo->id == 1)
        $(window).load(function() {
            $('#popupModal').modal('show');
        });
        @endif


        google.maps.event.addDomListener(window, 'load', init);
        function init() {
          @if ($empreendimento->endereco->latitude && $empreendimento->endereco->longitude)
            var latitude = {{ $empreendimento->id }};
            var latitude2 = {{ $empreendimento->id }};

            mapInit({{$empreendimento->endereco->latitude}},{{$empreendimento->endereco->longitude}},"estate-map","/site/images/pin-{{$empreendimento->subtipo->id}}.png", true);
            streetViewInit({{$empreendimento->endereco->latitude}},{{$empreendimento->endereco->longitude}},"estate-street-view");
          @endif
        }
      </script>

    </div>
  </section>
@endsection

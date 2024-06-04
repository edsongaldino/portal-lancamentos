@extends('site/layout')
@push('css')
<meta name='description' content="{{ $construtora->observacoes }}"/>
<meta property="og:description" content="{{ $construtora->observacoes }}" />

<meta name="twitter:image" content="{{ $construtora->getLogoUrl('260x260') }}">
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:title" content="{{ $construtora->nome }}" />
<meta property="og:image" content="{{ $construtora->getLogoUrl('260x260') }}" />
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1067">
<meta property="og:image:height" content="600">
<meta property="og:type" content="website">
<!-- Bootstrap -->
<link rel="stylesheet" href="/site/ferramenta/bootstrap/bootstrap.min.css">
<!-- Font awesome styles -->    
<link rel="stylesheet" href="/site/ferramenta/apartment-font/css/font-awesome.min.css">
<!-- Custom styles -->
<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,500italic,700,700italic&amp;subset=latin,latin-ext'>
<link rel="stylesheet" type="text/css" href="/site/css/plugins.css">
<link rel="stylesheet" type="text/css" href="/site/css/apartment-layout.css">
<link rel="stylesheet" type="text/css" href="/site/css/busca.css">
<link id="skin" rel="stylesheet" type="text/css" href="/site/css/apartment-colors-blue.css">
@endpush

@push('js_header')
<!-- jQuery  -->
<script src="/site/ferramenta/js/jQuery/jquery.min.js"></script>
<script src="/site/ferramenta/js/jQuery/jquery-ui.min.js"></script>
<!-- Bootstrap-->
<script src="/site/ferramenta/bootstrap/bootstrap.min.js"></script>
<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzzfaZRQcQvaSDOtK3hyLoeY9YVUKedjQ&amp;libraries=places"></script>
<!-- plugins script -->
<script src="/site/ferramenta/js/plugins.js"></script>
<!-- template scripts -->
<script src="/site/ferramenta/mail/validate.js"></script>
<script src="/site/ferramenta/js/apartment.js?v=03"></script>    
<script src="/site/ferramenta/bootstrap/bootstrap3-typeahead.min.js"></script>

<script src="/assets/javascripts/sweetalert2.8.js"></script>
<script src="/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
<script src="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.js') }}"></script>
<script src="/site/js/busca/formato_visualizacao.js"></script>
@endpush

@push('js_footer')
<script>
  $(function () {
    $(".loader-bg").fadeOut('slow');
  });
</script>
@endpush

@section('content')
<div id="wrapper">      
  <section class="section-light section-top-shadow top-padding-130">
    <div class="container">
      <div class="row">
        
        <div class="col-xs-12 col-md-12">
          
          <div class="row dados-construtora-hotsite">
            <div class="col-xs-12">
              <div class="details-title pull-left">
                <h3 class="hotsite">{{ $construtora->nome }}</h3>
                <div class="details-agency-address">
                  <i class="fa fa-map-marker"></i>
                  @if ($construtora->endereco)
                  <span>
                    {{ $construtora->endereco->logradouro }}, 
                    {{ $construtora->endereco->numero }} 
                    @if ($construtora->endereco->bairro)
                    {{ $construtora->endereco->bairro->nome }}, 
                    @endif
                    @if ($construtora->endereco->cidade)
                    {{ $construtora->endereco->cidade->nome }} - 
                    @endif
                    @if ($construtora->endereco->estado)
                    {{ $construtora->endereco->estado->nome }}
                    @endif
                  </span>
                  @endif
                </div>
              </div>
              <div class="clearfix"></div>	
              <div class="title-separator-primary"></div>
              
              <div class="row margin-top-60">
                <div class="col-xs-12 col-sm-6 col-lg-3">
                  <img src="{{ $construtora->getLogoUrl('260x260') }}" 
                    class="img-responsive" alt="" />
                </div>					
                <div class="col-xs-12 col-sm-6 col-lg-9">
                  <p class="negative-margin">{{ $construtora->observacoes }}</p>
                  
                  <div class="details-parameters agency-details margin-top-40">
                    @if($construtora->telefone)
                    <div class="team-desc-line">
                      <span class="agent-icon-circle">
                        <i class="fa fa-phone"></i>
                      </span>
                      <span>{{ $construtora->telefone }}</span>
                    </div>
                    @elseif($construtora->celular_atendimento)
                    <div class="team-desc-line">
                      <span class="agent-icon-circle">
                        <i class="fa fa-phone"></i>
                      </span>
                      <span>{{ $construtora->celular_atendimento }}</span>
                    </div>
                    @endif
                    <div class="team-desc-line">
                      <span class="agent-icon-circle">
                        <i class="fa fa-envelope fa-sm"></i>
                      </span>
                      <span><a href="mailto:{{ $construtora->email }}">{{ $construtora->email }}</a></span>
                    </div>

                    <div class="team-desc-line canais-atendimento">

                      @if($construtora->instagram)
                      <span class="agent-icon-circle">
                        <a href="{{ $construtora->instagram }}" target="_blank">
                          <i class="fa fa-instagram fa-sm"></i>
                        </a>
                      </span>
                      @endif

                      @if($construtora->facebook)
                      <span class="agent-icon-circle">
                        <a href="{{ $construtora->facebook }}" target="_blank">
                          <i class="fa fa-facebook fa-sm"></i>
                        </a>
                      </span>
                      @endif

                      @if($construtora->twitter)
                      <span class="agent-icon-circle">
                        <a href="{{ $construtora->twitter }}" target="_blank">
                          <i class="fa fa-twitter fa-sm"></i>
                        </a>
                      </span>
                      @endif

                      @if($construtora->whatsapp)
                      <span class="agent-icon-circle">
                        <a href="https://api.whatsapp.com/send?phone=55{{ limpa_campo($construtora->whatsapp) }}" target="_blank">
                          <i class="fa fa-whatsapp fa-sm"></i>
                        </a>
                      </span>
                      @endif

                    </div>
                    
                  </div>
                  
                </div>
              </div>
              
              
            </div>
          </div>	
          @php
          $pagina = "hotsite";
          @endphp
          @include('site/busca/desktop/resultados')
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
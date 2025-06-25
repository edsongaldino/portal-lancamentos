@extends('backpack::base.layout')
@section('content')
<header class="page-header">
  <h2>Empreendimento</h2>
  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="/admin/dashboard">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span><a href="/admin">Início</a></span></li>
      <li><span><a href="/admin/empreendimento">Empreendimento</a></span></li>
    </ol>
    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>

<!-- start: page -->
<div class="row">
  <div class="col-md-4 col-lg-3">
    @include('admin/empreendimentos/desktop/empreendimento/principal/coluna_esquerda')
  </div>
  <div class="col-md-8 col-lg-7">
    @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
    <div class="panel-group" id="accordion2">
      @include('admin/empreendimentos/desktop/empreendimento/principal/dados')

      @include('admin/empreendimentos/desktop/empreendimento/principal/endereco')

      @include('admin/empreendimentos/desktop/empreendimento/principal/endereco_stand')

      @include('admin/empreendimentos/desktop/empreendimento/principal/midias')

      @include('admin/empreendimentos/desktop/empreendimento/principal/tour_virtual')

      @include('admin/empreendimentos/desktop/empreendimento/principal/canais_atendimento')

      @include('admin/empreendimentos/desktop/empreendimento/principal/itens_lazer')

      @include('admin/empreendimentos/desktop/empreendimento/principal/caracteristicas')

      @include('admin/empreendimentos/desktop/empreendimento/principal/seo')  
      
      @include('admin/empreendimentos/desktop/empreendimento/principal/arquivos')

      @include('admin/empreendimentos/desktop/empreendimento/principal/honorarios')
    </div>
  </div>
  <div class="col-md-12 col-lg-2">                        
    @include('admin/empreendimentos/desktop/empreendimento/principal/coluna_direita')
  </div>
</div>
<!-- end: page -->

<script src="/assets/javascripts/empreendimento/index.js?v={{ filemtime('assets/javascripts/empreendimento/index.js') }}"></script>
<script src="/assets/javascripts/empreendimento/cep.js?v={{ filemtime('assets/javascripts/empreendimento/cep.js') }}"></script>

@endsection

@push('after_styles')
<link rel="stylesheet" href="/assets/vendor/select2/select2.css?v={{ filemtime('assets/vendor/select2/select2.css') }}" />
@endpush

@push('after_scripts')

<!-- Specific Page Vendor -->
<script src="/assets/vendor/gauge/gauge.js"></script>
<script src="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

<!-- Specific Page Vendor -->
<script src="/assets/vendor/select2/select2.js"></script>

<!-- Theme Initialization Files -->
<script src="/assets/javascripts/theme.init.js"></script>

<!-- Examples -->
<script src="/assets/javascripts/ui-elements/examples.charts.js"></script>

<!-- Examples -->
<script src="/assets/javascripts/forms/examples.advanced.form.js" /></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzzfaZRQcQvaSDOtK3hyLoeY9YVUKedjQ&amp;libraries=places"></script>
<script src="/assets/javascripts/empreendimento/marcar_mapa.js?v={{ filemtime('assets/javascripts/empreendimento/marcar_mapa.js') }}"></script>

<script type="text/javascript">
  var latitude = {{ (isset($endereco) && $endereco->latitude != null) ? $endereco->latitude : 40.663973050231185 }};
  var longitude = {{ (isset($endereco) && $endereco->longitude != null) ? $endereco->longitude : -74.11651628125003 }};

  var latitude_stand = {{ (isset($endereco_stand) && $endereco_stand->latitude != null) ? $endereco_stand->latitude : 40.663973050231185 }};
  var longitude_stand = {{ (isset($endereco_stand) && $endereco_stand->longitude != null) ? $endereco_stand->longitude : -74.11651628125003 }};

  google.maps.event.addDomListener(window, "load", mapa(latitude, longitude, 'map_canvas'));
  google.maps.event.addDomListener(window, "load", mapa(latitude_stand, longitude_stand, 'map_stand_canvas'));
</script>

@endpush

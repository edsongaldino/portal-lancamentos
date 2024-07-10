@extends('site/layout')

@push('meta')
  @if ($parametros['oferta'])
    <!-- OLD -->
    <meta charset="utf-8">
    
    @if (isset($construtora->nome_abreviado))
    <title>Ofertas - {{ $construtora->nome_abreviado }}</title>
    @else
    <title>@yield('title', 'Ofertas - Portal Lançamentos Online')</title>
    @endif
    <meta name="description" content="Ofertas imperdíveis de diversos empreendimentos na planta e prontos pra morar">
    <meta name="keywords" content="lançamentos online, lançamentos imobiliários, apartamento em cuiabá, apartamento novo, imoveis mt, imoveis novos cuiabá"> 
    <meta name="author" content="Lançamentos Online"> 
    <link rel="shortcut icon" href="/site/m/images/favicon.ico">
    <!-- Resolution Screen -->
    <meta content="IE=edge" http-equiv="x-ua-compatible">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">

    <meta name='description' content="Ofertas imperdíveis de diversos empreendimentos na planta e prontos pra morar"/>
    <meta name='keywords' content='ofertas, empreendimentos com desconto' />
    <meta property="og:description" content="Ofertas imperdíveis de diversos empreendimentos na planta e prontos pra morar" />
    <meta name="twitter:image" content="https://www.lancamentosonline.com.br/site/images/oferta-portal.jpg">
    <meta property="og:url" content="https://www.lancamentosonline.com.br/ofertas/empreendimentos-com-descontos-incriveis.html" />
    @if (isset($construtora->nome_abreviado))
    <meta property="og:title" content="Ofertas - {{ $construtora->nome_abreviado }}" />
    @else
    <meta property="og:title" content="Ofertas - Portal Lançamentos Online" />
    @endif
    <meta property="og:image" content="https://www.lancamentosonline.com.br/site/images/oferta-portal.jpg" />
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1067">
    <meta property="og:image:height" content="600">
    <meta property="og:type" content="website">
  @endif

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
@endpush

@push('js_footer')
<script type="text/javascript" src="/site/ferramenta/js/jQuery/jquery-ui.min.js"></script>
  
<!-- Bootstrap-->
<script type="text/javascript" src="/site/ferramenta/bootstrap/bootstrap.min.js"></script>

<!-- Google Maps -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzzfaZRQcQvaSDOtK3hyLoeY9YVUKedjQ&amp;libraries=places"></script>
  
<!-- plugins script -->
<script type="text/javascript" src="/site/ferramenta/js/plugins.js"></script>

<!-- template scripts -->
<script type="text/javascript" src="/site/ferramenta/mail/validate.js"></script>
<script type="text/javascript" src="/site/ferramenta/js/apartment.js?v=04"></script>
<script src="/site/js/ajax/index.js"></script>
<script src="/site/js/home/index.js"></script>
<script src="/site/js/busca/index.js"></script>
<script src="/site/js/busca/favorito.js"></script>
<script type="text/javascript">
  var empreendimentos = [    
    @foreach($empreendimentos_autocomplete as $emp)
    "{{ $emp->nome }}",
    @endforeach
  ];
</script>
<script src="/site/js/busca/filtro_lateral.js"></script>
<script src="/site/js/busca/formato_visualizacao.js"></script>

<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

@endpush

@push('js_header')
<!-- jQuery  -->
<script src="/site/ferramenta/js/jQuery/jquery.min.js"></script>
<script src="/site/ferramenta/js/jQuery/jquery-ui.min.js"></script>
<script src="/site/ferramenta/sweetalert/sweetalert.js"></script>
<link rel="stylesheet" href="/site/ferramenta/sweetalert/sweetalert.css">

<!-- Event snippet for Website lead conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-791268609/XYF3COGT5OsBEIGap_kC'});
</script>

@endpush

@section('content')
  <section class="section-light section-top-shadow top-padding-130">
    <div class="container">
      <div class="row">        
        <div class="col-xs-12 col-md-9 col-md-push-3" id="resultados">          
          @include('site/busca/desktop/resultados')
        </div>
        <div class="col-xs-12 col-md-3 col-md-pull-9">            
          <div class="sidebar-left">
            <h3 class="sidebar-title">Filtrar resultado</h3>
            <div class="title-separator-primary"></div>
            
            <div class="sidebar-select-cont">

              <div class="autocomplete">
                <input type="text" id="nome_empreendimento" name="nome" class="bootstrap-input autocomplete" placeholder="Nome do Empreendimento"><div class="icone-busca"><i class="fa fa-search fa-2x" aria-hidden="true"></i></div>
              </div>

              <select name="construtora_id" id="construtora_id_multiplo" class="bootstrap-select" title="Construtoras:" multiple>
                @foreach(get_construtoras() as $construtora)
                  <option value="{{ $construtora->id }}">{{ $construtora->nome_abreviado }}</option>
                @endforeach
              </select>

              <select name="subtipo_id" id="subtipo_id_multiplo" class="bootstrap-select" title="Tipo:" multiple>
                @foreach (get_subtipos() as $subtipo)
                  <option value="{{ $subtipo->id }}">{{ $subtipo->nome }}</option>
                @endforeach
              </select>
                            
              <select name="modalidade" id="modalidade" class="bootstrap-select" title="Etapa:" multiple>
                <option value="Lançamento">Lançamento</option>
                <option value="Em Obra">Em obra</option>
                <option value="Mude Já">Pronto</option>
              </select>
              
              <select name="cidade_id" id="cidade_id_multiplo" class="bootstrap-select" title="Cidade:" multiple>
                @foreach(get_cidades() as $cidade)
                  <option value="{{ $cidade->id }}">{{ $cidade->nome }} ({{ $cidade->estado->uf }})
                </option>
                @endforeach
              </select>                       
                        
              <select name="bairro_id" id="bairro_id_multiplo" class="bootstrap-select" title="Bairro:" multiple="multiple">
                @foreach(get_bairros() as $bairro)
                  <option value="{{ $bairro->id }}">{{ $bairro->nome }}</option>
                @endforeach
              </select>                            
              </div>
              <div class="adv-search-range-cont"> 
                <label for="slider-range-price-sidebar-value" class="adv-search-label">Valor:</label>
                <span>R$</span>
                <input type="text" id="slider-range-price-sidebar-value" readonly class="adv-search-amount" value="">
                <div class="clearfix"></div>
                <div id="slider-range-price-sidebar" data-min="100000" data-max="5000000" data-step="100000" class="slider-range"></div>
              </div>
              <div class="adv-search-range-cont"> 
                <label for="slider-range-area-sidebar-value" class="adv-search-label">Área:</label>
                <span>m<sup>2</sup></span>
                <input type="text" id="slider-range-area-sidebar-value" readonly class="adv-search-amount">
                <div class="clearfix"></div>
                <div id="slider-range-area-sidebar" data-min="0" data-max="980" class="slider-range"></div>
              </div>
              <div class="adv-search-range-cont"> 
                <label for="slider-range-bedrooms-sidebar-value" class="adv-search-label">Quartos:</label>
                <input type="text" id="slider-range-bedrooms-sidebar-value" readonly class="adv-search-amount">
                <div class="clearfix"></div>
                <div id="slider-range-bedrooms-sidebar" data-min="1" data-max="10" class="slider-range"></div>
              </div>
          </div>
        </div>        
      </div>
    </div>
  </section>
@endsection
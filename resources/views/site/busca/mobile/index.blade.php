@extends('site/layout_mobile')

@push('meta')
  @if ($parametros['oferta'])
    <!-- OLD -->
    <meta charset="utf-8">

    @if (isset($construtora->nome_abreviado))
    <title>Ofertas Black Friday - {{ $construtora->nome_abreviado }}</title>
    @else
    <title>@yield('title', 'Black Friday - Portal Lançamentos Online')</title>
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
    <meta name='keywords' content='Black friday, empreendimentos com desconto' />
    <meta property="og:description" content="Ofertas imperdíveis de diversos empreendimentos na planta e prontos pra morar" />
    <meta name="twitter:image" content="https://www.lancamentosonline.com.br/site/images/black-friday-portal.jpg">
    <meta property="og:url" content="https://www.lancamentosonline.com.br/ofertas/black-friday-empreendimentos-com-descontos-incriveis.html" />
    @if (isset($construtora->nome_abreviado))
    <meta property="og:title" content="Ofertas Black Friday - {{ $construtora->nome_abreviado }}" />
    @else
    <meta property="og:title" content="Black Friday - Portal Lançamentos Online" />
    @endif
    <meta property="og:image" content="https://www.lancamentosonline.com.br/site/images/black-friday-portal.jpg" />
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1067">
    <meta property="og:image:height" content="600">
    <meta property="og:type" content="website">
  @else
    <!-- OLD -->
    <meta charset="utf-8">
    <title>@yield('title', 'Portal Lançamentos Online - Exclusivo para Construtoras e Incorporadoras')</title>
    <meta name="description" content="O seu novo lar está aqui!">
    <meta name="keywords" content="lançamentos online, lançamentos imobiliários, apartamento em cuiabá, apartamento novo, imoveis mt, imoveis novos cuiabá"> 
    <meta name="author" content="Lançamentos Online"> 
    <link rel="shortcut icon" href="/site/m/images/favicon.ico">
    <!-- Resolution Screen -->
    <meta content="IE=edge" http-equiv="x-ua-compatible">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <!-- /Resolution Screen -->
    <meta property="og:title" content="Lançamentos Online"/>
    <meta property="og:description" content="O seu novo lar está aqui!">
    <meta property="og:type" content="Portal Imobiliário"/>
    <meta property="og:site_name" content="Portal de anúncios imobiliários especializado em lançamentos."/>
    <meta property="og:image" content="https://lancamentosonline.com.br/site/m/images/logo/lancamentos-online.jpg"/>
    <meta property="og:url" content="https://lancamentosonline.com.br"/>
    <!-- /SEO -->
  @endif

    <!-- Web App -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="apple-mobile-web-app-title" content="Lançamentos Online"/>
    <link rel="apple-touch-icon" href="/site/m/images/logo/app/lancamentosonline.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/site/m/images/logo/app/lancamentosonline-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/site/m/images/logo/app/lancamentosonline-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/site/m/images/logo/app/lancamentosonline-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/site/m/images/logo/app/lancamentosonline-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/site/m/images/logo/app/lancamentosonline-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/site/m/images/logo/app/lancamentosonline-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/site/m/images/logo/app/lancamentosonline-152x152.png" />
  
    <meta name="application-name" content="Lançamentos Online"/>
    <meta name="msapplication-TileColor" content="#000000"/>
    <meta name="msapplication-TileImage" content="https://lancamentosonline.com.br/site/m/images/logo/app/wphone.png"/>

@endpush

@push('css')

@endpush

@push('js_footer')

@endpush

@push('js_header')
<!-- Event snippet for Website lead conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-791268609/XYF3COGT5OsBEIGap_kC'});
</script>

@endpush

@section('content')
  <!-- Main Content -->
  <div class="content-container-busca animated fadeInUp">
    @if($empreendimentos->count() > 0)
      <div class="page-header-container animated fadeInRight">
        <span class="pra-title">
          Sua Busca retornou:
        </span>
        <h2 class="page-title">
          @if($empreendimentos->count() > 1)
            <h2>{{ $total }} empreendimentos </h2>
          @else
            <h2>{{ $total }} empreendimento </h2>
          @endif
        <div class="redline"></div>
      </div>
    @else
      <div class="page-header-container animated fadeInRight">
        <span class="pra-title">
          Em breve! Novos empreendimentos.
        </span>
        <h2 class="page-title"></h2>
        <div class="redline"></div>
      </div>
    @endif
  
    @include('site/busca/mobile/lista')

    <div class="clear"></div>
  </div>
  <!-- End Main Content -->
@endsection
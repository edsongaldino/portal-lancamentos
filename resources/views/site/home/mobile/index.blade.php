@extends('site/layout_mobile')

@push('meta')

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

@endpush

@push('css')

@endpush

@push('js_header')

@endpush

@push('js_footer')

@endpush

@section('content')
<!-- Main Content -->
@include('site/home/mobile/busca/lista')
@include('site/home/mobile/banner/lista')
@include('site/home/mobile/construtora/lista')
@include('site/home/mobile/noticia/lista')
<!-- END MAIN PAGE -->      
@endsection
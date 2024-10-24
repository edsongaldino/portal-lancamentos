@extends('site/layout')	

@push('meta')
<meta charset="utf-8">
<title>@yield('title', 'Portal Lançamentos Online - O seu novo lar está aqui!')</title>
<meta name="description" content="Um portal único e exclusivo para construtoras e incorporadoras.">
<meta name="keywords" content="lançamentos online, lançamentos imobiliários, apartamento em cuiabá, apartamento novo, imoveis mt, imoveis novos cuiabá"> 
<meta name="author" content="Lançamentos Online"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"> 

<meta name="twitter:image" content="https://www.lancamentosonline.com.br/site/m/images/logo/lancamentos-online.jpg">
<meta property="og:url" content="https://www.lancamentosonline.com.br/pagina-inicial.html" />
<meta property="og:title" content="Portal Lançamentos Online - O seu novo lar está aqui!" />
<meta property="og:description" content="Um portal único e exclusivo para construtoras e incorporadoras." />
<meta property="og:image" content="https://www.lancamentosonline.com.br/site/m/images/logo/lancamentos-online.jpg" />
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
<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,500italic,700,700italic&amp;subset=latin,latin-ext'>
<link rel="stylesheet" type="text/css" href="/site/css/plugins.css">
<link rel="stylesheet" type="text/css" href="/site/css/apartment-layout.css">
<link id="skin" rel="stylesheet" type="text/css" href="/site/css/apartment-colors-blue.css">
@endpush

@push('js_header')

<!-- jQuery  -->
<script src="/site/ferramenta/js/jQuery/jquery.min.js"></script>
<script src="/site/ferramenta/js/jQuery/jquery-ui.min.js"></script>
<!-- Bootstrap-->
<script src="/site/ferramenta/bootstrap/bootstrap.min.js"></script>
<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2iyRbAD5MmPd04zL6XmdobC96fNVbjDc&amp;libraries=places"></script>
<!-- plugins script -->
<script src="/site/ferramenta/js/plugins.js"></script>
<!-- template scripts -->
<script src="/site/ferramenta/mail/validate.js"></script>
<script src="/site/ferramenta/js/apartment.js?v=04"></script>
@endpush

@push('js_footer')
<script src="/site/js/ajax/index.js"></script>
<script src="/site/js/home/index.js"></script>
@endpush

@section('content')		
	@include('site/home/desktop/destaque/lista')
	@include('site/home/desktop/resumo/lista')
	@include('site/home/desktop/cidade/lista')
	@include('site/home/desktop/construtora/lista')
	@include('site/home/desktop/noticia/lista')
	@include('site/home/desktop/buscapopular/lista')	
@endsection
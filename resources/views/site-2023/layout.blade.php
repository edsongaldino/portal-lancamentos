<!DOCTYPE html>
<html dir="ltr" lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Ofertas imperdíveis de diversos empreendimentos na planta e prontos pra morar">
	<meta name="keywords" content="lançamentos online, lançamentos imobiliários, apartamento em cuiabá, apartamento novo, imoveis mt, imoveis novos cuiabá">
	<meta name="author" content="Lançamentos Online">
	<!-- css file -->
	<link rel="stylesheet" href="{{ asset('assets/site-2023/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/site-2023/css/style.css') }}">
	<!-- Responsive stylesheet -->
	<link rel="stylesheet" href="{{ asset('assets/site-2023/css/responsive.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/site-2023/css/custom.css') }}">
	<!-- Title -->
	<title>Lançamentos Online - O seu novo lar está aqui!</title>
	<!-- Favicon -->
	<link href="{{ asset('site/favicon.ico') }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
	<link href="{{ asset('site/favicon.ico') }}" sizes="128x128" rel="shortcut icon" />

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<body>
<div class="wrapper">
	<div class="preloader"></div>

	<!-- Main Header Nav -->
	<header class="header-nav menu_style_home_one style2 navbar-scrolltofixed stricky main-menu">
		<div class="container-fluid p0">
		    <!-- Ace Responsive Menu -->
		    <nav>
		        <!-- Menu Toggle btn-->
		        <div class="menu-toggle">
		            <a href="/pagina-inicial.html"><img class="nav_logo_img img-fluid" src="{{ asset('assets/site-2023/images/header-logo.png') }}" alt="header-logo.png"></a>
		            <button type="button" id="menu-btn">
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		        </div>
		        <a href="/pagina-inicial.html" class="navbar_brand float-left dn-smd">
		            <img class="logo1 img-fluid" src="{{ asset('assets/site-2023/images/header-logo.png') }}" alt="header-logo.png">
		            <img class="logo2 img-fluid" src="{{ asset('assets/site-2023/images/header-logo.png') }}" alt="header-logo.png">
		        </a>
		        <!-- Responsive Menu Structure-->
		        <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
		        <ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
					<!--
		            <li>
		                <a href="/empreendimentos/1-apartamentos.html"><span class="title"><i class="fas fa-building"></i> Apartamentos</span></a>
		            </li>
		            <li>
		                <a href="/empreendimentos/2-salascomerciais.html"><span class="title"><i class="fas fa-store"></i> Salas Comerciais</span></a>
		            </li>
		            <li>
		                <a href="/empreendimentos/3-condominiofechado.html"><span class="title"><i class="fas fa-house-damage"></i> Condomínios Horizontais</span></a>
		            </li>
					-->
	                <li class="list-inline-item add_listing"><a href="/plataforma-lancamentos-online.html" target="_blank"><i class="fas fa-rocket"></i><span class="dn-lg"> Anuncie</span></a></li>
					<li class="list-inline-item painel"><a href="/painel-anunciante.html" target="_blank"><i class="fas fa-user"></i><span class="dn-lg"> Login</span></a></li>
		        </ul>
		    </nav>
		</div>
	</header>


	<!-- Main Header Nav For Mobile -->
	<div id="page" class="stylehome1 h0">
		<div class="mobile-menu">
			<div class="header stylehome1">
				<div class="d-flex justify-content-between">
					<a class="mobile-menu-trigger" href="#menu"><img src="{{ asset('assets/site-2023/images/dark-nav-icon.svg') }}" alt=""></a>
					<a class="nav_logo_img" href="index.html"><img class="img-fluid mt20" src="{{ asset('assets/site-2023/images/header-logo.png') }}" alt="header-logo.png"></a>
					<a class="mobile-menu-reg-link" href="page-register.html"><span class="flaticon-user"></span></a>
				</div>
			</div>
		</div><!-- /.mobile-menu -->
		<nav id="menu" class="stylehome1">
			<ul>
				<li>
					<a href="/empreendimentos/1-apartamentos.html"><span class="title"><i class="fas fa-building"></i> Apartamentos</span></a>
				</li>
				<li>
					<a href="/empreendimentos/2-salascomerciais.html"><span class="title"><i class="fas fa-store"></i> Salas Comerciais</span></a>
				</li>
				<li>
					<a href="/empreendimentos/3-condominiofechado.html"><span class="title"><i class="fas fa-house-damage"></i> Condomínios Horizontais</span></a>
				</li>
				<li class="cl_btn"><a class="btn btn-block btn-lg btn-thm circle" href="/plataforma-lancamentos-online.html" target="_blank"><i class="fas fa-rocket"></i> Anuncie</a></li>
			</ul>
		</nav>
	</div>

	<!-- Listing Grid View -->
	<section id="feature-property" class="our-listing bgc-f7 pt0 pb0">
    @yield('content')
	</section>

  <a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>

  <!-- Our Footer -->
	<section class="footer_one">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 pr0 pl0">
					<div class="footer_about_widget">
						<h4>Lançamentos Online</h4>
						<p>O Lancamentos Online é o primeiro portal que publica exclusivamente imóveis novos e na planta das Construtoras e Incorporadoras conectadas. Criamos um canal direto onde você poderá buscar os melhores negócios e ofertas dos lançamentos imobiliários à venda no Brasil.</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
					<div class="footer_qlink_widget">
						<h4>Acesso rápido</h4>
						<ul class="list-unstyled">
							<li class="list-inline-item"><a href="/empreendimentos/1-apartamentos.html"><i class="fas fa-building"></i> Apartamentos</a></li>
							<li class="list-inline-item"><a href="/empreendimentos/2-salascomerciais.html"><i class="fas fa-store"></i> Salas Comerciais</a></li>
							<li class="list-inline-item"><a href="/empreendimentos/3-condominiofechado.html"><i class="fas fa-house-damage"></i> Condomínios Horizontais</a></li>
							<li class="list-inline-item"><a href="/plataforma-lancamentos-online.html" target="_blank"><i class="fas fa-rocket"></i> Anuncie</a></li>
							<li class="list-inline-item"><a href="/painel-anunciante.html" target="_blank"><i class="fas fa-cogs"></i> Painel Anunciante</a></li>
							
						</ul>
					</div>
				</div>
				
				<div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
					<div class="footer_social_widget">
						<h4>Siga-nos</h4>
						<ul class="mb30">
							<li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-dribbble"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-google"></i></a></li>
						</ul>
						<h4>Inscreva-se</h4>
						<form class="footer_mailchimp_form">
						 	<div class="form-row align-items-center">
							    <div class="col-auto">
							    	<input type="email" class="form-control mb-2" id="inlineFormInput" placeholder="Seu email">
							    </div>
							    <div class="col-auto">
							    	<button type="submit" class="btn btn-primary mb-2"><i class="fa fa-angle-right"></i></button>
							    </div>
						  	</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

  <!-- Our Footer Bottom Area -->
	<section class="footer_middle_area pt40 pb40">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-xl-6">
					
				</div>
				<div class="col-lg-6 col-xl-6">
					<div class="copyright-widget text-right">
						<p>© @php echo date("Y"); @endphp Portal Lançamentos Online</p>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>
<!-- Wrapper End -->
<script type="text/javascript" src="{{ asset('assets/site-2023/js/jquery-3.3.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/jquery-migrate-3.0.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/jquery.mmenu.all.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/ace-responsive-menu.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/snackbar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/simplebar.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/parallax.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/scrollto.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/jquery-scrolltofixed-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/jquery.counterup.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/pricing-slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/timepicker.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLZYFMbNKXu2gyC_yxbdEDGxA6G0LSNu8&callback=initMap"type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/google-maps.js') }}"></script>
<!-- Custom script for all pages -->
<script type="text/javascript" src="{{ asset('assets/site-2023/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascripts/mascaras/jquery.mask.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascripts/mascaras/jquery.maskMoney.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>

<script>
	$('.moeda').maskMoney({thousands: '.', decimal: ','});

	//verifica se o navegador tem suporte a geolocalização
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position){ // callback de sucesso
			// ajusta a posição do marker para a localização do usuário
			$('#contact-google-map').attr('data-map-lat', position.coords.latitude);
			$('#contact-google-map').attr('data-map-lng', position.coords.longitude);
		}, 
		function(error){ // callback de erro
		alert('Erro ao obter localização!');
		console.log('Erro ao obter localização.', error);
		});
	} else {
		console.log('Navegador não suporta Geolocalização!');
	}

	/* New Map CustomCode */
	"use strict";
	function gMapHome () {
	  if ($('.map-canvas').length) {
		$('.map-canvas').each(function () {
		  // getting options from html
		  var Self = $(this);
		  var mapName = Self.attr('id');
		  var mapLat = Self.data('map-lat');
		  var mapLng = Self.data('map-lng');
		  var iconPath = Self.data('icon-path');
		  var mapZoom = Self.data('map-zoom');
		  var mapTitle = Self.data('map-title');
	
		  var styles = [
			{"featureType": "all", "elementType": "labels.text", "stylers": [{"visibility": "off"} ] },
			{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#222222"} ] },
			{"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"} ] },
			{"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] },
			{"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 },
			{"lightness": 45 } ] },
			{"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] },
			{"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] },
			{"featureType": "road.local", "elementType": "labels.text", "stylers": [{"visibility": "off"} ] },
			{"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] },
			{"featureType": "water", "elementType": "all", "stylers": [{"color": "#ffe807"},
			{"visibility": "on"} ] } ];
	
		  if ($(this).hasClass('skin1')) {
			var iconPath = 'assets/site-2023/images/resource/map-marker.png';
			var styles = [
			{"featureType": "all", "elementType": "labels.text", "stylers": [{"visibility": "off"} ] },
			{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"} ] },
			{"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"} ] },
			{"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] },
			{"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 },
			{"lightness": 45 } ] }, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] },
			{"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] },
			{"featureType": "road.local", "elementType": "labels.text", "stylers": [{"visibility": "off"} ] },
			{"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] },
			{"featureType": "water", "elementType": "all", "stylers": [{"color": "#ffe807"}, {"visibility": "on"} ] } ];
		  }
		  if ($(this).hasClass('skin2')) {
			var iconPath = 'assets/site-2023/images/resource/map-marker.png';
			var styles = [
			{"featureType": "all", "elementType": "labels", "stylers": [{"visibility": "on"} ] },
			{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#222222"} ] },
			{"featureType": "landscape", "elementType": "all", "stylers": [{"color": "green"} ] },
			{"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] },
			{"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 }, {"lightness": 45 } ] },
			{"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] },
			{"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] },
			{"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] },
			{"featureType": "water", "elementType": "all", "stylers": [{"color": "blue"}, {"visibility": "on"}]}];
		  }
		  if ($(this).hasClass('skin3')) {
			var iconPath = 'assets/site-2023/images/resource/map-marker.png';
			var styles = [{"featureType": "all", "elementType": "labels", "stylers": [{"visibility": "off"} ] },
			{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"} ] },
			{"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"} ] },
			{"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] },
			{"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 },
			{"lightness": 45 } ] }, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] },
			{"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] },
			{"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] },
			{"featureType": "water", "elementType": "all", "stylers": [{"color": "#13a0b2"}, {"visibility": "on"} ] } ];
		  }
		  if ($(this).hasClass('skin4')) {
			var iconPath = 'assets/site-2023/images/resource/map-marker.png';
			var styles = [{"featureType": "all", "elementType": "labels", "stylers": [{"visibility": "off"} ] },
			{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"} ] },
			{"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"} ] },
			{"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] },
			{"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 },
			{"lightness": 45 } ] }, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] },
			{"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] },
			{"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] },
			{"featureType": "water", "elementType": "all", "stylers": [{"color": "#44e2ff"}, {"visibility": "on"} ] } ];
		  }
	
		  // if zoom not defined the zoom value will be 15;
		  if (!mapZoom) {
			var mapZoom = 12;
		  };
		  // init map
		  var map;
		  map = new GMaps({
			  div: '#'+mapName,
			  scrollwheel: false,
			  lat: mapLat,
			  lng: mapLng,
			  styles: styles,
			  zoom: mapZoom
		  });
		  // if icon path setted then show marker
		  if(iconPath) {
			@foreach ($empreendimentos as $empreendimento)
			map.addMarker({
				icon: 'assets/site-2023/images/resource/map-marker-{{ $empreendimento->subtipo_id }}.png',
				lat: {{ $empreendimento->endereco->latitude ?? '-15.595626' }},
				lng: {{ $empreendimento->endereco->longitude ?? '-56.099996' }},
				title: 'Tenby ',
				infoWindow: {
				content:
				'<a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html" target="_blank"><img src="{{ $empreendimento->fotoPrincipal() }}" alt="fp1.jpg"/> <h5>{{ $empreendimento->nome }}</h5> <h4>{{ $empreendimento->subtipo->nome }}</h4> <p>{{ $empreendimento->endereco->bairro->nome ?? '' }}, {{ $empreendimento->endereco->cidade->nome ?? '' }} - {{ $empreendimento->endereco->estado->uf ?? '' }}</p></a>'
			  }
			});
			@endforeach
		  }
		});
	  };
	}
	
	// Dom Ready Function
	jQuery(document).on('ready', function () {
	  (function ($) {
		// add your functions
		gMapHome();
	  })(jQuery);

	  	var municipios = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace("nome"),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: {
				url: "/auto-complete-cidades/%QUERY",
				wildcard: '%QUERY'
			},
			limit: 10
		});
		municipios.initialize();

		$("#ttexto").typeahead({
			hint: true,
			highlight: true,
			minLength: 1
		},
		{
			name: "municipios",
			displayKey: "nome",
			source: municipios.ttAdapter()
		}).bind("typeahead:selected", function(obj, datum, name) {
			console.log(datum);
			$(this).data("seletectedId", datum.nome);
			$('#cidade').val(datum.id);
			console.log(datum.value);
		});  



		var empreendimentos = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace("nome"),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: {
				url: "/auto-complete-empreendimentos/%QUERY",
				wildcard: '%QUERY'
			},
			limit: 10
		});
		empreendimentos.initialize();

		$("#etexto").typeahead({
			hint: true,
			highlight: true,
			minLength: 1
		},
		{
			name: "empreendimentos",
			displayKey: "nome",
			source: empreendimentos.ttAdapter()
		}).bind("typeahead:selected", function(obj, datum, name) {
			console.log(datum);
			$(this).data("seletectedId", datum.nome);
			$('#empreendimento').val(datum.id);
			console.log(datum.value);
		});

		var construtoras = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace("nome"),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: {
				url: "/auto-complete-construtoras/%QUERY",
				wildcard: '%QUERY'
			},
			limit: 10
		});
		construtoras.initialize();

		$("#ctexto").typeahead({
			hint: true,
			highlight: true,
			minLength: 1
		},
		{
			name: "construtoras",
			displayKey: "nome",
			source: construtoras.ttAdapter()
		}).bind("typeahead:selected", function(obj, datum, name) {
			console.log(datum);
			$(this).data("seletectedId", datum.nome);
			$('#construtora').val(datum.id);
			console.log(datum.value);
		});


	});

	</script>

</body>
</html>

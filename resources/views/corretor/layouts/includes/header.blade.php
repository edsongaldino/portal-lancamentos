<!DOCTYPE html>
<html lang="pt-br">
	<head>
        <title>Lançamentos Online - Conectando o Corretor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="Um canal direto onde você poderá buscar os melhores negócios e ofertas dos lançamentos imobiliários à venda no Brasil">
        <meta name="keywords" content="" />
        <script type="application/x-javascript"> addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <meta charset utf="8">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <!--font-awsome-css-->
        <link rel="stylesheet" href="{{ asset('corretor/app-assets/css/font-awesome.min.css') }}">
        <!--bootstrap-->
        <link href="{{ asset('corretor/app-assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <!--custom css-->
        <link href="{{ asset('corretor/app-assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{ asset('corretor/app-assets/css/percircle.css') }}">
        <!--component-css-->
        <script src="{{ asset('corretor/app-assets/js/jquery-2.1.4.min.js') }}"></script>
        <!--script-->
        <script src="{{ asset('corretor/app-assets/js/modernizr.custom.js') }}"></script>
        <script src="{{ asset('corretor/app-assets/js/bigSlide.js') }}"></script>
        <script>
            $(document).ready(function() {
            $('.menu-link').bigSlide();
            });
        </script>
        <script type="text/javascript" src="{{ asset('corretor/app-assets/js/move-top.js') }}"></script>
        <script type="text/javascript" src="{{ asset('corretor/app-assets/js/easing.js') }}"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".scroll").click(function(event){
                    event.preventDefault();
                    $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
                });
            });
        </script>
        <!--script-->
        <!-- swipe box js -->
        <link rel="stylesheet" href="{{ asset('corretor/app-assets/css/swipebox.css') }}">
        <script src="{{ asset('corretor/app-assets/js/jquery.swipebox.min.js') }}"></script>
            <script type="text/javascript">
                jQuery(function($) {
                    $(".swipebox").swipebox();
                });
        </script>
        <!-- //swipe box js -->
        <link href="{{ asset('corretor/app-assets/vendor/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link href="{{ asset('global/css/loader/index.css') }}" rel="stylesheet" type="text/css" />

    </head>
<body>

<div class="spinner-loading" id="loader"></div>

<div class="body-back">
	<div class="masthead pdng-stn1">
		<div id="menu" class="panel" role="navigation">
			<div class="wrap-content">
				<div class="profile-menu text-center">
                        @if(Session::get('usuario.foto') <> null)
					    <img class="img-circle border-effect" src="{{ url('corretor/usuario/'.Session::get('usuario.id').'/foto') }}" alt=" ">
                        @else
                        <img class="img-circle border-effect" src="{{ asset('corretor/app-assets/images/userFoto.png') }}" alt=" ">
                        @endif
						<h3>{{ Session::get('usuario.nome') }}</h3>
						<p>Corretor</p>
						<div class="pro-menu">
							<div class="logo">
								<li><a class="link link--yaku active" href="{{ route('home-corretor') }}"><span>H</span><span>o</span><span>m</span><span>e</span></a></li>
                                <!--
                                <li><a class="link link--yaku" href="{{ route('corretor.empreendimentos') }}"><span>E</span><span>m</span><span>p</span><span>r</span><span>e</span> <span>e</span><span>n</span><span>d</span><span>i</span><span>m</span><span>e</span><span>n</span><span>t</span><span>o</span><span>s</span></a></li>
								<li><a class="link link--yaku" href="{{ route('corretor.propostas') }}"><span>P</span><span>r</span><span>o</span><span>p</span><span>o</span><span>s</span><span>t</span><span>a</span><span>s</span></a></li>
                                <li><a class="link link--yaku" href="{{ route('corretor.leads') }}"><span>L</span><span>e</span><span>a</span><span>d</span><span>s</span></a></li>
                                -->
                                <li><a class="link link--yaku" href="{{ route('corretor.perfil') }}"><span>P</span><span>e</span><span>r</span><span>f</span><span>i</span><span>l</span></a></li>
                                <li><a class="link link--yaku" href="{{ route('corretor.logout') }}"><span>S</span><span>a</span><span>i</span><span>r</span></a></li>
                            </div>
						</div>
				</div>
			</div>
		</div>
		<div class="phone-box wrap push" id="home">
        <div class="menu-notify">
            <div class="profile-left">
                <a href="#menu" class="menu-link"><i class="fa fa-list-ul"></i></a>
            </div>
            <div class="Profile-mid">
                <h5 class="pro-link">APP Corretor</h5>
            </div>
            <div class="voltar"><a href="javascript:void(0)" onClick="history.go(-1); return false;"><button><i class="fa fa-angle-double-left" aria-hidden="true"></i></button></a></div>
            <div class="clearfix"></div>
        </div>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  @stack('meta')
  <!--  NEW-->
  <!-- Resolution Screen -->
  <meta content="IE=edge" http-equiv="x-ua-compatible">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
  <meta content="yes" name="apple-mobile-web-app-capable">
  <meta content="yes" name="apple-touch-fullscreen">
  <!-- /Resolution Screen -->
  <script type="text/javascript" src="/site/m/js/jquery.js"></script>

  @stack('css')
  <!-- CSS Styles -->
  <link rel="stylesheet" type="text/css" href="/site/m/css/stylec474.css?v=1.5">
  <link rel="stylesheet" type="text/css" href="/site/m/css/responsive.css?v=1.5">
  <script type="text/javascript" src="/global/js/ajax/index.js?v=1.5"></script>
  <script src="/site/ferramenta/js/maskbrphone/maskbrphone.js?v=1.5" type="text/javascript"></script>

  @stack('js_header')
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <!--
  <script type="text/javascript" src="/site/m/js/jquery.js"></script>-->
  <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script language="javascript" type="text/javascript">
    // instancia a pesquisa rapida
    $(document).ready(function() {
      $("#busca_rapida").autocomplete({source: "/autocomplete?tipo_busca=texto", delay: 0, position: { my : "right top", at: "right bottom" }});
    });
  </script>
  <link rel="stylesheet" type="text/css" href="/site/m/css/slide-index.css" />

  <!-- Global site tag (gtag.js) - Google Ads: 791268609 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-791268609"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-791268609');
  </script>

</head>
<body>
  <div id="main">
    <!-- LEFT SIDEBAR -->
    <div id="slide-out-left" class="side-nav">
      <!-- App/Site Menu -->
      <ul class="collapsible" data-collapsible="accordion">

        @if(false)
        <div class="dados-usuario-menu" style="display:none">
          <img src="" alt="" class="foto-usuario-logado">
          <div class="nome-usuario-logado"></div>
          <div class="email-usuario-logado"></div>
        </div>
        @endif

        <li>
          <a href="/">
            <i class="fa fa-reply-all"></i>
            Home
          </a>
        </li>
        <li>
          <a href="/seja-membro.html">
            <i class="fa fa-file-text-o"></i>
            Quem somos
          </a>
        </li>
        <li style="display: none">
          <a href="/construtoras">
            <i class="fa fa-user"></i>
            construtoras
          </a>
        </li>
        <li>
          <div class="collapsible-header current-item">
            <i class="fa fa-building-o"></i>
            Apartamentos
            <span class="angle-right fa fa-angle-right icone_right"></span>
          </div>
          <div class="collapsible-body">
            <ul>
              <li><a href="/apartamentos/4/mude-ja">Mude já</a></li>
              <li><a href="/apartamentos/1/em-obra">Em obra</a></li>
              <li><a href="/apartamentos/3/lancamento">Lançamento</a></li>
              <li><a href="/apartamentos/2/breve-lancamento">Breve lançamento</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="collapsible-header current-item">
            <i class="fa fa-home fa-2x"></i>
            Condomínios
            <span class="angle-right fa fa-angle-right icone_right"></span>
          </div>
          <div class="collapsible-body">
            <ul>
              <li><a href="/condominios/4/mude-ja">Mude já</a></li>
              <li><a href="/condominios/1/em-obra">Em obra</a></li>
              <li><a href="/condominios/3/lancamento">Lançamento</a></li>
              <li><a href="/condominios/2/breve-lancamento">Breve lançamento</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="collapsible-header current-item">
            <i class="fa fa-briefcase"></i>
            Salas Comerciais
            <span class="angle-right fa fa-angle-right icone_right"></span>
          </div>
          <div class="collapsible-body">
            <ul>
              <li><a href="/comerciais/1/em-obra">Em obra</a></li>
              <li><a href="/comerciais/4/mude-ja">Prontos</a></li>
            </ul>
          </div>
        </li>

        <li>
          <a href="/ofertas/black-friday-empreendimentos-com-descontos-incriveis.html" class="oferta-black">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            Ofertas
          </a>
        </li>

        <li>
          <a href="/admin" class="painel-admin">
            <i class="fa fa-cog" aria-hidden="true"></i>
            Acesso Construtora
          </a>
        </li>

        @if(false)
        <li>
          <a href="/minha_conta.php">
            <i class="fa fa-user"></i>
            Meu perfil
          </a>
        </li>

        <li>
          <a href="/favoritos.php">
            <i class="fa fa-heart"></i>
            Favoritos
          </a>
        </li>
        <li>
          <a href="/logout.php">
            <i class="fa fa-file-text-o"></i>
            Sair
          </a>
        </li>
        @else
        <li style="display:none">
          <a href="/login.php">
            <i class="fa fa-user"></i>
            Login
          </a>
        </li>
        @endif
      </ul>
      <!-- End Site/App Menu -->
    </div>
    <!-- END LEFT SIDEBAR -->

    <!-- MAIN PAGE -->
    <div id="page">
      <!-- FIXED Top Navbar -->
      <div class="top-navbar">
        <div class="top-navbar-right">
          <a href="#" id="menu-right" data-activates="slide-out-left">
            <i class="fa fa-bars"></i>
          </a>
        </div>
        <div class="site-title">
          <a href="/pagina-inicial.html" >
            <img src="/site/m/images/logo_lancamentos_online.png" width="198px" style="margin-top: 5px;" />
          </a>
        </div>
      </div>
      <!-- End FIXED Top Navbar -->

      @yield('content')
    </div>
    <!-- #main -->

    <!-- INICIO FOOTER -->
    <div class="footer">
      <div class="social-footer">
        <a href="https://www.facebook.com/Lancamentosonline" target="_blank" class="facebook">
          <i class="fa fa-facebook"></i>
        </a>
        <a href="https://twitter.com/lancamentos_BRA" target="_blank" class="twitter">
          <i class="fa fa-twitter"></i>
        </a>
        <a href="https://www.youtube.com/user/Lancamentosonline" target="_blank" class="gplus">
          <i class="fa fa-youtube"></i>
        </a>
      </div>
      <div class="navigation">
        <a href="/pagina-inicial.html">Início</a>
        <a href="/seja-membro.html">Quem Somos</a>
        <!--<a href="/fale-conosco">Fale Consoco</a>-->
      </div>
      <div class="copyright">
        &copy; Todos os direitos reservados.
      </div>
    </div>
    <!-- End FOOTER -->

    <!-- Back to top Link -->
    <div id="to-top" class="main-bg">
      <i class="fa fa-long-arrow-up"></i>
    </div>

    <div class="spinner-loading" style="display: none"></div>

    @stack('modal')

    <!-- FIM FOOTER -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-S0SXNSHLBM"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-S0SXNSHLBM');
    </script>
    <script type="text/javascript" src="/site/m/js/materialize.min.js"></script>
    <script type="text/javascript" src="/site/m/js/slick.min.js"></script>
    <script type="text/javascript" src="/site/m/js/jquery.swipebox.min.js"></script>
    <script type="text/javascript" src="/site/m/js/custom.js"></script>
    <script type="text/javascript" src="/site/m/js/jquery-ui.min.js"></script>
    <script type="text/javascript">
      function mostraCampo() {
        var tipo_busca = $('#tipo_busca').val();

        if(tipo_busca == '1'){
          $("#busca-bairro").css("display","block");
          $("#busca-empreendimento").css("display","none");
          $("#busca-construtora").css("display","none");
          $("#busca-geral").css("display","none");
        }else if(tipo_busca == '2'){
          $("#busca-bairro").css("display","none");
          $("#busca-empreendimento").css("display","block");
          $("#busca-construtora").css("display","none");
          $("#busca-geral").css("display","none");
        }else if(tipo_busca == '3'){
          $("#busca-bairro").css("display","none");
          $("#busca-empreendimento").css("display","none");
          $("#busca-construtora").css("display","block");
          $("#busca-geral").css("display","none");
        }
      }
    </script>
    @stack('js_footer')

  </body>
  </html>

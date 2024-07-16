<!DOCTYPE html>
<html lang="pt-br">
  <head>
    @stack('meta')

    <link rel="shortcut icon" href="/site/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/site/favicon.ico" type="image/x-icon">
    @stack('css')
    @stack('js_header')
    <link rel="stylesheet" href="/assets/sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">
    <link rel="stylesheet" href="/site/css/mobile.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="/global/css/loader/index.css">
    <link rel="stylesheet" href="/assets/site-2023/css/ace-responsive-menu.css">
    <script src="/global/js/loader/index.js"></script>
  </head>
  <body>
    <div class="loader-bg"></div>
    <header class="menu-topo">

        <a href="/pagina-inicial.html"><img class="logo-lancamentos-topo" src="{{ asset('assets/site-2023/images/header-logo.png') }}" alt="header-logo.png"></a>

        <div class="menu">  
          @if(isset($empreendimento))
            <div class="item"><a href="/busca-mapa.html?subtipo_id={{ $empreendimento->subtipo_id }}" target="_blank"><i class="fa fa-search"></i> Ver outros anúncios</a></div>
          @else
            <div class="item"><a href="/busca-mapa.html" target="_blank"><i class="fa fa-search"></i> Ver outros anúncios</a></div>
          @endif
                
          <div class="item parceiro"><a href="/plataforma-lancamentos-online.html" target="_blank"><i class="fa fa-rocket" aria-hidden="true"></i> Anuncie</a></div>
          <div class="item"><a href="/painel-anunciante.html" target="_blank"><i class="fa fa-user"></i> Login</a></div>
        </div>

    </header>
    <div id="mensagem-envio"></div>

    @yield('content')

    <!-- Modal-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="modal-title" id="exampleModalLongTitle">DESEJA ADICIONAR ESTE EMPREENDIMENTO AOS SEUS FAVORITOS?</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NÃO, FECHAR!</button>
            <button type="button" class="btn btn-primary"><i class="fa fa-heart fa-2x" aria-hidden="true"></i> SIM, MARCAR COMO FAVORITO!</button>
          </div>
        </div>
      </div>
    </div>

    <footer class="large-cont">
      <div class="container">
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-lg-3">
            <h4 class="second-color">Institucional</h4>
            <div class="footer-title-separator"></div>
            <p class="footer-p">O Lancamentos Online é o primeiro portal que publica exclusivamente imóveis novos e na planta das Construtoras e Incorporadoras conectadas. Criamos um canal direto onde você poderá buscar os melhores negócios e ofertas dos lançamentos imobiliários à venda no Brasil.</p>
            <address>
              <span><i class="fa fa-envelope fa-sm"></i><a href="#">contato@lancamentosonline.com.br</a></span>
            </address>
            <div class="clear"></div>
          </div>
          <div class="col-xs-6 col-sm-6 col-lg-3">
            <h4 class="second-color">Parceiros</h4>
            <div class="footer-title-separator"></div>
            <div class="col-xs-6 col-sm-6 col-lg-6 logo-parceiro"><a href="https://www.hypnobox.com.br/" title="Crm | Hypnobox - Transformamos leads em comissões" target="_Blank"><img src="/site/images/parceiros/hypnobox.png" class="img-responsive" alt=""></a></div>
            <div class="col-xs-6 col-sm-6 col-lg-6 logo-parceiro"><a href="https://www.anapro.com.br/" title="ANAPRO | Solução comercial completa para incorporadoras pequenas, médias e grandes" target="_Blank"><img src="/site/images/parceiros/anapro.png" class="img-responsive" alt=""></a></div>
            <div class="col-xs-6 col-sm-6 col-lg-6 logo-parceiro"><a href="https://www.appfacilita.com/" title="Facilita" target="_Blank"><img src="/site/images/parceiros/facilita.png" class="img-responsive" alt=""></a></div>
            <div class="col-xs-6 col-sm-6 col-lg-6 logo-parceiro"><a href="https://www.suahouse.com/" title="suahouse | one stop solution" target="_Blank"><img src="/site/images/parceiros/suahouse.png" class="img-responsive" alt=""></a></div>
            <div class="col-xs-6 col-sm-6 col-lg-6 logo-parceiro"><a href="https://www.construtordevendas.com.br/" title="Construtor de Vendas - Espelho de vendas para construtoras" target="_Blank"><img src="/site/images/parceiros/construtor.png" class="img-responsive" alt=""></a></div>
            <div class="clear"></div>
          </div>
          <div class="col-xs-6 col-sm-6 col-lg-3">
            <h4 class="second-color">Empreendimentos</h4>
            <div class="footer-title-separator"></div>
            <ul class="footer-ul">
              <li><span class="custom-ul-bullet"></span><a href="/empreendimentos/1-apartamentos.html">Apartamentos</a></li>
              <li><span class="custom-ul-bullet"></span><a href="/empreendimentos/2-salascomerciais.html">Salas comerciais</a></li>
              <li><span class="custom-ul-bullet"></span><a href="/empreendimentos/3-condominiofechado.html">Casas em condomínio</a></li>
              <li><span class="custom-ul-bullet"></span><a href="/empreendimentos/3-terrenocondominio.html">Terrenos em condomínio</a></li>
              <li><span class="custom-ul-bullet"></span><a href="/empreendimentos/4-loteamentos.html">Loteamentos</a></li>
            </ul>
          </div>
          <div class="col-xs-12 col-sm-6 col-lg-3">
            <h4 class="second-color">newsletter</h4>
            <div class="footer-title-separator"></div>
            <p class="footer-p">Cadastre seu e-mail e receba em primeira mão as melhores informações sobre o mercado imobiliário</p>
            <form class="form-inline footer-newsletter" id="form-newsletter">
              <input type="email" class="form-control" id="exampleInputEmail2" name="email" placeholder="Cadastre seu email" required>
              <input type="hidden" class="text" name="acao" value="eVZHZDBWR2J6ZFhadTFTYnk5bVp0RW1kaEozWg==">
              <button type="submit" class="btn"><i class="fa fa-lg fa-paper-plane"></i></button>
            </form>
          </div>
        </div>
      </div>
    </footer>
    <footer class="small-cont">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-md-2 small-cont">
            <img src="/site/images/logo-light.png" alt="" class="img-responsive footer-logo" />
          </div>
          <div class="col-xs-12 col-md-10 footer-copyrights">
            &copy; Copyright {{ date('Y') }} Lançamentos online - Todos os direitos reservados | <a href="politica-de-privacidade-lancamentos-online.html">POLÍTICA DE PRIVACIDADE</a> | <a href="termos-de-uso-lancamentos-online.html">TERMOS DE USO</a>
          </div>
        </div>
      </div>
    </footer>
    </div>
    <!-- Move to top button -->
    <div class="move-top">
      <div class="big-triangle-second-color"></div>
      <div class="big-icon-second-color"><i class="jfont fa-lg">&#xe803;</i></div>
    </div>
    <!-- Login modal-->
    <div class="modal fade apartment-modal" id="login-modal-old" style="display">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-title">
              <h1>Acesso Visitante</h1>
              <div class="short-title-separator"></div>
            </div>
            <a href="https://www.facebook.com/v2.4/dialog/oauth?client_id=1819690215006067&amp;state=ca0ec83456b7b8daaebbdeedc87c63c9&amp;response_type=code&amp;sdk=php-sdk-5.6.2&amp;redirect_uri=https%3A%2F%2Fwww.lancamentosonline.com.br%2Ffb-callback.php&amp;scope=email" class="facebook-button">
            <i class="fa fa-facebook"></i>
            <span>Login pelo Facebook</span>
            </a>
            <div class="margin-top-30"></div>
            <form name="login_usuario" method="POST" action="valida_login.php" enctype="multipart/form-data">
              <input name="email_usuario" type="email" class="input-full main-input" placeholder="Email" require/>
              <input name="senha_usuario" type="password" class="input-full main-input" placeholder="Senha" require/>
              <a href="javascript:login_usuario.submit()" class="button-primary button-shadow button-full">
                <span>Entrar</span>
                <div class="button-triangle"></div>
                <div class="button-triangle2"></div>
                <div class="button-icon"><i class="fa fa-user"></i></div>
              </a>
            </form>
            <a href="#forgot-modal" class="forgot-link pull-right">Esqueceu sua senha?</a>
            <div class="clearfix"></div>
            <p class="modal-bottom">Não tem cadastro? <a href="#register-modal" data-toggle="modal" class="register-link">Registre-se</a></p>
          </div>
        </div>
      </div>
    </div>
    <!--.modal --><!-- Register modal /.modal -->
    <div class="modal fade apartment-modal" id="register-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-title">
              <h1>Cadastre-se</h1>
              <div class="short-title-separator"></div>
            </div>
            <form name="cadastro_usuario" method="POST" action="grava_dados_usuario.php" enctype="multipart/form-data">
              <input name="nome_usuario" type="text" class="input-full main-input" placeholder="Nome completo" />
              <input name="email_usuario" type="email" class="input-full main-input" placeholder="Email" />
              <input name="telefone_usuario" type="text" class="input-full main-input" placeholder="Telefone" />
              <input name="senha_usuario" type="password" class="input-full main-input" placeholder="Senha" />
              <input name="confirma_senha_usuario" type="password" class="input-full main-input" placeholder="Repita a senha" />
              <a href="javascript:cadastro_usuario.submit()" class="button-primary button-shadow button-full">
                <span>Cadastrar</span>
                <div class="button-triangle"></div>
                <div class="button-triangle2"></div>
                <div class="button-icon"><i class="fa fa-user"></i></div>
              </a>
              <div class="clearfix"></div>
              <p class="login-or">Ou</p>
              <a href="https://www.facebook.com/v2.4/dialog/oauth?client_id=1819690215006067&amp;state=ca0ec83456b7b8daaebbdeedc87c63c9&amp;response_type=code&amp;sdk=php-sdk-5.6.2&amp;redirect_uri=https%3A%2F%2Fwww.lancamentosonline.com.br%2Ffb-callback.php&amp;scope=email" class="facebook-button">
              <i class="fa fa-facebook"></i>
              <span>Use sua conta do Facebook</span>
              </a>
              <input type="hidden" name="acao" id="acao" value="ejlHWmhSV0x5Rm1kaEozWg==">
            </form>
            <p class="modal-bottom">Já tem cadastro? <a href="#" class="login-link">Faça login</a></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Forgotten password modal -->
    <div class="modal fade apartment-modal" id="forgot-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-title">
              <h1>Esqueceu sua senha<span class="special-color">?</span></h1>
              <div class="short-title-separator"></div>
            </div>
            <form name="resetar_senha" method="POST" action="recuperar_senha.php" enctype="multipart/form-data">
              <p class="negative-margin forgot-info">Insira seu e-mail de cadastro.<br/>Enviaremos um link para redefinição de senha no seu e-mail.</p>
              <input name="email_reset" id="email_reset" type="email" class="input-full main-input" placeholder="Seu e-mail" required/>
              <a href="javascript:resetar_senha.submit()" class="button-primary button-shadow button-full">
                <span>Lembrar minha senha</span>
                <div class="button-triangle"></div>
                <div class="button-triangle2"></div>
                <div class="button-icon"><i class="fa fa-user"></i></div>
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--.modal -->
    <script src="/assets/javascripts/sweetalert2.8.js?v=1.5"></script>
    <script src="/assets/vendor/pnotify/pnotify.custom.js?v=1.5"></script>
    <script src="/site/js/home/newsletter.js?v=1.5"></script>
    <script>
      $(function () {
        new Newsletter();
      });
    </script>
    <script src="/site/ferramenta/bootstrap/bootstrap3-typeahead.min.js"></script>

    <script type="text/javascript">
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.typeahead').typeahead({
        source:  function (texto, process) {
          if (texto.length > 2) {
            return $.post('/autocomplete-geral', { texto: texto }, function (data) {
              return process(data);
            });
          }
        }
      });

    </script>

    @stack('js_footer')
    <div class="spinner-loading" style="display: none"></div>
  </body>
</html>

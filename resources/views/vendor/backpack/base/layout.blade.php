<!DOCTYPE html>
<html class="sidebar-left-collapsed fixed" lang="{{ app()->getLocale() }}">
<head>
  @include('backpack::inc.head')
</head>
<body class="hold-transition {{ config('backpack.base.skin') }} sidebar-mini sidebar-left-collapsed">
  <section class="body">
    <!-- start: header -->
    <header class="header">
      <div class="logo-container">
        <a href="{{ backpack_url('dashboard') }}" class="logo">
          <img src="/assets/images/logo.png" height="35" alt="Lançamentos Online" />
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
          <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
        @if (isAdmin())
          <div class="col-xs-2" style="margin-top:10px"> 
            <select class="form-control" name="construtora_id" id="select_construtora_id">
              <option value="">Nenhuma construtora</option>
              @foreach (get_construtoras() as $construtora)
              <option value="{{ $construtora->id }}" 
                @if ($construtora->id == Auth::user()->construtora_id)
                selected="true"
                @endif
                >
                {{ $construtora->nome_abreviado }}
              </option>
              @endforeach
            </select>
          </div>
        @endif
      </div>
      
      <!-- start: search & user box -->
      <div class="header-right">    
        
        <div id="userbox" class="userbox">
          <a href="#" data-toggle="dropdown">
            <figure class="profile-picture">
              @if (Auth::user()->foto)
              <img src="{{ url(Auth::user()->foto) }}" class="img-circle" alt="{{ Auth::user()->foto }}">
              @else
              <img src="{{ url('assets/images/user-sem-foto.jpg') }}" class="img-circle">
              @endif
            </figure>
            <div class="profile-info" data-lock-name="{{ Auth::user()->name }}" data-lock-email="{{ Auth::user()->email }}">
              <span class="name">{{ Auth::user()->name }}</span>
              <span class="role">
                @foreach (Auth::user()->getRoleNames() as $role)
                {{ $role }}
                @endforeach
              </span>
            </div>
            
            <i class="fa custom-caret"></i>
          </a>
          
          <div class="dropdown-menu">
            <ul class="list-unstyled">
              <li class="divider"></li>
              <li>
                <a role="menuitem" tabindex="-1" href="{{ route('perfil-usuario') }}"><i class="fa fa-user"></i> Meu perfil</a>
              </li>
              <li>
                <a role="menuitem" tabindex="-1" href="/admin/logout"><i class="fa fa-power-off"></i> Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- end: search & user box -->
    </header>
    <!-- end: header -->
    
    <div class="inner-wrapper">
      <!-- start: sidebar -->
      <aside id="sidebar-left" class="sidebar-left">
        
        <div class="sidebar-header">
          <div class="sidebar-title">
            Lançamentos Online
          </div>
          <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
          </div>
        </div>
        
        <div class="nano">
          <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">                    
              <ul class="nav nav-main">
                @include('backpack::inc.sidebar_content')
              </ul>
            </nav>      
          </div>
          
          <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
              if (localStorage.getItem('sidebar-left-position') !== null) {
                var initialPosition = localStorage.getItem('sidebar-left-position'),
                sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                
                sidebarLeft.scrollTop = initialPosition;
              }
            }
          </script>
          
          
        </div>
        
      </aside>
      <!-- end: sidebar -->
      
      <section class="content-body" role="main">          
        @yield('header')  
        @yield('content')  
      </section>
    </div>
  </section>
  
  
  <div class="modal fade" id="gerarUnidadesHorizontais" tabindex="-1" role="dialog" aria-labelledby="gerarUnidadesLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gerarUnidadesLabel">Gerar quadra e unidades</h4>
        </div>
        <div class="modal-body">
          <form id="dados-gerar-quadras-unidades" class="form-horizontal form-bordered">
            <input type="hidden" name="empreendimento_id" value="@if (isset($entry)){{ $entry->id }}@endif">
            
            <div class="form-group">
              <label class="col-md-2 control-label">Quadras (Total):</label>
              <div class="col-md-2">
                <input class="form-control" type="number" min="1" name="quadras">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-md-2 control-label">Unidades por Quadra:</label>
              <div class="col-md-2">
                <input class="form-control" type="number" min="1" name="unidades_quadra">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-md-2 control-label">Nomenclatura (Unidades):</label>
              <div class="col-md-5">
                <select class="form-control" name="nomenclatura">
                  <option value="Reiniciar">Sequencial com reínicio por quadra (1,2,3 Quadra 1, 1,2,3 Quadra 2...)</option>                                    
                  <option value="Sequencial">Sequencial (1,2,3,4,5...)</option>                  
                </select>
              </div>
            </div>  
            
            <div class="form-group">
              <div class="col-md-12">
                <button class="btn btn-success" type="button" id="gerar-quadras-unidades"><i class="fa fa-check-square-o"></i> Gerar quadras e unidades</button>    
              </div>
            </div>                          
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="gerarUnidadesVerticais" tabindex="-1" role="dialog" aria-labelledby="gerarUnidadesLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gerarUnidadesLabel">Gerar torres e unidades</h4>
        </div>
        <div class="modal-body">
          <form id="dados-gerar-torres-unidades" class="form-horizontal form-bordered torre">
            <input type="hidden" name="empreendimento_id" value="@if (isset($entry)){{ $entry->id }}@endif">
            
            <div class="form-group">
              <label class="col-md-2 control-label">Torres (Total):</label>
              <div class="col-md-2">
                <input class="form-control" type="number" min="1" name="torres">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-md-2 control-label">Andares (Total):</label>
              <div class="col-md-2">
                <input class="form-control" type="number" min="1" name="andares">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-md-2 control-label">Unidades por Andar:</label>
              <div class="col-md-2">
                <input class="form-control" type="number" min="1" name="unidades_andar">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Unidades no térreo?</label>
              <div class="col-md-2">                
                <input name="unidades_terreo" type="checkbox" value="1">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Unidades na cobertura?</label>
              <div class="col-md-2">                
                <input name="cobertura" type="checkbox" value="1">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-md-2 control-label">Nomenclatura (Unidades):</label>
              <div class="col-md-5">
                <select class="form-control" name="nomenclatura_unidades">
                  <option value="Dezena">Dezena (11,12,13,14,15...) - À partir do 1º Andar</option>
                  <option value="Centena">Centena (101,102,103,104,105...) - À partir do 1º Andar</option>                                    
                </select>
              </div>
            </div>  
            
            <div class="form-group">
              <div class="col-md-12">
                <button class="btn btn-success salvar-dados" type="button" id="gerar-torres-unidades"><i class="fa fa-check-square-o"></i> Gerar torres e unidades</button>    
              </div>
            </div>                       
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="spinner-loading" style="display: none"></div>

  <div class="modal fade" id="alterarVendaUnidade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body"></div>
      </div>
    </div>
  </div>
    
  <script src="/global/js/ajax/index.js?v=01"></script>
  <script src="/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
  <script src="/bower_components/jquery-maskmoney/dist/jquery.maskMoney.min.js"></script>
  
  @yield('before_scripts')
  @stack('before_scripts')
  
  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });      
    
    $(function () {
      $('.celular').mask('(00) 00000-0000');
      $('.fixo').mask('(00) 0000-0000');
      $('.cep').mask('00000-000');
      $('.date').mask('00/00/0000');
      $('.cnpj').mask('00.000.000/0000-00');
      $('.cpf').mask('000.000.000-00');
      $('.moeda').maskMoney({thousands: '.', decimal: ','});
      $('.moeda2').maskMoney({thousands: '', decimal: '.'});
    });
  </script>
  
  @include('backpack::inc.alerts')
  
  <script src="/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendor/nanoscroller/nanoscroller.js"></script>
  <script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="/assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
  <script src="/assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
  
  <!-- Specific Page Vendor -->
  <script src="/assets/vendor/autosize/autosize.js"></script>
  
  <!-- Theme Base, Components and Settings -->
  <script src="/assets/javascripts/theme.js"></script>
  
  <!-- Theme Custom -->
  <script src="/assets/javascripts/theme.custom.js"></script>
  
  <!-- Theme Initialization Files -->
  <script src="/assets/javascripts/theme.init.js"></script>
  
  <!-- Specific Page Vendor -->
  <script src="/assets/vendor/jquery-autosize/jquery.autosize.js"></script>
  <script src="/assets/vendor/gauge/gauge.js"></script>
  
  <!-- Specific Page Vendor -->
  <script src="/assets/vendor/jquery-appear/jquery.appear.js"></script>
  <script src="/assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
  <script src="/assets/vendor/flot/jquery.flot.js"></script>
  <script src="/assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
  <script src="/assets/vendor/flot/jquery.flot.pie.js"></script>
  <script src="/assets/vendor/flot/jquery.flot.categories.js"></script>
  <script src="/assets/vendor/flot/jquery.flot.resize.js"></script>
  <script src="/assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
  <script src="/assets/vendor/raphael/raphael.js"></script>
  <script src="/assets/vendor/morris/morris.js"></script>
  <script src="/assets/vendor/snap-svg/snap.svg.js"></script>
  <script src="/assets/vendor/liquid-meter/liquid.meter.js"></script>

  <script src="/assets/vendor/bootstrap-markdown/js/markdown.js"></script>
	<script src="/assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
	<script src="/assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
  
  <!-- Theme Base, Components and Settings -->
  <script src="/assets/javascripts/theme.js"></script>
  
  <!-- Theme Custom -->
  <script src="/assets/javascripts/theme.custom.js"></script>
  
  <!-- Theme Initialization Files -->
  <script src="/assets/javascripts/theme.init.js"></script>
  
  <!-- Examples -->
  <script src="/assets/javascripts/ui-elements/examples.charts.js"></script>
  
  <!-- Examples -->
  <script src="/assets/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>
  <script src="/assets/javascripts/forms/examples.advanced.form.js" /></script>
  <script src="/assets/javascripts/sweetalert2.8.js"></script>
  <script src="/global/js/confirmacao/index.js?v={{ filemtime('global/js/confirmacao/index.js') }}"></script>
  <script src="/global/js/ajax/index.js"></script>
  <script src="/global/js/trocar-construtora.js"></script>
  <script src="/global/js/contar_caracteres/index.js"></script>
  
  @yield('after_scripts')
  @stack('after_scripts')
  
  <!-- JavaScripts -->
  {{-- <script src="{{ mix('js/app.js') }}"></script> --}}

  <!-- Examples -->
<script src="/assets/javascripts/ui-elements/examples.modals.js"></script>

</body>
</html>
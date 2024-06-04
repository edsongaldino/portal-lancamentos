<!DOCTYPE html>
<html class="sidebar-left-collapsed fixed" lang="{{ app()->getLocale() }}">
<head>
    <title>
      {{ isset($title) ? $title.' :: '.config('backpack.base.project_name').' Admin' : config('backpack.base.project_name').' Admin' }}
    </title>
    <meta name="keywords" content="Lançamentos Online" />
    <meta name="description" content="Lançamentos Online">
    <meta name="author" content="Lançamentos Online">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    @if (config('backpack.base.overlays') && count(config('backpack.base.overlays')))
        @foreach (config('backpack.base.overlays') as $overlay)
        <link rel="stylesheet" href="{{ asset($overlay) }}">
        @endforeach
    @endif

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.css" />

    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="/assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="/assets/vendor/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="/assets/vendor/jquery-ui/jquery-ui.theme.css" />
    <link rel="stylesheet" href="/assets/vendor/select2/css/select2.css" />
    <link rel="stylesheet" href="/assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
    <link rel="stylesheet" href="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
    <link rel="stylesheet" href="/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
    <link rel="stylesheet" href="/assets/vendor/dropzone/basic.css" />
    <link rel="stylesheet" href="/assets/vendor/dropzone/dropzone.css" />
    <link rel="stylesheet" href="/assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
    <link rel="stylesheet" href="/assets/vendor/summernote/summernote.css" />
    <link rel="stylesheet" href="/assets/vendor/codemirror/lib/codemirror.css" />
    <link rel="stylesheet" href="/assets/vendor/codemirror/theme/monokai.css" />
    <link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">
    <link rel="stylesheet" href="/global/css/loader/index.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/assets/stylesheets/theme.css?v={{ filemtime('assets/stylesheets/theme.css') }}" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="/assets/stylesheets/skins/default.css?v={{ filemtime('assets/stylesheets/skins/default.css') }}" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="/assets/stylesheets/theme-custom.css?v={{ filemtime('assets/stylesheets/theme-custom.css') }}">
    <link rel="stylesheet" href="/assets/stylesheets/lancamentosonline.css?v={{ filemtime('assets/stylesheets/lancamentosonline.css') }}">

    <!-- Head Libs -->
    <script src="/assets/vendor/modernizr/modernizr.js"></script>

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
                <img src="" alt="" class="img-circle" data-lock-picture="" />
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
                  <a role="menuitem" tabindex="-1" href="{{ route('perfil') }}"><i class="fa fa-user"></i> Meu perfil</a>
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
    
    <!-- Vendor -->
    <script src="/assets/javascripts/sweetalert2.8.js"></script>
    <script src="/global/js/confirmacao/index.js?v={{ filemtime('global/js/confirmacao/index.js') }}"></script>
    <script src="/assets/vendor/jquery/jquery.js"></script>
    <script src="/global/js/ajax/index.js?v={{ filemtime('global/js/ajax/index.js') }}"></script>
    <script src="/global/js/trocar-construtora.js?v={{ filemtime('global/js/trocar-construtora.js') }}"></script>
    <script src="/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="/assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
    <script src="/assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
    
    <!-- Specific Page Vendor -->
    <script src="/assets/vendor/jquery-ui/jquery-ui.js"></script>
    <script src="/assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
    <script src="/assets/vendor/select2/js/select2.js"></script>
    <script src="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    <script src="/assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
    <script src="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="/assets/vendor/bootstrap-timepicker/bootstrap-timepicker.js"></script>
    <script src="/assets/vendor/fuelux/js/spinner.js"></script>
    <script src="/assets/vendor/dropzone/dropzone.js"></script>
    <script src="/assets/vendor/bootstrap-markdown/js/markdown.js"></script>
    <script src="/assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
    <script src="/assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
    <script src="/assets/vendor/codemirror/lib/codemirror.js"></script>
    <script src="/assets/vendor/codemirror/addon/selection/active-line.js"></script>
    <script src="/assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
    <script src="/assets/vendor/codemirror/mode/javascript/javascript.js"></script>
    <script src="/assets/vendor/codemirror/mode/xml/xml.js"></script>
    <script src="/assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="/assets/vendor/codemirror/mode/css/css.js"></script>
    <script src="/assets/vendor/summernote/summernote.js"></script>
    <script src="/assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="/assets/vendor/ios7-switch/ios7-switch.js"></script>
    <script src="/assets/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>
    <script src="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.js') }}"></script>    
    
    <!-- Theme Base, Components and Settings -->
    <script src="/assets/javascripts/theme.js"></script>
    
    <!-- Theme Custom -->
    <script src="/assets/javascripts/theme.custom.js"></script>
    
    <!-- Theme Initialization Files -->
    <script src="/assets/javascripts/theme.init.js"></script>

    <!-- Examples -->
    <script src="/assets/javascripts/forms/examples.advanced.form.js"></script>

    <!-- Vendor -->
    <script src="/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
    <script src="/bower_components/jquery-maskmoney/dist/jquery.maskMoney.min.js"></script>

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
      });
    </script>    
    <script src="/assets/javascripts/empreendimento/index.js?v={{ filemtime('assets/javascripts/empreendimento/index.js') }}"></script>    
    <script src="/global/js/loader/index.js?v={{ filemtime('global/js/loader/index.js') }}"></script>    
    @stack('after_scripts')
  </body>
</html>
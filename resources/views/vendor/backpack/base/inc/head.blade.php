<title>
  {{ isset($title) ? $title.' :: '.config('backpack.base.project_name').' Admin' : config('backpack.base.project_name').' Admin' }}
</title>
<meta name="keywords" content="Lançamentos Online" />
<meta name="description" content="Lançamentos Online">
<meta name="author" content="Lançamentos Online">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

@yield('before_styles')
@stack('before_styles')


<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/skins/_all-skins.min.css">

<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/pace/pace.min.css">
<link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">

<!-- BackPack Base CSS -->
<link rel="stylesheet" href="{{ asset('vendor/backpack/base/backpack.base.css') }}?v=3">
@if (config('backpack.base.overlays') && count(config('backpack.base.overlays')))
    @foreach (config('backpack.base.overlays') as $overlay)
    <link rel="stylesheet" href="{{ asset($overlay) }}">
    @endforeach
@endif

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.css" />

<link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" href="/assets/vendor/magnific-popup/magnific-popup.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="/assets/vendor/jquery-ui/jquery-ui.css" />
<link rel="stylesheet" href="/assets/vendor/jquery-ui/jquery-ui.theme.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
<link rel="stylesheet" href="/assets/vendor/dropzone/basic.css" />
<link rel="stylesheet" href="/assets/vendor/dropzone/dropzone.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
<link rel="stylesheet" href="/assets/vendor/summernote/summernote.css" />
<link rel="stylesheet" href="/assets/vendor/codemirror/lib/codemirror.css" />
<link rel="stylesheet" href="/assets/vendor/codemirror/theme/monokai.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
<link rel="stylesheet" href="/global/css/loader/index.css">
<link rel="stylesheet" href="/global/css/lightbox/index.css">

<!-- Theme CSS -->
<link rel="stylesheet" href="/assets/stylesheets/theme.css?v={{ filemtime('assets/stylesheets/theme.css') }}" />

<!-- Skin CSS -->
<link rel="stylesheet" href="/assets/stylesheets/skins/default.css?v={{ filemtime('assets/stylesheets/skins/default.css') }}" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="/assets/stylesheets/theme-custom.css?v={{ filemtime('assets/stylesheets/theme-custom.css') }}">

<link rel="stylesheet" href="/assets/stylesheets/lancamentosonline.css?v={{ filemtime('assets/stylesheets/lancamentosonline.css') }}">

<!-- Head Libs -->
<script src="/assets/vendor/modernizr/modernizr.js"></script>

<script src="/assets/vendor/jquery/jquery.js"></script>l
<script src="/assets/javascripts/sweetalert2.8.js"></script>
<link rel="stylesheet" href="/assets/sweetalert/dist/sweetalert.css">

<script src="/global/js/loader/index.js?v={{ filemtime('global/js/loader/index.js') }}"></script>
<script src="/global/js/confirmacao/index.js?v={{ filemtime('global/js/confirmacao/index.js') }}"></script>
<script src="/global/js/lightbox/index.js?v={{ filemtime('global/js/lightbox/index.js') }}"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

@yield('after_styles')
@stack('after_styles')
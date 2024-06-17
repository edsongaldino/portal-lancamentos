<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @stack('meta')   
    
    <!-- Google font -->
	<link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />
	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="/assets/premium/css/bootstrap.min.css" />
    
	<!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="/assets/premium/css/custom.css" />
	<link type="text/css" rel="stylesheet" href="/assets/premium/css/style.css" />
    <link href="/assets/premium/fontawesome/css/all.css" rel="stylesheet">

</head>
<body>

    <div class="topo">
        <a href="/pagina-inicial.html"><div class="logo"><img src="/assets/images/premium/logo_lancamentos_online.png" alt="" class="img-responsive"></div></a>
        <div class="logo-empreendimento"><img src="/assets/images/premium/logo_empreendimento.png" alt="" class="img-responsive"></div>
    </div>

    @yield('content')

    @stack('rodape') 

    <script src="{{ asset('/assets/premium/js/index.js') }}"></script>
    
</body>
</html>
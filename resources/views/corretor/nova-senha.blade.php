<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Lançamentos Online - Conectando o Corretor</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <!-- Author Meta -->
    <meta name="author" content="Datapix Tecnologia">
    <!-- Meta Description -->
    <meta name="description" content="Um canal direto onde você poderá buscar os melhores negócios e ofertas dos lançamentos imobiliários à venda no Brasil">
    <!-- Meta Keyword -->
    <meta name="keywords" content="lancamentos imobiliarios, imóveis novos, na planta">

    <meta name="twitter:image" content="{{ asset('corretor/app-assets/images/logo-app.png') }}">

    <meta property="og:url" content="" />
    <meta property="og:title" content="Lançamentos Online - Conectando o Corretor" />
    <meta property="og:description" content="Um canal direto onde você poderá buscar os melhores negócios e ofertas dos lançamentos imobiliários à venda no Brasil" />
    <meta property="og:image" content="{{ asset('corretor/app-assets/images/logo-app.png') }}" />

    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1067">
    <meta property="og:image:height" content="600">
    <meta property="og:type" content="website">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('corretor/app-assets/img/icons/favicon.ico') }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('corretor/app-assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('corretor/app-assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('corretor/app-assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('corretor/app-assets/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('corretor/app-assets/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('corretor/app-assets/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('corretor/app-assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('corretor/app-assets/css/main.css') }}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url({{ asset('corretor/app-assets/images/img-01.jpg') }});">
        <div class="wrap-login100 p-t-190 p-b-30">
            <form class="login100-form validate-form" method="POST" action="{{ route('alterar.senha') }}">
                @csrf
                <input type="hidden" name="acao" value="login">
                <div class="login100-form-avatar">
                    <img src="{{ asset('corretor/app-assets/images/avatar-01.png') }}" alt="AVATAR">
                </div>

                <span class="login100-form-title p-b-45">
                    Lançamentos Online<br/><span class="subtitulo">Conectando o Corretor</span>
                </span>

                <div class="wrap-input100 validate-input m-b-10" data-validate = "O usuário é obrigatório">
                    <input class="input100" type="text" name="email" value="{{ $email }}" readonly>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input m-b-10" data-validate = "A senha é obrigatória">
                    <input class="input100" type="password" name="senha" placeholder="Senha">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input m-b-10" data-validate = "O campo repetir senha é obrigatória">
                    <input class="input100" type="password" name="confirmar_senha" placeholder="Confirmar Senha">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
                </div>

                <div class="container-login100-form-btn p-t-10">
                    <button class="login100-form-btn" type="submit" name="btLogar">
                        ALTERAR E ENTRAR
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="{{ asset('corretor/app-assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('corretor/app-assets/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('corretor/app-assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('corretor/app-assets/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('corretor/app-assets/js/main.js') }}"></script>

</body>
</html>

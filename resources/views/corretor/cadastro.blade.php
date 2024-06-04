<!DOCTYPE html>
<html lang="pt-br">
	<head>
        <title>Lançamentos Online - Conectando o Corretor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="lancamentos imobiliarios, imóveis novos, na planta" />
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
            <script src="{{ asset('corretor/app-assets/js/bootstrap.min.js') }}"></script>
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
            <link href="{{ asset('assets/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css" />

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    </head>
<body>

<div class="body-back">
	<div class="masthead pdng-stn1">

		<div class="phone-box wrap push" id="home">
			<div class="menu-notify">
				<div class="Profile-mid">
					<h5 class="pro-link">Lançamentos Online - Conectando o Corretor</h5>
				</div>
                <div class="voltar"><a href="javascript:void(0)" onClick="history.go(-1); return false;"><button><i class="fa fa-angle-double-left" aria-hidden="true"></i></button></a></div>
				<div class="clearfix"></div>
			</div>
            <div class="conteudo">
                <h3 class="perfil"><i class="fa fa-info"></i> Cadastro</h3>

                @if (session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
                @endif
                <form action="{{ route('corretor.salvar') }}" method="POST" class="cadastro-usuario">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <label for="cpf_usuario">CPF</label>
                    <input type="text" class="form-control" name="cpf" id="cpf" placeholder="" onblur="$(this).mask('000.000.000-00')" onkeypress="$(this).mask('000.000.000-00')" required>
                    <label for="nome_usuario">NOME COMPLETO</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="" required>
                    <label for="cpf_usuario">CRECI</label>
                    <input type="text" class="form-control" name="creci" id="creci" placeholder=""  required>
                    <label for="nome_usuario">DATA DE NASCIMENTO</label>
                    <input type="text" class="form-control" name="data_nascimento" id="data_nascimento" onblur="$(this).mask('00/00/0000')" onkeypress="$(this).mask('00/00/0000')" placeholder="" required>
                    <label for="nome_usuario">TELEFONE</label>
                    <input type="text" class="form-control" name="telefone" id="telefone" placeholder="" onblur="$(this).mask('(00) 00009-0000')" onkeypress="$(this).mask('(00) 00009-0000')" required>
                    <label for="nome_usuario">EMAIL (LOGIN)</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="" required>
                    <label for="nome_usuario">SENHA</label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="" maxlength="8" required>
                    <input type="password" class="form-control" name="confirmar_senha" id="confirmar_senha" placeholder="CONFIRME SUA SENHA" maxlength="8" required>

                    <button class="gravar-dados-usuario cadastroCorretor" type="button"><i class="fa fa-save"></i> Gravar Informações</button>
                </form>

            </div>
        </div>
    </div>
<script src="{{ asset('corretor/app-assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('corretor/app-assets/js/scripts.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/sweetalert/dist/sweetalert.js') }}" ></script>
</body>
</html>

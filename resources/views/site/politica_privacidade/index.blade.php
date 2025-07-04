@extends('site/layout');

@push('css')
<!-- Bootstrap -->
<link rel="stylesheet" href="/site/ferramenta/bootstrap/bootstrap.min.css">
<!-- Font awesome styles -->    
<link rel="stylesheet" href="/site/ferramenta/apartment-font/css/font-awesome.min.css">
<!-- Custom styles -->
<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,500italic,700,700italic&amp;subset=latin,latin-ext'>
<link rel="stylesheet" type="text/css" href="/site/css/plugins.css">
<link rel="stylesheet" type="text/css" href="/site/css/apartment-layout.css">
<link rel="stylesheet" type="text/css" href="/site/css/busca.css">
<link id="skin" rel="stylesheet" type="text/css" href="/site/css/apartment-colors-blue.css">
@endpush

@push('js_header')
<!-- jQuery  -->
<script src="/site/ferramenta/js/jQuery/jquery.min.js"></script>
<script src="/site/ferramenta/js/jQuery/jquery-ui.min.js"></script>
<!-- Bootstrap-->
<script src="/site/ferramenta/bootstrap/bootstrap.min.js"></script>
<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzzfaZRQcQvaSDOtK3hyLoeY9YVUKedjQ&amp;libraries=places"></script>
<!-- plugins script -->
<script src="/site/ferramenta/js/plugins.js"></script>
<!-- template scripts -->
<script src="/site/ferramenta/mail/validate.js"></script>
<script src="/site/ferramenta/js/apartment.js?v=04"></script>    
<script src="/site/ferramenta/bootstrap/bootstrap3-typeahead.min.js"></script>

<script src="/assets/javascripts/sweetalert2.8.js"></script>
<script src="/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
<script src="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.js') }}"></script>
@endpush

@push('js_footer')
<script>
  $(function () {
    $(".loader-bg").fadeOut('slow');
  });
</script>
@endpush

@section('content')
<section class="section-light section-top-shadow no-bottom-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        
                        <div class="row margin-top-60">
                                                
                            <div class="col-xs-12 col-sm-6 col-lg-12 politica">


                                <h3>Política de privacidade</h3>
                                <p>Todas as suas informações pessoais recolhidas, serão usadas para o ajudar a tornar a sua visita no nosso site o mais produtiva e agradável possível.</p>
                                <p>A garantia da confidencialidade dos dados pessoais dos utilizadores do nosso site é importante para o Lançamentos Online.</p>
                                <p>Todas as informações pessoais relativas a membros, assinantes, clientes ou visitantes que usem o Lançamentos Online serão tratadas em concordância com a Lei da Proteção de Dados Pessoais de 26 de outubro de 1998 (Lei n.º 67/98).</p>
                                <p>A informação pessoal recolhida pode incluir o seu nome, e-mail, número de telefone e/ou telemóvel, morada, data de nascimento e/ou outros.</p>
                                <p>O uso do Lançamentos Online pressupõe a aceitação deste Acordo de privacidade. A equipa do Lançamentos Online reserva-se ao direito de alterar este acordo sem aviso prévio. Deste modo, recomendamos que consulte a nossa política de privacidade com regularidade de forma a estar sempre atualizado.</p>
                                
                                <h3>Os anúncios</h3>
                                <p>Tal como outros websites, coletamos e utilizamos informação contida nos anúncios. A informação contida nos anúncios, inclui o seu endereço IP (Internet Protocol), o seu ISP (Internet Service Provider, como o Sapo, Clix, ou outro), o browser que utilizou ao visitar o nosso website (como o Internet Explorer ou o Firefox), o tempo da sua visita e que páginas visitou dentro do nosso website.</p>
                                <h3>Os Cookies e Web Beacons</h3>
                                <p>Utilizamos cookies para armazenar informação, tais como as suas preferências pessoas quando visita o nosso website. Isto poderá incluir um simples popup, ou uma ligação em vários serviços que providenciamos, tais como fóruns.</p>
                                <p>Em adição também utilizamos publicidade de terceiros no nosso website para suportar os custos de manutenção. Alguns destes publicitários, poderão utilizar tecnologias como os cookies e/ou web beacons quando publicitam no nosso website, o que fará com que esses publicitários (como o Google através do Google AdSense) também recebam a sua informação pessoal, como o endereço IP, o seu ISP, o seu browser, etc. Esta função é geralmente utilizada para geotargeting (mostrar publicidade de Lisboa apenas aos leitores oriundos de Lisboa por ex.) ou apresentar publicidade direcionada a um tipo de utilizador (como mostrar publicidade de restaurante a um utilizador que visita sites de culinária regularmente, por ex.).</p>
                                <p>Você detém o poder de desligar os seus cookies, nas opções do seu browser, ou efetuando alterações nas ferramentas de programas Anti-Virus, como o Norton Internet Security. No entanto, isso poderá alterar a forma como interage com o nosso website, ou outros websites. Isso poderá afetar ou não permitir que faça logins em programas, sites ou fóruns da nossa e de outras redes.</p>
                                
                                <h3>Ligações a Sites de terceiros</h3>
                                <p>O Lançamentos Online possui ligações para outros sites, os quais, a nosso ver, podem conter informações / ferramentas úteis para os nossos visitantes. A nossa política de privacidade não é aplicada a sites de terceiros, pelo que, caso visite outro site a partir do nosso deverá ler a politica de privacidade do mesmo.</p>
                                <p>Não nos responsabilizamos pela política de privacidade ou conteúdo presente nesses mesmos sites.</p>
                                
                            
                            </div>
                        </div>

                        
                    </div>
                </div>
                
                
                
            </div>

        </div>
    </div>
</section>
<div class="row margin-top-60"></div>
@endsection
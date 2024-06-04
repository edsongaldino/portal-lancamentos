@if($view == "mobile")

<!DOCTYPE html>
<html lang="pt">
<head>
  <!-- geral -->
  <meta charset="iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"  user-scalable="no" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $empreendimento->nome }} - MAPA INTERATIVO</title>
  <meta name='description' content="{{ $empreendimento->descricao }}"/>
  <meta property="og:description" content="{{ $empreendimento->descricao }}" />

  <meta name="twitter:image" content="{{ url($empreendimento->fotoMapa()) }}">
  <meta property="og:url" content="{{ Request::url() }}" />
  <meta property="og:title" content="{{ $empreendimento->nome }} - MAPA INTERATIVO" />
  <meta property="og:image" content="{{ url($empreendimento->fotoMapa()) }}" />
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="1067">
  <meta property="og:image:height" content="600">
  <meta property="og:type" content="website">

  <!-- Bootstrap 3.3.7 -->
  @include('/site/empreendimento/mobile/mapa/mapa_css')
  <link href="/global/css/loader/index.css" rel="stylesheet">
  <link href="/site/mapa/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/site/mapa/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/site/mapa/fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
  <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />
  <script
  src="https://code.jquery.com/jquery-1.12.0.min.js"
  integrity="sha256-Xxq2X+KtazgaGuA2cWR1v3jJsuMJUozyIXDB3e793L8="
  crossorigin="anonymous"></script>

  <script
  src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"
  integrity="sha256-SOuLUArmo4YXtXONKz+uxIGSKneCJG4x0nVcA0pFzV0="
  crossorigin="anonymous"></script>

  <link rel="stylesheet" href="/global/css/loader/index.css">
  <!-- ATUALIZADO -->
  <script type="text/javascript" src="/site/mapa/fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>
  <style type="text/css">
    .fancybox-custom .fancybox-skin {
        box-shadow: 0 0 50px #222;
    }

    .modal-center {
      top: 50% !important;
      transform: translateY(-50%) !important;
    }

    #tela {
        z-index: 1;
        position: absolute !important;
        top: 0 !important;
        padding-bottom: 150px !important;
    }

    h4.modal-title {
      margin-left: -230px !important;
    }

    .box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .quadra .valor {
        font-size: 14px !important;
    }

    .box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .terreno .valor {
        font-size: 16px !important;
    }

    .box_detalhes_unidade #dados-unidade-reserva .valor-unidade .valor .valor-item {
        font-size: 20px !important;
    }

    .box_detalhes_unidade #dados-unidade-reserva .unidade-lote .info {
        line-height: 12px !important;
        font-size: 14px !important;
    }

    .box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .lote .valor {
        font-size: 16px !important;
    }

    .box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .planta {
        height: 20px !important;
        line-height: 20px !important;
        font-size: 16px !important;
    }

    .box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .area_privativa .valor {
        font-size: 16px !important;
    }

    .box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .quartos .valor {
        font-size: 18px !important;
    }

    .box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .suites .valor {
        font-size: 18px !important;
    }

    .box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .garagem .valor {
        font-size: 18px !important;
    }

    .marcador{
        background-image: url("/site/images/pin-mapa-unidade.png");
        background-repeat: no-repeat;
        width: 420px;
        height: 629px;
        position: absolute;
        text-align: center;
        font-weight: bold;
        cursor: pointer;
        z-index: 3;
      }

      .info-mapa-move{
        width: 100px;
        height: 100px;
        position: absolute;
        top: 120px;
        left: 10px;
        background-color: #00698C;
      }

    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

  </head>

  <body>


  @if($view <> "pdf")
    <div class="spinner-loading" id="loader"></div>
    <a href="/empreendimento/{{ $empreendimento->id }}/visualizar/download-pdf" target="_blank"><button id="btGerarPDF" class="btn-gerar-pdf"></button></a>
    <div class="btn-compartilhar-mapa">
        <div class="titulo-input">Copie e compartilhe o link do mapa</div>
        <input type="text" name="link-whatsapp" class="input-link link-whatsapp" value="{{ Request::url() }}">
        <div class="btn-copiar js-textareacopybtn-wp"></div>
    </div>
  @endif

  <div id="tela">

    @if(isset($unidade))

      @php
        $situacoes = [
          'Disponível' => 'd',
          'Reservada' => 'r',
          'Vendida' => 'v',
          'Bloqueada' => 'b',
          'Outros' => 'o'
        ];

        $tipo_pne = "N";
        $title = "Unidade " . $unidade->nome;
        if($empreendimento->getCaracteristica('disponibilidade_mapa') == "N") {
          $situacao_unidade = 'o';
          $situacao = 'o';
        }elseif(isset($unidade->quadra->status) && $unidade->quadra->status == 'Bloqueada'){
          $situacao_unidade = 'o';
          $situacao = 'o';
        }else{
          $situacao_unidade = $situacoes[$unidade->situacao];
          $situacao = $situacoes[$unidade->situacao];
        }
        $css_tam = "gd";
        $metade_tam_unid = 30;
        $metade_tam_foto = 22;

        if ($unidade->getCaracteristica("pne") == "Sim") {
          $tipo_pne = "S";
          $title = "Unidade PNE";
        }

        if ($situacao_unidade == 'B') {
          $situacao_unidade = "s";
          $title = "Já existe uma solicitação de reserva desta unidade.";
        }

        if ($empreendimento->getCaracteristica('tam_implantacao') == "pq") {
          $css_tam = "pq";
          $metade_tam_unid = 10;
          $metade_tam_foto = 22;
        }

        if ($empreendimento->getCaracteristica('tam_implantacao') == "md") {
          $css_tam = "md";
          $metade_tam_unid = 20;
          $metade_tam_foto = 22;
        }

        $classeCss = "ponto_unidade ponto_unidade_sit_{$situacao_unidade} ponto_unidade_pne_{$tipo_pne}_{$css_tam} ponto_unidade_tam_{$css_tam}";
      @endphp

      <div
        data-idunidade="{{ $unidade->id }}"
        data-stunidade="{{ $situacao }}"
        class="{{ $classeCss }}"
        style="
          top: {{ $unidade->coord_y - $metade_tam_unid }}px;
          left: {{ $unidade->coord_x - $metade_tam_unid }}px;"
          title="{{ $title }}">
          {{ $unidade->nome }}
      </div>


      @if($empreendimento->tipo == 'Horizontal')
      <div class="marcador" style="
        top: calc({{ $unidade->coord_y - $metade_tam_unid }}px - 630px);
        left: calc({{ $unidade->coord_x - $metade_tam_unid }}px - 200px);">
      </div>
      @endif



    @else

    @foreach($empreendimento->unidades as $unidade)
      @php
        $situacoes = [
          'Disponível' => 'd',
          'Reservada' => 'r',
          'Vendida' => 'v',
          'Bloqueada' => 'b',
          'Outros' => 'o'
        ];

        $tipo_pne = "N";
        $title = "Unidade " . $unidade->nome;
        if($empreendimento->getCaracteristica('disponibilidade_mapa') == "N") {
          $situacao_unidade = 'o';
          $situacao = 'o';
        }elseif(isset($unidade->quadra->status) && $unidade->quadra->status == 'Bloqueada'){
          $situacao_unidade = 'o';
          $situacao = 'o';
        }else{
          $situacao_unidade = $situacoes[$unidade->situacao];
          $situacao = $situacoes[$unidade->situacao];
        }
        $css_tam = "gd";
        $metade_tam_unid = 30;
        $metade_tam_foto = 22;

        if ($unidade->getCaracteristica("pne") == "Sim") {
          $tipo_pne = "S";
          $title = "Unidade PNE";
        }

        if ($situacao_unidade == 'B') {
          $situacao_unidade = "s";
          $title = "Já existe uma solicitação de reserva desta unidade.";
        }

        if ($empreendimento->getCaracteristica('tam_implantacao') == "pq") {
          $css_tam = "pq";
          $metade_tam_unid = 10;
          $metade_tam_foto = 22;
        }

        if ($empreendimento->getCaracteristica('tam_implantacao') == "md") {
          $css_tam = "md";
          $metade_tam_unid = 20;
          $metade_tam_foto = 22;
        }

        $classeCss = "ponto_unidade ponto_unidade_sit_{$situacao_unidade} ponto_unidade_pne_{$tipo_pne}_{$css_tam} ponto_unidade_tam_{$css_tam}";
      @endphp

      <div
        data-idunidade="{{ $unidade->id }}"
        data-stunidade="{{ $situacao }}"
        class="{{ $classeCss }}"
        style="
          top: {{ $unidade->coord_y - $metade_tam_unid }}px;
          left: {{ $unidade->coord_x - $metade_tam_unid }}px;"
          title="{{ $title }}">
          {{ $unidade->nome }}
      </div>

      @php
        $fotos = $empreendimento->fotos->where('status', 'Liberada');
      @endphp

      @foreach($fotos as $foto)
        <div class="ponto_foto"
          style="
            top: {{ $foto->coord_y - $metade_tam_foto}}px;
            left: {{ $foto->coord_x - $metade_tam_foto}}px;">
          <a class="fancybox"
            @if ($foto->tipo_ponto == 'M')
              data-fancybox-group="gallery{{ $foto->id }}"
            @endif

            @if ($foto->tipo_ponto == 'I')
              data-fancybox-group="map{{ $foto->id }}"
            @endif
            href="{{ $foto->getUrl('original') }}"
            title="{{ $foto->descricao }}">

            @if ($foto->tipo_ponto == 'M')
              <img src="/site/mapa/imagem/icone_mapa.png" title="{{ $foto->descricao }}" />
            @endif

            @if ($foto->tipo_ponto == 'I')
              <img src="/site/mapa/imagem/icone_foto.png" title="{{ $foto->descricao }}" />
            @endif
          </a>
        </div>
      @endforeach
    @endforeach

    @endif
    <img id="mapa_fundo" src="{{ $empreendimento->getFotoTipo('Implantação') }}"/>
  </div>

  <div class="modal fade" id="modal_detalhes" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md modal-center">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Situação</h4>
          <button tipo="button" class="close fechar-modal" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="panel panel-default sem_margin_bottom">
            <div class="panel-body">
              <div class="box_detalhes_unidade" id="box_detalhes_unidade"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Exemplo</h4>
        </div>
        <div class="modal-body text-center">
            <img src="" />
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
        </div>
        </div>
    </div>
    </div>


  <script src="/assets/javascripts/maps/bootstrap.min.js"></script>
  <script src="/global/js/loader/index.js"></script>
  <script src="/global/js/ajax/index.js"></script>
  <script src="/site/js/empreendimento/mapaMobile.js"></script>
  <script language="JavaScript">
      var copyTextareaBtn = document.querySelector('.js-textareacopybtn-wp');

      copyTextareaBtn.addEventListener('click', function(event) {
      var copyTextarea = document.querySelector('.link-whatsapp');
      copyTextarea.select();

      try {
          var successful = document.execCommand('copy');
          var msg = successful ? 'successful' : 'unsuccessful';
          console.log('Copying text command was ' + msg);
      } catch (err) {
          console.log('Oops, unable to copy');
      }
      });

  $(document).ready(function() {
        $('.fancybox-media')
            .attr('rel', 'media-gallery')
            .fancybox({
                openEffect : 'none',
                closeEffect : 'none',
                prevEffect : 'none',
                nextEffect : 'none',

                arrows : false,
                helpers : {
                    media : {},
                    buttons : {}
                }
            });


        $('.fancybox').fancybox();
    });

    $(document).ready(function() {
        $(".various").fancybox({
            maxWidth  : 610,
            maxHeight : 600,
            fitToView : false,
            width   : '70%',
            height    : '70%',
            autoSize  : true,
            closeClick  : false,
            openEffect  : 'none',
            closeEffect : 'none'
        });
    });

    $(document).ready(function() {
    $(".fancybox-thumb").fancybox({
        prevEffect  : 'none',
        nextEffect  : 'none',
        'titlePosition'  : 'inside',
        helpers : {
            title : {
                type: 'outside'
            },
            thumbs  : {
                width : 50,
                height  : 50
            }
        }
    });
    });

    jQuery(window).load(function() {
        //Após a leitura da pagina o evento fadeOut do loader é acionado, esta com delay para ser perceptivo em ambiente fora do servidor.
        jQuery("#loader").delay(2000).fadeOut("slow");
    });

</script>

</body>
</html>

@else

<!DOCTYPE html>
<html lang="pt" style="overflow: hidden;" class="js no-touch">
<head>
  <!-- geral -->
  <meta charset="iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" user-scalable="no" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $empreendimento->nome }} - MAPA INTERATIVO MOBILE</title>
  <meta name='description' content="{{ $empreendimento->descricao }}"/>
  <meta property="og:description" content="{{ $empreendimento->descricao }}" />
  <meta name="twitter:image" content="{{ url($empreendimento->fotoMapa()) }}">
  <meta property="og:url" content="{{ Request::url() }}" />
  <meta property="og:title" content="{{ $empreendimento->nome }} - MAPA INTERATIVO" />
  <meta property="og:image" content="{{ url($empreendimento->fotoMapa()) }}" />
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="1067">
  <meta property="og:image:height" content="600">
  <meta property="og:type" content="website">
  <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />

  <script
  src="https://code.jquery.com/jquery-1.12.0.min.js"
  integrity="sha256-Xxq2X+KtazgaGuA2cWR1v3jJsuMJUozyIXDB3e793L8="
  crossorigin="anonymous"></script>

  <style>
      body{
        background: #FFF;
        font-family: 'Open Sans', sans-serif;
        margin: 0;
        background-size: cover;
        padding: 0;
      }
      .topo-mapa{
          width: 100%;
          height: 80px;
          position: fixed;
          top: 0px;
          background: #3797dd;
      }


      .topo-mapa .logo-empreendimento{
        width: 125px;
        height: 95px;
        float: left;
        filter: drop-shadow(6px 6px 8px black);
        background-color: #FFF;
      }

      .topo-mapa .entrega{
        width: 130px;
        height: 60px;
        float: right;
        padding: 10px;
      }

      .topo-mapa .entrega .titulo{
        width: 100%;
        height: 20px;
        line-height: 20px;
        font-size: 12px;
        text-align: center;
        color: #FFF;
        float: left;
      }

      .topo-mapa .entrega .data{
        width: 100%;
        height: 35px;
        line-height: 35px;
        font-size: 16px;
        text-align: center;
        color: #333;
        font-weight: bold;
        background-color: #FFC926;
        border-radius: 5px;
        float: left;
      }

      .topo-mapa .entrega .data.pronto{
        background-color: #07bd71 !important;
        margin-top: 10px;
        color: #FFF !important;
      }

      .topo-mapa .botao-mapa-pdf{
        width: 100%;
        float: left;
        height: 40px;
        background-color: #003647;
        margin-top: -25px;
      }

      .topo-mapa .botao-mapa-pdf .botao-ver-completo{
        width: 60%;
        height: 40px;
        float: right;
        margin-right: 20px;
        text-align: right;
        line-height: 40px;
        font-size: 14px;
        color: #FFF;
      }



      @media screen and (min-height: 480px) {
        .conteudo-mapa{
            width: 100%;
            height: 100vh;
            float: left;
            margin-top: 80px;
        }
      }

      @media screen and (min-height: 800px) {
        .conteudo-mapa{
            width: 100%;
            height: 100vh;
            float: left;
            margin-top: 80px;
        }
      }

      @media screen and (min-height: 1280px) {
        .conteudo-mapa{
            width: 100%;
            height: 100vh;
            float: left;
            margin-top: 80px;
        }
      }

      @media screen and (min-height: 1920px) {
        .conteudo-mapa{
            width: 100%;
            height: 100vh;
            float: left;
            margin-top: 80px;
        }
      }

      .botoes-mapa{

        width: 100%;
        background-color: aquamarine;
        clear: both;
        position: relative;
        height: 200px;
        margin-top: -200px;

      }

      .footer-corretor {
          height: 40px;
          position: fixed;
          bottom: 0;
          background: #1e84ce;
          width: 100%;
          z-index: 99999999999;
          color: #ddd;
          font-size: 12px;
          text-align: center;
          line-height: 40px;
      }

      .footer {
          height: auto;
          position: fixed;
          bottom: 0;
          background: rgba(254, 255, 255, 0.9);
          width: 100%;
          z-index: 99999999999;
          line-height: 60px;
          text-align: center;
          font-size: 20px;
          color: #FFF;
      }

      .footer .logo-construtora{
        width: 125px;
        height: 95px;
        filter: drop-shadow(6px 6px 8px rgba(0, 0, 0, 0.356));
        float: left;
      }

      .footer .topo{
        width: 100%;
        height: 30px;
        background-color: #00698C;
        color: #FFF;
        font-size: 14px;
        text-align: center;
        line-height: 30px;
        float: left;
      }

      .footer .topo .ocultar{
        width: 40%;
        height: 40px;
        margin-top: -10px;
        line-height: 40px;
        float: left;
        background-color: #0a6dad;
      }

      .footer .topo .mostrar{
        width: 40%;
        height: 40px;
        margin-top: -10px;
        line-height: 40px;
        float: left;
        background-color: #003647;
      }

      .footer .topo .falar{
        width: 60%;
        height: 30px;
        float: right;
      }

      .footer .chat{
        width: 70px;
        height: 60px;
        line-height: 60px;
        color: #FFF;
        font-size: 40px;
        background-color: #07bd71;
        border-radius: 10px;
        margin: 15px 15px 0 0;
        float: right;
      }

      .footer .ligar{
        width: 70px;
        height: 60px;
        line-height: 60px;
        color: #FFF;
        font-size: 40px;
        background-color: #00698C;
        border-radius: 10px;
        margin: 15px 15px 0 0;
        float: right;
      }
      .info-mapa-move{
        width: 100px;
        height: 100px;
        position: absolute;
        top: 120px;
        left: 10px;
        background-image: url("/assets/images/move-mapa.png");
        background-repeat: no-repeat;
      }
  </style>

</head>
<body>

    <div class="topo-mapa">
      <div class="logo-empreendimento"><img src="{{ url($empreendimento->getLogo()) }}" alt="" width="125" height="95"></div>
      <div class="entrega">
        @php
          $previsao = get_previsao_entrega($empreendimento);
        @endphp

        @if ($previsao == 'Prontossss')

        <div class="data pronto">PRONTO</div>

        @else

        <div class="titulo">Entrega em</div>
        <div class="data">{{ get_previsao_entrega($empreendimento) }}</div>

        @endif

      </div>

      <div class="botao-mapa-pdf">
        <a href="/empreendimento/{{ $empreendimento->id }}/visualizar/download-pdf" target="_blank"><div class="botao-ver-completo"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> VER MAPA COMPLETO </div></a>
      </div>

    </div>

    <div class="info-mapa-move"></div>

    <iframe class="conteudo-mapa" id="iframe" src="https://www.lancamentosonline.com.br/empreendimento/{{ $empreendimento->id }}/{{ $empreendimento->id*37 }}/visualizar-mapa/mobile" frameborder="0"></iframe>

    @if($view == "user")
      <div class="footer">
        <div class="topo">
            <div class="ocultar" id="ocultarContato"><i class="fa fa-arrow-down" aria-hidden="true"></i> Ocultar</div>
            <div class="mostrar" id="showContato" style="display: none;"><i class="fa fa-arrow-up" aria-hidden="true"></i> Mostrar</div>
            <div class="falar">FALE COMIGO AGORA</div>
        </div>
        <div class="contato-construtora" style="display: block;">

            <div class="logo-construtora foto-usuario">

              @if (isset($user->foto))
              <img src="{{ url($user->foto) }}" class="rounded img-responsive" alt="{{ $user->foto }}" width="125" class="img-responsive">
              @else
              <img src="{{ url('assets/images/user-sem-foto.jpg') }}" width="125" class="img-responsive">
              @endif

            </div>

            @if($user->whatsapp)
            <a href="https://api.whatsapp.com/send?phone=55{{ limpa_campo($user->whatsapp) }}&text=Ol%C3%A1%2C%20vi%20o%20an%C3%BAncio%20do%20empreendimento%20({{ $empreendimento->nome }})%20no%20Portal%20Lan%C3%A7amentos%20Online%20e%20gostaria%20de%20obter%20maiores%20informa%C3%A7%C3%B5es" target="_blank">
              <div class="chat"><img src="../../../../assets/images/icone-whatsapp.png" alt=""></div>
            </a>
            @else
            <div class="chat"><img src="../../../../assets/images/icone-whatsapp-off.png" alt=""></div>
            @endif


            @if($user->celular)
            <a href="tel:{{ $user->celular }}" onclick="GravarCliquetel(); return true;">
              <div class="ligar"><img src="../../../../assets/images/icone-phone.png" alt=""></div>
            </a>
            @else
            <div class="ligar"><img src="../../../../assets/images/icone-phone-off.png" alt=""></div>
            @endif
        </div>

      </div>

    @elseif($view == "construtora")

      <div class="footer">
        <div class="topo">
            <div class="ocultar" id="ocultarContato"><i class="fa fa-arrow-down" aria-hidden="true"></i> Ocultar</div>
            <div class="mostrar" id="showContato" style="display: none;"><i class="fa fa-arrow-up" aria-hidden="true"></i> Mostrar</div>
            <div class="falar">FALE COM A CONSTRUTORA</div>
        </div>
        <div class="contato-construtora" style="display: block;">
            <div class="logo-construtora">
              <img src="{{ $empreendimento->construtora->getLogoUrl('125x95') }}" width="125" class="img-responsive" />
            </div>

            @if($empreendimento->getCaracteristica('whatsapp_atendimento'))
            <a href="https://api.whatsapp.com/send?phone=55{{ limpa_campo($empreendimento->getCaracteristica('whatsapp_atendimento')) }}&text=Ol%C3%A1%2C%20vi%20o%20an%C3%BAncio%20do%20empreendimento%20({{ $empreendimento->nome }})%20no%20Portal%20Lan%C3%A7amentos%20Online%20e%20gostaria%20de%20obter%20maiores%20informa%C3%A7%C3%B5es" target="_blank">
              <div class="chat"><img src="../../../../assets/images/icone-whatsapp.png" alt=""></div>
            </a>
            @elseif($empreendimento->construtora->whatsapp)
            <a href="https://api.whatsapp.com/send?phone=55{{ limpa_campo($empreendimento->construtora->whatsapp) }}&text=Ol%C3%A1%2C%20vi%20o%20an%C3%BAncio%20do%20empreendimento%20({{ $empreendimento->nome }})%20no%20Portal%20Lan%C3%A7amentos%20Online%20e%20gostaria%20de%20obter%20maiores%20informa%C3%A7%C3%B5es" target="_blank">
              <div class="chat"><img src="../../../../assets/images/icone-whatsapp.png" alt=""></div>
            </a>
            @else
            <div class="chat"><img src="../../../../assets/images/icone-whatsapp-off.png" alt=""></div>
            @endif


            @if($empreendimento->getCaracteristica('telefone_central'))
            <a href="tel:{{ $empreendimento->getCaracteristica('telefone_central') }}" onclick="GravarCliquetel(); return true;">
              <div class="ligar"><img src="../../../../assets/images/icone-phone.png" alt=""></div>
            </a>
            @elseif($empreendimento->construtora->telefone_nun)
            <a href="tel:{{ $empreendimento->getCaracteristica('telefone_central') }}" onclick="GravarCliquetel(); return true;">
              <div class="ligar"><img src="../../../../assets/images/icone-phone.png" alt=""></div>
            </a>
            @elseif($empreendimento->construtora->celular_atendimento)
            <a href="tel:{{ $empreendimento->construtora->telefone_nun }}" onclick="GravarCliquetel(); return true;">
              <div class="ligar"><img src="../../../../assets/images/icone-phone.png" alt=""></div>
            </a>
            @elseif($empreendimento->construtora->telefone)
            <a href="tel:{{ $empreendimento->construtora->telefone }}" onclick="GravarCliquetel(); return true;">
              <div class="ligar"><img src="../../../../assets/images/icone-phone.png" alt=""></div>
            </a>
            @else
            <div class="ligar"><img src="../../../../assets/images/icone-phone-off.png" alt=""></div>
            @endif
        </div>

      </div>
    @else
      <div class="footer-corretor">&copy;<script>document.write(new Date().getFullYear());</script> Portal Lançamentos Online</div>
    @endif

    <script>
      $(document).ready(function() {
          $('#showContato').click(function() {
              $('.contato-construtora').slideToggle("slow");
              $(".mostrar").css("display", "none");
              $('.ocultar').css("display", "block");
          });
          $('#ocultarContato').click(function() {
              $('.contato-construtora').slideToggle("slow");
              $(".mostrar").css("display", "block");
              $('.ocultar').css("display", "none");
          });
      });
    </script>

</body>
</html>

@endif

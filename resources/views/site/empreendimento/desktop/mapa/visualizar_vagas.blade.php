<!DOCTYPE html>
<html lang="pt">
<head>
  <!-- geral -->
  <meta charset="iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $empreendimento->nome }} - MAPA DE VAGAS</title>
  <meta name='description' content="{{ $empreendimento->descricao }}"/>
  <meta property="og:description" content="{{ $empreendimento->descricao }}" />

  <meta name="twitter:image" content="{{ env('APP_URL') }}/assets/images/mapa-vagas.jpg">
  <meta property="og:url" content="{{ Request::url() }}" />
  <meta property="og:title" content="{{ $empreendimento->nome }} - MAPA DE VAGAS" />
  <meta property="og:image" content="{{ env('APP_URL') }}/assets/images/mapa-vagas.jpg" />
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="1067">
  <meta property="og:image:height" content="600">
  <meta property="og:type" content="website">
  
  <!-- Bootstrap 3.3.7 -->
  @include('/site/empreendimento/desktop/mapa_garagens_css') 
  <link href="/global/css/loader/index.css" rel="stylesheet">
  <link href="/site/mapa/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/site/mapa/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/site/mapa/fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
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

    .modal-header {
        height: 50px !important;
    }

    body{
        background: #FFF;
        font-family: 'Open Sans', sans-serif;
        margin: 0;
        background-size: cover;
        padding: 0;
      }
      .topo-mapa{
          width: 100%;
          height: 90px;
          position: fixed;
          top: 0px;
          z-index: 99;
          background: #6c038b;
      }


      .topo-mapa .logo-empreendimento{
        width: 125px;
        height: 95px;
        float: left;
        filter: drop-shadow(6px 6px 8px black);
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
      
      .botoes-mapa{

        width: 100%;
        background-color: aquamarine;
        clear: both;
        position: relative;
        height: 200px;
        margin-top: -200px;

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
        background-color: #6c038b;
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
        background-color: #3a044b;
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

    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />
  </head>

  <body>
  
  @if($view <> "pdf")
    <div class="topo-mapa">
      <div class="logo-empreendimento"><img src="{{ url($empreendimento->getLogo()) }}" alt="" width="125" height="95"></div>
      <div class="entrega">
        @php 
          $previsao = get_previsao_entrega($empreendimento);
        @endphp

        @if ($previsao == 'Pronto')

        <div class="data pronto">PRONTO</div>

        @else

        <div class="titulo">Entrega em</div>
        <div class="data">{{ get_previsao_entrega($empreendimento) }}</div>

        @endif

      </div>
    </div>

    <div class="spinner-loading" id="loader"></div>
    <a href="/empreendimento/{{ $empreendimento->id }}/download-pdf" target="_blank"><button id="btGerarPDF" class="btn-gerar-pdf"></button></a>
    <div class="btn-compartilhar-mapa">
        <div class="titulo-input">Copie e compartilhe o link do mapa</div>
        <input type="text" name="link-whatsapp" class="input-link link-whatsapp" value="{{ Request::url() }}">
        <div class="btn-copiar js-textareacopybtn-wp"></div>
    </div>

  @endif
  
  <div id="tela">
    @foreach($empreendimento->garagens as $garagem)          
      @php
        $situacoes = [
          'Disponível' => 'd',
          'Reservada' => 'r',
          'Vendida' => 'v',
          'Bloqueada' => 'b',
          'Outros' => 'o'
        ];
        
        $tipo_pne = "N";
        $title = "Vaga " . $garagem->nome;
        
        if($empreendimento->getCaracteristica('disponibilidade_mapa') == "N") {
          $situacao_garagem = 'o';
          $situacao = 'o';
        }elseif(isset($garagem->quadra->status) && $garagem->quadra->status == 'Bloqueada'){
          $situacao_garagem = 'o';
          $situacao = 'o';
        }else{
          $situacao_garagem = $situacoes[$garagem->situacao];
          $situacao = $situacoes[$garagem->situacao];
        }
        $css_tam = "gd";
        $metade_tam_unid = 30;
        $metade_tam_foto = 22;
      
        if ($garagem->vaga_pne == 'Sim')  {
          $tipo_pne = "S";
          $title = "Vaga PNE";
        }
        
        if($garagem->formato_vaga){
          $formato_vaga = url_amigavel($garagem->formato_vaga);
        }

        if($garagem->tipo_vaga){
          $tipo_vaga = url_amigavel($garagem->tipo_vaga);
        }else{
          $tipo_vaga = 'padrao';
        }

        if ($situacao_garagem == 'B') {
          $situacao_garagem = "s";
          $title = "Já existe uma solicitação de reserva desta garagem.";
        }
        
        if ($empreendimento->getCaracteristica('tam_implantacao_garagem') == "pq") {
          $css_tam = "pq";
          $metade_tam_unid = 10;
          $metade_tam_foto = 22;            
        }
        
        if ($empreendimento->getCaracteristica('tam_implantacao_garagem') == "md") { 
          $css_tam = "md";
          $metade_tam_unid = 20;
          $metade_tam_foto = 22;          
        }
        
        $classeCss = "ponto_garagem formato_vaga_{$formato_vaga} ponto_garagem_sit_{$situacao_garagem} ponto_garagem_pne_{$tipo_pne}_{$css_tam} ponto_garagem_tam_{$css_tam} {$tipo_vaga}-{$css_tam}";
      @endphp
    
      <div 
        data-idgaragem="{{ $garagem->id }}" 
        data-stgaragem="{{ $situacao }}" 
        class="{{ $classeCss }}" 
        style="
          top: {{ $garagem->coord_y - $metade_tam_unid }}px; 
          left: {{ $garagem->coord_x - $metade_tam_unid }}px;" 
          title="{{ $title }}">    
          
          @if ($garagem->vaga_pne == 'Sim') 
          <i class="fa fa-wheelchair" aria-hidden="true"></i> 
          @else          
            @if($garagem->tipo_vaga == 'Gaveta Descoberta' || $garagem->tipo_vaga == 'Gaveta Coberta')        
            <i class="fa fa-car" aria-hidden="true"></i><br/><i class="fa fa-car" aria-hidden="true"></i>
            @else
            <i class="fa fa-car" aria-hidden="true"></i>
            @endif
          @endif

      </div>    

      @php
        $fotos = $empreendimento->fotos->where('status', 'Liberada')->where('coord_y', '!=', '');
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
    <img id="mapa_fundo" src="{{ $empreendimento->getFotoTipo('Mapa de Vagas') }}"/>
  </div>  


  @if($view <> "pdf")
    @if($view == "corretor")
    <div class="footer-corretor">&copy;<script>document.write(new Date().getFullYear());</script> Portal Lançamentos Online</div>
    @else
    <div class="footer">
      <div class="topo">
          <div class="ocultar" id="showContato">Ocultar</div>
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

    <script>
      $(document).ready(function() {
          $('#showContato').click(function() {
              $('.contato-construtora').slideToggle("fast");
          });
      });
    </script>
    @endif
  @endif
    
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
              <div class="box_detalhes_garagem" id="box_detalhes_garagem"></div>
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
  <script src="/site/js/empreendimento/mapaGaragem.js"></script> 
   
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

  </script>


  <script>
    $(window).load(function() {

    var $container = $("#tela");
    var $img = $("#mapa_fundo");
    var cHeight = $container.height();
    var cWidth = $container.width();
    var iHeight = $img.height();
    var iWidth = $img.width();

    @php
      $px = (int) isset($_GET["x"]) ? $_GET['x'] : 0;
      $py = (int) isset($_GET["y"]) ? $_GET['y'] : 0;
      if ($px > 0 && $py > 0) { 
    @endphp
      var top = {{ $py }};
      var left = {{ $px }};
    @php } else { @endphp
      var top = (iHeight - cHeight) / 2;
      var left = (iWidth - cWidth) / 2;
    @php } @endphp

    $container.scrollLeft(left);
    $container.scrollTop(top);
    $(".carregando").remove();
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
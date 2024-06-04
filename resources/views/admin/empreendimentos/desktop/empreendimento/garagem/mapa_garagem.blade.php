<!DOCTYPE html>
<html lang="pt">
<head>
  <!-- geral -->
  <meta charset="iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!-- Bootstrap 3.3.7 -->
  <link href="/site/mapa/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/site/mapa/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet">
  <script
  src="https://code.jquery.com/jquery-1.12.0.min.js"
  integrity="sha256-Xxq2X+KtazgaGuA2cWR1v3jJsuMJUozyIXDB3e793L8="
  crossorigin="anonymous"></script>

  <script
  src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"
  integrity="sha256-SOuLUArmo4YXtXONKz+uxIGSKneCJG4x0nVcA0pFzV0="
  crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="/global/css/loader/index.css">
  <link rel="stylesheet" href="/site/mapa/css/mapa_garagens.css">
  <link rel="stylesheet" href="/assets/sweetalert/dist/sweetalert.css">
  <script src="/assets/javascripts/sweetalert2.8.js"></script>
  <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <!--carregando-->
  <div class="carregando">&nbsp;</div>  

  <!--controle-->
  <div class="controle_mapa">
    <img src="/site/imagem/icone_controle_mapa.png" usemap="#bt_controle_mapa" />
    <map name="bt_controle_mapa" id="bt_controle_mapa">
      <area id="bt_mapa_e" alt="Esquerda" title="Esquerda" href="javascript: void(0);" shape="rect" coords="26,72,50,91" />
      <area id="bt_mapa_c" alt="Cima" title="Cima" href="javascript: void(0);" shape="rect" coords="52,46,72,67" />
      <area id="bt_mapa_d" alt="Direita" title="Direita" href="javascript: void(0);" shape="rect" coords="74,71,98,92" />
      <area id="bt_mapa_b" alt="Baixo" title="Baixo" href="javascript: void(0);" shape="rect" coords="51,96,73,119" />
    </map>
  </div>
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
      $title = "Unidade " . $garagem->nome;
      $situacao_garagem = $situacoes[$garagem->situacao];
      $situacao = $situacoes[$garagem->situacao];
      $css_tam = "gd";
      $metade_tam_unid = 30;
      $metade_tam_foto = 22;
      
      if($garagem->vaga_pne == 'Sim'){
        $tipo_pne = "S";
        $title = "Unidade PNE";
      }

      if($garagem->tipo_vaga){
        $tipo_vaga = url_amigavel($garagem->tipo_vaga);
      }else{
        $tipo_vaga = 'padrao';
      }

      if($garagem->formato_vaga){
        $formato_vaga = url_amigavel($garagem->formato_vaga);
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
        data-garagem="{{ $garagem->nome }}"
        data-idgaragem="{{ $garagem->id }}" 
        data-tamponto="{{ $empreendimento->getCaracteristica('tam_implantacao_garagem') }}"
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
    @endforeach

    @php
      $fotos_mapa = $empreendimento->getFotosMapa();
    @endphp

    @foreach($fotos_mapa as $foto)      
      <div 
        data-foto="{{ $foto->descricao }}"
        data-idfoto="{{ $foto->id }}" 
        class="ponto_foto" 
        style="top: {{ $foto->coord_y - $metade_tam_foto}}px; left: {{ $foto->coord_x - $metade_tam_foto}}px;"
      >
        <a 
          class="fancybox"
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
      
    <img id="mapa_fundo" src="{{ $empreendimento->getFotoTipo('Mapa de Vagas') }}"/>

  </div>
  
  @include('admin.empreendimentos/desktop/empreendimento/garagem/garagem_mapa')
  
  
  <script src="/assets/javascripts/maps/bootstrap.min.js"></script>
  <script src="/global/js/loader/index.js?v={{ filemtime('global/js/loader/index.js') }}"></script>
  <script src="/global/js/ajax/index.js?v={{ filemtime('global/js/ajax/index.js') }}"></script>
  <script src="/assets/javascripts/empreendimento/mapa_garagens.js?v={{ filemtime('assets/javascripts/empreendimento/mapa_garagens.js') }}"></script>


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
</script>

</body>
</html>
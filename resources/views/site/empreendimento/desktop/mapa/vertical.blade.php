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
  <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css">
  <script
  src="https://code.jquery.com/jquery-1.12.0.min.js"
  integrity="sha256-Xxq2X+KtazgaGuA2cWR1v3jJsuMJUozyIXDB3e793L8="
  crossorigin="anonymous"></script>

  <script
  src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"
  integrity="sha256-SOuLUArmo4YXtXONKz+uxIGSKneCJG4x0nVcA0pFzV0="
  crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="/global/css/loader/index.css">
  <link rel="stylesheet" href="/site/mapa/css/mapa2.css">
  <link rel="stylesheet" href="/assets/sweetalert/dist/sweetalert.css">
  <script src="/assets/javascripts/sweetalert2.8.js"></script>
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="/assets/premium/fontawesome/css/all.css" rel="stylesheet">
  </head>
  <body>
  <!--carregando-->
  <div class="carregando">&nbsp;</div>  

  <div class="box-select-posicao">
      <div class="icone-posicao"><i class="fab fa-uncharted" aria-hidden="true"></i></div>
      <select class="select-posicao" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        <option value="/admin/empreendimento/{{ $empreendimento->id }}/mapa-vertical/frente" @php if($view == "frente"){echo "selected";} @endphp>FRENTE</option>
        <option value="/admin/empreendimento/{{ $empreendimento->id }}/mapa-vertical/fundo" @php if($view == "fundo"){echo "selected";} @endphp>FUNDO</option>
        <option value="/admin/empreendimento/{{ $empreendimento->id }}/mapa-vertical/lateral" @php if($view == "lateral"){echo "selected";} @endphp>LATERAL</option>
    </select>
  </div>

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
    @php

      $css_tam = "gd";
      $metade_tam_unid = 20;
      $metade_tam_foto = 22;
      
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
    @endphp
    @foreach($unidades as $unidade)          
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
      $situacao_unidade = $situacoes[$unidade->situacao];
      $situacao = $situacoes[$unidade->situacao];
      
      if ($unidade->getCaracteristica("pne") == "Sim") {
        $tipo_pne = "S";
        $title = "Unidade PNE";
      }
      if ($situacao_unidade == 'B') {
        $situacao_unidade = "s";
        $title = "Já existe uma solicitação de reserva desta unidade.";
      }
            
      $classeCss = "ponto_unidade ponto_unidade_sit_{$situacao_unidade} ponto_unidade_pne_{$tipo_pne}_{$css_tam} ponto_unidade_tam_{$css_tam}";
      @endphp

      <div 
        data-unidade="{{ $unidade->nome }}"
        data-idunidade="{{ $unidade->id }}" 
        data-tamponto="{{ $empreendimento->getCaracteristica('tam_implantacao') }}"
        data-stunidade="{{ $situacao }}" 
        class="{{ $classeCss }}" 
        style="
          top: {{ $unidade->coord_y - $metade_tam_unid }}px; 
          left: {{ $unidade->coord_x - $metade_tam_unid }}px;" 
        title="{{ $title }}">              
          {{ $unidade->nome }}
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
      
    <img id="mapa_fundo" src="{{ $foto_implantacao }}"/>

  </div>
  
  @include('admin.empreendimentos/desktop/empreendimento/mapa/unidade_vertical_mapa')
  
  
  <script src="/assets/javascripts/maps/bootstrap.min.js"></script>
  <script src="/global/js/loader/index.js"></script>
  <script src="/global/js/ajax/index.js"></script>
  <script src="/assets/javascripts/empreendimento/mapaVertical.js"></script>


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
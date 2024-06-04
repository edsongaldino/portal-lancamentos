<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSS -->  
  @include('site/empreendimento/desktop/mapa_css')  
  <link href="/site/mapa/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/site/mapa/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/site/mapa/fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
  <link rel="stylesheet" href="/global/css/loader/index.css">

  <!-- JS -->
  <script src="/site/ferramenta/js/jQuery/jquery.min.js"></script>
  <script src="/site/ferramenta/js/jQuery/jquery-ui.min.js"></script>    
  <script src="/site/ferramenta/zoom/src/panzoom.js"></script>
  <script src="/site/ferramenta/zoom/test/libs/jquery.mousewheel.js"></script>
  <script src="/site/ferramenta/bootstrap/bootstrap.min.js"></script>
  <script type="text/javascript" src="/site/mapa/fancybox/lib/jquery.mousewheel.pack.js"></script>
  <script type="text/javascript" src="/site/mapa/fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>
  <script src="/site/js/ajax/index.js"></script>
  <script src="/site/js/empreendimento/mapa.js"></script>     
  <script src="/global/js/loader/index.js"></script>
  <script src="/global/js/ajax/index.js"></script>   

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>   
  <div id="tela">
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
        $situacao_unidade = $situacoes[$unidade->situacao];
        $situacao = $situacoes[$unidade->situacao];
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
        @if ($unidade->getCaracteristica("pne") == "Não")
          {{ $unidade->nome }}
        @endif
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
    <img id="mapa_fundo" src="{{ $empreendimento->getFotoTipo('Implantação') }}"/>
  </div>    
  <div class="modal fade" id="modal_detalhes" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button tipo="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Situação</h4>
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
</body>
</html>
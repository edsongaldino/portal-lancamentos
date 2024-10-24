@extends('site/empreendimento/premium/layout_interno')

@push('meta')
<title>INICIO</title>
@endpush

@push('includes_head')
<!-- Bootstrap -->
<link rel="stylesheet" href="/site/ferramenta/bootstrap/bootstrap.min.css">     
<link rel="stylesheet" href="/site/ferramenta/apartment-font/css/font-awesome.min.css">  
<link rel="stylesheet" type="text/css" href="/site/css/plugins.css">
<link rel="stylesheet" type="text/css" href="/site/css/apartment-layout.css?v=02">
<link rel="stylesheet" type="text/css" href="/site/css/empreendimento.css">
<link rel="stylesheet" href="/assets/sweetalert/dist/sweetalert.css">
<script src="/site/ferramenta/js/jQuery/jquery.min.js"></script>
<script src="/site/ferramenta/js/jQuery/jquery-ui.min.js"></script>  
<script src="/site/ferramenta/bootstrap/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2iyRbAD5MmPd04zL6XmdobC96fNVbjDc&amp;libraries=places"></script>
<script src="/site/ferramenta/js/plugins.js"></script>
<script src="/site/ferramenta/mail/validate.js"></script>
<script src="/site/ferramenta/js/apartment.js?v=06"></script>
<script src="/site/ferramenta/js/funcao_javascript.js" type="text/javascript"></script>
<script src="/site/ferramenta/bootstrap/bootstrap3-typeahead.min.js"></script>
<script src="/assets/javascripts/sweetalert2.8.js"></script>
<script src="/site/ferramenta/zoom/src/panzoom.js"></script>
<script src="/site/ferramenta/zoom/test/libs/jquery.mousewheel.js"></script>
<script src="/site/m/js/jquery.mask.js"></script>
<script src="/site/js/ajax/index.js"></script>
<script src="/site/js/empreendimento/formulario.js"></script>
<script src="/site/js/empreendimento/oferta.js"></script>
<script src="/site/js/empreendimento/index.js"></script>
@endpush

@section('content')

<div class="conteudo">
    <div id="tour">
        <div class="titulo-tour"><i class="fas fa-circle-notch" aria-hidden="true"></i> Tour 360º</div>

        @foreach ($empreendimento->tour as $tour)
        <a data-fancybox data-type="iframe" data-src="{{ $tour->link }}" href="javascript:;">
            <div class="btn-tour-360">
                <div class="title"><i class="fas fa-circle-notch" aria-hidden="true"></i> {{ $tour->titulo }}</div>
                <div class="subtitulo">Clique para abrir</div>
            </div>
        </a>
        @endforeach

    </div>
</div>

@endsection

@push('rodape')
<div class="rodape">
    <div class="btn-voltar" onclick='history.go(-1)'><i class="fa fa-reply-all" aria-hidden="true"></i></div>
    <a href="/empreendimento/{{ $empreendimento->id }}/premium"><div class="btn-condicoes-pagamento"><i class="fa fa-building" aria-hidden="true"></i> Empreendimento</div></a>
</div>

<script>
    $(function() {
        $(".fancyboxIframe").fancybox({
            maxWidth    : 900,
            maxHeight   : 600,
            fitToView   : false,
            width       : '90%',
            height      : '90%',
            autoSize    : false,
            closeClick  : false,
            openEffect  : 'none',
            closeEffect : 'none',
        iframe: {
            scrolling : 'auto',
            preload   : true
        }
        });
    });
</script>

@endpush
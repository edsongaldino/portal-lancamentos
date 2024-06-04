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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzzfaZRQcQvaSDOtK3hyLoeY9YVUKedjQ&amp;libraries=places"></script>
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

<div class="conteudo fotos">
    <div class="fotos">
        <div class="gallery-grid">
            <div class="gallery-grid-sizer"></div>
            <div class="gallery-grid-lg">
            @php
                $fotos = $empreendimento->fotos->where('planta_id', 0)->where('planta_id', null)->where('status', 'Liberada');
            @endphp
            @foreach($fotos AS $foto)
                <a href="{{ $foto->getUrl('original') }}" class="gallery-grid-item {{ url_amigavel($foto->tipo)}}" data-sub-html="{{ $foto->tipo }}-{{ $foto->descricao }}">
                <img src="{{ $foto->getUrl('original') }}" alt="" />
                <span>
                    {{ $foto->tipo }}-{{$foto->descricao }}
                    <br/>
                    <i class="fa fa-search-plus"></i>
                </span>
                <div class="big-triangle"></div>
                </a>
            @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('rodape')
<div class="rodape">
    <a href="/empreendimento/{{ $empreendimento->id }}/premium"><div class="btn-voltar-foto"><i class="fa fa-reply-all" aria-hidden="true"></i></div></a>
</div>
<script src="/assets/vendor/pnotify/pnotify.custom.js"></script>
<script src="/assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="/site/painel/assets/javascripts/ui-elements/examples.modals.js"></script>  
<script src="/site/painel/assets/javascripts/ui-elements/examples.lightbox.js"></script>
@endpush
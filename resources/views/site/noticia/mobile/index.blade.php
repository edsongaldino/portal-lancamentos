@extends('site/layout_mobile')

@push('meta')
  <meta name="twitter:image" content="/uploads/{{ $noticia->arquivo }}">
  <meta property="og:url" content="{{ $noticia->getUrlCompleta() }}" />
  <meta property="og:title" content="{{ $noticia->titulo }}" />
  <meta property="og:description" content="{{ $noticia->resumo }}" />
  <meta property="og:image" content="/uploads/{{ $noticia->arquivo }}" />
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="1067">
  <meta property="og:image:height" content="600">
@endpush

@section('content')
<div class="post-featured animated fadeInRight">
  <img src="/uploads/{{ $noticia->arquivo }}" class="img-responsive" width="100%" alt="" />
</div>
<div class="content-container-interna animated fadeInUp">
  <div class="entry-main">
    <h1 class="entry-title">{{ $noticia->titulo }}</h1>
    <p><i class="fa fa-calendar-o"></i> Data: {{ $noticia->data }}</p>
    <div class="entry-content">
      <p class="texto-quem-somos">{!! $noticia->texto !!}</p>
    </div>
    <p><i class="fa fa-user"></i> Fonte: Assessoria de imprensa - Lançamentos Online</p>

    <div class="pull-right">            
      <span class="compartilhar">Compartilhar:</span>
      <div class="pull-right icon-margin blog-big-icon whatsapp">
        <a class="whatsapp" target="_blank" href="https://api.whatsapp.com/send?text={{ $noticia->getUrlCompleta() }}"">
          <i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i>
        </a>
      </div>
      <div class="pull-right icon-margin blog-big-icon facebook">
        <a class="facebook" target="_blank" href="https://facebook.com/sharer.php?u={{ $noticia->getUrlCompleta() }}">
          <i class="fa fa-facebook fa-2x"></i>
        </a>
      </div>
    </div>

  </div>
  <div class="clear"></div>
</div>  
@endsection
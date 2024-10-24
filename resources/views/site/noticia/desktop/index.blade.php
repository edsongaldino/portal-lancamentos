@extends('site/layout')

@push('css')
  <!-- Bootstrap -->
  <link rel="stylesheet" href="/site/ferramenta/bootstrap/bootstrap.min.css">
  <!-- Font awesome styles -->    
  <link rel="stylesheet" href="/site/ferramenta/apartment-font/css/font-awesome.min.css">
  <!-- Custom styles -->
  <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,500italic,700,700italic&amp;subset=latin,latin-ext'>
  <link rel="stylesheet" type="text/css" href="/site/css/plugins.css">
  <link rel="stylesheet" type="text/css" href="/site/css/apartment-layout.css">
  <link id="skin" rel="stylesheet" type="text/css" href="/site/css/apartment-colors-blue.css">
  @endpush

  @push('js_header')
  <!-- jQuery  -->
  <script src="/site/ferramenta/js/jQuery/jquery.min.js"></script>
  <script src="/site/ferramenta/js/jQuery/jquery-ui.min.js"></script>
  <!-- Bootstrap-->
  <script src="/site/ferramenta/bootstrap/bootstrap.min.js"></script>
  <!-- Google Maps -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR2IVq3jVk74-DZM8sEliKtRcVJqZoLPI&amp;libraries=places"></script>
  <!-- plugins script -->
  <script src="/site/ferramenta/js/plugins.js"></script>
  <!-- template scripts -->
  <script src="/site/ferramenta/mail/validate.js"></script>
  <script src="/site/ferramenta/js/apartment.js"></script>
@endpush

@push('js_footer')
  <script src="/site/js/ajax/index.js"></script>
  <script src="/site/js/home/index.js"></script>
@endpush

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
  <section class="section-light section-top-shadow top-padding-130">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-9 col-md-push-3">
          <article class="archive-item zoom-cont2">
            <h2 class="title-negative-margin">
              {{ $noticia->titulo }}
            </h2>
            
            <a href="#" class="title-link">
              <div class="blog-top-icon pull-left">
                <i class="fa fa-user"></i>
                Assessoria de imprensa - Lançamentos Online
              </div>
            </a>

            <a href="#" class="title-link">
              <div class="blog-top-icon pull-left">
                <i class="fa fa-calendar-o"></i>{{ $noticia->data }}
              </div>
            </a>
            <div class="clearfix"></div>						
            <div class="title-separator-primary"></div>
            <figure style="float: left; max-width:400px; margin: 60px 20px 20px 0;">
              <img src="/uploads/{{ $noticia->arquivo }}" 
                class="img-responsive" 
                alt="">
            </figure>
            <div class="blog-text">
              {!! $noticia->texto !!}
              <br>
            </div>
            <div class="agent-social-bar margin-top-30">
              <div class="pull-right">
                <a class="pull-left tag-div">
                  <span>Compartilhar</span>
                  <div class="button-triangle2"></div>
                </a>
                <div class="pull-right icon-margin blog-big-icon whatsapp">
                  <a class="whatsapp" target="_blank" href="https://api.whatsapp.com/send?text={{ $noticia->getUrlCompleta() }}">
                    <i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i>
                  </a>
                </div>
                <div class="pull-right icon-margin blog-big-icon facebook">
                  <a class="facebook" target="_blank" href="https://facebook.com/sharer.php?u={{ $noticia->getUrlCompleta() }}">
                    <i class="fa fa-facebook fa-2x"></i>
                  </a>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </article>	          
        </div>		

        <div class="col-xs-12 col-md-3 col-md-pull-9">
          <div class="sidebar-left">
            <div class="sidebar-title-cont">
              <h4 class="sidebar-title">Últimas<span class="special-color"> Publicações</span></h4>
              <div class="title-separator-primary"></div>
            </div>
            <div class="sidebar-blog-cont">
              @foreach($ultimas_noticias as $n)
                <article>
                  <a href="{{ $n->getUrl() }}">
                    <img src="/uploads/{{ $n->arquivo }}" 
                      alt="" 
                      class="sidebar-blog-image">
                  </a>
                  <div class="sidebar-blog-title">
                    <a href="{{ $n->getUrl() }}">                      
                      {{ $n->titulo }}
                    </a>
                  </div>
                  <div class="sidebar-blog-date">
                    <i class="fa fa-calendar-o"></i>{{ $n->data }}
                  </div>
                  <div class="clearfix"></div>					
                </article>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
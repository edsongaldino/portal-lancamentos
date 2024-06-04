<div class="post-featured post-featured-index animated fadeInRight">    
  <!-- Box Construtoras -->
  <div class="widget-box">
    <h3 class="widget-title construtoras"><!-- Title Latest Widget -->
      <span>Publicações - Novidades e Artigos</span>
    </h3><!-- End Title Latest Widget -->
    
    @foreach($noticias as $noticia)
    <a href="{{ $noticia->getUrl() }}">
      <div class="post-featured animated fadeInRight artigo">
        <div class="imagem">
          <img src="/uploads/{{ $noticia->arquivo }}" class="img-responsive" alt="" />
        </div>
        <div class="data">
            <i class="fa fa-calendar-o"></i> 
            {{ $noticia->data }}
        </div>
        <div class="titulo">
          {{ $noticia->titulo }}
        </div>
      </div>
    </a>
    @endforeach
    
  </div>
</div>
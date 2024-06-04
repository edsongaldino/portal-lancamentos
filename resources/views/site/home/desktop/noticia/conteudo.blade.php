<div class="blog-grid1-post-content">
  <div class="blog-grid1-topline">
    <div class="blog-grid1-date pull-left">
      <i class="fa fa-calendar-o"></i>{{ $noticia->data }}
    </div>
    <div class="clearfix">						
    </div>
  </div>
  <a href="{{ $noticia->getUrl() }}" class="blog-grid1-title">
    <h4>{{ mb_strtoupper($noticia->titulo) }}</h4>
  </a>
  <div class="blog-grid1-separator"></div>
  <p>
    {{ $noticia->resumo }}
  </p>
  <a href="{{ $noticia->getUrl() }}" class="blog-grid1-button">
    <span>Ler mais</span>
    <div class="blog-grid1-triangle"></div>
  </a>
</div>
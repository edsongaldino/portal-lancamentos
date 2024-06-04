<div class="post-featured post-featured-index animated fadeInRight">  
  <!-- Box Construtoras -->
  <div class="widget-box">
    <h3 class="widget-title construtoras"><!-- Title Latest Widget -->
      <span>Construtoras em Destaque</span>
    </h3><!-- End Title Latest Widget -->
    
    <ul class="lista-construtoras">
      @foreach($construtoras as $construtora)
      @if ($construtora->getLogoUrl())
      <li class="col-5">
        <a href="{{ $construtora->getPaginaUrl() }}">
          <div class="entry-thumb">
            <a href="{{ $construtora->getPaginaUrl() }}">
              <img src="{{ $construtora->getLogoUrl() }}"></a>
            </div>
          </a>
        </li>
        @endif
        @endforeach
      </ul>
    </div>
    <!-- Latest Widget -->
    <!-- Fim Box Construtoras -->
  </div>  
</div>
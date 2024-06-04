<section class="post-featured animated fadeInRight">
  @include('site/empreendimento/mobile/facebook')
  <!-- Slide imgs --> 
  <div id="demo-test-gallery" class="featured-gallery-slider animated fadeInRight gallery-empreendimento">
    @php
    $fotos = $empreendimento->getFotosCarrossel();
    @endphp

    @foreach ($fotos as $foto)  
      <a href="{{ $foto->getUrl() }}" data-size="{{ $foto->getTamanho('original') }}" data-med="{{ $foto->getUrl('original') }}" data-med-size="{{ $foto->getTamanho('original') }}" data-author="Lançamentos Online">
        <img src="{{ $foto->getUrl('400x300') }}" class="center">
        <figure class="texto">
          {{ $foto->nome }}
        </figure>
      </a>              
    @endforeach       

  </div>
  <!-- /Slide imgs -->
</section>
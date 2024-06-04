@php
  $fotos_carrossel = $empreendimento->getFotosCarrossel();
@endphp

<section class="section-dark no-padding">

  <!-- Slider main container -->
  <div id="swiper-gallery" class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">

      <!-- Slides -->
      @foreach($fotos_carrossel as $foto)
      <div class="swiper-slide">
        <div class="slide-bg swiper-lazy" data-background="{{ $foto->getUrl() }}" data-sub-html="<strong>{{ $foto->tipo }}</strong><br/>{{ $foto->nome }}"></div>
        <!-- Preloader image -->
        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-9 col-lg-8 slide-desc-col detalhes animated fadeInUp gallery-slide-desc-{{ $loop->iteration }}">
              <div class="gallery-slide-cont">
                <div class="gallery-slide-cont-inner">  
                  <div class="gallery-slide-title pull-right">
                    <h3>{{ $empreendimento->nome }}</h3>
                    <h5 class="subtitle-margin-top">{{ $foto->nome }}</h5>

                  </div>
                  <div class="gallery-slide-estate pull-right hidden-xs">
                    <i class="fa fa-camera"></i>
                  </div>

                </div>
              </div>  
            </div>      
          </div>

          @if ($empreendimento->caracteristicas->where('nome', 'video')->first())
            @if($empreendimento->caracteristicas->where('nome', 'video')->first()->pivot->valor)
              <a href="#myModal" data-toggle="modal"><div class="video-empreendimento"><img src="/site/images/detalhes/video-empreendimento.png" alt=""></div></a>
            @endif
          @endif
        </div>
      </div>
      @endforeach

    </div>

    <div class="slide-buttons slide-buttons-center">
      <a href="#" class="navigation-box navigation-box-next slide-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
      <div id="slide-more-cont"></div>
      <a href="#" class="navigation-box navigation-box-prev slide-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
    </div>

  </div>
</section>

<section class="thumbs-slider section-both-shadow">
  <div class="container">
    <div class="row">
      <div class="col-xs-1">
        <a href="#" class="thumb-box thumb-prev pull-left"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
      </div>
      <div class="col-xs-10">
        <!-- Slider main container -->
        <div id="swiper-thumbs" class="swiper-container">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach($fotos_carrossel as $foto)
            <div class="swiper-slide">
              <img class="slide-thumb" src="{{ $foto->getUrl('110x83') }}" alt="">
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-xs-1">
        <a href="#" class="thumb-box thumb-next pull-right"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
      </div>
    </div>
  </div>
</section>
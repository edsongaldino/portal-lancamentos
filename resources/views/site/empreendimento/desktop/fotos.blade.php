<div class="row margin-top-45">
  <div class="container">
    <div class="row margin-top-60">
      <div class="col-xs-10">
        <h3 class="title-negative-margin">Mais Imagens do Empreendimento</h3>
        <div class="title-separator-primary"></div>
      </div>
    </div>
  </div>

  <div class="container gallery-filter-cont margin-top-60">
    <div class="row">
      <div class="col-xs-12 text-left">
        <div class="gallery-filter" data-filter="*">Todas as Fotos</div>
          @php
            $tipos_imagem = array(
              array(1,"Externa"),
              array(2,"Interna"),
              array(4,"Decorado"),
              array(5, "Estágio de Obra"),
              array(6, "Implantação"),
            );
          @endphp
          @foreach($tipos_imagem as $tipo_imagem)
            <div class="gallery-filter" data-filter=".{{ url_amigavel($tipo_imagem[1])}}">{{ $tipo_imagem[1]}}</div>
          @endforeach
      </div>
    </div>
  </div>                        
  <div class="gallery-grid">
      <div class="gallery-grid-sizer"></div>
      <div class="gallery-grid-lg">

        @php
          $fotos = $empreendimento->fotos->where('planta_id', 0)->where('planta_id', null)->where('status', 'Liberada');
        @endphp

        @foreach($fotos AS $foto)
          <a href="{{ $foto->getUrl('original') }}" class="gallery-grid-item {{ url_amigavel($foto->tipo)}}" data-sub-html="{{ $foto->tipo }}-{{ $foto->descricao }}">
            <img src="{{ $foto->getUrl('400x300') }}" alt="" />
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
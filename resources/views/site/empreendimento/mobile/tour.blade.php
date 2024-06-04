@php
$link_tour = $empreendimento->caracteristicas->where('nome', 'link_tour')->first();
@endphp
@if($link_tour)
  @if ($link_tour->pivot->valor != null)
    <section id="conteudo-tour">
      <div class="widget-box">
        <h3 class="widget-title">
          <span class="perfil">Tour Virtual</span>
        </h3>
      </div>
      <div class="post-featured-tour animated fadeInRight">
        <iframe src="{{ $link_tour->pivot->valor }}" class="tour"></iframe>          
      </div>
    </section>
  @endif
@endif
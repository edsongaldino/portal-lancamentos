<!-- Vídeo do Empreendimento -->
@if ($empreendimento->caracteristicas->where('nome', 'video')->first())
  @if($empreendimento->caracteristicas->where('nome', 'video')->first()->pivot->valor)
    <section id="conteudo-video">
      <div class="widget-box">
        <h3 class="widget-title">
          <span class="perfil">Vídeo do Empreendimento</span>
        </h3>
      </div>
      <div class="post-featured-video animated fadeInRight">
        <iframe src="{{ $empreendimento->caracteristicas->where('nome', 'video')->first()->pivot->valor }}" class="video"></iframe>
      </div>
    </section>
  @endif
@endif
<!-- Content Localização -->
<section id="conteudo-localizacao">
  <div class="widget-box">
    <h3 class="widget-title">
      <span class="perfil">Localização</span>
    </h3>
  </div>
  <div class="post-featured-localizacao animated fadeInRight">
    <div id="estate-map" class="details-map"></div>
  </div>

  <div class="endereco-localizacao-empreendimento">
    <i class="fa fa-map-marker 3x"></i>
    <br/>
    @php
      $endereco = null;

      if ($empreendimento->endereco) {
        $e = $empreendimento->endereco;
        $endereco = "{$e->logradouro} {$e->numero} {$e->bairro->nome} {$e->cidade->nome} {$e->cidade->estado->nome}";
      }            
    @endphp

    {{ $endereco }}
  </div>
</section>
<!-- /Content Localização -->
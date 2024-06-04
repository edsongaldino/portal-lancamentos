<div class="details-image pull-left hidden-xs">
  <img src="{{ url($empreendimento->getLogo()) }}" alt="" width="125" height="95">
</div>

<div class="details-title pull-left">
  <h1>{{ $empreendimento->nome }}</h1>
  <h5 class="subtitle-margin-top"><i class="fa fa-map-marker" aria-hidden="true"></i> 
    @if ($empreendimento->endereco)
    {{ $empreendimento->endereco->bairro->nome }},
    @endif 
    @if ($empreendimento->endereco)
    {{ $empreendimento->endereco->cidade->nome }} - 
    @endif
    @if ($empreendimento->endereco)
    {{ $empreendimento->endereco->cidade->estado->nome }}
    @endif
  </h5>
</div>

<div class="details-share pull-right">
  @if(false)
  @if(in_array($empreendimento->id, $array_empreendimentos_favoritos))
  <div class="list-favorite active" onclick="removeFavorito('{{ $empreendimento->id }}">
    <i class="fa fa-heart fa-2x" aria-hidden="true"></i>
  </div>
  @else
  <div class="list-favorite" onclick="addFavorito('{{ $empreendimento->id }}');">
    <i class="fa fa-heart fa-2x" aria-hidden="true"></i>
  </div>
  @endif
  @else
  <div class="list-favorite" data-toggle="modal" data-target="#login-modal">
    <i class="fa fa-heart fa-2x" aria-hidden="true"></i>
  </div>
  @endif

  <a href="https://facebook.com/sharer.php?u=https://www.lancamentosonline.com.br/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome )}}-{{$empreendimento->id}}.html" target="_blank" class="facebook">
    <div class="list-share">
      <i class="fa fa-share-alt fa-2x" aria-hidden="true"></i>
    </div>
  </a>
</div>

<div class="clearfix"></div>                              

<div class="title-separator-detalhes"></div>

@if ($empreendimento->construtora->black_friday == 'S'):?>
  <div class="selo-oferta-detalhe">
    <img src="/site/images/selo_oferta_{{ $empreendimento->construtora_id }}.png" alt="">
  </div>
@elseif ($empreendimento->ofertasAtivas->count())
  <div class="selo-oferta-detalhe">
    <img src="/site/images/selo-blackmonth-lancamentos.png" alt="">
  </div>
@endif

<div class="type-container-detalhe">
  @if ($empreendimento->subtipo->id == 1)
  <div class="estate-type">
    <i class="fa fa-building" aria-hidden="true" title="Apartamento"></i>
  </div>
  @elseif ($empreendimento->subtipo->id == 2)
  <div class="estate-type">
    <i class="fa fa-briefcase" aria-hidden="true" title="Salas Comerciais"></i>
  </div>
  @else
  <div class="estate-type">
    <i class="fa fa-home" aria-hidden="true" title="Casas em Condomínio"></i>
  </div>
  @endif

  @if ($empreendimento->modalidade == 'Lançamento')
  <div class="transaction-type lancamento" title="Lançamento">L</div>
  @elseif ($empreendimento->modalidade == 'Em Obra')
  <div class="transaction-type obra" title="Em Obra">O</div>
  @elseif ($empreendimento->modalidade == 'Breve')
  <div class="transaction-type breve" title="Breve Lançamento">B</div>
  @else
  <div class="transaction-type mude-ja" title="Pronto para Morar">P</div>
  @endif                               
</div>

<p class="details-desc detalhe">{{ $empreendimento->descricao }}</p>
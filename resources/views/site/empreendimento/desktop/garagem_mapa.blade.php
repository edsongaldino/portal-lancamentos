<div id="dados-garagem">

  <div class="dados-vaga">

    <div class="descricao-vaga">
      <div class="icone"><i class="fa fa-car" aria-hidden="true"></i></div>
      <div class="nome">Vaga Nº {{ $garagem->nome }}</div>
    </div>

    <div class="formato-vaga {{ url_amigavel($garagem->formato_vaga) }}">
      <div class="icone" title="{{ $garagem->formato_vaga }}">{{ $garagem->formato_vaga[0] }}</div>
      <div class="nome-formato">{{ $garagem->formato_vaga }}</div>
    </div>

    @if($garagem->formato_vaga == 'Extra')
    <div class="valor-vaga">
      <div class="icone"><i class="fa fa-dollar" aria-hidden="true"></i></div>
      <div class="valor">{{ $garagem->caracteristicas->where('nome', 'valor_vaga')->first()->pivot->valor ?? '' }}</div>
    </div>
    @endif

    <div class="tipo-vaga {{ url_amigavel($garagem->tipo_vaga) }}">
      @if($garagem->tipo_vaga == 'Gaveta Coberta' || $garagem->tipo_vaga == 'Gaveta Descoberta')
      <div class="icone gaveta"><i class="fa fa-car" aria-hidden="true"></i><br><i class="fa fa-car" aria-hidden="true"></i></div>
      <div class="nome-tipo gaveta">{{ $garagem->tipo_vaga }}</div>
      @else
      <div class="icone"><i class="fa fa-car" aria-hidden="true"></i></div>
      <div class="nome-tipo">{{ $garagem->tipo_vaga }}</div>
      @endif
    </div>

    @if($garagem->vaga_pne == 'Sim')
    <div class="vaga-pne">
      <div class="icone"><i class="fa fa-wheelchair" aria-hidden="true"></i></div>
      <div class="nome">PNE</div>
    </div>
    @endif

  </div>

  @if(isset($garagem->unidade_id))
  <div class="dados-unidade">
    <div class="topo">*Esta vaga está vinculada a unidade abaixo</div>
    <div class="descricao-unidade">
      <div class="icone"><i class="fa fa-building" aria-hidden="true"></i></div>
      <div class="nome">{{ $garagem->torre->nome ?? '' }} - {{ $garagem->unidade->andar->numero ?? '' }}º Andar - Unidade {{ $garagem->unidade->nome ?? '' }}</div>
      <div class="valor"><i class="fa fa-dollar" aria-hidden="true"></i></div>
    </div>
  </div>
  @endif

  <div class="info">*Valores e disponibilidade podem sofrer alterações sem aviso prévio.</div>
                 
</div>
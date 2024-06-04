<div class="details-parameters-cont detalhe">                       
  <div class="details-parameters-icon">
    <i class="fa fa-briefcase fa-2x" aria-hidden="true" title="Salas Comerciais"></i>
  </div>
  <div class="details-parameters-name">Unidades</div>
  <div class="details-parameters-val">
    {{ $empreendimento->unidades->count() }}
  </div>
  <div class="clearfix"></div>  
</div>
<div class="details-parameters-cont detalhe">
  <div class="details-parameters-icon">
    <i class="fa fa-info fa-2x" aria-hidden="true"></i>
  </div>
  <div class="details-parameters-name">Número de torres</div>
  <div class="details-parameters-val">
    {{ $empreendimento->torres->count() }}
  </div>
  <div class="clearfix"></div>  
</div>
<div class="details-parameters-cont detalhe">
  <div class="details-parameters-icon">
    <i class="fa fa-object-group fa-2x" aria-hidden="true"></i>
  </div>
  <div class="details-parameters-name">Metragem das Salas</div>
  <div class="details-parameters-val">{!! qtd_metragem($empreendimento) !!}m<sup>2</sup></div>
  <div class="clearfix"></div>  
</div>
<div class="details-parameters-cont detalhe">
  <div class="details-parameters-icon">
    <i class="fa fa-ticket fa-2x" aria-hidden="true"></i>
  </div>
  <div class="details-parameters-name">Estacionamento rotativo</div>
  <div class="details-parameters-val">
    @if($empreendimento->getCaracteristica('estacionamento_rotativo') == 'S')
    Sim
    @else
    Não
    @endif
  </div>
  <div class="clearfix"></div>  
</div>
<div class="details-parameters-cont detalhe">
  <div class="details-parameters-icon">
    <i class="fa fa-columns fa-2x"></i>
  </div>
  <div class="details-parameters-name">Qtd. de Elevadores</div>
  <div class="details-parameters-val">
    {{ $empreendimento->getCaracteristica('qtd_elevador') }}
  </div>
  <div class="clearfix"></div>  
</div>
<div class="details-parameters-cont detalhe">
  <div class="details-parameters-icon">
    <i class="fa fa-car fa-2x" aria-hidden="true"></i>
  </div>
  <div class="details-parameters-name">Garagem</div>
  <div class="details-parameters-val">
    {!! qtd_vagas($empreendimento, 'Vertical') !!}
  </div>
  <div class="clearfix"></div>  
</div>
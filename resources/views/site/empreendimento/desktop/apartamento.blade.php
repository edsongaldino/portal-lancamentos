<div class="details-parameters-cont detalhe">        
  <div class="details-parameters-icon">
    <i class="fa fa-building fa-2x" aria-hidden="true" title="Apartamentos"></i>
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
  <div class="details-parameters-name">Metragem</div>
  <div class="details-parameters-val">
    {!! qtd_metragem($empreendimento) !!}
  </div>
  <div class="clearfix"></div>  
</div>
<div class="details-parameters-cont detalhe">
  <div class="details-parameters-icon">
    <i class="fa fa-bed fa-2x" aria-hidden="true"></i>
  </div>
  <div class="details-parameters-name">Dormitórios</div>
  <div class="details-parameters-val">
    {!! qtd_dormitorio($empreendimento, true) !!}
  </div>
  <div class="clearfix"></div>  
</div>
<div class="details-parameters-cont detalhe">
  <div class="details-parameters-icon">
    <i class="fa fa-bathtub fa-2x"></i></div>
    <div class="details-parameters-name">Suítes</div>
    <div class="details-parameters-val">
      {!! qtd_suites($empreendimento) !!}
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
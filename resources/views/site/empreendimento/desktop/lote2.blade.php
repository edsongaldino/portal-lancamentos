<div class="details-parameters-cont detalhe">                       
  <div class="details-parameters-icon">
    <i class="fa fa-pause fa-2x" aria-hidden="true" title="Lotes em Condomínio Fechado"></i>
  </div>
  <div class="details-parameters-name">Unidades</div>
  <div class="details-parameters-val">
    {{ $empreendimento->unidades->count() }}
  </div>                        
  <div class="clearfix"></div>  
</div>
<div class="details-parameters-cont detalhe">
  <div class="details-parameters-icon">
    <i class="fa fa-object-group fa-2x" aria-hidden="true"></i>
  </div>
  <div class="details-parameters-name">Lotes de </div>
  <div class="details-parameters-val">{{ converte_valor_real_semdecimal($empreendimento->getCaracteristica('area_privativa_real', 'minimo_planta'))}} à {{ converte_valor_real_semdecimal($empreendimento->getCaracteristica('area_privativa_real', 'maximo_planta'))}}m<sup>2</sup></div>
  <div class="clearfix"></div>  
</div>
<div class="details-parameters-cont detalhe">
  <div class="details-parameters-icon">
    <i class="fa fa-map-o fa-2x" aria-hidden="true"></i>
  </div>
  <div class="details-parameters-name">Área Total</div>
  <div class="details-parameters-val">{{ converte_valor_real_semdecimal($empreendimento->getCaracteristica('area_total'))}}m<sup>2</sup></div>
  <div class="clearfix"></div>  
</div>
<div class="details-parameters-cont detalhe">
  <div class="details-parameters-icon"><i class="fa fa-tree fa-2x" aria-hidden="true"></i></div>
  <div class="details-parameters-name">Área de preservação </div>

  <div class="details-parameters-val">{{ converte_valor_real_semdecimal($empreendimento->getCaracteristica('area_preservacao'))}}m<sup>2</sup></div>

  <div class="clearfix"></div>  
</div>
<div class="details-parameters-cont detalhe">
  <div class="details-parameters-icon"><i class="fa fa-info fa-2x" aria-hidden="true"></i></div>
  <div class="details-parameters-name">Tipo das unidades</div>
  <div class="details-parameters-val">{{ $empreendimento->getCaracteristica('tipo_condominio') }}</div>
  <div class="clearfix"></div>  
</div>
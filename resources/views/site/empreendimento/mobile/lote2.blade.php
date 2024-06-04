<div class="small-listing-item">
  <div class="entry-thumb1">
    <img src="/site/m/images/icones/condominio-lotes-icon.png" alt="Empreendimento" title="Nome do empreendimento">
  </div>
  <div class="entry-content1">
    <h2>
      <br/>
      <span class="previsao-entrega">
        {{ $empreendimento->unidades->count() }}
      </span>
      <span class="texto-previsao">Unidades (Lotes)</span>
    </h2>
  </div>
</div>

<div class="small-listing-item">
  <div class="entry-thumb1">
    <img src="/site/m/images/icones/area-lotes-icon.png" alt="Lotes" title="Metragem dos lotes">
  </div>
  <div class="entry-content1">
    <h2>
      Área dos Lotes
      <br/>
      <span class="previsao-entrega">              
        De {{ $empreendimento->getCaracteristica('area_unidade_min') }} à {{ $empreendimento->getCaracteristica('area_unidade_max') }}m<sup>2</sup>
      </h2>
  </div>
</div>

<div class="small-listing-item">
  <div class="entry-thumb1">
    <img src="/site/m/images/icones/area-verde-icon.png" alt="Área Verde" title="Área Verde">
  </div>
  <div class="entry-content1">
    <h2>
      Área Verde em comum
      <br/>
      <span class="previsao-entrega">
        {{ $empreendimento->getCaracteristica('area_verde') }}m<sup>2</sup>
      </h2>
    </div>
</div>

<div class="small-listing-item">
  <div class="entry-thumb1">
    <img src="/site/m/images/icones/area-preservacao-icon.png" alt="Vagas" title="Total de vagas cobertas">
  </div>
  <div class="entry-content1">
    <h2>
      Área de Preservação Permanente - APP
      <br/>
      <span class="previsao-entrega">
        {{ $empreendimento->getCaracteristica('area_preservacao') }}m<sup>2</sup>
      </span>
    </h2>
  </div>
</div>
<div class="small-listing-item">
  <div class="entry-thumb1">
    <img src="/site/m/images/icones/area-total-icon.png" alt="Vagas" title="Total de vagas cobertas">
  </div>
  <div class="entry-content1">
    <h2>
      Área Total do Loteamento
      <br/>
      <span class="previsao-entrega">
        {{ $empreendimento->getCaracteristica('area_total') }}m<sup>2</sup>
      </span>
    </h2>
  </div>
</div>

<div class="clear"></div>
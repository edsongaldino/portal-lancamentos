<div class="entry-thumb1">
  <img src="/site/m/images/icones/condominio-casas-icon.png" alt="Empreendimento" title="Nome do empreendimento">
</div>
<div class="entry-content1">
  <h2>
    <br/>
    <span class="previsao-entrega">
      {{ $empreendimento->unidades->count() }}
    </span>
    <span class="texto-previsao">
      Unidades 
      @if ($empreendimento->getCaracteristica('tipo_condominio'))
        ({{ $empreendimento->getCaracteristica('tipo_condominio') }})
      @endif
    </span>
  </h2>
</div>

@if(qtd_vagas($empreendimento, 'Horizontal', true))
  <div class="small-listing-item">
    <div class="entry-thumb1">
      <img src="/site/m/images/carro-icon.png" alt="Vagas" title="Total de vagas cobertas">
    </div>
    <div class="entry-content1">
      <h2>
        Vagas de garagem
        <br/>
        <span class="previsao-entrega">
          {!! qtd_vagas($empreendimento, 'Horizontal') !!}            
        </span>
      </h2>
    </div>
  </div>
@endif
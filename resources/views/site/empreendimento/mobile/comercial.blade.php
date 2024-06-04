<div class="small-listing-item">
  <div class="entry-thumb1">
    <img src="/site/m/images/elevador-icon.png" alt="Elevadores" title="Quantidade de elevadores">
  </div>
  <div class="entry-content1">
    <h2>
      Elevadores(s)
      <br/>
      <span class="previsao-entrega">
        {{ $empreendimento->getCaracteristica('qtd_elevador') }}          
      </span>
    </h2>
  </div>
</div>

<div class="small-listing-item">
  <div class="entry-thumb1">
    <img src="/site/m/images/estacionamento-icon.png" alt="Estacionamento" title="Estacionamento Rotativo">
  </div>
  <div class="entry-content1">
    <h2>
      Estacionamento Rotativo
      <br/>
      <span class="previsao-entrega">        
        @if($empreendimento->getCaracteristica('estacionamento_rotativo') == 'S')
          Sim
        @else
          Não
        @endif
      </span>
    </h2>
  </div>
</div>
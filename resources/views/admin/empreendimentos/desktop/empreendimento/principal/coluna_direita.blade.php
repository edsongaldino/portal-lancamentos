<ul class="simple-card-list mb-xlg box-info-empreendimento">
  
  @if (isset($entry))
    <a href="{{ $entry->getUrl() }}" class="btn btn-success btn-ver-anuncio" target="_blank" rel="tooltip" data-original-title="Clique para acessar o empreendimento no portal">
    <i class="fa fa-external-link" aria-hidden="true"></i> Ver anúncio no site
    </a>
  @endif

  <li class="primary">
    <h3>
      <i class="fa fa-building"></i> 
      @if (isset($entry))
      {{ unidades('Disponível', $entry->id) }}
      @else
      0
      @endif
    </h3>
    <p>Unidades Disponíveis</p>
  </li>
  <li class="success">
    <h3>
      <i class="fa fa-check-square-o"></i> 
      @if (isset($entry))
      {{ unidades('Vendida', $entry->id) }}
      @else
      0
      @endif
    </h3>
    <p>Unidades vendidas</p>
  </li>

  <li class="warning">
    <h3>
      <i class="fa fa-calendar"></i> 
      @if (isset($entry))
        {{ get_previsao_entrega($entry)}} 
      @else
        Não definida
      @endif
    </h3>
    <p>Previsão de Entrega</p>
  </li>

  <li class="warning" style="background-color: #70309e">
    @if (isset($entry) && $entry->valor_inicial)
      <h3>
        <i class="fa fa-dollar"></i> {{ $entry->valor_inicial }}  
      </h3>
      
    @else
      <h3>
        <i class="fa fa-dollar"></i>Não definido  
      </h3>      
    @endif
    <p>Unidade a partir de</p>

  </li>

  @if(isset($entry))

    @if ($entry->tipo == 'Vertical')
    <a href="/admin/empreendimento/{{ $entry->id }}/mapa-lazer" class="btn btn-success btn-ver-anuncio" target="_blank" rel="tooltip" data-original-title="Clique para acessar o empreendimento no portal">
      <i class="fa fa-external-link" aria-hidden="true"></i> Mapa (Área de Lazer)
    </a>

    <a href="/empreendimento/{{ $entry->id }}/{{ Auth::user()->id*37 }}/visualizar-mapa-lazer/view" class="btn btn-info btn-ver-anuncio" target="_blank" rel="tooltip" data-original-title="Clique para acessar o empreendimento no portal">
      <i class="fa fa-external-link" aria-hidden="true"></i> Visualizar Mapa (Área de Lazer)
    </a>
    @endif
    
  @endif

</ul>
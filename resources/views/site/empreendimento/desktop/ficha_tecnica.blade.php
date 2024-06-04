<div role="tabpanel" class="tab-pane @php if(empty($modulo_itens_lazer)): echo 'active'; endif; @endphp" id="profile">
  @php
    $infra_estrutura = $empreendimento->caracteristicas
      ->where('tipo', 'Empreendimento')
      ->where('exibir', 'Sim');

    $total_infra=1;
    $i = 1;
    $total_itens_infraestrutura = $infra_estrutura->count();

    $total_linhas = round($total_itens_infraestrutura/3)+2; 

  @endphp

  @foreach($infra_estrutura->all() as $item_infra)                                
    @if ($i==1)
    <div class="col-xs-6 col-sm-4">
      <ul class="details-ticks">
        <li>
          <i class="jfont">&#xe815;</i> 
          {{ $item_infra->nome }}
        </li>
    @elseif ($i < $total_linhas)
        <li>
          <i class="jfont">&#xe815;</i> 
          {{ $item_infra->nome }} 
        </li>                                 
    @elseif(($i==$total_linhas) || ($total_infra == $total_itens_infraestrutura))
      @php
        $i=0
      @endphp
        <li>
          <i class="jfont">&#xe815;</i> 
          {{ $item_infra->nome }} 
        </li>      
      </ul>
    </div>
    @endif
    @php
      $i = $i + 1;
      $total_infra = $total_infra + 1;
    @endphp
  @endforeach
</div>
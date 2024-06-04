<div role="tabpanel" class="tab-pane active" id="home">
  @php
    $itens_lazer = $empreendimento->itensLazer;
    $total_itens_lazer = $itens_lazer->count();

    $i = 1;
    $itens = 1;

    $total_linhas = round($total_itens_lazer/3)+2; 
    
    
  @endphp

  @foreach($itens_lazer->all() as $item_lazer)
    @if($i == 1)
      <div class="col-xs-6 col-sm-4">
        <ul class="details-ticks">
          <li>
            <i class="jfont">&#xe815;</i> 
            {{ $item_lazer->nome }}
          </li>
    @elseif($i < $total_linhas)
      <li>
        <i class="jfont">&#xe815;</i> 
        {{ $item_lazer->nome }}
      </li>                                 
    @elseif(($i == $total_linhas) || ($itens == $total_itens_lazer))
      @php
        $i = 0;
      @endphp
      <li>
        <i class="jfont">&#xe815;</i> 
        {{ $item_lazer->nome }}
      </li>      
      </ul>
      </div>
    @endif
    @php
      $i=$i+1;
      $itens=$itens+1;
    @endphp
  @endforeach
    
  </div>
  <div class="clearfix"></div>
</div>
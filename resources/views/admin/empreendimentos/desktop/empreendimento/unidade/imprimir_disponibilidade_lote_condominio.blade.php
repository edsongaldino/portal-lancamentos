<table class="table table-bordered" width="100%">
  <tr>
    <td align="center">
      <i class="fa fa-braille"></i>
    </td>
    <td align="center">
        {{ $empreendimento->variacao->nome }}
    </td>
    <td align="center">
      <i class="fa fa-window-maximize"></i>
    </td>
    <td align="center">
      <i class="fa fa-money"></i>
    </td>
  </tr>
  
  @foreach($unidades as $un)
    
    <tr>
      <td align="center">        
        {{ $un->quadra->nome }}
      </td>
      <td align="center">
        {{ $un->nome }}
      </td>
      <td align="center">
        @php
          $metragem_terreno = 0;            
        @endphp
        
        @php
          if ($metragem = $un->caracteristicas->where('nome', 'metragem_total')->first()) {
            $metragem_terreno = $metragem->pivot->valor;
          }
        @endphp
                
        {{ $metragem_terreno }} m<sup>2</sup>
      </td>

      <td align="center">

        @if($un->caracteristicas->where('nome', 'valor_unidade')->first() && $un->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '')
            R$ {{ converte_valor_real($un->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor) }} 
        @else
            @if($un->caracteristicas->where('nome', 'valor_m2')->first() && $un->caracteristicas->where('nome', 'metragem_total')->first())
                @php
                    $valor_m2 = $un->caracteristicas->where('nome', 'valor_m2')->first()->pivot->valor;
                    $metragem = $un->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor;
                @endphp
                R$ {{ converte_valor_real(floatval($valor_m2) * floatval($metragem)) }}
            @else
                R$ 0,00
            @endif
        @endif  
             
      </td>
    </tr>
  @endforeach

</table>
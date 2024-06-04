<table class="table table-bordered" width="100%">
  <tr>
    <td align="center">
      <i class="fa fa-braille"></i>
    </td>
    <td align="center">
      Casa
    </td>
    <td align="center">
      <i class="fa fa-window-maximize"></i>
    </td>
    <td align="center">
      <i class="fa fa-codepen"></i>
    </td>
    <td align="center">
      <i class="fa fa-bed"></i>
    </td>
    <td align="center">
      <i class="fa fa-car"></i>
    </td>
    <td align="center">
      <i class="fa fa-money"></i>
    </td>
  </tr>
  
  @foreach($unidades as $un)
    @php
      $planta = null;
      if ($un->planta) {
        $planta = $un->planta;
      }
    @endphp

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
        @if (!$planta)              
          @php
            $planta_principal = $empreendimento->caracteristicas->where('planta_principal')->first();
            if ($planta_principal) {
              $planta = $planta_principal->pivot->valor;
              $planta = App\Models\Planta::find($planta);
            }
          @endphp
        @endif

        @if ($planta)
          {{ $planta->nome }}
        @endif
      </td>
      <td align="center">
        @php
          $qtde_dormitorios = 0;            
          $qtde_suites = 0;
        @endphp
        
        @if ($planta)
          @php
            if ($dormitorios = $planta->caracteristicas->where('nome', 'qtd_dormitorio')->first()) {
              $qtde_dormitorios = $dormitorios->pivot->valor;
            }

            if ($suites = $planta->caracteristicas->where('nome', 'qtd_suite')->first()) {
              $qtde_suites = $suites->pivot->valor;
            }
          @endphp
        @endif
        
        @if ($qtde_suites > 0)
          {{ $qtde_dormitorios }} quartos sendo {{ $qtde_suites }} suítes
        @else
          {{ $qtde_dormitorios }} quarto(s)
        @endif
      </td>
      <td align="center">
        @php
          $qtde_garagens = 0;            
        @endphp
        
        @php            
          if ($planta) {
            if ($garagens = $planta->caracteristicas->where('nome', 'vagas_garagem')->first()) {
              $qtde_garagens = $garagens->pivot->valor;
            }
          }
        @endphp

        {{ $qtde_garagens }} vaga(s)
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
                R$ {{ converte_valor_real($valor_m2 * $metragem) }}
            @else
                R$ 0,00
            @endif
        @endif     
      </td>
    </tr>
  @endforeach

</table>
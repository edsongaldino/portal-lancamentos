<table class="table table-bordered" width="100%">
  <tr class="topo">
    <td align="center">
      <i class="fa fa-arrows-v"></i>
    </td>
    @if ($empreendimento->torres->count() > 1)
    <td align="center">
      <i class="fa fa-building"></i>
    </td>
    @endif
    <td align="center">
      Unidade
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
      <i class="fa fa-sun-o"></i>
    </td>
    <td align="center">
      <i class="fa fa-money"></i>
    </td>
  </tr>
  @php $contator = 0;@endphp
  @foreach($unidades as $un)
    <tr class="item">
      <td align="center">
        @if ($un->andar)
          <b>{{ $un->andar->numero }}</b>
        @endif
      </td>
      @if ($empreendimento->torres->count() > 1)
      <td align="center">
        {{ $un->torre->nome }}
      </td>
      @endif
      <td align="center">
        <b>{{ $un->nome }}</b>
      </td>
      <td align="center">
        @php
          $planta = null;
        @endphp

        @if ($un->planta)
          @php
            $planta = $un->planta;
          @endphp
        @else
          @php
            $planta_principal = $empreendimento->caracteristicas->where('planta_principal')->first();
            if ($planta_principal) {
              $planta = $planta_principal->pivot->valor;
              $planta = App\Models\Planta::find($planta);
            }
          @endphp
        @endif

        @if ($planta)
          <b>{{ $planta->nome }}</b><br>{{ $planta->area_privativa }}m²
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
          <b>{{ $qtde_dormitorios }} quarto(s)</b><br/>{{ $qtde_suites }} Suítes
        @else
          {{ $qtde_dormitorios }} quarto(s)
        @endif
      </td>
      <td align="center" class="vaga">
        @php
          $qtde_garagens = 0;            
        @endphp
        
        @php
          $total_vagas = get_total_vagas_unidade($un->id);
          if($total_vagas > 0){
            $qtde_garagens = $total_vagas;
          }elseif ($garagens = $un->caracteristicas->where('nome', 'vagas_garagem')->first()) {
            $qtde_garagens = $garagens->pivot->valor;
          }

        @endphp
        <b>{{ $qtde_garagens }} vaga(s) <br/></b>
        {{ get_texto_vagas($un->id) }}
      </td>
      <td align="center">
        @php
          $sol = '';            

          if ($tipo_sol = $un->caracteristicas->where('nome', 'tipo_sol')->first()) {
            $sol = $tipo_sol->pivot->valor;
          }              
        @endphp    

        {{ $sol }}      
      </td>
      <td align="center">
        @php
          $valor = 0;            

          if ($valor_unidade = $un->caracteristicas->where('nome', 'valor_unidade')->first()) {
            $valor = converte_valor_real($valor_unidade->pivot->valor);
          }              
        @endphp    

        <b>R$ {{ $valor }}</b>    
      </td>
    </tr>

    @php 
      $contator += 1;
      if($contator > 20){
        echo '<div class="pagebreak"></div>';
        $contador = 0;
      }
    @endphp

  @endforeach

</table>
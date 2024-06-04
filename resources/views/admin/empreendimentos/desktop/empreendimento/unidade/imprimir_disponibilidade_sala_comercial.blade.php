<table class="table table-bordered" width="100%">
  <tr>
    <td align="center">
      <i class="fa fa-arrows-v"></i>
    </td>
    <td align="center">
      Sala
    </td>
    <td align="center">
      <i class="fa fa-codepen"></i>
    </td>
    <td align="center">
      <i class="fa fa-bath"></i>
    </td>
    <td align="center">
      <i class="fa fa-coffee"></i>
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
  
  @foreach($unidades as $un)
    <tr>
      <td align="center">
        @if ($un->andar)
          {{ $un->andar->numero }}
        @endif
      </td>
      <td align="center">
        {{ $un->nome }}
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
          {{ $planta->nome }}
        @endif
      </td>
      <td align="center">
        @php
          $qtde_banheiros = 0;            
        @endphp
        
        @if ($planta)
          @php
            if ($banheiros = $planta->caracteristicas->where('nome', 'qtd_banheiro')->first()) {
              $qtde_banheiros = $banheiros->pivot->valor;
            }
          @endphp
        @endif
                
        {{ $qtde_banheiros }} banheiro(s)
      </td>
      <td align="center">
        @php
          $possui_copa = 'Não';            
        @endphp
        
        @if ($planta)
          @php
            if ($copa = $planta->caracteristicas->where('nome', 'possui_copa')->first()) {
              $possui_copa = $copa->pivot->valor;
            }
          @endphp
        @endif
                
        Copa: {{ $possui_copa }}
      </td>
      <td align="center">
        @php
          $qtde_garagens = 0;            
        @endphp
        
        @php            
          if ($garagens = $un->caracteristicas->where('nome', 'vagas_garagem')->first()) {
            $qtde_garagens = $garagens->pivot->valor;
          }
        @endphp

        {{ $qtde_garagens }} vaga(s)
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

        R$ {{ $valor }}      
      </td>
    </tr>
  @endforeach

</table>
<div id="topo-empreendimento-perfil">
  <div class="logo-empreendimento">
    <img src="{{ url($empreendimento->getLogo()) }}" alt="">
  </div>
  <div class="dados-empreendimento">
    <span class="nome-empreendimento">
      {{ $empreendimento->nome }}
    </span>
    <br/>
    <span class="endereco-empreendimento">
      @if ($empreendimento->endereco)
      {{ $empreendimento->endereco->bairro->nome }},
      @endif 
      @if ($empreendimento->endereco)
      {{ $empreendimento->endereco->cidade->nome }} - 
      @endif
      @if ($empreendimento->endereco)
      {{ $empreendimento->endereco->cidade->estado->nome }}
      @endif
    </span>
  </div>
</div>

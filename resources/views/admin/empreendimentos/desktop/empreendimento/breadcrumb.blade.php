@if(isset($entry))
<div class="botoes-acao">
  <div class="btn-group btn-group-justified">

    @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
      <a 
      href="{{ route('fotos-empreendimento', $entry->id) }}" 
      class="btn btn-default" 
      role="button"
      @if(url_possui('foto'))
      style="background: #005B79; color: white" 
      @endif
    >
    @else
      <a 
      class="btn btn-default erro-permissao-menu" 
      role="button"
      @if(url_possui('foto'))
        style="background: #005B79; color: white" 
      @endif
      >
    @endif
      <i class="fa fa-photo"></i> Fotos
    </a>

    @if ($entry->tipo == 'Vertical')

      @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
      <a 
       href="{{ route('torres', $entry->id) }}" 
       class="btn btn-default" 
       role="button"
       @if(url_possui('torre'))
        style="background: #005B79; color: white" 
       @endif
      >
      @else
      <a 
       class="btn btn-default erro-permissao-menu" 
       role="button"
       @if(url_possui('torre'))
        style="background: #005B79; color: white" 
       @endif
      >
      @endif
        <i class="fa fa-building"></i> 
        Torres
      </a>
    @endif

    @if ($entry->tipo == 'Horizontal')

      @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
      <a 
        href="{{ route('quadras', $entry->id) }}" 
        class="btn btn-default" 
        role="button"
        @if(url_possui('quadra'))
          style="background: #005B79; color: white" 
        @endif
      >
      @else
      <a 
        class="btn btn-default erro-permissao-menu" 
        role="button"
        @if(url_possui('quadra'))
          style="background: #005B79; color: white" 
        @endif
      >

      @endif
        <i class="fa fa-braille"></i> 
        Quadras
      </a>
    @endif
    
    @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
    <a       
      class="btn btn-default" 
      role="button"
      @if ($entry->variacao)
        @if ($entry->variacao->nome == 'Lote')
          style="background: #D3D3D3; color: white" 
          href="#" 
        @else
          href="{{ route('plantas', $entry->id) }}" 
        @endif
      @else
        href="{{ route('plantas', $entry->id) }}"
      @endif

      @if(url_possui('planta'))
        style="background: #005B79; color: white" 
      @endif      
    >
    @else
    <a       
      class="btn btn-default erro-permissao-menu" 
      role="button"
      @if(url_possui('planta'))
        style="background: #005B79; color: white" 
      @endif      
    > 

    @endif
      <i class="fa fa-codepen"></i> 
      Plantas
    </a>


    <a 
      href="{{ route('unidades', $entry->id) }}" 
      class="btn btn-default" 
      role="button"
      @if(url_possui('unidade'))
        style="background: #005B79; color: white" 
      @endif
    >
      <i class="fa fa-columns"></i> 
      Unidades
    </a>	       

    @if ($entry->tipo == 'Vertical')

       <a 
        href="{{ route('pavimentos', $entry->id) }}" 
        class="btn btn-default" 
        role="button"
        @if(url_possui('pavimento'))
          style="background: #005B79; color: white" 
        @endif
      >      
        <i class="fa fa-car"></i> 
        Garagens
      </a>      
    @endif
  </div>
</div>
@endif
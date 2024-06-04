<div class="botoes-mapa">
    @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
    @if ($entry->tipo == 'Horizontal' && $entry->getFotoTipo('Implantação') && $entry->unidades->count() > 0)
                                     
            <a target="_blank" rel="tooltip" data-original-title="Mapa"  data-placement="bottom" href="{{ route('empreendimento.mapa', $entry->id) }}" class="btn btn-warning editar-mapa">
                <i class="fa fa-edit"></i>
                <span>Editar Mapa</span>
            </a>

            <a target="_blank" rel="tooltip" data-original-title="Visualizar Mapa"  data-placement="bottom" href="/empreendimento/{{ $entry->id }}/{{ Auth::user()->id*37 }}/visualizar-mapa/view" class="btn btn-success visualizar-mapa">
                <i class="fa fa-eye"></i>
                <span>Visualizar Mapa</span>
            </a>

    @elseif ($entry->tipo == 'Vertical' && ($entry->getFotoTipo('Implantação Vertical - Frente') || $entry->getFotoTipo('Implantação Vertical - Fundo')) && $entry->unidades->count() > 0)
  
            <a target="_blank" rel="tooltip" data-original-title="Mapa"  data-placement="bottom" href="/admin/empreendimento/{{ $entry->id }}/mapa-vertical/frente" class="btn btn-warning editar-mapa">
                <i class="fa fa-edit"></i>
                <span>Editar Mapa</span>
            </a>

            <a target="_blank" rel="tooltip" data-original-title="Visualizar Mapa"  data-placement="bottom" href="/empreendimento/{{ $entry->id }}/{{ Auth::user()->id*37 }}/visualizar-mapa-vertical/view" class="btn btn-success visualizar-mapa">
                <i class="fa fa-eye"></i>
                <span>Visualizar Mapa</span>
            </a>

    @endif
    @endif
</div>
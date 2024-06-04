@if (isset($garagens))
    @foreach ($garagens as $garagem)    
        <div class="btn-group dropup col-6 col-md-4 col-lg-2">
            <button type="button" class="mb-xs mt-xs mr-xs btn 
            @if ($garagem->situacao == 'Vendida')btn-danger @endif
            @if ($garagem->situacao == 'Reservada')btn-warning @endif
            @if ($garagem->situacao == 'Bloqueada')btn-default @endif
            @if ($garagem->situacao == 'Disponível')btn-success @endif
            dropdown-toggle btn-garagens" data-toggle="dropdown">  
                <div class="formato-vaga">Vaga {{ $garagem->formato_vaga }}</div>
                @if($garagem->tipo_vaga == "Gaveta")                    
                <i class="fa fa-car" aria-hidden="true" rel="tooltip" data-original-title="Garagem Tipo Gaveta"></i><i class="fa fa-car" aria-hidden="true" rel="tooltip" data-original-title="Garagem Tipo Gaveta"></i>
                @else
                <i class="fa fa-car" aria-hidden="true" rel="tooltip" data-original-title="Garagem Individual"></i>
                @endif
                @if ($garagem->vaga_pne == 'Sim') <i class="fa fa-wheelchair" aria-hidden="true"></i> @endif
                <br/>
                {{ $garagem->nome }}
                
            </button>
            @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
            <ul class="dropdown-menu editar-garagems" role="menu">
                <li class="editar-situacao-garagem">

                    <button data-situacao="" data-toggle="modal" data-target="#alterarInfoGaragem" data-id="{{ $garagem->id }}" data-url="{{ route('alterar-garagem', $garagem->id) }}" type="button" class="btn btn-primary btn-garagem-editar"><i class="fa fa-edit"></i> Editar Garagem</button>

                    @if ($garagem->situacao != 'Vendida')
                        <button data-toggle="modal" data-target="#alterarVendaGaragem" data-id="{{ $garagem->id }}" data-url="{{ route('alterar-venda-garagem', $garagem->id) }}" data-situacao="Vendida" type="button" class="btn btn-danger btn-garagem-editar"><i class="fa fa-money"></i> Marcar como Vendida</button>
                    @endif
                    
                    @if ($garagem->situacao != 'Reservada')
                        <button data-id="{{ $garagem->id }}" data-url="{{ route('alterar-situacao-garagem', $garagem->id) }}" data-situacao="Reservada"  type="button" class="btn btn-warning alterar-situacao-garagem btn-garagem-editar"><i class="fa fa-clock-o"></i> Marcar como Reservada</button>
                    @endif
                    
                    @if ($garagem->situacao != 'Bloqueada')
                        <button data-id="{{ $garagem->id }}" data-url="{{ route('alterar-situacao-garagem', $garagem->id) }}" data-situacao="Bloqueada"  type="button" class="btn btn-default alterar-situacao-garagem btn-garagem-editar"><i class="fa fa-ban"></i> Marcar como Bloqueada</button>
                    @endif
                    
                    @if ($garagem->situacao != 'Disponível')
                        <button data-id="{{ $garagem->id }}" data-url="{{ route('alterar-situacao-garagem', $garagem->id) }}" data-situacao="Disponível"  type="button" class="btn btn-success alterar-situacao-garagem btn-garagem-editar"><i class="fa fa-check-square-o"></i> Marcar como Disponível</button>
                    @endif
    
                    @if ($garagem->situacao == 'Vendida' or $garagem->situacao == 'Bloqueada')
                        <button data-toggle="modal" data-target="#alterarVendaGaragem" data-id="{{ $garagem->id }}" data-url="{{ route('alterar-venda-garagem', $garagem->id) }}" data-situacao="Vendida" type="button" class="btn btn-danger btn-garagem-editar"><i class="fa fa-briefcase"></i> Editar Dados da Venda</button>
                    @endif

                    

                </li>
            </ul>

            @endif
        </div> 
    @endforeach
@endif
@if (isset($garagens))
    @foreach ($garagens as $garagem)    
        <div class="btn-group dropup col-6 col-md-4 col-lg-2">
            <button type="button" class="mb-xs mt-xs mr-xs btn 
            @if ($garagem->situacao == 'Vendida')btn-danger @endif
            @if ($garagem->situacao == 'Reservada')btn-warning @endif
            @if ($garagem->situacao == 'Bloqueada')btn-default @endif
            @if ($garagem->situacao == 'Disponível')btn-success @endif
            dropdown-toggle btn-garagens" data-toggle="dropdown">
                <div class="formato-vaga-{{ url_amigavel($garagem->formato_vaga) }}">{{ $garagem->formato_vaga }}</div>
                @if($garagem->tipo_vaga == "Gaveta Coberta" || $garagem->tipo_vaga == "Gaveta Descoberta")                    
                <i class="fa fa-car" aria-hidden="true" rel="tooltip" data-original-title="Garagem Tipo ({{ $garagem->tipo_vaga }})"></i> <i class="fa fa-car" aria-hidden="true" rel="tooltip" data-original-title="Garagem Tipo ({{ $garagem->tipo_vaga }})"></i>
                @else
                <i class="fa fa-car" aria-hidden="true" rel="tooltip" data-original-title="Garagem Tipo ({{ $garagem->tipo_vaga }})"></i>
                @endif
                @if ($garagem->vaga_pne == 'Sim') <i class="fa fa-wheelchair" aria-hidden="true" rel="tooltip" data-original-title="Vaga do Tipo PNE"></i> @endif
                <br/>                       
                Vaga Nº {{ $garagem->nome }}<br/> 
                @if($garagem->formato_vaga <> 'Visitante')

                    @if(isset($garagem->unidade))
                    <span class="unidade-garagem"><i class="fa fa-building" aria-hidden="true" rel="tooltip" data-original-title="Unidade vinculada a esta vaga"></i> {{ $garagem->unidade->andar->numero }}º Andar ({{ $garagem->unidade->nome }})<br/></span>
                    @else
                    <!--<i class="fa fa-building" aria-hidden="true" rel="tooltip" data-original-title="NENHUMA unidade foi vinculada a esta vaga"></i>-->
                    <br/>
                    @endif

                    @if($garagem->formato_vaga == 'Extra')
                    <span class="valor-garagem"><i class="fa fa-dollar" aria-hidden="true" rel="tooltip" data-original-title="Valor da Vaga Extra"></i> {{  $garagem->caracteristicas->where('nome', 'valor_vaga')->first()->pivot->valor ?? '' }}<br/></span>
                    @else
                    <br/>
                    @endif

                @else
                <br/>
                <br/>
                @endif
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu editar-garagens" role="menu">
                <li class="editar-situacao-garagem">
                    
                    @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
                    
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

                    @endif

                </li>
            </ul>
        </div> 
    @endforeach
@endif
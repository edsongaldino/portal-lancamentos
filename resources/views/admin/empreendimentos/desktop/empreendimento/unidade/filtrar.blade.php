@if (isset($unidades))
    @foreach ($unidades as $unidade)    
        <div class="btn-group dropup col-6 col-md-4 col-lg-2">
            <button type="button" class="mb-xs mt-xs mr-xs btn 
            @if ($unidade->situacao == 'Vendida')btn-danger @endif
            @if ($unidade->situacao == 'Reservada')btn-warning @endif
            @if ($unidade->situacao == 'Bloqueada')btn-secondary @endif
            @if ($unidade->situacao == 'Disponível')btn-success @endif
            @if ($unidade->situacao == 'Outros')btn-outros @endif
            dropdown-toggle btn-unidades" data-toggle="dropdown">        
                @if ($unidade->empreendimento->tipo == 'Vertical')     
                    Unidade {{ $unidade->nome }} 
                    <br>
                    @if($unidade->planta)
                        <span style="color: yellow">
                            <img src="/assets/images/icones/floor-plan.png" rel="tooltip" data-original-title="Metragem da Planta" alt=""> {{ $unidade->planta->area_privativa }} m<sup>2</sup>
                        </span>
                    @else
                        <span style="color: transparent">-</span>
                    @endif
                    <br>
                    @if($unidade->caracteristicas->where('nome', 'valor_unidade')->first())
                        R$ {{ converte_valor_real($unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor) }} 
                    @else
                        R$ 0,00
                    @endif
                    <br>
                    <span class="caret"></span>
                @endif

                @if ($unidade->empreendimento->tipo == 'Horizontal')
                    Unidade {{ $unidade->nome }}
                  
                    @if ($unidade->empreendimento->variacao_id == 6 || $unidade->empreendimento->variacao_id == 10 || $unidade->empreendimento->variacao_id == 11)
                        @if($unidade->caracteristicas->where('nome', 'metragem_total')->first())
                            <br>
                            <span style="color: yellow">
                                <i class="fa fa-map" aria-hidden="true" rel="tooltip" data-original-title="Tamanho do Lote"></i> {{ $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor }} m<sup>2</sup>
                            </span>
                        @else
                            <br>
                            <span style="color: yellow">
                                <i class="fa fa-map" aria-hidden="true" rel="tooltip" data-original-title="Tamanho do Lote"></i> 0.00 m<sup>2</sup> 
                            </span>
                        @endif
                    @else
                        @if($unidade->planta)
                            <br>
                            <span style="color: yellow">
                                <i class="fa fa-home" aria-hidden="true" rel="tooltip" data-original-title="Casa (Metragem)"></i> {{ $unidade->planta->area_privativa }} m<sup>2</sup>
                            </span>
                            @if($unidade->caracteristicas->where('nome', 'metragem_total')->first())
                                <br>
                                <span style="color: aliceblue">
                                    <i class="fa fa-map" aria-hidden="true" rel="tooltip" data-original-title="Tamanho do Terreno"></i> {{ $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor }} m<sup>2</sup>
                                </span>
                            @else
                                <br>
                                <span style="color: aliceblue">
                                    <i class="fa fa-map" aria-hidden="true" rel="tooltip" data-original-title="Tamanho do Terreno"></i>  0.00 m<sup>2</sup> 
                                </span>
                            @endif
                        @else
                            <br>
                            <span style="color: yellow">
                                0.00 m<sup>2</sup> 
                            </span>
                            @if($unidade->caracteristicas->where('nome', 'metragem_total')->first())
                                <br>
                                <span style="color: yellow">
                                    <i class="fa fa-map" aria-hidden="true" rel="tooltip" data-original-title="Tamanho do Terreno"></i> {{ $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor }} m<sup>2</sup>
                                </span>
                            @else
                                <br>
                                <span style="color: yellow">
                                    <i class="fa fa-map" aria-hidden="true" rel="tooltip" data-original-title="Tamanho do Terreno"></i>  0.00 m<sup>2</sup> 
                                </span>
                            @endif
                        @endif
                    @endif

                    @if($unidade->caracteristicas->where('nome', 'valor_unidade')->first() && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '' && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '0')
                        <br>
                        R$ {{ converte_valor_real($unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor) }} 
                    @else
                        @if($unidade->caracteristicas->where('nome', 'valor_m2')->first() && $unidade->caracteristicas->where('nome', 'metragem_total')->first())
                            <br>
                            @php
                                $valor_m2 = $unidade->caracteristicas->where('nome', 'valor_m2')->first()->pivot->valor;
                                $metragem = $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor;
                            @endphp
                            R$ {{ converte_valor_real(floatval($valor_m2) * floatval($metragem)) }}
                        @else
                            <br>
                            R$ 0,00
                        @endif
                    @endif
                    
                    <br>
                    <span class="caret"></span>
                @endif
            </button>
            <ul class="dropdown-menu editar-unidades" role="menu">
                <li class="editar-situacao-unidade">

                    @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())

                    <button data-situacao="" data-toggle="modal" data-target="#alterarInfoUnidade" data-id="{{ $unidade->id }}" data-url="{{ route('alterar-unidade', $unidade->id) }}" type="button" class="btn btn-default btn-unidade-editar"><i class="fa fa-edit"></i> Editar Unidade</button>

                    @if ($unidade->situacao != 'Vendida')
                    <button data-toggle="modal" data-target="#alterarVendaUnidade" data-id="{{ $unidade->id }}" data-url="{{ route('alterar-venda-unidade', $unidade->id) }}" data-situacao="Vendida" type="button" class="btn btn-danger btn-unidade-editar"><i class="fa fa-money"></i> Marcar como Vendida</button>
                    @endif
                    
                    @if ($unidade->situacao != 'Reservada')
                    <button data-toggle="modal" data-target="#alterarReservaUnidade" data-id="{{ $unidade->id }}" data-url="{{ route('alterar-reserva-unidade', $unidade->id) }}" data-situacao="Reservada"  type="button" class="btn btn-warning alterar-situacao-unidade btn-unidade-editar"><i class="fa fa-clock-o"></i> Marcar como Reservada</button>
                    @endif
                    
                    @if ($unidade->situacao != 'Bloqueada' && isAdmin())
                    <button data-id="{{ $unidade->id }}" data-url="{{ route('alterar-situacao-unidade', $unidade->id) }}" data-situacao="Bloqueada"  type="button" class="btn btn-secondary alterar-situacao-unidade btn-unidade-editar"><i class="fa fa-ban"></i> Bloquear Unidade</button>
                    @endif
                    
                    @if ($unidade->situacao != 'Disponível')
                    <button data-id="{{ $unidade->id }}" data-url="{{ route('alterar-situacao-unidade', $unidade->id) }}" data-situacao="Disponível"  type="button" class="btn btn-success alterar-situacao-unidade btn-unidade-editar"><i class="fa fa-check-square-o"></i> Marcar como Disponível</button>
                    @endif

                    @if ($unidade->situacao != 'Outros')
                    <button data-id="{{ $unidade->id }}" data-url="{{ route('alterar-situacao-unidade', $unidade->id) }}" data-situacao="Outros"  type="button" class="btn btn-outros alterar-situacao-unidade btn-unidade-editar"><i class="fa fa-check-square-o"></i> Outros (Estoque / Permuta)</button>
                    @endif
    
                    @if ($unidade->situacao == 'Vendida' or $unidade->situacao == 'Bloqueada')
                    <button data-toggle="modal" data-target="#alterarVendaUnidade" data-id="{{ $unidade->id }}" data-url="{{ route('alterar-venda-unidade', $unidade->id) }}" data-situacao="Vendida" type="button" class="btn btn-danger btn-unidade-editar"><i class="fa fa-briefcase"></i> Editar Dados da Venda</button>
                    @endif

                    @if ($unidade->situacao == 'Reservada')
                    <button data-toggle="modal" data-target="#alterarReservaUnidade" data-id="{{ $unidade->id }}" data-url="{{ route('alterar-reserva-unidade', $unidade->id) }}" data-situacao="Reservada" type="button" class="btn btn-warning btn-unidade-editar"><i class="fa fa-clock-o"></i> Editar Dados da Reserva</button>
                    @endif

                    @else

                    <button data-situacao="" data-toggle="modal" data-target="#InfoUnidade" data-id="{{ $unidade->id }}" data-url="{{ route('info-unidade', $unidade->id) }}" type="button" class="btn btn-primary btn-unidade-editar"><i class="fa fa-eye"></i> Informações da Unidade</button>

                    @endif

                </li>
            </ul>
        </div> 
    @endforeach
@endif
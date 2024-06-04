<tr class="lista-vendas">
    <td>{{ data_br($c->data) }}</td>
    <td>  
        {{ $c->nome_comprador ?? '' }}                                          
        <button type="button" style="border: 0; background: none" class="btn btn-secondary btn-tooltip" data-toggle="tooltip" data-html="true" data-placement="right" title="
                <h6>Informações do comprador</h6>
                <p>CPF: {{ $c->cpf  }} </p>
                <p>E-mail: {{ $c->email  }} </p>
                <p>Celular: {{ $c->celular  }} </p>
                <p>Estado Cívil: {{ $c->estado_civil  }} </p>
                @if($c->estado_civil == 'Casado' || $c->estado_civil == 'UniaoEstavel')
                <p>Conjugê: {{ $c->nome_esposa  }} </p>
                @endif
            ">
            <i class="fa fa-info"></i>  
        </button>
    </td>
    <td>{{ $c->empreendimento ? $c->empreendimento->nome ?? '' : '' }}</td>
    <td class="center">
        @if ($c->empreendimento)
            @if ($c->empreendimento->tipo == 'Vertical')
                {{ $c->torre->nome ?? '' }} - {{ $c->andar->numero ?? '' }} º Andar - Unidade {{ $c->nome ?? '' }}
            @endif
            @if ($c->empreendimento->tipo == 'Horizontal')
                {{ $c->quadra->nome ?? '' }} - Unidade {{ $c->nome ?? '' }}
            @endif        
        @endif
        @if($c->planta)
            <button type="button" style="border: 0; background: none" class="btn btn-secondary btn-tooltip modal-basic" href="#modalInfo_{{$c->id}}" title="Clique para visualizar a planta">
                <i class="fa fa-codepen"></i>  
            </button>

            <div id="modalInfo_{{$c->id}}" class="modal-block modal-block-info mfp-hide">
              <section class="panel">
                <header class="panel-heading">
                  <h2 class="panel-title">Informações da Planta</h2>
                </header>
                <div class="panel-body box-planta" style="margin-top: 0px !important;">
                      <div class="thumb-info mb-md">
                        @if ($c->planta->getFotoDestaque())
                          <img src="{{ $c->planta->getFotoDestaque()->getUrl('original') }}" class="rounded img-responsive">      
                        @endif
                        <div class="thumb-info-title">
                          <span class="thumb-info-inner">{{ $c->planta->nome }}</span>
                          @if(get_caracteristica('Planta', $c->planta->id, 'planta_tipo', 'valor'))
                          <span class="thumb-info-type">{{ get_caracteristica('Planta', $c->planta->id, 'planta_tipo', 'valor') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="widget-content-expanded dados-planta">
                        <ul class="simple-todo-list itens-planta">                            
                          <li>                                
                            <i class="fa fa-pencil" style="margin-right: 20px !important;"></i>
                            {!! $c->planta->area_privativa !!} m<sup>2</sup>
                          </li>

                          @if($c->planta->caracteristicas->where('nome', 'qtd_dormitorio')->first())
                            @php
                              $quartos = $c->planta->caracteristicas->where('nome', 'qtd_dormitorio')->first()->pivot->valor;
                            @endphp

                            <li>                                        
                              @if($c->planta->caracteristicas->where('nome', 'qtd_suite')->first())              
                                @php
                                  $suites = $c->planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor;
                                @endphp

                                @if ($suites == $quartos)
                                  <i class="fa fa-bed" style="margin-right: 20px !important;"></i>                                
                                  &nbsp; {{  $suites }} Suítes
                                @else
                                  @if ($suites)
                                    <i class="fa fa-bed" style="margin-right: 20px !important;"></i>                                
                                    &nbsp; {{  $quartos }} Quarto(s) sendo {{ $suites }} suíte(s)
                                  @endif
                                @endif
                              @else
                                <i class="fa fa-bed" style="margin-right: 20px !important;"></i>                                
                                &nbsp; {{  $quartos }} Quarto(s)
                              @endif                            
                            </li>
                          @endif                                
                        </ul>
                      </div>
                </div>
                <footer class="panel-footer">
                  <div class="row">
                    <div class="col-md-12 text-right">
                      <button class="btn btn-info modal-dismiss">Fechar</button>
                    </div>
                  </div>
                </footer>
              </section>
            </div>
        @endif
    </td>    
    <td class="valor-venda">
        R$ {{ converte_valor_real($c->valor) }}
        <button type="button" style="border: 0; background: none" class="btn btn-secondary btn-tooltip" data-toggle="tooltip" data-html="true" data-placement="right" title="
                <h6>Informações da venda</h6>
                <p>Equipe/Parceiro: {{ $c->origem_venda  }} </p>
                <p>Corretor: {{ $c->nome_corretor  }} </p>
                <p>Creci: {{ $c->creci_corretor  }} </p>
                <p>Telefone: {{ $c->telefone_corretor  }} </p>
                <p>Percentual Honorário: {{ $c->percentual_honorario  }}% </p>
                <p>Valor Honorário: R$ {{ $c->valor_honorario  }} </p>
            ">
            <i class="fa fa-info"></i>  
        </button>
    </td>
    <td class="info-venda">
        <button 
            style="background: none; border: none" 
            data-toggle="modal" 
            data-titulo="Visualizar dados" 
            data-visualizar="sim" 
            data-target="#alterarVendaUnidade"         
            data-id="{{ $c->id }}" 
            data-url="{{ route('alterar-venda-unidade', $c->id) }}" 
            data-situacao="Vendida"

        >
            <i class="fa fa-search-plus"></i>    
        </button>
        <button 
            style="background: none; border: none" 
            data-toggle="modal" 
            data-titulo="Visualizar dados" 
            data-visualizar="não" 
            data-target="#alterarVendaUnidade" 
            data-id="{{ $c->id }}" 
            data-url="{{ route('alterar-venda-unidade', $c->id) }}"
        >
            <i class="fa fa-edit"></i>    
        </button>        
    </td>
</tr>
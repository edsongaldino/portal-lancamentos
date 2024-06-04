<div class="panel panel-accordion panel-accordion-primary">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2One">
        <i class="fa fa-building"></i> Informações do Empreendimento
      </a>
    </h4>
  </div>
  <div id="collapse2One" class="accordion-body collapse">
    <div class="panel-body">
      <form id="dados-empreendimento" class="form-horizontal form-bordered">
        @if(isset($entry))
        <input type="hidden" name="id" value="{{ $entry->id }}">
        @endif
        <div class="form-group">
          <label class="col-md-2 control-label">Nome</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-building"></i>
              </span>
              <input name="nome" value="@if(isset($entry)){{ $entry->nome }}@endif" id="nome" type="text" placeholder="Nome completo" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Conceito e Estilo</label>
          <div class="col-md-10">
            <p>              
              <code>Número máximo de caracteres</code> é 500.
            </p>                                     
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-building"></i>
              </span>                     
              <textarea data-item="alterar-caracteres" data-target="contar_descricao" maxlength="500" name="descricao" class="form-control descricao" rows="5" id="descricao_empreendimento" data-plugin-textarea-autosize>@if(isset($entry)){!! strip_tags($entry->descricao) !!}@endif</textarea>              
            </div>
            <p style="margin-top: 10px; margin-bottom: 0;">              
              <code>Qtde atual de caracteres:</code> é <span id="contar_descricao" data-role="contar-caracteres" data-target="descricao_empreendimento"></span>.
            </p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Tipo</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-building"></i>
              </span>                                            
              <select class="form-control" name="tipo" id="tipo">       
                <option>Selecione o tipo</option>
                <option value="Vertical" @if(isset($entry) && $entry->tipo == 'Vertical') selected="true" @endif>Vertical</option>
                <option value="Horizontal" @if(isset($entry) && $entry->tipo == 'Horizontal') selected="true" @endif>Horizontal</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Subtipo</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-building"></i>
              </span>                                            
              <select class="form-control" name="subtipo_id" id="subtipo">
                <option>Selecione um subtipo</option>
                @if (isset($entry))
                @foreach($subtipos as $subtipo)       
                <option value="{{ $subtipo->id }}" @if($entry->subtipo_id == $subtipo->id) selected="true" @endif>{{ $subtipo->nome }}</option>
                @endforeach
                @else
                <option value="">Selecione o Tipo</option>
                @endif
              </select>
            </div>
          </div>
          <label class="col-md-2 control-label">Variação</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-building"></i>
              </span>                                            
              <select class="form-control" name="variacao_id" id="variacao">       
                <option>Selecione uma variação</option>
                @if (isset($entry))
                @foreach($variacoes as $variacao)       
                <option value="{{ $variacao->id }}" @if($entry->variacao_id == $variacao->id) selected="true" @endif>{{ $variacao->nome }}</option>
                @endforeach
                @else
                <option value="">Selecione o Tipo</option>
                @endif
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Valor inicial</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-money"></i>
              </span>                                            
              <input name="valor_inicial" value="@if(isset($entry)){{ number_format($entry->getOriginal('valor_inicial'), 2, ',', '.') }}@endif" id="valor_inicial" type="text" placeholder="Valor inicial" class="form-control moeda">
            </div>
          </div>

          <label class="col-md-2 control-label">Valor final</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-money"></i>
              </span>                                            
              <input name="valor_final" value="@if(isset($entry)){{ number_format($entry->getOriginal('valor_final'), 2, ',', '.') }}@endif" id="valor_final" type="text" placeholder="Valor final" class="form-control moeda">
            </div>
          </div>
        </div>


        <div class="form-group">
            <div class="col-md-3"></div>
            <label for="Deseja ocultar o valor do empreendimento no site?" class="col-md-3 control-label">Deseja ocultar o <b>VALOR</b> do empreendimento?</label>
            <div class="col-md-5">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-money"></i>
                </span> 
                <select class="form-control ocultar_valor" name="ocultar_valor" id="ocultar_valor">
                  @if (isset($entry))
                  <option value="N" @if ($entry->caracteristicas->where('nome', 'ocultar_valor')->first() && $entry->caracteristicas->where('nome', 'ocultar_valor')->first()->pivot->valor == "N") selected="true" @endif>Não Ocultar</option>
                  <option value="S" @if ($entry->caracteristicas->where('nome', 'ocultar_valor')->first() && $entry->caracteristicas->where('nome', 'ocultar_valor')->first()->pivot->valor == "S") selected="true" @endif>Ocultar no site e na Disponibilidade</option>
                  <option value="OS" @if ($entry->caracteristicas->where('nome', 'ocultar_valor')->first() && $entry->caracteristicas->where('nome', 'ocultar_valor')->first()->pivot->valor == "OS") selected="true" @endif>Ocultar somente no site</option>
                  <option value="OD" @if ($entry->caracteristicas->where('nome', 'ocultar_valor')->first() && $entry->caracteristicas->where('nome', 'ocultar_valor')->first()->pivot->valor == "OD") selected="true" @endif>Ocultar somente na Disponibilidade</option>
                  @else
                  <option value="N">Não Ocultar</option>
                  <option value="S">Ocultar no site e na Disponibilidade</option>
                  <option value="OS">Ocultar somente no site</option>
                  <option value="OD">Ocultar somente na Disponibilidade</option>
                  @endif
                </select>
              </div>
            </div>
            <div class="col-md-1 info" rel="tooltip" data-original-title="Oculta o valor do empreendimento no site/disponibilidade, deixando informado que o valor é somente com a construtora (SOB CONSULTA)"><i class="fa fa-info-circle"></i></div>
        </div>

        <div class="form-group">
          <label for="Previsão de Condomínio" class="col-md-2 control-label">Previsão de Condomínio</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-money"></i>
              </span>
              <input class="form-control moeda" type="text" name="previsao_condominio" @if (isset($entry) && $entry->caracteristicas->where('nome', 'previsao_condominio')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'previsao_condominio')->first()->pivot->valor) }}"@endif>
            </div>
          </div>

          <label for="Renda Familiar" class="col-md-2 control-label">Renda Familiar</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-money"></i>
              </span>
              <input class="form-control moeda" type="text" name="renda_familiar" @if (isset($entry) && $entry->caracteristicas->where('nome', 'renda_familiar')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'renda_familiar')->first()->pivot->valor) }}"@endif>
            </div>
          </div>  
        </div> 

        @if(isset($entry))
          @if ($entry->tipo == 'Horizontal')

            <div class="form-group">
              <div class="col-md-2"></div>
              <label for="Permite a visualização do mapa de vendas no site?" class="col-md-6 control-label">Permite a visualização do <b>mapa interativo</b> no site?</label>
              <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-building"></i>
                  </span> 
                  <select class="form-control mostra_mapa" name="mostra_mapa" id="mostra_mapa">
                    <option value="S" @if ($entry->caracteristicas->where('nome', 'mostra_mapa')->first() && $entry->caracteristicas->where('nome', 'mostra_mapa')->first()->pivot->valor == "S") selected="true" @endif>Sim</option>
                    <option value="N" @if ($entry->caracteristicas->where('nome', 'mostra_mapa')->first() && $entry->caracteristicas->where('nome', 'mostra_mapa')->first()->pivot->valor == "N") selected="true" @endif>Não</option>
                  </select>
                </div>
              </div>
              <div class="col-md-1 info" rel="tooltip" data-original-title="Permite que o cliente possa visualizar as informações das unidades mas ocultando a informação de disponibilidade"><i class="fa fa-info-circle"></i></div>
            </div> 

            <div class="form-group">
              <div class="col-md-2"></div>
              <label for="Permite a visualização do mapa de vendas no site?" class="col-md-6 control-label">Permite a visualização da <b>disponibilidade</b> no mapa interativo?</label>
              <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-building"></i>
                  </span> 
                  <select class="form-control disponibilidade_mapa" name="disponibilidade_mapa" id="disponibilidade_mapa">
                    <option value="S" @if ($entry->caracteristicas->where('nome', 'disponibilidade_mapa')->first() && $entry->caracteristicas->where('nome', 'disponibilidade_mapa')->first()->pivot->valor == "S") selected="true" @endif>Sim</option>
                    <option value="N" @if ($entry->caracteristicas->where('nome', 'disponibilidade_mapa')->first() && $entry->caracteristicas->where('nome', 'disponibilidade_mapa')->first()->pivot->valor == "N") selected="true" @endif>Não</option>
                  </select>
                </div>
              </div>
              <div class="col-md-1 info" rel="tooltip" data-original-title="Permite a visualização de todas as informações das unidades, incluindo a disponibilidade."><i class="fa fa-info-circle"></i></div>
            </div> 

            <div class="form-group">
              <label for="Previsão de Condomínio" class="col-md-2 control-label">Área Verde</label>
              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </span>
                  <input class="form-control moeda" type="text" name="area_verde" @if (isset($entry) && $entry->caracteristicas->where('nome', 'area_verde')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'area_verde')->first()->pivot->valor) }}"@endif>
                </div>
              </div>

              <label for="Renda Familiar" class="col-md-2 control-label">Área de Preservação</label>
              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </span>
                  <input class="form-control moeda" type="text" name="area_preservacao" @if (isset($entry) && $entry->caracteristicas->where('nome', 'area_preservacao')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'area_preservacao')->first()->pivot->valor) }}"@endif>
                </div>
              </div>  
            </div>
          @endif
        @endif 

        @if(isset($entry))
          @if ($entry->variacao)
            @if ($entry->variacao->nome == 'Lote')
              <div class="form-group">
                <label for="Previsão de Condomínio" class="col-md-2 control-label">Lotes de (m<sup>2</sup>)</label>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-money"></i>
                    </span>
                    <input class="form-control moeda" type="text" name="area_unidade_min" @if (isset($entry) && $entry->caracteristicas->where('nome', 'area_unidade_min')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'area_unidade_min')->first()->pivot->valor) }}"@endif>
                  </div>
                </div>

                <label for="Renda Familiar" class="col-md-2 control-label">Até de (m<sup>2</sup>)</label>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-money"></i>
                    </span>
                    <input class="form-control moeda" type="text" name="area_unidade_max" @if (isset($entry) && $entry->caracteristicas->where('nome', 'area_unidade_max')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'area_unidade_max')->first()->pivot->valor) }}"@endif>
                  </div>
                </div>  
              </div>
            @endif
          @endif
        @endif 

        @if(isset($entry))
          @if ($entry->variacao)
            @if ($entry->variacao->nome == 'Lote')
              <div class="form-group">
                <label for="Previsão de Condomínio" class="col-md-2 control-label">Área total</label>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-money"></i>
                    </span>
                    <input class="form-control moeda" type="text" name="area_total" @if (isset($entry) && $entry->caracteristicas->where('nome', 'area_total')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'area_total')->first()->pivot->valor) }}"@endif>
                  </div>
                </div>            
              </div>
            @endif
          @endif
        @endif 

        @if(isset($entry))
        @if ($entry->variacao)
        @if ($entry->variacao->nome <> 'Lote')
        @php
          $planta_principal = null;

          if ($pp = $entry->caracteristicas->where('nome', 'planta_principal')->first()) {
            $planta_principal = $pp->pivot->valor;
          }
        @endphp
        <div class="form-group">
            <label class="col-md-2 control-label">Planta Principal</label>
            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-building"></i>
                </span>                                            
                <select class="form-control" name="planta_principal">       
                  <option value="">Selecione a planta</option>
                  @if ($entry->plantas)
                    @foreach($entry->plantas as $planta)
                      <option 
                        value="{{ $planta->id }}"
                        @if ($planta->id == $planta_principal)
                          selected="true" 
                        @endif
                      >
                        {{ $planta->nome }}
                      </option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>
        </div>
        @endif             
        @endif 
        @endif 


        <div class="form-group">  
          <label class="col-md-2 control-label">Modalidade</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-building"></i>
              </span>                                            
              <select class="form-control" name="modalidade">       
                <option value="Breve" @if(isset($entry) && $entry->modalidade == 'Breve') selected="true" @endif>Breve Lançamento</option>
                <option value="Lançamento" @if(isset($entry) && $entry->modalidade == 'Lançamento') selected="true" @endif>Lançamento</option>
                <option value="Em Obra" @if(isset($entry) && $entry->modalidade == 'Em Obra') selected="true" @endif>Em Obra</option>
                <option value="Mude Já" @if(isset($entry) && $entry->modalidade == 'Mude Já') selected="true" @endif>Mude Já</option>
              </select>
            </div>
          </div>        
          <label class="col-md-2 control-label">Status</label>
          <div class="col-md-4">            
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-building"></i>
              </span>                                            
              <select class="form-control" name="status" 
                @if(!isset($entry))
                  readonly="true" disabled="true"
                @elseif(!$entry->isFotosClassificadas()) 
                    readonly="true" disabled="true"
                @endif>       
                <option value="Bloqueada" @if(isset($entry) && $entry->status == 'Bloqueada') selected="true" @endif>Bloqueado</option>
                <option value="Liberada" @if(isset($entry) && $entry->status == 'Liberada') selected="true" @endif>Liberado</option>                
                <option value="Entregue" @if(isset($entry) && $entry->status == 'Entregue') selected="true" @endif>Entregue</option>                                
              </select>              
            </div>
              
            @if(isset($entry))
              @if (!$entry->isFotosClassificadas())
                <br>
                
                <code>
                  Para liberar o empreendimento você precisa:
                  <ul>
                    <li>
                      Cadastrar no mínimo 5 Fotos
                    </li>
                    <li>
                      Colocar a descrição em todas as fotos
                    </li>
                    <li>
                      Definir 1 foto como destaque principal
                    </li>
                    <li>
                      Definir no mínimo 5 fotos como destaque do carrossel
                    </li>
                  </ul>
                </code>
              @endif
            @endif
          </div>          

        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Logomarca</label>
          <div class="col-md-4">
            <div class="container">
              <div class="avatar-upload">
                <div class="avatar-edit">
                  <input name="logomarca" type='file' class="imagem" id="campoLogomarca" data-id="#logomarca"/>
                  <label for="campoLogomarca"></label>
                </div>
                @if (isset($entry) && $entry->logomarca)
                <div class="avatar-preview">
                  <div id="logomarca" style="background-image: url( {{ url($entry->getLogo()) }});">
                  </div>
                </div>
                @else
                <div class="avatar-preview">
                  <div id="logomarca">
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>

        
        
        <div class="form-group">
          <div class="col-md-12">
            
            @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
            <button class="btn btn-success salvar-dados" type="button" id="salvar-dados-empreendimento"><i class="fa fa-save"></i> Salvar informações básicas</button>    
            @else 
            <button class="btn btn-success salvar-dados erro-permissao" type="button"><i class="fa fa-save"></i> Salvar dados</button> 
            @endif

          </div>
        </div>
        
      </form>
    </div>
  </div>
</div>
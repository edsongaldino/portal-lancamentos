<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<div class="modal-negociar-unidade">
  <div id="custom-content" class="modal-block modal-block-md modal-blackmonth-site">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <section class="panel">
      <div class="panel-heading topo-blackmonth-site">
        @if ($oferta->empreendimento->subtipo->id == 3 or $oferta->empreendimento->subtipo->id == 4)
          <div class="titulo">
            <h2 class="panel-title">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i> 
              {{ $oferta->empreendimento->nome }} (Unidade {{ $oferta->unidade->nome }} - {{ $oferta->unidade->torre->nome }})
            </h2>
          </div>
          <div class="icones">
            @if($oferta->empreendimento->getCaracteristica('tipo_condominio') == "Lotes")
              <div class="area_lote">
                <img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-lote.png" title="Tamanho da Unidade" alt="">             
                  {{ $oferta->unidade->getCaracteristica('metragem_total') }}
              </div>
              <div class="area_app">
                <img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-app.png" title="Área de Preservação Permanente" alt=""> 
                {{ $oferta->empreendimento->getCaracteristica('area_preservacao') }}
              </div>
              <div class="qtd_unidades">
                <img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-unidade.png" title="Total de Unidades" alt=""> 
                {{ $oferta->empreendimento->getCaracteristica('total_unidades') }} {{ $oferta->empreendimento->getCaracteristica('tipo_condominio') }}
              </div>
            @else
              <div class="sol">
                <img src="https://sistema.domuslog.com.br/imagem/icone/icone_{{ $oferta->unidade->getCaracteristica('tipo_sol') }}.png" width="60" title="Sol {{ $oferta->unidade->getCaracteristica('tipo_sol') }}" alt="">
              </div>
              <div class="metragem">
                <img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-planta.png" title="Tamanho da Planta" alt=""> 
                {{ $oferta->empreendimento->getCaracteristica('area_privativa_real') }}m²
              </div>
              <div class="quartos">
                <img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-quartos.png" title="Quantidade de quartos" alt=""> 
                {{ $oferta->empreendimento->getCaracteristica('qtd_dormitorio') }}
              </div>
              <div class="suites">
                <img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-suites.png" title="Número de suítes disponíveis" alt=""> 
                {{ $oferta->empreendimento->getCaracteristica('qtd_suite') }}
              </div>
            @endif
          </div>
        @else
          <div class="titulo">
            <h2 class="panel-title">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i> 
              {{ $oferta->empreendimento->nome }} 
              (Unidade {{ $oferta->unidade->nome }} 
              - {{ $oferta->unidade->torre->nome }} 
              - {{ $oferta->unidade->andar->numero }}º Andar)
            </h2>
          </div>
          <div class="icones">
            <div class="sol">
              <img src="https://sistema.domuslog.com.br/imagem/icone/icone_{{ $oferta->unidade->getCaracteristica('tipo_sol') }}.png" width="60" title="Sol {{ $oferta->unidade->getCaracteristica('tipo_sol') }}" alt="">
            </div>
            <div class="metragem">
              <img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-planta.png" title="Tamanho da Planta" alt=""> 
              {{ $oferta->empreendimento->getCaracteristica('area_privativa_real') }}m²
            </div>
            <div class="quartos">
              <img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-quartos.png" title="Quantidade de quartos" alt=""> 
              {{ $oferta->empreendimento->getCaracteristica('qtd_dormitorio') }}
            </div>
            <div class="suites">
              <img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-suites.png" title="Número de suítes disponíveis" alt=""> 
              {{ $oferta->empreendimento->getCaracteristica('qtd_suite') }}
            </div>
          </div>
        @endif

        </div>
        <div class="panel-body">
          <section class="panel form-wizard" id="w4">
            <div class="panel-body">
              <div class="wizard-progress wizard-progress-lg">
                <div class="steps-progress">
                  <div class="progress-indicator"></div>
                </div>
                <ul class="wizard-steps">

                  <li class="active">
                    <a href="#w4-construtora" data-toggle="tab"><span><i class="fa fa-usd etapa" aria-hidden="true"></i></span>Condições da<br/>Construtora</a>
                  </li>
                  <li>
                    <a href="#w4-profile" data-toggle="tab"><span><i class="fa fa-pencil-square-o etapa" aria-hidden="true"></i></span>Minha Proposta</a>
                  </li>
                  <li>
                    <a href="#w4-billing" data-toggle="tab"><span><i class="fa fa-user etapa" aria-hidden="true"></i></span>Meus Dados</a>
                  </li>
                  <li>
                    <a href="#w4-confirm" data-toggle="tab"><span><i class="fa fa-paper-plane etapa" aria-hidden="true"></i></span>Confirmação e<br/>Envio</a>
                  </li>

                </ul>
              </div>

              <form class="form-horizontal" name="form_proposta_unidade" id="form_proposta_unidade" novalidate="novalidate" method="POST" action="painel/sessao_ofertas/grava_proposta.php">

                <div class="tab-content">

                 <div id="w4-construtora" class="tab-pane active">
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-2 control-label" for="w4-first-name">Preço de Tabela</label>
                      <div class="col-sm-3">
                        <div class="input-group mb-md">
                          <span class="input-group-addon">R$</span>
                          <input type="text" value="{{ $oferta->preco_tabela }}" class="form-control valor preco_tabela campo-bloqueado" readonly>
                        </div>
                      </div>
                      <label class="col-sm-1 control-label" for="w4-first-name">Oferta</label>
                      <div class="col-sm-3">
                        <div class="input-group mb-md">
                          <span class="input-group-addon btn-warning">R$</span>
                          <input type="text" value="{{ $oferta->preco_oferta }}" class="form-control valor campo-bloqueado preco-oferta" readonly>
                        </div>
                      </div>

                      <label class="col-sm-1 control-label" for="w4-first-name">Desconto</label>
                      <div class="col-sm-2">
                        <div class="input-group mb-md">
                          <span class="input-group-addon btn-danger">
                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                            <i class="fa fa-usd" aria-hidden="true"></i>
                          </span>
                          <input type="text" value="{{ $oferta->valor_desconto }}" class="form-control campo-bloqueado" readonly>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      @if ($oferta->tipo_negociacao <> 'Avista')
                        <label class="col-sm-2 control-label" for="w4-first-name">Valor de Entrada</label>
                        <div class="col-sm-3">
                          <div class="input-group mb-md">
                            <span class="input-group-addon">R$</span>
                            <input type="text" value="{{ $oferta->valor_entrada }}" class="form-control valor campo-bloqueado" readonly>
                          </div>
                        </div>
                      @endif
                      
                      @if ($oferta->tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento' || $oferta->tipo_negociacao == 'EntradaComMensaisFinanciamento')
                        <label class="col-md-1 control-label">Mensais</label>
                        <div class="col-sm-3">
                          <div class="input-group mb-md">
                            <span class="input-group-addon"><strong>{{ $oferta->quantidade_parcela }}X</strong></span>
                            <input type="text" value="{{ $oferta->valor_parcela }}" class="form-control valor campo-bloqueado" readonly>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>


                  <div class="form-group parcelas">

                    <div class="col-sm-8 box-parcelas-balao">
                      <div class="titulo-box-balao"><i class="fa fa-list-ol" aria-hidden="true"></i> Parcelas Balão</div>

                      @if($oferta->baloes->count() > 0)
                        @if($oferta->tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento' || $oferta->tipo_negociacao == 'EntradaComBaloesFinanciamento')
                          @foreach($oferta->baloes as $balao)
                            <div class="row">
                              <label class="col-sm-3 control-label" for="w4-first-name">
                                Parcela Balão {{ $loop->iteration }}
                              </label>
                              <div class="col-sm-4">
                                <div class="input-group mb-md">
                                  <span class="input-group-addon">R$</span>
                                  <input type="text" value="{{ $balao->valor }}" class="form-control valor" id="money" readonly>
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                  <input type="text" value="{{ $balao->data }}" class="form-control" readonly>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        @endif
                      @else
                        <div class="texto-baloes">
                          A proposta da construtora para esta unidade não permite parcelas intermediárias.  
                        </div> 
                      @endif
                    </div>
                    <div class="col-sm-4 saldo">
                      <div class="titulo-box-saldo"><i class="fa fa-usd" aria-hidden="true"></i> 
                        Saldo remanescente
                      </div>
                      <label class="control-label" for="w4-first-name">
                        @if($oferta->tipo_negociacao == 'Avista')
                          Pagamento à Vista
                        @else
                          À Negociar
                        @endif
                      </label>
                      <div class="input-group mb-md">
                        <span class="input-group-addon btn-warning">R$</span>
                        <input type="text" value="
                          @if($oferta->tipo_negociacao == 'Avista')
                            {{ $oferta->valor_desconto }}
                          @else
                            {{ $oferta->saldo_remanescente }}
                          @endif" class="form-control valor" readonly>
                      </div>
                    </div>

                  </div>

                  <ul class="pager">
                    <li class="next next2">
                      <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary montar-proposta">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Montar Proposta</button>
                    </li>
                  </ul>
                </div>

                <div id="w4-profile" class="tab-pane">
                  <div class="form-group">
                    <div class="row">

                      <label class="col-sm-3 control-label" for="w4-first-name">Valor da Proposta</label>
                      <div class="col-sm-3">
                        <div class="input-group mb-md">
                          <span class="input-group-addon btn-warning">R$</span>
                          <input type="text" name="valor_proposta" id="valor_proposta" value="{{ $oferta->valor_desconto }}" class="form-control valor valor_proposta">
                        </div>
                      </div>

                      @if($oferta->tipo_negociacao <> 'Avista')
                        <label class="col-sm-2 control-label" for="w4-first-name">Valor de Entrada</label>
                        <div class="col-sm-4">
                          <div class="input-group mb-md">
                            <span class="input-group-addon">R$</span>
                            <input type="text" id="valor_entrada" name="valor_entrada" value="{{ $oferta->valor_entrada }}" class="form-control valor valor_entrada">
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>

                  @if($oferta->tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento' 
                    or $oferta->tipo_negociacao == 'EntradaComMensaisFinanciamento')
                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3 control-label">Nº Parcelas Mensais</label>
                        <div class="col-md-3">
                          <div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 30 }'>
                            <div class="input-group" style="width:150px;">
                              <input type="text" id="qtd_parcela_mensal" name="qtd_parcela_mensal" value="{{ $oferta->quantidade_parcela }}" class="spinner-input form-control qtd_parcela_mensal" maxlength="2" readonly>
                              <div class="spinner-buttons input-group-btn">
                                <button type="button" class="btn btn-default spinner-up">
                                  <i class="fa fa-angle-up"></i>
                                </button>
                                <button type="button" class="btn btn-default spinner-down">
                                  <i class="fa fa-angle-down"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <label class="col-sm-2 control-label" for="w4-first-name">Valor (Mensais)</label>
                        <div class="col-sm-4">
                          <div class="input-group mb-md">
                            <span class="input-group-addon">R$</span>
                            <input type="text" name="valor_parcela_mensal" id="valor_parcela_mensal" 
                              value="{{ $oferta->valor_parcela }}" class="form-control valor valor_parcela_mensal">
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif

                  <div class="form-group parcelas">
                    <div class="col-sm-8 box-parcelas-balao">
                      <div class="titulo-box-balao">
                        <i class="fa fa-list-ol" aria-hidden="true"></i> Parcelas Balão
                      </div>
                      @if(($oferta->baloes->count() > 0) 
                        && ($oferta->tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento' 
                        or $oferta->tipo_negociacao == 'EntradaComBaloesFinanciamento'))
                        <div id="parcelas">
                          @foreach($oferta->baloes as $balao)
                            <div class="row" id="remove{{ $loop->iteration }}">
                              <label class="col-sm-2 control-label" for="w4-first-name">
                                Balão {{ $loop->iteration }}
                              </label>
                              <div class="col-sm-4">
                                <div class="input-group mb-md">
                                  <span class="input-group-addon">R$</span>
                                  <input type="text" name="valor_parcela_balao[]" id="valor_parcela_balao" value="{{ $balao->valor }}" class="form-control valor valor_parcela_balao_{{ $loop->iteration }}" id="money">
                                </div>
                              </div>
                              <div class="col-sm-2">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                  <input type="date" name="data_parcela_balao[]" id="data_parcela_balao" value="{{ $balao->data }}" class="form-control">
                                </div>
                              </div>
                              <div class="col-sm-2 botoes-balao">
                                @if ($loop->iteration == 1)
                                  <a class="simple-ajax-modal btn btn-lg btn-success btn-add-parcela" href="javascript:void(0)" id="add_parcela">
                                    <i class="fa fa-plus-square"></i>
                                  </a>
                                @else
                                  <a class="simple-ajax-modal btn btn-lg btn-danger btn-remove-parcela remove_campo" href="javascript:void(0)" id="{{ $loop->iteration }}">
                                    <i class="fa fa-minus-square"></i>
                                  </a>
                                @endif
                              </div>
                            </div>
                          @endforeach
                        </div>
                      @else
                        <div class="texto-baloes">
                          A proposta da construtora para esta unidade não exige parcelas balão
                        </div> 
                      @endif
                    </div>
                    <div class="col-sm-4 saldo">
                      <div class="titulo-box-saldo">
                        <i class="fa fa-usd" aria-hidden="true"></i> Saldo remanescente 
                        <div class="btn-info btn-atualizar atualizar_saldo">
                          <i class="fa fa-refresh" aria-hidden="true"></i> Atualizar
                        </div>
                      </div>
                      <label class="control-label" for="w4-first-name">
                        @if($oferta->tipo_negociacao == 'Avista')
                          Pagamento à Vista
                        @else
                          À Negociar
                        @endif
                      </label>
                      <div class="input-group mb-md">
                        <span class="input-group-addon btn-warning">
                          R$
                        </span>
                        <input type="text" name="saldo_remanescente" id="saldo_remanescente" value="
                          @if($oferta->tipo_negociacao == 'Avista')
                            {{ $oferta->valor_desconto }}
                          @else
                            {{ $oferta->saldo_remanescente }}                          
                          @endif" class="form-control valor saldo_remanescente" readonly>
                      </div>
                    </div>
                  </div>

                  @if($oferta->aceita_bens == 'Sim')
                    <div class="row">
                      <div class="complementar-proposta">
                        <div class="col-sm-5">
                          <label class="control-label" for="tipo_negociacao_saldo">
                            Negociar Saldo Remanescente Através de:
                          </label>
                          <select id="tipo_negociacao_saldo" name="tipo_negociacao_saldo" class="form-control" onchange="CarregaDadosOferta();">
                            <option value="">Selecione</option>
                            <option value="Mediante Financiamento">Financiamento Imobiliário</option>
                            <option value="Bens Negociáveis">Bens Negociáveis (Carro, Imóveis, etc)</option>
                          </select>
                        </div>
                        <div id="dados_bens_negociaveis" style="display:none;">
                          <div class="col-sm-3">
                            <label class="control-label">Valor total dos bens negociáveis</label>
                            <div class="input-group mb-md">
                              <span class="input-group-addon btn-info">R$</span>
                              <input type="text" name="valor_bens_negociaveis" id="valor_bens_negociaveis" value="" class="form-control valor valor_bens_negociaveis">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <textarea name="descricao_bens_negociaveis" id="descricao_bens_negociaveis" class="descricao-valores" placeholder="Descrição dos bens negociáveis" maxlength="100"></textarea>
                          </div>
                        </div>

                        <div id="dados_financiamento" style="display:none;">
                          <div class="col-sm-7 negociar-financiamento">
                            O saldo remanescente deverá ser negociado diretamente com seu banco de preferência.
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                </div>

                <div id="w4-billing" class="tab-pane">
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-2 control-label" for="w4-first-name">
                        Nome completo
                      </label>
                      <div class="col-sm-6">
                        <div class="input-group mb-md">
                          <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                          <input type="text" name="nome" id="nome" value="" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-group mb-md">
                          <span class="input-group-addon btn-warning">CPF</span>
                          <input type="text" name="cpf" id="cpf" value="" class="form-control cpf" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 control-label" for="w4-first-name">Data de Nascimento</label>
                      <div class="col-sm-3">
                        <div class="input-group mb-md">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input type="text" name="data_nascimento" id="data_nascimento" value="" class="form-control data" required>
                        </div>
                      </div>
                      <label class="col-sm-2 control-label" for="w4-first-name">E-mail</label>
                      <div class="col-sm-5">
                        <div class="input-group mb-md">
                          <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                          <input type="email" name="email" id="email" value="" class="form-control" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 control-label" for="w4-first-name">Telefone</label>
                      <div class="col-sm-3">
                        <div class="input-group mb-md">
                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                          <input type="text" name="telefone" id="telefone" value="" class="form-control phone" required>
                        </div>
                      </div>
                      <label class="col-sm-2 control-label" for="w4-first-name">Estado civil</label>
                      <div class="col-sm-3 select">
                        <select id="codigo_estado_civil" name="codigo_estado_civil" class="form-control" onchange="CarregaDadosConjuge();" required>
                          <option value="">Selecione</option>
                          <option value="Solteiro">Solteiro</option>
                          <option value="Casado">Casado</option>
                          <option value="Viúvo">Viúvo</option>
                          <option value="Separado">Separado</option>
                          <option value="Divorciado">Divorciado</option>
                          <option value="União estável">União estável</option>
                          <option value="Não informado">Não informado</option>
                        </select>
                      </div>
                    </div>

                    <div class="row" id="dados_conjuge" style="display:none;">
                      <label class="col-sm-2 control-label" for="w4-first-name">
                        Nome Cônjuge
                      </label>
                      <div class="col-sm-6">
                        <div class="input-group mb-md">
                          <span class="input-group-addon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                          </span>
                          <input type="text" name="nome_conjuge" id="nome_conjuge" value="" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-group mb-md">
                          <span class="input-group-addon btn-warning">CPF</span>
                          <input type="text" name="cpf_conjuge" id="cpf_conjuge" value="" class="form-control cpf">
                        </div>
                      </div>
                    </div>

                    <div class="row renda">
                      <label class="col-sm-2 control-label" for="w4-first-name">Renda</label>
                      <div class="col-sm-3">
                        <div class="input-group mb-md">
                          <span class="input-group-addon btn-renda"><i class="fa fa-usd" aria-hidden="true"></i></span>
                          <input type="text" name="renda_conjuge" value="" class="form-control renda valor" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="w4-confirm" class="tab-pane">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="topo-resumo">
                          <i class="fa fa-usd" aria-hidden="true"></i> 
                          Resumo da sua proposta
                        </div>
                        <div class="resumo-proposta">
                          <div class="item-resumo">
                            <div class="descricao-item">
                              Valor da Proposta
                            </div>
                            <div class="valor-item proposta resumo_valor_proposta">
                            </div>
                          </div>
                          <div class="item-resumo">
                            <div class="descricao-item">
                              Entrada
                            </div>
                            <div class="valor-item resumo_valor_entrada">                            
                            </div>
                          </div>
                          <div class="item-resumo">
                            <div class="descricao-item">
                              Total 
                              <span class="mensais">(Parcelas mensais)</span>
                            </div>
                            <div class="valor-item resumo_mensais">
                            </div>
                          </div>
                          <div class="item-resumo">
                            <div class="descricao-item">
                              Total 
                              <span class="mensais">(Balões / Intermediárias)</span>
                            </div>
                            <div class="valor-item resumo_balao">
                            </div>
                          </div>
                          <div class="item-resumo">
                            <div class="descricao-item">
                              Total 
                              <span class="mensais">
                                (Bens Negociáveis)
                              </span>
                            </div>
                            <div class="valor-item resumo_bens_negociaveis">
                            </div>
                          </div>
                          <div class="item-saldo">
                            <div class="descricao-item">
                              Saldo Remanescente
                            </div>
                            <div class="valor-item resumo_saldo_remanescente">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group informacoes-proposta">
                          <p>
                            <strong>Correção Parcela Mensal:</strong> 
                            {{ $oferta->correcao_parcela }}
                          </p>
                          <p>
                            <strong>Correção Parcela Balão / Intermediária:</strong> 
                            {{ $oferta->correcao_parcela_balao }}
                          </p>
                          <p>
                            Informamos que sua proposta será enviada para a construtora para análise, no período máximo de <strong>24 horas</strong> você será informado se a mesmo foi aprovada ou não. A proposta não garante a reserva da unidade e também não gera nenhum vínculo com a construtora e/ou incorporadora.
                          </p>
                          <textarea name="outros_comentarios" id="outros_comentarios" class="outros-comentarios" placeholder="Gostaria de incluir algum comentário?" maxlength="100"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-9">
                      <div class="checkbox-custom checkbox-terms">
                        <input type="checkbox" name="terms" id="w4-terms" required>
                        <label for="w4-terms">Concordo em disponibilizar meus dados para análise da construtora</label>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="codigo_oferta" value="{{ $oferta->id }}">
              </div>
            </form>
          </div>
          <div class="panel-footer rodape-proposta">
            <ul class="pager">
              <li class="previous disabled">
                <a><i class="fa fa-angle-left"></i> Voltar</a>
              </li>
              <li class="finish hidden pull-right">
                <a class="enviar" onClick='submitForm()'><i class="fa fa-save"></i> Enviar Proposta</a>
              </li>
              <li class="next">
                <a class="botao-avancar">Próximo <i class="fa fa-angle-right"></i></a>
              </li>
            </ul>
          </div>
        </section>
      </div>
    </section>
  </div>
</div>
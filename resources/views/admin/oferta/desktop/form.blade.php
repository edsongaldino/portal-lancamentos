<div class="row">
  <div class="col-xs-12">
    <section class="panel form-wizard" id="w10">
      <header class="panel-heading">
        <div class="panel-actions">
          <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
          <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
        </div>
      </header>
      <div class="panel-body">
        <div class="wizard-progress wizard-progress-lg">
          <div class="steps-progress">
            <div class="progress-indicator" style="width: 0%;"></div>
          </div>
          <ul class="wizard-steps">
            <li class="active">
              <a href="#w10-unidade" data-toggle="tab"><span>1</span>Unidade</a>
            </li>
            <li class="">
              <a href="#w10-valor" data-toggle="tab"><span>2</span>Valor</a>
            </li>
            <li class="">
              <a href="#w10-negociacao" data-toggle="tab"><span>3</span>Negociação</a>
            </li>
            <li>
              <a href="#w10-confirmacao" data-toggle="tab"><span>4</span>Confirmação</a>
            </li>
          </ul>
        </div>

        <form id="formOferta" class="form-horizontal" novalidate="novalidate">          
          @if (isset($empreendimento))
          <input type="hidden" name="empreendimento_id" value="{{ $empreendimento->id }}" id="empreendimento_id">
          @endif
          <div class="tab-content">
            <div id="w10-unidade" class="tab-pane active">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="w10-username"><i class="fa fa-building" aria-hidden="true"></i>  Empreendimento</label>
                <div class="col-sm-4">
                  <select id="empreendimento" name="empreendimento_id" class="form-control" required="true" @if(isset($empreendimento))disabled="true"@endif>
                    <option value="">Selecionar empreendimento</option>      
                    @foreach($empreendimentos as $emp)
                      <option value="{{ $emp->id }}" @if(isset($empreendimento) && $emp->id == $empreendimento->id) selected="true" @endif>{{ $emp->nome }}</option>
                    @endforeach
                  </select>
                </div>                
              </div>              
              
              @if(isset($empreendimento))
                @if($empreendimento->tipo == 'Horizontal')
                  @include('admin/oferta/desktop/oferta_horizontal')
                @endif
                @if($empreendimento->tipo == 'Vertical')
                  @include('admin/oferta/desktop/oferta_vertical')
                @endif
              @else
                <div id="buscar-unidade"></div>
                <div id="andares"></div>
                <div style="clear: both"></div>
                <div style="margin-top: 20px"></div>
                <div id="unidades"></div>
                <div id="plantas"></div>
              @endif

              <script type="text/javascript">
                function maxLengthCheck(object) {
                  if (object.value.length > object.maxLength) {          
                    object.value = object.value.slice(0, object.maxLength)
                  }
                }
                    
                function isNumeric (evt) {
                  var theEvent = evt || window.event;
                  var key = theEvent.keyCode || theEvent.which;
                  key = String.fromCharCode (key);
                  var regex = /[0-9]|\./;
                  if ( !regex.test(key) ) {
                    theEvent.returnValue = false;
                    if(theEvent.preventDefault) theEvent.preventDefault();
                  }
                }
              </script>
            </div>            
            <div id="w10-valor" class="tab-pane">
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 control-label" for="w10-first-name">Preço de Tabela</label>
                  <div class="col-sm-4">
                    <div class="input-group mb-md">
                      <span class="input-group-addon">R$</span>
                      <input type="text" name="preco_tabela" id="preco_tabela" class="form-control moeda preco_tabela" @if (isset($oferta)) value="{{$oferta->preco_tabela }}" @else value="" @endif>
                    </div>
                  </div>
                  <label class="col-sm-2 control-label" for="w10-first-name">Desconto</label>
                  <div class="col-sm-3">
                    <div class="input-group mb-md">
                      <span class="input-group-addon btn-danger">%</span>
                      <input type="number" min="1" name="percentual_desconto" id="percentual_desconto"  class="form-control percentual_desconto"
                      onkeypress="return isNumeric(event)"
                      oninput="maxLengthCheck(this)"
                      maxlength="6"
                      min="0"
                      max="100"
                      @if (isset($oferta)) value="{{$oferta->percentual_desconto }}" @else value="" @endif>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 control-label" for="w10-first-name">Preço de Oferta</label>
                  <div class="col-sm-4">
                    <div class="input-group mb-md">
                      <span class="input-group-addon btn-warning">R$</span>
                      <input type="text" name="preco_oferta" id="preco_oferta" class="form-control moeda preco_oferta" @if (isset($oferta)) value="{{$oferta->preco_oferta }}" @else value="" @endif>
                    </div>
                  </div>

                  <label class="col-sm-2 control-label" for="w10-first-name">Desconto de:</label>
                  <div class="col-sm-3">
                    <div class="input-group mb-md">
                      <span class="input-group-addon btn-danger">R$</span>
                      <input type="text" name="valor_desconto" id="valor_desconto" class="form-control valor_desconto" readonly="" @if (isset($oferta)) value="{{$oferta->valor_desconto }}" @else value="" @endif>
                    </div>
                  </div>

                </div>  
              </div>
            </div>

            <div id="w10-negociacao" class="tab-pane">
              <div class="form-group tipo-negociacao">
                <div class="row">
                  <label class="col-sm-3 control-label" for="w10-password">Tipo da Negociação</label>
                  <div class="col-sm-9">
                    <div class="input-group mb-md">
                      <span class="input-group-addon btn-info"><i class="fa fa-usd" aria-hidden="true"></i></span>
                      <select id="tipo_negociacao" name="tipo_negociacao" class="form-control" required="">
                        <option value="">Selecione tipo da negociação</option> 
                        
                        <option value="EntradaComFinanciamento" @if (isset($oferta) && $oferta->tipo_negociacao == 'EntradaComFinanciamento') selected="true" @endif>Entrada + Financiamento</option>
                        
                        <option value="EntradaParcelamentoDireto" @if (isset($oferta) && $oferta->tipo_negociacao == 'EntradaParcelamentoDireto') selected="true"@endif>Entrada + Parcelamento Direto</option>

                        <option value="EntradaComBaloesFinanciamento" @if (isset($oferta) && $oferta->tipo_negociacao == 'EntradaComBaloesFinanciamento') selected="true" @endif>Entrada com Balões + Financiamento</option>

                        <option value="EntradaComMensaisFinanciamento" @if (isset($oferta) && $oferta->tipo_negociacao == 'EntradaComMensaisFinanciamento') selected="true" @endif>Entrada com Mensais + Financiamento</option>

                        <option value="EntradaComMensaisBaloesFinanciamento" @if (isset($oferta) && $oferta->tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento') selected="true" @endif>Entrada com Mensais e Balões + Financiamento</option>

                        <option value="Avista" @if (isset($oferta) && $oferta->tipo_negociacao == 'Avista') selected="true" @endif>Somente Pagamento à Vista</option>

                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group" id="grupo_entrada" @if (isset($oferta) && $oferta->tipo_negociacao != 'Avista') style="display: block" @else style="display:none;" @endif>
                <div class="row">
                  <label class="col-sm-3 control-label" for="w10-first-name">Valor de Entrada</label>
                  <div class="col-sm-4">
                    <div class="input-group mb-md">
                      <span class="input-group-addon">R$</span>
                      <input type="text" id="valor_entrada" name="valor_entrada" @if (isset($oferta))value="{{ $oferta->valor_entrada }}" @endif class="form-control moeda valor_entrada">
                    </div>
                  </div>

                  <label class="col-sm-2 control-label" for="w10-first-name">Percentual</label>
                  <div class="col-sm-3">
                    <div class="input-group mb-md">
                      <span class="input-group-addon btn-danger">%</span>                      
                      <input type="number" min="1" name="entrada_percentual" id="percentual_entrada" class="form-control percentual_entrada"
                      onkeypress="return isNumeric(event)"
                      oninput="maxLengthCheck(this)"
                      maxlength="9"
                      min="0"
                      max="100"
                      @if (isset($oferta))value="{{ $oferta->percentual_entrada }}" @endif>
                    </div>
                  </div>

                </div>
              </div>
              
              <div class="form-group" id="grupo_parcelas_mensais" 
                @if (isset($oferta))
                  @if ($oferta->tipo_negociacao == 'EntradaComMensaisFinanciamento' 
                  || $oferta->tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento' || $oferta->tipo_negociacao == 'EntradaParcelamentoDireto') 
                    style="display: block" 
                  @else 
                    style="display:none;" 
                  @endif
                @else
                  style="display:none;" 
                @endif
                >
                <div class="row">
                  <label class="col-md-3 control-label">Nº Parcelas Mensais</label>
                  <div class="col-md-3">
                    <div class="input-group mb-md">
                      <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                      <input type="number" min="1" id="parcela_mensal" name="quantidade_parcela" class="form-control" @if (isset($oferta))value="{{ $oferta->quantidade_parcela }}" @endif>
                    </div>
                  </div>

                  <label class="col-sm-2 control-label" for="w10-first-name">Valor (Mensais)</label>
                  <div class="col-sm-4">
                    <div class="input-group mb-md">
                      <span class="input-group-addon">R$</span>
                      <input type="text" name="valor_parcela" id="valor_parcela_mensal" class="form-control moeda valor_parcela_mensal" @if (isset($oferta))value="{{ $oferta->valor_parcela }}" @endif>
                    </div>
                  </div>
                </div>
              </div>  
              
              <div class="form-group parcelas" id="parcelas" 
                @if (isset($oferta))
                  @if (isset($oferta) && $oferta->tipo_negociacao == 'EntradaComBaloesFinanciamento' || $oferta->tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento' || $oferta->tipo_negociacao == 'EntradaParcelamentoDireto') 
                    style="display: block" 
                  @else 
                    style="display:none;" 
                  @endif
                @else
                  style="display:none;"
                @endif
                >
                  <div class="row">
                    <div class="col-sm-offset-10 col-sm-2">
                      <div class="pull-left">
                        <a class="simple-ajax-modal btn btn-lg btn-success btn-add-parcela" href="javascript:void(0)" id="add_parcela"><i class="fa fa-plus-square"></i></a>
                      </div>
                    </div>  
                  </div>
                  <br>
                  @if (isset($oferta) && isset($oferta->baloes))
                    @foreach ($oferta->baloes as $balao)
                    <div class="row">
                      <label class="col-sm-3 control-label nome-parcela">Parcela Balão {{ $loop->iteration }}</label>
                      <div class="col-sm-4">
                        <div class="input-group mb-md">
                          <span class="input-group-addon">R$</span>
                          <input type="text" name="valor_parcela_balao[]" class="form-control moeda valor_parcela_balao" value="{{ $balao->valor }}">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </span>
                          <input placeholder="00/00/0000" type="text" name="data_parcela_balao[]" class="form-control data" value="{{ $balao->data }}">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <a class="simple-ajax-modal btn btn-lg btn-danger btn-remover-parcela" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                      </div>
                    </div>
                    @endforeach
                  @else  
                    <div class="row">                
                      <label class="col-sm-3 control-label nome-parcela">Parcela Balão 1</label>
                      <div class="col-sm-4">
                        <div class="input-group mb-md">
                          <span class="input-group-addon">R$</span>
                          <input type="text" name="valor_parcela_balao[]" class="form-control moeda valor_parcela_balao" value="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </span>
                          <input placeholder="00/00/0000" type="text" name="data_parcela_balao[]" class="form-control data" value="00/00/0000">
                        </div>
                      </div>                      
                    </div>
                  @endif                
  
                <div id="bloco-parcela" style="display: none">
                  <div class="row">
                    <label class="col-sm-3 control-label nome-parcela">Parcela Balão 1</label>
                    <div class="col-sm-4">
                      <div class="input-group mb-md">
                        <span class="input-group-addon">R$</span>
                        <input type="text" name="valor_parcela_balao[]" class="form-control moeda valor_parcela_balao" value="">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input placeholder="00/00/0000" type="text" name="data_parcela_balao[]" class="form-control data data_parcela_balao" value="">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <a class="simple-ajax-modal btn btn-lg btn-danger btn-remover-parcela" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                    </div>
                  </div>
                </div>

                <div id="novas-parcelas"></div>
              </div>
              
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 control-label" for="w10-first-name">Saldo Remanescente</label>
                  <div class="col-sm-4">
                    <div class="input-group mb-md">
                      <span class="input-group-addon btn-warning">R$</span>
                      <input type="text" name="saldo_remanescente" id="saldo_remanescente" class="form-control valor saldo_remanescente" readonly="" @if (isset($oferta)) value="{{ $oferta->saldo_remanescente }}" @endif>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 control-label" for="w10-first-name">Outros Bens</label>
                  <div class="col-sm-9">
                    <div class="checkbox-custom outros-bens">
                      <input type="checkbox" name="aceita_bens" id="bens" value="Sim" @if (isset($oferta) && $oferta->aceita_bens == 'Sim') checked="true" @endif>
                      <label for="bens">Aceitamos outros bens como parte da negociação (Ex: Carro, terreno, etc)</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div id="w10-confirmacao" class="tab-pane">
              <div class="form-group margin-bottom-20">
                <div class="row">
                  <label class="col-sm-3 control-label" for="w10-first-name">Oferta Válida até:</label>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <span class="input-group-addon btn-danger">
                        <i class="fa fa-calendar"></i>
                      </span>
                      <input type="text" name="validade" id="validade_oferta" class="form-control data" placeholder="00/00/0000" @if (isset($oferta)) value="{{ $oferta->validade }}" @endif>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 control-label" for="w10-first-name">Correção (Parcela mensal)</label>
                  <div class="col-sm-3">
                    <div class="input-group mb-md">
                      <span class="input-group-addon btn-info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                      <input type="text" name="correcao_parcela" id="correcao_parcela_mensal" placeholder="INCC + IGPM" class="form-control moeda" @if (isset($oferta)) value="{{ $oferta->correcao_parcela }}" @endif>
                    </div>
                  </div>

                  <label class="col-sm-3 control-label" for="w10-first-name">Correção (Parcela(s) Balão)</label>
                  <div class="col-sm-3">
                    <div class="input-group mb-md">
                      <span class="input-group-addon btn-info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                      <input type="text" name="correcao_parcela_balao" id="correcao_parcela_balao" placeholder="INCC + IGPM" class="form-control moeda" @if (isset($oferta)) value="{{ $oferta->correcao_parcela_balao }}" @endif>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 control-label" for="w10-first-name">Informações Adicionais</label>
                  <div class="col-sm-9">
                    <div class="input-group mb-md">
                      <textarea name="informacoes" id="informacoes_adicionais" class="form-control informacoes_adicionais" cols="100" rows="3">@if (isset($oferta)){{ $oferta->informacoes }}@endif</textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                  <p>A oferta online permite selecionar até 3 unidades do empreendimento para que sejam publicadas no portal lançamentos online. Na oferta online você define, preço, descontos, condições de pagamento, correções e ajustes das parcelas, balões, saldo devedor e período de validade da proposta. O cliente que navegar no portal lançamentos online poderá selecionar a unidade ofertada e formular a proposta online de maneira simples e rápida. A proposta será encaminhada aos gerentes cadastrados no sistema com as seguintes informações: Dados da unidade ofertada condições de pagamento do cliente dados pessoais do cliente, dos quais; nome completo, CPF, renda, telefone, nome no conjugue e e-mail. O portal lançamentos online não poderá se responsabilizar pelas informações e conteúdos inseridos na proposta online enviada pelo cliente. O portal lançamentos online será remunerado pela oferta publicada desde que o proponente encaminhe a proposta online e no período máximo de 90 dias a partir da emissão da mesma formalize e conclua o negócio. O valor da remuneração será de 0,5% sobre o valor da unidade comercializada. O valor remunerado será identificado como mídia digital - oferta online do portal lançamentos online.</p>
                </div>
              </div>


              <div class="form-group">
                <div class="col-sm-9">
                  <div class="checkbox-custom">
                    <input type="checkbox" name="aceita_termos" id="termos" required="" @if (isset($oferta) && $oferta->aceita_termos == 'Sim') checked="true" @endif>
                    <label for="termos">Concordo com os termos e confirmo a disponibilização desta unidade em oferta</label>
                  </div>
                </div>
              </div>
            </div>
          </div>        
      </div>
      <div class="panel-footer">
        <ul class="pager">
          <li class="previous disabled">
            <a><i class="fa fa-angle-left"></i> Anterior</a>
          </li>
          <li class="finish hidden pull-right">
            <button type="button" class="btn btn-success anunciar-oferta">Anunciar oferta</button>
          </li>
          <li class="next">
            <a>Próximo <i class="fa fa-angle-right"></i></a>
          </li>
        </ul>
      </div>
    </section>
  </div>  
</div>
</form>

<script src="/assets/vendor/jquery-validation/jquery.validate.js"></script>
<script src="/assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
<script src="/assets/vendor/pnotify/pnotify.custom.js"></script>
<script src="/assets/javascripts/forms/examples.wizard.js"></script>
<script type="/assets/javascripts/oferta/form_oferta.js"></script>
<script type="/assets/javascripts/oferta/index.js"></script>
<script type="/assets/javascripts/oferta/wizard.js"></script>
<script type="text/javascript">
  $(function () {
    $('.moeda').maskMoney({thousands: '.', decimal: ','});
    $('.data').mask('00/00/0000');

    var variacao = {{ isset($empreendimento) ? $empreendimento->variacao->id ?? 0 : 0 }};
    var saldo_remanescente = '';
    var preco_oferta = '';
    var preco_tabela = '';
    var valor_entrada = '';
    var percentual_entrada = '';
    var url = "{{ route('cadastrar-oferta') }}";
    var tipo_negociacao = '';

    @if (isset($oferta))
      saldo_remanescente = {!! $oferta->getOriginal('saldo_remanescente') !!};
      preco_oferta = {!! $oferta->getOriginal('preco_oferta') !!};
      preco_tabela = {!! $oferta->getOriginal('preco_tabela') !!};
      valor_entrada = {!! $oferta->getOriginal('valor_entrada') ?? '0.00' !!};
      percentual_entrada = {!! $oferta->getOriginal('percentual_entrada') ?? '0.00' !!};
      url = "{{ route('atualizar-oferta', $oferta->id) }}";
      tipo_negociacao = "{!! $oferta->tipo_negociacao !!}";
    @endif
    
    var oferta = new Oferta(
      saldo_remanescente,
      preco_oferta,
      preco_tabela,
      valor_entrada,
      percentual_entrada,
      variacao,
      url,
      tipo_negociacao
    );

    var wizard = new OfertaWizard(oferta);

    wizard.iniciar();
  });  
</script>

@csrf
<div class="col-md-12 tabela-online">
    <div class="row">
        <input type="hidden" name="construtora_id" value="{{ get_construtora_id() }}">
        <input type="hidden" name="tabela_id" id="tabela_id" value="{{ $tabela->id ?? '' }}">
        <div class="col-md-4">
            <div class="form-group">
                <label>Empreendimento</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    <select data-construtora="{{ get_construtora_id() }}" class="form-control select-empreendimento" name="empreendimento_id" id="empreendimento" required>
                        <option value="">Selecione um empreendimento</option>
                        @foreach (get_empreendimentos() as $empreendimento)
                            <option value="{{ $empreendimento->id }}"
                                    @if (isset($tabela) && $tabela->empreendimento_id == $empreendimento->id)
                                    selected="true"
                                @endif
                            >
                                {{ $empreendimento->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>



        <div class="col-md-3" id="selectTorresQuadras">

            @if(isset($tabela) && $tabela->empreendimento->tipo ?? '' == 'Vertical')
            <div class="form-group">
                <label>Torre</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    <select class="form-control select-empreendimento" name="torre_id" id="torre_id">
                        @foreach($empreendimento->torres as $torre)
                        <option value="{{ $torre->id }}" @if(isset($tabela) && $tabela->torre->id == $torre->id) selected="true" @endif>{{ $torre->nome }}</option>
                        @endforeach
                        <option value="1" @if(isset($tabela)) @if($tabela->torre->id == 1) selected="true" @endif @endif>Todas as torres</option>
                    </select>
                </div>
            </div>
            @else

            <div class="form-group">
                <label>Quadra</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    <select class="form-control select-empreendimento" name="quadra_id" id="quadra_id">
                        @foreach($empreendimento->quadras as $quadra)
                        <option value="{{ $quadra->id }}" @if(isset($tabela) && $tabela->quadra->id == $quadra->id) selected="true" @endif>{{ $quadra->nome }}</option>
                        @endforeach
                        <option value="1" @if(isset($tabela)) @if($tabela->quadra->id == 1) selected="true" @endif @endif>Todas as quadras</option>
                    </select>
                </div>
            </div>

            @endif

        </div>

        <div class="col-md-2" id="previsaoEntrega">

            @if(isset($tabela) && $tabela->empreendimento->tipo ?? '' == 'Vertical')
            <div class="form-group">
                <label>Previsão de entrega</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" class="form-control previsao-entrega" value="@if(isset($tabela)) {{ mes_extenso_abreviado($tabela->torre->previsao_entrega_mes ?? '') }}/{{ $tabela->torre->previsao_entrega_ano ?? '' }} @endif" readonly>
                </div>
            </div>
            @else
            <div class="form-group">
                <label>Previsão de entrega</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" class="form-control previsao-entrega" value="@if(isset($tabela)) {{ mes_extenso_abreviado($tabela->quadra->previsao_entrega_mes ?? '') }}/{{ $tabela->quadra->previsao_entrega_ano ?? '' }} @endif" readonly>
                </div>
            </div>
            @endif

        </div>



        <div class="col-md-3">
            <div class="form-group">
                <label>Tipo da Tabela <a class="modal-with-form modal-with-move-anim" href="#modalForm"><div class="gerenciar-tipos"><i class="fa fa-plus"></i> Adicionar tipo</div></a> </label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-outdent"></i>
                    </span>
                    <select class="form-control select-empreendimento" name="tipo_tabela_id" id="tipo_tabela_id" required>
                        <option value="">Selecione um tipo</option>
                        <option value="1" @if(isset($tabela) && $tabela->tipo_tabela_id == 1) selected="true" @endif>Lançamentos Online</option>
                        @foreach ($tipo_tabela as $tipo)
                        <option value="{{ $tipo->id }}" @if(isset($tabela) && $tabela->tipo_tabela_id == $tipo->id) selected="true" @endif>{{ $tipo->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!--
        <div class="col-md-12 m-t-20">
            <div class="dados-empreendimento-tabela"></div>
        </div>
        -->

    </div>
</div>

<div class="col-sm-12 m-t-20">

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Possui entrada?</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    <select class="form-control select-empreendimento" name="possuiEntrada" id="possuiEntrada">
                        <option value="Não">Não</option>
                        <option value="Sim"@if (($tabela->percentual_entrada ?? '') <> null) selected="true" @endif>Sim</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-3" id="percentualEntrada" @if (($tabela->percentual_entrada ?? '') <> null) style="display: block;" @else style="display: none;" @endif>
            <div class="form-group">
                <label>Qual o percentual de entrada?</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        %
                    </span>
                    <input class="form-control percentual-valor percentual" name="percentual_entrada" id="percentual_entrada" value="{{ converte_valor_real($tabela->percentual_entrada ?? '') }}" placeholder="">
                </div>
            </div>
        </div>

        <div class="col-md-3" id="parcelamentoEntrada" @if (($tabela->percentual_entrada ?? '') <> null) style="display: block;" @else style="display: none;" @endif>
            <div class="form-group">
                <label>Entrada Parcelada?</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    <select class="form-control select-empreendimento" name="entradaParcelada" id="entradaParcelada">
                        <option value="Não">Não</option>
                        <option value="Sim"@if (($tabela->qtd_parcelas_entrada ?? '') <> null) selected="true" @endif>Sim</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="QtdeParcelaEntrada" class="col-md-3" @if (($tabela->qtd_parcelas_entrada ?? '') <> null) style="display: block;" @else style="display: none;" @endif>
            <div class="form-group">
                <label>Nº Parcelas (Máximo)</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-sort-numeric-asc"></i>
                    </span>
                    <input class="form-control select-empreendimento" type="number" name="qtd_parcelas_entrada" id="qtd_parcelas_entrada" value="{{ $tabela->qtd_parcelas_entrada ?? '' }}" placeholder="">
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Possui parcelas mensais?</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    <select class="form-control select-empreendimento" name="possuiMensais" id="possuiMensais">
                        <option value="Não">Não</option>
                        <option value="Sim" @if (($tabela->qtd_mensais ?? '') > 0) selected="true" @endif>Sim</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="mensaisTabela" @if (($tabela->qtd_mensais ?? '') > 0) style="display: block;" @else style="display: none;" @endif>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Qual a quantidade de parcelas mensais?</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc"></i>
                        </span>
                        <input class="form-control select-empreendimento" name="qtd_mensais" id="qtd_mensais" value="{{ $tabela->qtd_mensais ?? '' }}" placeholder="">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Qual o percentual das parcelas mensais?</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            %
                        </span>
                        <input class="form-control percentual-valor percentual" name="percentual_mensais" id="percentual_mensais" value="{{ converte_valor_real($tabela->percentual_mensais ?? '') }}" placeholder="">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Qual o percentual de juros ao mês?</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            %
                        </span>
                        <input class="form-control percentual-valor percentual" name="percentual_juros_mensal" id="percentual_juros_mensal" value="{{ converte_valor_real($tabela->percentual_juros_mensal ?? '') }}" placeholder="">
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Possui parcelas balões?</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    <select class="form-control select-empreendimento" name="possuiBaloes" id="possuiBaloes">
                        <option value="Não">Não</option>
                        <option value="Sim" @if (($tabela->qtd_baloes ?? '') > 0) selected="true" @endif>Sim</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="baloesTabela" @if (($tabela->qtd_baloes ?? '') > 0) style="display: block;" @else style="display: none;" @endif>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Qual a quantidade de parcelas balões?</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc"></i>
                        </span>
                        <input class="form-control select-empreendimento" name="qtd_baloes" id="qtd_baloes" value="{{ $tabela->qtd_baloes ?? '' }}" placeholder="">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Qual o percentual das parcelas balões?</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            %
                        </span>
                        <input class="form-control percentual-valor percentual" name="percentual_baloes" id="percentual_baloes" value="{{ converte_valor_real($tabela->percentual_baloes ?? '') }}" placeholder="">
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if (isset($tabela) && isset($tabela->baloes))

    <section class="panel m-t-20" id="baloes" style="display: block;">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
            </div>

            <h2 class="panel-title"><i class="fa fa-adjust"></i> Parcelas Balões</h2>
        </header>
        <div class="panel-body" id="TabelaBaloes">
            @foreach ($tabela->baloes as $balao)
            <div class="col-md-6 linha-tabela-balao" id="linhaBalao">

                <div class="col-md-4 titulo-parcela-balao">
                    <i class="fa fa-calendar-o"></i> Parcela Balão
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Data da Parcela Balão</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="date" class="form-control" name="data_parcela_balao[]" value="{{ $balao->data_balao }}">
                        </div>
                    </div>
                </div>
                <input type="hidden" class="form-control select-empreendimento" name="percentual_parcela_balao[]" placeholder="" value="10">
                <!--
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Valor</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </span>
                            <input class="form-control select-empreendimento" name="tipo_tabela" id="tipo_tabela" placeholder="">
                        </div>
                    </div>
                </div>
                -->

                <div class="col-md-2 box-info-balao">
                    <i class="fa fa-info-circle"></i>
                </div>

            </div>
            @endforeach
        </div>
    </section>

    @else

    <section class="panel m-t-20" id="baloes" style="display: none;">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
            </div>

            <h2 class="panel-title"><i class="fa fa-adjust"></i> Parcelas Balões</h2>
        </header>
        <div class="panel-body" id="TabelaBaloes">

            <div class="col-md-6 linha-tabela-balao" id="linhaBalao">

                <div class="col-md-4 titulo-parcela-balao">
                    <i class="fa fa-calendar-o"></i> Parcela Balão
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Data da Parcela Balão</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="date" class="form-control" name="data_parcela_balao[]" value="">
                        </div>
                    </div>
                </div>

                <!--
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Valor</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </span>
                            <input class="form-control select-empreendimento" name="tipo_tabela" id="tipo_tabela" placeholder="">
                        </div>
                    </div>
                </div>
                -->

                <div class="col-md-2 box-info-balao">
                    <i class="fa fa-info-circle"></i>
                </div>

            </div>

        </div>
    </section>

    @endif

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Possui parcela única (Entrega das Chaves)?</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    <select class="form-control select-empreendimento" name="possuiParcelaUnica" id="possuiParcelaUnica">
                        <option value="Não">Não</option>
                        <option value="Sim"@if (($tabela->percentual_parcela_unica ?? '') <> null) selected="true" @endif>Sim</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-3" id="percentualParcelaUnica" @if (($tabela->percentual_parcela_unica ?? '') <> null) style="display: block;" @else style="display: none;" @endif>
            <div class="form-group">
                <label>Qual o percentual da parcela única?</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        %
                    </span>
                    <input class="form-control percentual-valor percentual" name="percentual_parcela_unica" id="percentual_parcela_unica" value="{{ converte_valor_real($tabela->percentual_parcela_unica ?? '') }}" placeholder="">
                </div>
            </div>
        </div>

        <div class="col-md-3" id="dataParcelaUnica" @if (($tabela->percentual_parcela_unica ?? '') <> null) style="display: block;" @else style="display: none;" @endif>
            <div class="form-group">
                <label>Data da Parcela Única (Chaves) *Previsão</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="date" class="form-control" name="data_parcela_unica" value="{{ $tabela->data_parcela_unica ?? '' }}">
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <label>Opção de Vaga Extra?</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    <select class="form-control select-empreendimento" name="possui_vaga_extra" id="possuiVagaExtra">
                        <option value="Não"@if (($tabela->possui_vaga_extra ?? '') == 'Não') selected="true" @endif>Não</option>
                        <option value="Sim_PG"@if (($tabela->possui_vaga_extra ?? '') == 'Sim_PG') selected="true" @endif>Sim (Padrão e Gaveta)</option>
                        <option value="Sim_SP"@if (($tabela->possui_vaga_extra ?? '') == 'Sim_SP') selected="true" @endif>Sim (Somente Padrão)</option>
                        <option value="Sim_SG"@if (($tabela->possui_vaga_extra ?? '') == 'Sim_SG') selected="true" @endif>Sim (Somente Gaveta)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-3" id="valorVagaExtraPadrao" @if ((($tabela->possui_vaga_extra ?? '') == 'Sim_PG') || (($tabela->possui_vaga_extra ?? '') == 'Sim_SP')) style="display: block;" @else style="display: none;" @endif>
            <div class="form-group">
                <label>Qual o valor da vaga extra <b>(PADRÃO)</b>?</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        R$
                    </span>
                    <input class="form-control percentual-valor moeda" name="valor_vaga_extra" id="valor_vaga_extra" value="{{ converte_valor_real($tabela->valor_vaga_extra ?? '') }}" placeholder="">
                </div>
            </div>
        </div>

        <div class="col-md-3" id="valorVagaExtraGaveta" @if ((($tabela->possui_vaga_extra ?? '') == 'Sim_PG') || (($tabela->possui_vaga_extra ?? '') == 'Sim_SG')) style="display: block;" @else style="display: none;" @endif>
            <div class="form-group">
                <label>Qual o valor da vaga extra <b>(GAVETA)</b>?</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        R$
                    </span>
                    <input class="form-control percentual-valor moeda" name="valor_vaga_extra_gaveta" id="valor_vaga_extra_gaveta" value="{{ converte_valor_real($tabela->valor_vaga_extra_gaveta ?? '') }}" placeholder="">
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        
        <div class="col-md-3">
            <div class="form-group">
                <label>Percentual Remanescente (Financiamento)</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        %
                    </span>
                    <input class="form-control percentual-remanascente percentual" name="percentual_remanescente" value="{{ converte_valor_real($tabela->percentual_remanescente ?? '') }}" id="percentual_remanescente" placeholder="" readonly>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Tem parceria com algum banco?</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-bank"></i>
                    </span>
                    <select class="form-control select-empreendimento" name="parceriaBanco" id="parceriaBanco">
                        <option value="Não">Não</option>
                        <option value="Sim" @if (($tabela->banco_parceiro ?? '') <> null) selected="true" @endif>Sim</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-3" id="bancos" style="display: none;">
            <div class="form-group">
                <label>Selecione o banco</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-bank"></i>
                    </span>
                    <select class="form-control select-empreendimento" name="banco_parceiro" id="banco_parceiro">
                        <option value="Não">Selecione</option>
                        <option value="Banco do Brasil" @if (($tabela->banco_parceiro ?? '') == 'Banco do Brasil') selected="true" @endif>Banco do Brasil</option>
                        <option value="Caixa" @if (($tabela->banco_parceiro ?? '') == 'Caixa') selected="true" @endif>Caixa Econômica Federal</option>
                    </select>
                </div>
            </div>
        </div>

    </div>


    <section class="panel m-t-20">

        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
            </div>

            <h2 class="panel-title"><i class="fa fa-list-alt"></i> Complementos da Tabela</h2>
        </header>
        <div class="panel-body">

            <div class="col-md-3">
                <div class="form-group">
                    <label>Desconto à vista</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            %
                        </span>
                        <input class="form-control percentual-desconto percentual" name="desconto_avista" id="desconto_avista" value="{{ converte_valor_real($tabela->desconto_avista ?? '') }}" placeholder="" required>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Renda mínima</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                           <i class="fa fa-dollar"></i>
                        </span>
                        <input class="form-control renda-minima-tabela moeda" name="renda_minima" id="renda_minima" value="{{ converte_valor_real($tabela->renda_minima ?? '') }}" placeholder="" required>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Programa Habitacional</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                           <i class="fa fa-hand-o-right"></i>
                        </span>
                        <select class="form-control select-empreendimento" name="programa_habitacional" id="programaHabitacional" required>
                            <option value="">Selecione</option>
                            <option value="Não" @if (($tabela->programa_habitacional ?? '') == 'Não') selected="true" @endif>Não se enquandra</option>
                            <option value="MCMV" @if (($tabela->programa_habitacional ?? '') == 'MCMV') selected="true" @endif>Minha casa, Minha vida</option>
                            <option value="CV" @if (($tabela->programa_habitacional ?? '') == 'CV') selected="true" @endif>Casa Verde</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label>Subsídio de até:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                           %
                        </span>
                        <input class="form-control percentual-desconto percentual" name="subsidio_maximo" id="subsidio_maximo" value="{{ converte_valor_real($tabela->subsidio_maximo ?? '') }}" placeholder="" disabled>
                    </div>
                </div>
            </div>

            <!--

            <div class="col-md-3">
                <div class="form-group">
                    <label>Correção Período de Obra</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                           <i class="fa fa-subscript"></i>
                        </span>
                        <select class="form-control select-empreendimento" name="correcao_obra" id="correcao_obra">
                            <option value="">Selecione</option>
                            <option value="INCC" @if (($tabela->correcao_obra ?? '') == 'INCC') selected="true" @endif>INCC</option>
                            <option value="Não" @if (($tabela->correcao_obra ?? '') == 'Não') selected="true" @endif>S/ Correção</option>
                        </select>
                    </div>
                </div>
            </div>
            -->

            <div class="col-md-3">
                <div class="form-group">
                    <label>Correção Pós Chave</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                           <i class="fa fa-key"></i>
                        </span>
                        <select class="form-control select-empreendimento" name="correcao_poschave" id="correcao_poschave" required>
                            <option value="">Selecione</option>
                            <option value="INCC" @if (($tabela->correcao_poschave ?? '') == 'INCC') selected="true" @endif>INCC</option>
                            <option value="IGPM" @if (($tabela->correcao_poschave ?? '') == 'IGPM') selected="true" @endif>IGPM</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Aceita outros bens no pagamento?</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                           <i class="fa fa-hand-o-left"></i>
                        </span>
                        <select class="form-control select-empreendimento" name="aceita_bens" id="aceita_bens" required>
                            <option value="">Selecione</option>
                            <option value="Não" @if (($tabela->aceita_bens ?? '') == 'Não') selected="true" @endif>Não</option>
                            <option value="Sim" @if (($tabela->aceita_bens ?? '') == 'Sim') selected="true" @endif>Sim</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Validade da tabela</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="date" name="validade_tabela" id="validade_tabela" value="{{ $tabela->validade_tabela ?? '' }}" class="form-control">
                    </div>
                </div>
            </div>

        </div>

    </section>


</div>

@extends('admin.empreendimentos.desktop.empreendimento.layout')
@section('conteudo_empreendimento')
    @php
        $andares = [];
        if ($entry->torres->first()) {
            $andares = $entry->torres->first()->andares->toArray();
            usort($andares, function($a, $b) {
                return $a['numero'] <=> $b['numero'];
            });
        }
    @endphp

    <div class="col-md-8 col-lg-9">
        @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
        <div class="row">
            <div class="col-xs-12">

                @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
                <section class="panel">
                    <header class="panel-heading topo-alteracoes-lote">
                        <div class="col-md-12">

                            <h2 class="panel-title">Alterações em lote</h2>

                            <div class="btn-alterar-valor" id="btn-alterar-valor"><i class="fa fa-chevron-down"></i>  Exibir Opções</div>

                        </div>
                    </header>
                    <div class="panel-body" id="alteracoes-lote">

                        <a href="{{ route('historico-unidades', $entry->id) }}" class="btn btn-primary">
                            Histórico Alterações
                        </a>

                        <br><br>

                        <div class="col-md-12 linha-alteracao">
                            <input type="hidden" name="tipo_alteracao" value="Lote">
                            <div class="col-md-11">
                                <div class="col-md-4">
                                    <label for="">O que deseja alterar?</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sort-numeric-desc"></i>
                                        </span>
                                        <select class="form-control" id="item_alteracao" name="item_alteracao" placeholder="O que deseja alterar?" onchange="carregaCampos();">
                                            <option value="" selected disabled hidden>O que deseja alterar?</option>
                                            <optgroup label="Valor (R$)">
                                                <option value="valor_fixo">Valor Fixo (Unidade)</option>
                                                @if ($entry->tipo == 'Horizontal')
                                                <option value="valor_m2">Valor do (M²)</option>
                                                @endif
                                                <option value="acrescimo_real">Aumentar valor (R$)</option>
                                                <option value="decrescimo_real">Diminuir valor (R$)</option>
                                            </optgroup>

                                            <optgroup label="Valor (%)">
                                                <option value="acrescimo_percentual">Aumentar valor (%)</option>
                                                <option value="decrescimo_percentual">Diminuir valor (%)</option>
                                            </optgroup>

                                            @if ($entry->tipo == 'Horizontal')
                                            <optgroup label="Metragem">
                                                @if ($entry->variacao_id == 6 || $entry->variacao_id == 10)
                                                <option value="metragem_valor_fixo">Metragem Unidade (Lote)</option>
                                                @else
                                                <option value="metragem_valor_fixo">Área do Lote (m²)</option>
                                                @endif
                                                <option value="dimensoes_lote">Dimensões do Lote</option>
                                            </optgroup>
                                            @endif

                                            @if (count($entry->plantas) > 0)
                                            <optgroup label="Planta">
                                                <option value="definir_planta">Definir planta da Unidade</option>
                                            </optgroup>
                                            @endif
                                            <optgroup label="Situação">
                                                <option value="definir_situacao">Alterar Situação da Unidade</option>
                                            </optgroup>

                                            @if ($entry->tipo == 'Vertical')
                                            <optgroup label="Informações Adicionais">
                                                <option value="incidencia_sol">Incidência do Sol</option>
                                                <option value="posicao_unidade">Posição da Unidade</option>
                                            </optgroup>
                                            @endif

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4" id="incidencia_sol" style="display: none;">
                                    <label for="">Selecione a posição solar:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon valor">
                                            <i class="fa fa-sun-o" aria-hidden="true"></i>
                                        </span>
                                        <select class="form-control" name="tipo_sol_alteracao" id="tipo_sol_alteracao">
                                            <option value="" disabled hidden selected>Selecione</option>
                                            <option value="Manhã">Manhã</option>
                                            <option value="Parcial da Manhã">Parcial da Manhã</option>
                                            <option value="Tarde">Tarde</option>
                                            <option value="Parcial da Tarde">Parcial da Tarde</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4" id="posicao_unidade" style="display: none;">
                                    <label for="">Selecione a posição na torre:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon valor">
                                            <i class="fa fa-building-o" aria-hidden="true"></i>
                                        </span>
                                        <select class="form-control" name="posicao_unidade_alteracao" id="posicao_unidade_alteracao">
                                            <option value="" disabled hidden selected>Selecione</option>
                                            <option value="Frente">Frente da Torre</option>
                                            <option value="Fundo">Fundos da Torre</option>
                                            <option value="Lateral">Lateral da Torre</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4" id="valor_real" style="display: block;">
                                    <label for="">Defina o valor que será aplicado:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon valor">
                                            R$
                                        </span>
                                        <input type="text" id="valor_alteracao" name="valor_alteracao_real" class="form-control moeda valor-alteracao" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-4" id="percentual-up" style="display: none;">
                                    <label for="">Defina o percentual que será aplicado:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon valor">
                                            <i class="fa fa-arrow-up"></i>%
                                        </span>
                                        <input type="text" name="valor_alteracao_percentual_up" class="form-control moeda valor-alteracao" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-4" id="box_planta_unidade" style="display: none;">
                                    <label for="">Defina a planta que será aplicada:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon valor">

                                        </span>
                                        <select class="form-control" name="planta_alteracao" id="planta_unidade">
                                            <option value="" disabled hidden selected>Selecione</option>
                                            @if (count($entry->plantas) > 0)
                                                @foreach($entry->plantas as $planta)
                                                <option value="{{ $planta->id }}">{{ $planta->nome }} - {{ converte_valor_real($planta->area_privativa) }}m²</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4" id="box_situacao_unidade" style="display: none;">
                                    <label for="">Defina a situação que será aplicada:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon valor">

                                        </span>
                                        <select class="form-control" name="situacao_alteracao">
                                            <option value="" disabled hidden selected>Selecione</option>

                                            <option value="Disponível">Disponível</option>
                                            <option value="Vendida">Vendida</option>
                                            <option value="Bloqueada">Bloqueada</option>
                                            <option value="Reservada">Reservada</option>
                                            <option value="Outros">Outros</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4" id="percentual-down" style="display: none;">
                                    <label for="">Defina o percentual que será aplicado:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon valor">
                                            <i class="fa fa-arrow-down"></i>%
                                        </span>
                                        <input type="text" name="valor_alteracao_percentual_down" class="form-control moeda valor-alteracao" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-4" id="valor_m2" style="display: none;">
                                    <label for="">Defina o valor do <strong>(M²)</strong> que será aplicado:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon valor">
                                            M²
                                        </span>
                                        <input type="text" name="valor_alteracao_m2" class="form-control moeda valor-alteracao" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-4" id="metragem_terreno" style="display: none;">
                                    <label for="">Defina a metragem dos terrenos <strong>(M²)</strong>:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon valor">
                                            M²
                                        </span>
                                        <input type="text" name="valor_alteracao_metragem" class="form-control moeda valor-alteracao" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-8" id="dimensoes_lote" style="display: none;">

                                    <div class="col-md-3">
                                        <label for="">Frente <strong>(M)</strong>:</label>
                                        <div class="input-group btn-group">
                                            <input type="text" name="lote_frente" class="form-control moeda valor-alteracao" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Fundo <strong>(M)</strong>:</label>
                                        <div class="input-group btn-group">
                                            <input type="text" name="lote_fundo" class="form-control moeda valor-alteracao" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Lateral Dir <strong>(M)</strong>:</label>
                                        <div class="input-group btn-group">
                                            <input type="text" name="lote_lateral_dir" class="form-control moeda valor-alteracao" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Lateral Esq <strong>(M)</strong>:</label>
                                        <div class="input-group btn-group">
                                            <input type="text" name="lote_lateral_esq" class="form-control moeda valor-alteracao" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="">Selecione onde aplicar:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sort-numeric-desc"></i>
                                        </span>
                                        <select class="form-control" name="alvo_alteracao" id="alvo_alteracao" onchange="carregaCampos2();">
                                            <option value="" selected hidden disabled>Aplicar a: </option>
                                            <option value="todas_unidades">Todas as unidades</option>
                                            <option value="todas_unidades_disponiveis">Todas as unidades Disponíveis</option>
                                            <option value="unidades_especificas">Unidades Específicas</option>

                                            @if ($entry->tipo == 'Horizontal')
                                                <option value="unidades_quadra">Unidades das Quadras</option>
                                                @if (count($entry->plantas) > 0)
                                                <option value="plantas_disponiveis">Unidades da Planta</option>
                                                @endif
                                            @endif

                                            @if ($entry->tipo == 'Vertical')
                                                <option value="torres_andares_disponiveis">Unidades da Torre/Andar</option>
                                                <option value="plantas_disponiveis">Unidades da Planta</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="col-md-12 linha-alteracao" id="linha-alteracao" style="display: block;">
                            <div class="col-md-11">

                                @if ($entry->tipo == 'Horizontal')
                                <div class="col-md-12" id="box-quadras" style="display: block">
                                    <label for="">Selecione as quadras:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sort-numeric-desc"></i>
                                        </span>

                                        <select name="quadras_alteracao[]" data-empreendimento="{{ $entry->id }}" multiple data-plugin-selectTwo class="form-control quadras_multiplas">
                                            <option value="" disabled hidden>Selecione a quadra</option>
                                            @foreach($entry->quadras->where('status', 'Liberada') as $quadra)
                                                <option value="{{ $quadra->id }}">{{ $quadra->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4" id="box-quadras-torres" style="display: none">
                                    <label for="">Selecione a quadra:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sort-numeric-desc"></i>
                                        </span>
                                        <select class="form-control" name="quadra_unidades" id="quadra_unidades">
                                            <option value="" disabled hidden selected>Selecione a quadra</option>
                                        @foreach($entry->quadras->where('status', 'Liberada') as $quadra)
                                            <option value="{{ $quadra->id }}">{{ $quadra->nome }}</option>
                                        @endforeach

                                        </select>
                                    </div>
                                </div>

                                @endif


                                @if ($entry->tipo == 'Vertical')
                                <div class="col-md-4" id="box-torres" style="display: block">
                                    <label for="">Selecione as torres:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sort-numeric-desc"></i>
                                        </span>
                                        <select name="torres_alteracao[]" data-empreendimento="{{ $entry->id }}" multiple data-plugin-selectTwo class="form-control torres_multiplas" placeholder="Todas as torres">
                                            <option value="" disabled hidden>Selecione a torre</option>
                                            @foreach($entry->torres->where('status', 'Liberada') as $torre)
                                                <option value="{{ $torre->id }}">{{ $torre->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id="box-quadras-torres" style="display: none">
                                    <label for="">Selecione a torre:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sort-numeric-desc"></i>
                                        </span>
                                        <select class="form-control" name="torre_unidades" id="torre_unidades">
                                            <option value="" disabled hidden selected>Selecione a torre</option>
                                            @foreach($entry->torres->where('status', 'Liberada') as $torre)
                                                <option value="{{ $torre->id }}">{{ $torre->nome }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                @endif


                                @if ($entry->tipo == 'Vertical')
                                <div class="col-md-4" id="box-andares" style="display: block">
                                    <label for="">Selecione os andares:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sort-numeric-desc"></i>
                                        </span>
                                        <div class="andares_alteracao">
                                            <select class="form-control andares_multiplos" placeholder="Selecione" name="andar_alteracao[]" multiple data-plugin-selectTwo>
                                                <option value="" disabled hidden>Selecione o andar</option>
                                                @if ($andares)
                                                    @foreach($andares as $andar)
                                                        <option value="{{ $andar['numero'] }}">{{ $andar['numero'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if (count($entry->plantas) > 0)
                                <div class="col-md-4" id="box-plantas" style="display: none">
                                    <label for="">Selecione a planta:</label>
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sort-numeric-desc"></i>
                                        </span>

                                        <select class="form-control" name="planta_origem" id="plantas_alteracao">
                                            <option value="" disabled hidden selected>Selecione</option>
                                            @foreach($entry->plantas as $planta)
                                            <option value="{{ $planta->id }}">{{ $planta->nome }} - {{ converte_valor_real($planta->area_privativa) }}m²</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                @endif

                                <div class="col-md-8" id="box-unidades" style="display: none"></div>

                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="colunas-padding btn-aplicar-alteracao">
                            <button class="btn btn-primary aplicar-alteracao alterar-lote" id="aplicar-alteracao" data-empreendimento="{{ $entry->id }}" data-tipo="{{ $entry->tipo }}" style="display: block;">Aplicar</button>
                            <button class="btn btn-primary aplicar-alteracao2 alterar-lote" id="aplicar-alteracao2" data-empreendimento="{{ $entry->id }}" data-tipo="{{ $entry->tipo }}" style="display: none;" >Aplicar</button>
                        </div>

                    </div>
                </section>
                @endif

                <section class="panel">
                    <header class="panel-heading">
                        <div class="col-md-2">
                            <h2 class="panel-title">Filtros</h2>
                        </div>
                        <div class="col-md-10">
                            <div style="display: inline-block;">
                                <div style="width:10px; padding: 5px; background: red; border: 1px solid black"></div>
                            </div>
                            <div style="display: inline-block; padding-right: 50px">
                                <strong style="color: black">Vendido</strong>
                            </div>
                            <div style="display: inline-block;">
                                <div style="width:10px; padding: 5px; background: green; border: 1px solid black"></div>
                            </div>
                            <div style="display: inline-block;padding-right: 50px">
                                <strong style="color: black">Disponível</strong>
                            </div>
                            <div style="display: inline-block;">
                                <div style="width:10px; padding: 5px; background: orange; border: 1px solid black"></div>
                            </div>
                            <div style="display: inline-block;padding-right: 50px">
                                <strong style="color: black">Reservado</strong>
                            </div>
                            <div style="display: inline-block;">
                                <div style="width:10px; padding: 5px; background: blue; border: 1px solid black"></div>
                            </div>
                            <div style="display: inline-block;padding-right: 50px">
                                <strong style="color: black">Outros</strong>
                            </div>
                        </div>
                        <div style="padding: 10px"></div>
                    </header>
                    <div class="panel-body">
                        <form class="form-horizontal form-bordered" action="#">
                            <input type="hidden" name="empreendimento_id" value="{{ $entry->id }}" id="empreendimento_id">
                            <div class="form-group">
                                @if ($entry->tipo == 'Horizontal')
                                    <div class="col-md-3">
                                        <div class="input-group btn-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-sort-numeric-desc"></i>
                                            </span>
                                            <select class="form-control" placeholder="Selecione" data-plugin-multiselect name="quadra_id" id="quadra">
                                                <option value="Todas">Todas as quadras</option>
                                                @foreach($entry->quadras->where('status', 'Liberada') as $quadra)
                                                    <option value="{{ $quadra->id }}">{{ $quadra->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if ($entry->tipo == 'Vertical')
                                    <div class="col-md-3">
                                        <div class="input-group btn-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                            <select class="form-control" placeholder="Selecione" data-plugin-multiselect name="torre_id" id="torre">
                                                <option value="Todas">Todas as torres</option>
                                                @foreach($entry->torres->where('status', 'Liberada') as $torre)
                                                    <option value="{{ $torre->id }}">{{ $torre->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group btn-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-sort-numeric-desc"></i>
                                            </span>
                                            <select class="form-control" placeholder="Selecione" data-plugin-multiselect name="andar_id" id="andar">
                                                <option value="Todas">Todas os andares</option>
                                                @if ($andares)
                                                    @foreach($andares as $andar)
                                                        <option value="{{ $andar['numero'] }}">{{ $andar['numero'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if ($entry->plantas)
                                <div class="col-md-3">
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-codepen"></i>
                                        </span>
                                        <select class="form-control" placeholder="Selecione" data-plugin-multiselect name="planta_id" id="planta">
                                            <option value="Todas">Todas as plantas</option>
                                            @foreach($entry->plantas as $planta)
                                                <option value="{{ $planta->id }}">{{ $planta->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif

                                <div class="col-md-3">
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-check-square-o"></i>
                                        </span>

                                        <select class="form-control" placeholder="Selecione" data-plugin-multiselect name="situacao" id="situacao">
                                            <option value="Todas">Todas as situações</option>
                                            @if ($entry->torres)
                                            <option value="Disponível">Disponível</option>
                                            <option value="Vendida">Vendida</option>
                                            <option value="Reservada">Reservada</option>
                                            <option value="Outros">Outros</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 bloco-vertical">
                @if ($entry->tipo == 'Vertical')
                    @include('admin.empreendimentos.desktop.empreendimento.unidade.botoes_mapa')
                    @php
                        $sorted = $entry->torres->where('status', 'Liberada')->sortBy('id');
                    @endphp

                    @foreach ($sorted as $torre)
                        <a
                            class="btn btn-primary btn-cores btn-torre"
                            href="/admin/empreendimento/{{ $entry->id }}/unidades?torre={{ $torre->id }}"
                            @if ($torre_selecionada == $torre->id)
                                style="background: green; color: white"
                            @endif
                        >
                            {{ $torre->nome }}
                        </a>
                    @endforeach
                @endif

                @if ($entry->tipo == 'Horizontal')
                    @php
                        $sorted = $entry->quadras->where('status', 'Liberada')->sortBy('id');
                    @endphp

                    <div class="todas-quadras">
                        <a
                            class="btn btn-primary btn-cores"
                            href="/admin/empreendimento/{{ $entry->id }}/unidades"
                            @if ($quadra_selecionada == null)
                                style="background: #006666; color: white"
                            @endif
                        >
                        <i class="fa fa-th-large" aria-hidden="true"></i> Todas as quadras
                        </a>
                        @include('admin.empreendimentos.desktop.empreendimento.unidade.botoes_mapa')
                    </div>

                    <div class="quadras">
                    @foreach ($sorted as $quadra)
                        @php
                            $total_outros = $quadra->unidades->where('situacao', 'Outros')->count();
                            $total_vendido = $quadra->unidades->where('situacao', 'Vendida')->count();
                            $total_geral = $quadra->unidades->where('situacao', '<>', 'Excluído')->count();

                            if($total_outros == $total_geral){
                                $btn = "btn-outros";
                                $title = "Todas as Unidades Bloquedas (Unidades em Estoque / Permuta)";
                            }elseif($total_vendido == $total_geral){
                                $btn = "btn-danger";
                                $title = "Todas as Unidades Vendidas";
                            }else{
                                $btn = "btn-primary";
                                $title = "Unidades";
                            }

                            if($quadra_selecionada == $quadra->id){
                                $btn = "btn-default";
                            }

                        @endphp
                        <div class="box-quadra" title="{{ $title }}">
                            <a
                                class="btn {{ $btn }} btn-cores btn-quadra"
                                href="/admin/empreendimento/{{ $entry->id }}/unidades?quadra={{ $quadra->id }}">
                            <i class="fa fa-th-large" aria-hidden="true"></i> {{ $quadra->nome }}
                            </a>
                        </div>

                    @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="pull-right">

            @if ($entry->getFotoTipo('Mapa de Vagas') && $entry->garagens->count() > 0)
            <a class="btn btn-primary btn-acao-mapa" rel="tooltip" data-original-title="Visualizar vagas no Mapa" href="/empreendimento/{{ $entry->id }}/{{ Auth::user()->id*37 }}/visualizar-garagens/view" target="_blank">
                <i class="fa fa-car" aria-hidden="true"></i>
            </a>
            @endif

            @if ($entry->tipo == 'Horizontal' && $entry->getFotoTipo('Implantação') && $entry->unidades->count() > 0)
            <a class="btn btn-primary btn-acao-mapa" rel="tooltip" data-original-title="Visualizar unidades no Mapa" href="/empreendimento/{{ $entry->id }}/{{ Auth::user()->id*37 }}/visualizar-mapa/view" target="_blank">
                <i class="fa fa-map" aria-hidden="true"></i>
            </a>

            <a data-toggle="modal" data-target="#copiarLink" class="btn btn-primary btn-copiar-linkMapa" rel="tooltip" data-original-title="Copiar link do Mapa">
                <i class="fa fa-external-link" aria-hidden="true"></i>
            </a>
            @endif

            <!--<a class="btn btn-primary btn-acao-print" rel="tooltip" data-original-title="Imprimir Unidades" href="{{ route('imprimir-disponibilidade', $entry->id) }}" target="_blank">
                <i class="fa fa-print"></i>
            </a> -->

            <a class="btn btn-primary btn-acao-pdf" href="{{ route('imprimir-disponibilidade-pdf', $entry->id) }}" target="_blank" rel="tooltip" data-original-title="Gerar PDF das Unidades">
                <i class="fa fa-file-pdf-o"></i>
            </a>

            <a class="btn btn-primary btn-acao-print mg-r-10" href="{{ route('imprimir-disponibilidade', $entry->id) }}" target="_blank" rel="tooltip" data-original-title="Gerar Impressão das Unidades">
                <i class="fa fa-print"></i>
            </a>

        </div>

        <div class="resumo-unidades">
            <div class="und-disponiveis" rel="tooltip" data-original-title="Total de Unidades Disponíveis"><div class="qtd">{{ $entry->unidades->where('situacao', 'Disponível')->count() }}</div><div class="cor"></div></div>
            <div class="und-vendidas" rel="tooltip" data-original-title="Total de Vendidas"><div class="qtd">{{ $entry->unidades->where('situacao', 'Vendida')->count() }}</div><div class="cor"></div></div>
            <div class="und-reservadas" rel="tooltip" data-original-title="Total de Unidades Reservadas"><div class="qtd">{{ $entry->unidades->where('situacao', 'Reservada')->count() }}</div><div class="cor"></div></div>
            <div class="und-outros" rel="tooltip" data-original-title="Outros (Unidades em Estoque / Permuta)"><div class="qtd">{{ $entry->unidades->where('situacao', 'Outros')->count() }}</div><div class="cor"></div></div>
        </div>

        <div class="row">
            <div class="col-md-12" id="unidades">
                @if ($entry->tipo == 'Vertical')
                    @if ($torre_selecionada)
                      @include('admin.empreendimentos.desktop.empreendimento.unidade.andares_bloco')
                    @else
                      @foreach ($entry->torres->where('status', 'Liberada') as $torre)
                        @include('admin.empreendimentos.desktop.empreendimento.unidade.andares_bloco')
                      @endforeach
                    @endif
                @endif

                @if ($entry->tipo == 'Horizontal')
                    @if ($quadra_selecionada)
                      @include('admin.empreendimentos.desktop.empreendimento.unidade.quadras_bloco')
                    @else
                      @foreach ($entry->quadras->where('status', 'Liberada') as $quadra)
                        @include('admin.empreendimentos.desktop.empreendimento.unidade.quadras_bloco')
                      @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="alterarInfoUnidade" tabindex="-1" role="dialog" aria-labelledby="alterarUnidadeLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="alterarUnidadeLabel"></h4>
          </div>
          <div class="modal-body"></div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="InfoUnidade" tabindex="-1" role="dialog" aria-labelledby="alterarUnidadeLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="alterarUnidadeLabel"></h4>
            </div>
            <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="alterarReservaUnidade" tabindex="-1" role="dialog" aria-labelledby="alterarUnidadeLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="alterarUnidadeLabel"></h4>
            </div>
            <div class="modal-body"></div>
          </div>
        </div>
      </div>


    <div class="modal fade" id="copiarLink" tabindex="-1" role="dialog" aria-labelledby="alterarUnidadeLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="alterarUnidadeLabel"><i class="fa fa-share-alt-square"></i> Selecione o link que deseja compartilhar</h4>
            </div>
            <div class="modal-body">

                <input type="text" name="link-mapa-user" class="input-link-mapa link-mapa-user" value="{{ URL::to('/') }}/empreendimento/{{ $entry->id }}/{{ Auth::user()->id*37 }}/visualizar-mapa/user">
                <button class="btn btn-primary ladda-button link-user"><i class="fa fa-chain"></i> Link com minha foto e informações de contato</button>

                <input type="text" name="link-mapa-construtora" class="input-link-mapa link-mapa-construtora" value="{{ URL::to('/') }}/empreendimento/{{ $entry->id }}/{{ $entry->id*37 }}/visualizar-mapa/construtora">
                <button class="btn btn-primary ladda-button link-construtora"><i class="fa fa-chain"></i> Link com informações da construtora</button>

                <input type="text" name="link-mapa-externo" class="input-link-mapa link-mapa-externo" value="{{ URL::to('/') }}/empreendimento/{{ $entry->id }}/{{ $entry->id*37 }}/visualizar-mapa/externo">
                <button class="btn btn-primary ladda-button link-externo"><i class="fa fa-chain"></i> Link sem informações de contato</button>

            </div>
            </div>
        </div>
    </div>

    <script src="/assets/javascripts/unidade/index.js?v={{ filemtime('assets/javascripts/unidade/index.js') }}"></script>
@endsection

@push('after_styles')
<link rel="stylesheet" href="/assets/vendor/select2/css/select2.css" />
@endpush

@push('after_scripts')
    <script src="/assets/vendor/select2/js/select2.js"></script>

    <script language="JavaScript">

        var copyLinkUser = document.querySelector('.link-user');
        copyLinkUser.addEventListener('click', function(event) {
            var linkUser = document.querySelector('.link-mapa-user');
            linkUser.select();

            try {
                document.execCommand('copy');
                Swal.fire(
                    'OK!',
                    'Link copiado para área de transferência!',
                    'success'
                )
            } catch (err) {
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'error'
                )
            }
        });

        var copyLinkConstrutora = document.querySelector('.link-construtora');
        copyLinkConstrutora.addEventListener('click', function(event) {
            var linkConstrutora = document.querySelector('.link-mapa-construtora');
            linkConstrutora.select();

            try {
                document.execCommand('copy');
                Swal.fire(
                    'OK!',
                    'Link copiado para área de transferência!',
                    'success'
                )
            } catch (err) {
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'error'
                )
            }
        });

        var copyLinkExterno = document.querySelector('.link-externo');
        copyLinkExterno.addEventListener('click', function(event) {
            var linkExterno = document.querySelector('.link-mapa-externo');
            linkExterno.select();

            try {
                document.execCommand('copy');
                Swal.fire(
                    'OK!',
                    'Link copiado para área de transferência!',
                    'success'
                )
            } catch (err) {
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'error'
                )
            }
        });

    </script>

@endpush


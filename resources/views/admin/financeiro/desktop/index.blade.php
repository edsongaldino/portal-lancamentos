@extends('backpack::layout')
@section('header')
<header class="page-header">
  <h2>{{ trans('backpack::base.my_account') }}</h2>
  
  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a>
      </li>
      
      <li>
        <a href="{{ route('leads') }}">Minha conta</a>
      </li>
    </ol>
    
    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
@endsection

@section('content')
<section class="panel">

<div class="row">

    @include('admin/financeiro/desktop/msg_bloqueio')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">                
                <div class="form-group">
                    <label>Filtrar por Empreendimento</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-building"></i>
                        </span>                                            
                        <select data-construtora="{{ get_construtora_id() }}" class="form-control select-empreendimento" name="empreendimento_id" id="empreendimento_id">
                            <option value="">Todos</option>
                            @foreach (get_empreendimentos() as $empreendimento)
                                <option value="{{ $empreendimento->id }}" 
                                @if ($empreendimento->id == $empreendimento_id)
                                @php $empreendimento_tipo = $empreendimento->tipo; $empreendimento_select = $empreendimento; @endphp
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
        </div>        
    </div>


    <div class="col-md-3">
        <section class="panel">
            <div class="panel-body bg-tertiary">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-building"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Unidades Disponíveis</h4>
                            <div class="info">
                                <strong class="amount">{{ unidades('Disponível', $empreendimento_id, $construtora_id) }}</strong>
                            </div>
                        </div>
                        <div class="summary-footer" style="text-align: left;">
                            <span style="font-size: 16px; color: white;">
                                @php
                                    $vgv_unidades_disponiveis = converte_valor_real(0);

                                    $vgv_unidades_disponiveis_construtora = total_valor_unidade($construtora_id, $empreendimento_id, 'Disponível');

                                    if ($vgv_unidades_disponiveis_construtora) {
                                        $vgv_unidades_disponiveis = converte_valor_real($vgv_unidades_disponiveis_construtora);
                                    }
                                @endphp

                                VGV {{ $vgv_unidades_disponiveis }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-3">
        <section class="panel">
            <div class="panel-body bg-secondary">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Unidades Vendidas</h4>
                            <div class="info">
                                <strong class="amount">{{ unidades('Vendida', $empreendimento_id, $construtora_id) }}</strong>
                            </div>
                        </div>
                        <div class="summary-footer" style="text-align: left;">
                            <span style="font-size: 16px; color: white;">
                                @php
                                    $vgv_unidades_vendidas = converte_valor_real(0);

                                    $vgv_unidades_vendidas_construtora = total_valor_unidade($construtora_id, $empreendimento_id, 'Vendida');

                                    if ($vgv_unidades_vendidas_construtora) {
                                        $vgv_unidades_vendidas = converte_valor_real($vgv_unidades_vendidas_construtora);
                                    }
                                @endphp

                                VGV {{ $vgv_unidades_vendidas }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>    
    <div class="col-md-3">
        <section class="panel">
            <div class="panel-body bg-primary">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-thumbs-up"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Honorários de venda</h4>                                
                        </div>
                        <div class="summary-footer" style="text-align: left;">
                            <span style="font-size: 16px; color: white;">
                                @php
                                    $vgv_total = converte_valor_real(0);

                                    $vgv_honorarios = total_valor_honorario($construtora_id, $empreendimento_id);

                                    if ($vgv_honorarios) {
                                        $vgv_total = converte_valor_real($vgv_honorarios);
                                    }
                                @endphp

                                VGC {{ $vgv_total }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-3">
        <section class="panel">
            <div class="panel-body bg-quartenary">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-usd"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title" style="color: white">Total Unidades</h4>
                            <div class="info">
                                <strong class="amount" style="color: white">{{ unidades('Todas', $empreendimento_id, $construtora_id) }}</strong>
                            </div>
                        </div>
                        <div class="summary-footer" style="text-align: left;">
                            <span style="font-size: 16px; color: white;">
                                @php
                                    $vgv_unidades = converte_valor_real(0);

                                    $vgv_geral = total_vgv_geral($construtora_id, $empreendimento_id);

                                    if ($vgv_geral) {
                                        $vgv_unidades = converte_valor_real($vgv_geral);
                                    }
                                @endphp

                                VGV {{ $vgv_unidades }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tabs lista-vendas">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#popular" data-toggle="tab"><i class="fa fa-star"></i> Minhas Vendas</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="popular" class="tab-pane active">
                    <div class="panel-body">
                        <section class="panel filtro">
                            <header class="panel-heading">       
                                <div class="col-md-12">
                                    <h2 class="panel-title">Filtros</h2>    
                                </div>
                            </header>
                            <div class="panel-body form-filtro">
                                <form class="form-horizontal form-bordered" name="filtrar_vendas" id="filtrar_vendas" method="GET" data-construtora="{{ get_construtora_id() }}" data-empreendimento="{{ $empreendimento_id }}">
                                    @if (isset($empreendimento_id))
                                    <input type="hidden" name="empreendimento_id" value="{{ $empreendimento_id }}" id="empreendimento_id">
                                    @endif
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <div class="input-group btn-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                                <input type="text" class="form-control nome-comprador" name="nome_comprador" id="" placeholder="Nome do comprador" value="{{ $nome_comprador }}">
                                            </div>
                                        </div>  

                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" id="date" name="data_compra" data-plugin-masked-input="" data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control" value="{{ data_br($data_compra) }}">
                                            </div>
                                        </div>
                                        @if (isset($empreendimento_id))
                                        @if (($empreendimento_tipo ?? '') == 'Horizontal')
                                        <div class="col-md-2">
                                            <div class="input-group btn-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-th-list"></i>
                                                </span>
                                                <select class="form-control campo-filtro" name="quadra_id" id="quadra_filtro">
                                                    <option value="" selected>Selecione a Quadra</option>
                                                    @foreach($empreendimento_select->quadras->where('status', 'Liberada') as $quadra)
                                                    <option value="{{ $quadra->id }}">{{ $quadra->nome }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                        @if (($empreendimento_tipo ?? '') == 'Vertical')
                                        <div class="col-md-2">
                                            <div class="input-group btn-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-th-list"></i>
                                                </span>
                                                <select class="form-control campo-filtro" name="torre_id" id="torre_filtro">
                                                    <option value="" selected>Selecione a Torre</option>
                                                    @foreach($empreendimento_select->torres->where('status', 'Liberada') as $torre)
                                                    <option value="{{ $torre->id }}">{{ $torre->nome }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        @endif

                                        <div class="col-md-2" id="box-unidades">
                                            <div class="input-group btn-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-th-list"></i>
                                                </span>
                                                <select class="form-control campo-filtro" name="unidade_id" id="unidade">
                                                    <option value="" selected disabled>Selecione</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary botao-filtrar"><i class="fa fa-search"></i> Filtrar</button>
                                        </div>

                                    </div> 

                                </form>
                            </div>
                        </section>

                                    
                        <table class="table table-bordered table-striped mb-none">
                            <thead>
                                <tr>
                                    <th>Data da compra</th>
                                    <th>Nome do comprador</th>
                                    <th>Empreendimento</th>
                                    <th class="hidden-phone">Unidade</th>
                                    <th class="hidden-phone">Valor da Venda</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php                                    
                                    if (isAdmin() && !$construtora_id) {
                                        $compradores = $vendas::select('unidades.*', 
                                                'compradores_unidades.nome as nome_comprador', 
                                                'compradores_unidades.cpf', 
                                                'compradores_unidades.email', 
                                                'compradores_unidades.celular', 
                                                'compradores_unidades.email', 
                                                'compradores_unidades.estado_civil', 
                                                'compradores_unidades.nome_esposa', 
                                                'compradores_unidades.origem_venda', 
                                                'compradores_unidades.nome_corretor', 
                                                'compradores_unidades.creci_corretor', 
                                                'compradores_unidades.telefone_corretor', 
                                                'compradores_unidades.percentual_honorario', 
                                                'compradores_unidades.valor_honorario', 
                                                'compradores_unidades.valor',
                                                'compradores_unidades.data')
                                            ->leftjoin('compradores_unidades', function ($j) {
                                                $j->on('compradores_unidades.unidade_id', '=', 'unidades.id')
                                                    ->where('unidades.situacao', 'Vendida');
                                            })->join('empreendimentos', function ($j) {
                                                $j->on('empreendimentos.id', '=', 'unidades.empreendimento_id')
                                                    ->where('empreendimentos.status', 'Liberada');
                                            })->where('unidades.situacao', 'Vendida')->orderby('compradores_unidades.data', 'DESC');
                                            

                                        if ($empreendimento_id) {
                                            $compradores->where('unidades.empreendimento_id', $empreendimento_id);
                                        }

                                        if ($nome_comprador) {
                                            $compradores->where('compradores_unidades.nome', 'like', '%'.$nome_comprador.'%');
                                        }

                                        if ($data_compra) {
                                            $compradores->where('compradores_unidades.data', $data_compra);
                                        }

                                        if ($quadra_filtro) {
                                            $compradores->where('unidades.quadra_id', $quadra_filtro);
                                        }

                                        if ($torre_filtro) {
                                            $compradores->where('unidades.torre_id', $torre_filtro);
                                        }

                                        if ($unidade_filtro) {
                                            $compradores->where('unidades.id', $unidade_filtro);
                                        }

                                        $compradores = $compradores->paginate(10);

                                    } else {
                                        $compradores = $construtora->unidades()
                                            ->select('unidades.*', 
                                                'compradores_unidades.nome as nome_comprador', 
                                                'compradores_unidades.cpf', 
                                                'compradores_unidades.email', 
                                                'compradores_unidades.celular', 
                                                'compradores_unidades.email', 
                                                'compradores_unidades.estado_civil', 
                                                'compradores_unidades.nome_esposa', 
                                                'compradores_unidades.origem_venda', 
                                                'compradores_unidades.nome_corretor', 
                                                'compradores_unidades.creci_corretor', 
                                                'compradores_unidades.telefone_corretor', 
                                                'compradores_unidades.percentual_honorario', 
                                                'compradores_unidades.valor_honorario', 
                                                'compradores_unidades.valor',
                                                'compradores_unidades.data')
                                            ->leftjoin('compradores_unidades', function ($j) {
                                                $j->on('compradores_unidades.unidade_id', '=', 'unidades.id')
                                                    ->where('unidades.situacao', 'Vendida');
                                            })->join('empreendimentos', function ($j) {
                                                $j->on('empreendimentos.id', '=', 'unidades.empreendimento_id')
                                                    ->where('empreendimentos.status', 'Liberada');
                                            })->where('unidades.situacao', 'Vendida')->orderby('compradores_unidades.data', 'DESC');

                                        if ($empreendimento_id) {
                                            $compradores->where('unidades.empreendimento_id', $empreendimento_id);
                                        }

                                        if ($nome_comprador) {
                                            $compradores->where('compradores_unidades.nome', 'like', '%'.$nome_comprador.'%');
                                        }

                                        if ($data_compra) {
                                            $compradores->where('compradores_unidades.data', $data_compra);
                                        }

                                        if ($quadra_filtro) {
                                            $compradores->where('unidades.quadra_id', $quadra_filtro);
                                        }

                                        if ($torre_filtro) {
                                            $compradores->where('unidades.torre_id', $torre_filtro);
                                        }

                                        if ($unidade_filtro) {
                                            $compradores->where('unidades.id', $unidade_filtro);
                                        }

                                        $compradores = $compradores->paginate(10);
                                    }                                    
                                @endphp

                                @foreach($compradores as $c)
                                    @include('admin.financeiro.desktop.lista_compradores')
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" align="center">
                                        {{ $compradores->appends(['empreendimento_id' => $empreendimento_id, 'quadra_id' => $quadra_filtro, 'data_compra' => $data_compra])->links() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Specific Page Vendor -->
<script src="/assets/javascripts/unidade/index.js?v={{ filemtime('assets/javascripts/unidade/index.js') }}"></script>
<script src="/assets/javascripts/financeiro/index.js?v={{ filemtime('assets/javascripts/financeiro/index.js') }}"></script>
@endsection

@push('after_styles')
<link rel="stylesheet" href="/assets/vendor/select2/css/select2.css?v={{ filemtime('assets/vendor/select2/css/select2.css') }}" />
@endpush

@push('after_scripts')
    <script src="/assets/vendor/select2/js/select2.js"></script>
    <script type="text/javascript">
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endpush

@push('after_scripts')
    <script src="/assets/vendor/select2/js/select2.js"></script>
    <script src="/assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="/assets/javascripts/ui-elements/examples.modals.js"></script>
@endpush
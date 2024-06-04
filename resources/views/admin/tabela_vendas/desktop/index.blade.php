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
        Tabela de Vendas
      </li>
    </ol>

    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
@endsection

@section('content')

<div class="col-md-12">
    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <label>Filtrar por Empreendimento</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    <select data-construtora="{{ get_construtora_id() }}" class="form-control select-empreendimento" name="buscaEmpreendimento_id" id="empreendimento_id">
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

        <div class="col-md-3 al-rigth">
            <a
            class="btn btn-lg btn-primary btn-tabela-add"
            href="{{ route('nova-tabela') }}">
            <i class="fa fa-plus-square"></i> Adicionar tabela
            </a>
        </div>


    </div>
</div>


<div class="col-sm-12">
    <div class="row m-b-10">
        <div class="col-sm-3 hidden-print with-border">

        </div>
    </div>


    <div class="row">

        <div class="pricing-table">

            @foreach ($tabelas as $tabela)
            <div class="col-lg-4 col-sm-6">
                <div class="plan most-popular">

                    <h3 class="nome-empreendimento"><i class="fa fa-briefcase"></i> Tabela {{ $tabela->tipo->nome ?? '' }}</h3>
                    <div class="nome-tabela"><i class="fa fa-building"></i> {{ $tabela->empreendimento->nome ?? '' }} </div>
                    <ul class="itens-tabela">
                        <li><span class="item">Entrada:</span><span class="valor">{{ $tabela->percentual_entrada }}%</span></li>
                        <li><span class="item">Mensais:</span><span class="valor"><b>{{ $tabela->qtd_mensais }}</b> ({{ $tabela->percentual_mensais }}%)</span></li>
                        <li><span class="item">Balões:</span><span class="valor"><i data-toggle="tooltip" data-placement="top" data-html="true"

                        title='
                            @php
                            $i = 1;
                            @endphp
                            @foreach($tabela->baloes as $balao)
                            <dic class="linha-balao-info"><b>Balão {{ $i }} </b>- <i class="fa fa-calendar"></i> {{ data_br($balao->data_balao) }}</div>
                            @php $i = $i+1; @endphp
                            @endforeach
                        ' class="fa fa-plus-circle baloes"></i> <b>{{ $tabela->qtd_baloes }}</b> ({{ $tabela->percentual_baloes }}%)</span>

                        </li>
                        <li><span class="item">Financiamento:</span><span class="valor">{{ $tabela->percentual_remanescente }}%</span></li>
                        <li><span class="item-desconto">Desconto á vista:</span><span class="valor">{{ $tabela->desconto_avista }}%</span></li>
                        <li><span class="item">Tabela válida até:</span><span class="valor"><i class="fa fa-calendar"></i> {{ data_br($tabela->validade_tabela) }}</span></li>
                    </ul>

                    <div class="botoes-acao-tabela">
                        <a class="btn btn-lg btn-editarTabela btn-warning" href="{{ route('editar-tabela', $tabela->id) }}"><i class="fa fa-edit"></i> Editar</a>
                        <a class="btn btn-lg btn-excluirTabela btn-danger" data-id="{{ $tabela->id }}" data-url="{{ route('excluir-tabela', $tabela->id) }}"><i class="fa fa-close"></i> Excluir</a>
                    </div>

                </div>
            </div>
            @endforeach


        </div>

    </div>

</div>
<script src="/assets/javascripts/tabela-vendas/index.js"></script>
@endsection

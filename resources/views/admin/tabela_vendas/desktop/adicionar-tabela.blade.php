@extends('backpack::layout')

@section('header')
<header class="page-header">
  <h2>Adicionar - Tabela de Vendas</h2>

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

<form action="{{ route('gravar-tabela') }}" id="formTabelaVendas" name="formTabelaVendas" method="POST">
@include('admin/tabela_vendas/desktop/form')
<button id="salvar-tabela" class="btn btn-info gravar-tabela modal-confirm"><i class="fa fa-save"></i> Gravar Tabela de Vendas</button>
</form>

<!-- Modal Form -->
<div id="modalForm" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Incluir Tipo de Tabela</h2>
        </header>
        <div class="panel-body">
            <form id="form-tipoTabela" class="form-horizontal mb-lg" method="POST" action="{{ route("gravar-tipo-tabela") }}">
                @csrf
                <input type="hidden" name="construtora_id" id="construtora_id" value="{{ get_construtora_id() }}">
                <div class="form-group form-tipo">
                    <label>Nome da Tabela</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-outdent"></i>
                        </span>
                        <input class="form-control select-empreendimento" name="nome" id="nome" placeholder="" required>
                    </div>
                </div>
                
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-default modal-dismiss">Fechar</button>
                    <button id="salvar-tipo-tabela" class="btn btn-primary modal-confirm"><i class="fa fa-save"></i> Gravar</button>
                </div>
            </div>
        </footer>
    </section>
</div>

<script src="/assets/javascripts/tabela-vendas/index.js"></script>
@endsection

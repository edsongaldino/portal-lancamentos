@extends('backpack::base.layout2')
@section('content')
    <header class="page-header">
        <h2>Empreendimento</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span><a href="/admin">Início</a></span></li>
                <li><span><a href="/admin/empreendimento">Empreendimento</a></span></li>
            </ol>
    
            <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">
        @include('admin/financeiro/desktop/msg_bloqueio')
    </div>

    @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
    <div class="row">
        @include('admin/oferta/desktop/banner_oferta')
    </div>

    <div class="col-sm-12">
        <div class="row m-b-10">
            <div class="hidden-print with-border">
                <a href="{{ route('empreendimento.criar') }}" class="btn btn-primary ladda-button btn-adicionar" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Adicionar empreendimento</span></a>
            </div>
        </div>
    </div>
    @endif

    <div style="clear:both; margin-bottom: 10px"></div>

    <div class="row">
        <div class="col-xs-12">

            <section class="panel">
                <div class="panel-body">
                    
                        <div class="form-group">
                            <div class="col-md-5">
                                <div class="input-group btn-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input placeholder="Digite o nome do empreendimento e pressione ENTER" type="text" class="form-control" id="nome-empreendimento">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="input-group btn-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sort-numeric-desc"></i>
                                    </span>
                                    <select class="form-control subtipo_id" placeholder="Selecione" data-plugin-multiselect id="ms_example4">
                                        <option value="Todas">Todos os subtipos</option>
                                        @foreach (get_subtipos() as $subtipo)
                                            <option value="{{ $subtipo->id }}">{{ $subtipo->nome }}</option>
                                        @endforeach                                            
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group btn-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-codepen"></i>
                                    </span>
                                    <select class="form-control cidade_id" placeholder="Selecione" data-plugin-multiselect id="ms_example4">
                                        <option value="Todas">Todas as cidades</option>
                                        @foreach (get_cidades() as $cidade)
                                            <option value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="input-group btn-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-check-square-o"></i>
                                    </span>
                                    <select class="form-control status" placeholder="Selecione" data-plugin-multiselect id="ms_example4">
                                        <option value="Todas">Todas as situações</option>
                                        <option value="Liberada">Publicado(s)</option>
                                        <option value="Bloqueada">Bloqueado(s)</option>
                                    </select>
                                </div>
                            </div>
                                            
                        </div>        

                </div>
            </section>
        </div>
    </div>
    
    <div id="lista_empreendimentos">
        @include('admin/empreendimentos/desktop/empreendimento/lista')
    </div>
    <!-- end: page -->        
@endsection

@push('after_scripts')
<script src="/assets/javascripts/empreendimento/filtro.js?v={{ filemtime('assets/javascripts/empreendimento/filtro.js') }}"></script>
@endpush
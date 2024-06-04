@extends('admin.empreendimentos.desktop.empreendimento.layout')
@section('conteudo_empreendimento')
    <div class="col-md-8 col-lg-7">
        @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
        <div class="row">
            <div class="col-md-12">
                <div class="toggle" data-plugin-toggle>
                    <section class="toggle active">
                        <label><i class="fa fa-building"></i>@if (isset($quadra)) {{ $quadra->nome }} @else Quadra @endif</label>
                        <div class="toggle-content">
                            <section class="panel">
                                <div class="panel-body">
                                    <form @if (isset($quadra))id="atualizar-dados-quadra" @else id="cadastrar-dados-quadra" @endif  class="form-horizontal form-bordered quadra">                            
                                        <input type="hidden" name="id" value="@if (isset($quadra)){{ $quadra->id }}@endif">
                                        <input type="hidden" name="empreendimento_id" value="{{ $entry->id }}">

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nome da Quadra</label>
                                            <div class="col-md-6">
                                                <input class="form-control" data-plugin-maxlength maxlength="20" name="nome" @if (isset($quadra))value="{{ $quadra->nome }}"@endif />
                                            </div>


                                            <label class="col-md-2 control-label">Total de unidades:</label>
                                            <div class="col-md-2">
                                                <input class="form-control" type="number" min="1" name="total_unidades" @if (isset($quadra))value="{{ $quadra->unidades }}"@endif>
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="col-md-2 control-label">Entrega (Previsão):</label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="date" class="form-control" name="previsao_entrega"  @if (isset($quadra))value="{{ $quadra->previsao_entrega }}"@endif>
                                                </div>
                                            </div>                                        

                                            <label class="col-md-2 control-label">Situação da quadra:</label>
                                            <div class="col-md-3">
                                                <select class="form-control" name="status">
                                                    <option value="Liberada" @if (isset($quadra) && $quadra->status == 'Liberada') selected="true" @endif>Liberada</option>
                                                    <option value="Bloqueada" @if (isset($quadra) && $quadra->status == 'Bloqueada') selected="true" @endif>Bloqueada</option>
                                                    <option value="Entregue" @if (isset($quadra) && $quadra->status == 'Entregue') selected="true" @endif>Entregue</option>
                                                </select>
                                            </div>
                                        </div>                                        
                                    </form>
                                </div>
                            </section>
                        </div>                        
                    </section>
                </div>
            </div>
        </div>
        
        <div class="pull-right">
            <button data-id="{{ $entry->id }}" @if (isset($quadra))id="atualizar-quadra" @else id="cadastrar-quadra" @endif type="button" class="mb-xs mt-xs mr-xs btn btn-success"><i class="fa fa-save"></i> Salvar Informações da Quadra</button>
        </div>
    </div>

    <div class="col-md-12 col-lg-2">

        <ul class="simple-card-list mb-xlg box-info-empreendimento">
            <li class="primary">
                <h3><i class="fa fa-braille"></i> {{ total_quadras($entry->id) }}</h3>
                <p>Quantidade de Quadras</p>
            </li>
        </ul>
      
    </div>

<script src="/assets/javascripts/quadra/index.js?v=01"></script>

@endsection

@push('after_styles')
<link rel="stylesheet" href="/assets/vendor/select2/select2.css" />
@endpush

@push('after_scripts')

<!-- Specific Page Vendor -->
<script src="/assets/vendor/gauge/gauge.js"></script>

<!-- Specific Page Vendor -->
<script src="/assets/vendor/select2/select2.js"></script>

<!-- Theme Initialization Files -->
<script src="/assets/javascripts/theme.init.js"></script>

<!-- Examples -->
<script src="/assets/javascripts/ui-elements/examples.charts.js"></script>

<!-- Examples -->
<script src="/assets/javascripts/forms/examples.advanced.form.js" /></script>

@endpush
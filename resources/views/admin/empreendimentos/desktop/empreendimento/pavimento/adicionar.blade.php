@extends('admin.empreendimentos.desktop.empreendimento.layout')
@section('conteudo_empreendimento')
<div class="col-md-10 col-lg-9">
  @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
  <div class="row">
    <div class="col-md-12">
      <div class="toggle" data-plugin-toggle>
        <section class="toggle active">
          <label><i class="fa fa-building"></i>@if (isset($pavimento)) {{ $pavimento->nome }} @else Pavimento @endif</label>
          <div class="toggle-content">
            <section class="panel">
              <div class="panel-body">
                <form @if (isset($pavimento))id="atualizar-dados-pavimento" @else id="cadastrar-dados-pavimento" @endif  class="form-horizontal form-bordered pavimento">                            
                  <input type="hidden" name="id" value="@if (isset($pavimento)){{ $pavimento->id }}@endif">
                  <input type="hidden" name="empreendimento_id" value="{{ $entry->id }}">
                  @include('admin/empreendimentos/desktop/empreendimento/pavimento/campos_form')
                  <div class="pull-right">
                    <button data-id="{{ $entry->id }}" @if (isset($pavimento))id="atualizar-pavimento" @else id="cadastrar-pavimento" @endif type="button" class="mb-xs mt-xs mr-xs btn btn-success"><i class="fa fa-save"></i> Salvar Informações do Pavimento</button>
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
</div>

<script src="/assets/javascripts/pavimento/index.js?v=01"></script>

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
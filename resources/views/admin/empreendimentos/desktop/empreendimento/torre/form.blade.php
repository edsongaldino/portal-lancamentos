@extends('admin.empreendimentos.desktop.empreendimento.layout')
@section('conteudo_empreendimento')
<div class="col-md-8 col-lg-7">
  @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
  <div class="row">
    <div class="col-md-12">
      <div class="toggle" data-plugin-toggle>
        <section class="toggle active">
          <label><i class="fa fa-building"></i>@if (isset($torre)) {{ $torre->nome }} @else Torre @endif</label>
          <div class="toggle-content">
            <section class="panel">
              <div class="panel-body">
                <form @if (isset($torre))id="atualizar-dados-torre" @else id="cadastrar-dados-torre" @endif  class="form-horizontal form-bordered torre">                            
                  <input type="hidden" name="id" value="@if (isset($torre)){{ $torre->id }}@endif">
                  <input type="hidden" name="empreendimento_id" value="{{ $entry->id }}">
                  @include('admin/empreendimentos/desktop/empreendimento/torre/campos_form')
                  <div class="pull-right">
                    <button data-id="{{ $entry->id }}" @if (isset($torre))id="atualizar-torre" @else id="cadastrar-torre" @endif type="button" class="mb-xs mt-xs mr-xs btn btn-success"><i class="fa fa-save"></i> Salvar Informações da Torre</button>
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

<div class="col-md-12 col-lg-2">

  <ul class="simple-card-list mb-xlg box-info-empreendimento">
    <li class="primary">
      <h3><i class="fa fa-braille"></i> {{ total_torres($entry->id) }}</h3>
      <p>Quantidade de Torres</p>
    </li>
  </ul>

</div>

<script src="/assets/javascripts/torre/index.js?v=01"></script>

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
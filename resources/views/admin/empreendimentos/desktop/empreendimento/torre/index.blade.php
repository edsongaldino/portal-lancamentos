@extends('admin.empreendimentos.desktop.empreendimento.layout')
@section('conteudo_empreendimento')
<div class="col-md-10 col-lg-9">
  @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
    
  <div class="col-md-12">
    <a href="{{ route('cadastrar-torre', $entry->id) }}"><button type="button" class="mb-xs mt-xs mr-xs btn btn-success incluir-torre"><i class="fa fa-plus"></i> Incluir torre (Manual)</button></a>

    <div class="pull-right">
      @if (isset($torres))  
        <button class="btn btn-primary">
          <i class="fa fa-columns"></i>
          {{ $torres->count() }} torres
        </button>
        <button class="btn btn-primary">
          <i class="fa fa-building"></i>
          @if ($torres->first())
            {{ $torres->first()->empreendimento->unidades->count() }} unidades
          @else
            0 unidades
          @endif
        </button>
      @endif
    </div>
  </div>  

  <div style="clear: both; margin-bottom: 20px; padding-bottom: 20px"></div>

  <div class="row">

    @foreach($torres as $torre)
    <div class="toggle" data-plugin-toggle data-toggle="collapse">
      <section class="toggle">
        <label>
          <i class="fa fa-building"></i>{{ $torre->nome }}
          <div class="pull-right" style="padding-right: 20px">
            <i class="fa fa-building" style="font-size: 20px"></i>
            {{ $torre->unidades->count() }} unidades  
          </div>        
        </label>        
        <div class="toggle-content">
          <section class="panel">
            <div class="panel-body">
              <form id="atualizar-dados-torre-{{ $loop->index }}" class="form-horizontal form-bordered torre">                            
                <input type="hidden" name="id" value="{{ $torre->id }}">
                <input type="hidden" name="empreendimento_id" value="{{ $torre->empreendimento->id }}">
                
                @include('admin/empreendimentos/desktop/empreendimento/torre/campos_form')

                <div class="form-group">
                  <div class="col-md-6">
                    <button data-id="{{ $torre->id }}" type="button" class="mb-xs mt-xs mr-xs btn btn-danger remover-torre"><i class="fa fa-close"></i> Excluir torre</button>
                  </div>
                  <div class="col-md-6">
                    <div class="pull-right">
                      <button data-form="#atualizar-dados-torre-{{ $loop->index }}" type="button" class="mb-xs mt-xs mr-xs btn btn-success salvar-torre"><i class="fa fa-save"></i> Salvar Informações da Torre</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </section>
    </div>
    @endforeach

  </div>
</div>

<script src="/assets/javascripts/torre/index.js?v=01"></script>
@endsection

@push('after_styles')
<style type="text/css">
  .form-bordered .form-group {
    border-bottom: none;
  }
</style>
@endpush
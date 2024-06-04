@extends('admin.empreendimentos.desktop.empreendimento.layout')


@section('conteudo_empreendimento')
<div class="col-md-10 col-lg-9">
  @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
  
  <div class="col-md-12">
    <a href="{{ route('cadastrar-quadra', $entry->id) }}"><button type="button" class="mb-xs mt-xs mr-xs btn btn-success incluir-quadra"><i class="fa fa-plus"></i> Incluir Quadra (Manual)</button></a>    
    <div class="pull-right">
      @if (isset($quadras))  
        <button class="btn btn-primary">
          <i class="fa fa-columns"></i>
          {{ $quadras->count() }} quadras
        </button>
        <button class="btn btn-primary">
          <i class="fa fa-home"></i>
          @if ($quadras->first())
            {{ $quadras->first()->empreendimento->unidades->count() }} unidades
          @else
            0 unidades
          @endif
        </button>
      @endif
    </div>
  </div>  

  @foreach($quadras as $quadra)
  <div class="toggle" data-plugin-toggle data-toggle="collapse">
    <section class="toggle">
      <label><i class="fa fa-building"></i>
        @if (isset($quadra)) 
          {{ $quadra->nome }}  
        @else 
          Quadra 
        @endif
        <div class="pull-right" style="padding-right: 20px">
          <i class="fa fa-home" style="font-size: 20px"></i>
          {{ $quadra->unidades->count() }} unidades  
        </div>        
      </label>
      <div class="toggle-content">
        <section class="panel">
          <div class="panel-body">
            <form id="atualizar-dados-quadra-{{ $loop->index }}" class="form-horizontal form-bordered quadra">                            
              <input type="hidden" name="id" value="@if (isset($quadra)){{ $quadra->id }}@endif">
              <input type="hidden" name="empreendimento_id" value="{{ $entry->id }}">

              @include('admin/empreendimentos/desktop/empreendimento/quadra/campos_form')

              <div class="form-group">
                <div class="col-md-6">
                  <button data-id="{{ $quadra->id }}" type="button" class="mb-xs mt-xs mr-xs btn btn-danger remover-quadra"><i class="fa fa-close"></i> Excluir quadra</button>
                </div>
                <div class="col-md-6">
                  <div class="pull-right">
                    <button data-form="#atualizar-dados-quadra-{{ $loop->index }}" type="button" class="mb-xs mt-xs mr-xs btn btn-success salvar-quadra"><i class="fa fa-save"></i> Salvar Informações da quadra</button>
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
<script src="/assets/javascripts/quadra/index.js?v=01"></script>
@endsection

@push('after_styles')
<style type="text/css">
  .form-bordered .form-group {
    border-bottom: none;
  }
</style>
@endpush
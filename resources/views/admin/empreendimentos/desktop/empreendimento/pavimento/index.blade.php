@extends('admin.empreendimentos.desktop.empreendimento.layout')
@section('conteudo_empreendimento')
<div class="col-md-10 col-lg-9">
  @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
    
  <div class="row">
    <div class="col-md-12">

      @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
      <a href="{{ route('cadastrar-pavimento', $entry->id) }}"><button type="button" class="mb-xs mt-xs mr-xs btn btn-success incluir-pavimento"><i class="fa fa-plus"></i> Incluir Pavimento (Manual)</button></a>
      @endif

    <div class="pull-right">
      @if (isset($pavimentos))  
        <button class="btn btn-primary">
          <i class="fa fa-columns"></i>
          {{ $pavimentos->count() }} pavimentos
        </button>
        <button class="btn btn-primary">
          <i class="fa fa-building"></i>
          @if ($entry->pavimentos)
            @php
              $total = 0;
            @endphp
            @foreach($pavimentos as $p)
              @php
                $total += $p->garagens->count();
              @endphp
            @endforeach
            {{ $total }} vagas
          @else
            0 garagens
          @endif
        </button>
      @endif
    </div>
  </div>
  </div>  

  <div class="pull-right">

      @if ($entry->getFotoTipo('Mapa de Vagas') && $entry->garagens->count() > 0)
      <a class="btn btn-primary btn-acao-editar-mapa" rel="tooltip" data-original-title="Editar vagas no Mapa" href="{{ url('admin/empreendimento/'.$entry->id.'/mapa-garagens') }}" target="_blank">
          <i class="fa fa-car" aria-hidden="true"></i> Editar Vagas
      </a> 

      <a class="btn btn-primary btn-acao-mapa" rel="tooltip" data-original-title="Visualizar vagas no Mapa" href="/empreendimento/{{ $entry->id }}/{{ $entry->id*37 }}/visualizar-garagens/view" target="_blank">
        <i class="fa fa-car" aria-hidden="true"></i>
      </a> 

      @endif   

      <a class="btn btn-primary btn-acao-print" rel="tooltip" data-original-title="Imprimir Unidades" href="{{ route('imprimir-disponibilidade', $entry->id) }}" target="_blank">
          <i class="fa fa-print"></i>
      </a> 

      <a class="btn btn-primary btn-acao-pdf" href="{{ route('imprimir-disponibilidade-pdf', $entry->id) }}" target="_blank" rel="tooltip" data-original-title="Gerar PDF das Unidades">
          <i class="fa fa-file-pdf-o"></i>
      </a>    

  </div>

  <div class="resumo-unidades">
      <div class="und-disponiveis" rel="tooltip" data-original-title="Total de Vagas Disponíveis"><div class="qtd">{{ $entry->garagens->where('situacao', 'Disponível')->count() }}</div><div class="cor"></div></div>
      <div class="und-vendidas" rel="tooltip" data-original-title="Total de Vendidas"><div class="qtd">{{ $entry->garagens->where('situacao', 'Vendida')->count() }}</div><div class="cor"></div></div>
      <div class="und-reservadas" rel="tooltip" data-original-title="Total de Unidades Reservadas"><div class="qtd">{{ $entry->garagens->where('situacao', 'Reservada')->count() }}</div><div class="cor"></div></div>
      <div class="und-bloqueadas" rel="tooltip" data-original-title="Vagas Bloquedas"><div class="qtd">{{ $entry->garagens->where('situacao', 'Bloqueada')->count() }}</div><div class="cor"></div></div>
  </div>

  <div style="clear: both; margin-bottom: 20px; padding-bottom: 20px"></div>

  @foreach($pavimentos as $pavimento)
    <div class="toggle" data-plugin-toggle data-toggle="collapse">
      <section class="toggle active">
        <label>
          <i class="fa fa-building"></i>{{ $pavimento->nome }}
          <div class="pull-right" style="padding-right: 20px">
            <i class="fa fa-building" style="font-size: 20px"></i>
            {{ $pavimento->garagens->count() }} vagas  
          </div>        
        </label>        
        <div class="toggle-content">
          <section class="panel">
            <div class="panel-body">
              @if (count($pavimento->garagens))
                @include('admin.empreendimentos.desktop.empreendimento.pavimento.garagem', ['garagens' => $pavimento->garagens])
              @endif
            </div>
          </section>
        </div>
      </section>
    </div>
  @endforeach
</div>


<div class="modal fade" id="alterarInfoGaragem" tabindex="-1" role="dialog" aria-labelledby="alterarGaragemLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="alterarGaragemLabel"></h4>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="alterarVendaGaragem" tabindex="-1" role="dialog" aria-labelledby="alterarGaragemLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="alterarGaragemLabel"></h4>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>

<script src="/assets/javascripts/pavimento/index.js?v=01"></script>
<script src="/assets/javascripts/garagem/index.js"></script>
@endsection

@push('after_styles')
<style type="text/css">
  .form-bordered .form-group {
    border-bottom: none;
  }
</style>
@endpush
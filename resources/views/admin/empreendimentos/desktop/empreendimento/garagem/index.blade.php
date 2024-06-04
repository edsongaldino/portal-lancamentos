@extends('admin.empreendimentos.desktop.empreendimento.layout')
@section('conteudo_empreendimento')
    <div class="col-md-8 col-lg-9">
        @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
        <div class="row">
        <div class="col-xs-12">                        
                <section class="panel">
                    <header class="panel-heading">       
                        <h2 class="panel-title">Filtros</h2>
                    </header>
                    <div class="panel-body">
                        <form class="form-horizontal form-bordered" action="#">
                            <input type="hidden" name="empreendimento_id" value="{{ $entry->id }}" id="empreendimento_id">
                            <div class="form-group">                                
                                @if ($entry->tipo == 'Vertical')
                                    <div class="col-md-3">
                                        <div class="input-group btn-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                            <select class="form-control" placeholder="Selecione" data-plugin-multiselect name="torre_id" id="torre">
                                                <option value="Todas">Todas as torres</option>
                                                @foreach($entry->torres as $torre)
                                                    <option value="{{ $torre->id }}">{{ $torre->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                    
                                @endif                                                                

                                <div class="col-md-3">
                                    <div class="input-group btn-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-check-square-o"></i>
                                        </span>

                                        <select class="form-control" placeholder="Selecione" data-plugin-multiselect name="situacao" id="situacao">
                                            <option value="Todas">Todas as situações</option>
                                            @if ($entry->torres)
                                            <option value="Disponível">Disponível</option>
                                            <option value="Vendida">Vendida</option>
                                            <option value="Reservada">Reservada</option>
                                            <option value="Bloqueada">Bloqueada</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>                                
                            </div>        
                        </form>
                    </div>
                </section>
            </div>
        </div>
            
        <div class="row">
            <div class="col-md-12">
                @if ($entry->tipo == 'Vertical')
                    @php
                        $sorted = $entry->pavimentos->sortBy('id');
                    @endphp

                    @foreach ($sorted as $torre)
                        <a                             
                            class="btn btn-primary pavimentos-cores" 
                            href="/admin/empreendimento/{{ $entry->id }}/garagens?pavimento={{ $torre->id }}"
                            @if ($pavimento_selecionado == $torre->id)
                                style="background: green; color: white"                            
                            @endif
                        >
                            {{ $torre->nome }}
                        </a>
                    @endforeach
                @endif                
            </div>  
        </div>  
                        
        <div class="row">
            <div class="col-md-12" id="garagens">
                @if ($entry->tipo == 'Vertical')
                    @if ($pavimento_selecionado)
                        @php
                            $garagens = App\Models\PavimentoGaragem::find($pavimento_selecionado)->garagens
                        @endphp

                        @include('admin.empreendimentos.desktop.empreendimento.garagem.filtrar', ['garagens' => $garagens])                        
                    @else
                        @foreach ($entry->pavimentos as $pavimento)                    
                            @include('admin.empreendimentos.desktop.empreendimento.garagem.filtrar', ['garagens' => $pavimento->garagens])
                        @endforeach               
                    @endif
                @endif                
            </div>
        </div>
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

    <script src="/assets/javascripts/garagem/index.js?v={{ filemtime('assets/javascripts/garagem/index.js') }}"></script>
@endsection
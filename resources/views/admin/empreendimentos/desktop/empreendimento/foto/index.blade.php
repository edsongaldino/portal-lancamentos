@extends('admin.empreendimentos.desktop.empreendimento.layout')
@section('conteudo_empreendimento')
<div class="col-md-10 col-lg-9">
  @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
  <div class="row">
    <div class="col-xs-12">
      <section class="panel">
        <header class="panel-heading">
          <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
          </div>

          <h2 class="panel-title">Arraste e solte as fotos aqui embaixo</h2>
        </header>
        <div class="panel-body">
          <form action="{{ route('upload_fotos') }}" method="post" class="dropzone dz-square" id="dropzone-example" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $entry->id }}">
          </form>
        </div>
      </section>
    </div>
  </div>

  
  <code>
    Para liberar o empreendimento você precisa:
    <ul>
      <li>
        Cadastrar no mínimo 5 Fotos
      </li>
      <li>
        Colocar a descrição em todas as fotos
      </li>
      <li>
        Definir 1 foto como destaque principal
      </li>
      <li>
        Definir no mínimo 5 fotos como destaque do carrossel
      </li>
    </ul>
  </code>

  <!-- start: page -->
  <div id="bloco_fotos">
    <section class="content-with-menu content-with-menu-has-toolbar media-gallery">
      <div class="inner-toolbar clearfix">
        <ul>
          <li>
            <a href="#" id="mgSelectAll"> <span data-all-text="Selecionar todas" data-none-text="Desmarcar todas">Selecionar todas</span></a>
          </li>
          <li>
            <a href="#" id="excluir-fotos" data-rota="{{ route('excluir-fotos') }}"><i class="fa fa-trash-o"></i> Excluir</a>
          </li>
          <li class="right" data-sort-source data-sort-id="media-gallery">
            <ul class="nav nav-pills nav-pills-primary">
              <li>
                <a href="/admin/empreendimento/{{ $entry->id }}/fotos">Fotos ({{ $fotos->count() }})</a>
              </li>
              <li>
                <a data-option-value=".interna" href="#interna">Internas ({{ $fotos->where('tipo', 'Interna')->count() }})</a>
              </li>
              <li>
                <a data-option-value=".externa" href="#externa">Externas ({{ $fotos->where('tipo', 'Externa')->count() }})</a>
              </li>
              <li>
                <a data-option-value=".decorado" href="#decorado">Decorado ({{ $fotos->where('tipo', 'Decorado')->count() }})</a>
              </li>
              <li>
                <a data-option-value=".estagio" href="#estagio">Estágio de obra ({{ $fotos->where('tipo', 'Estágio de Obra')->count() }})</a>
              </li>
              <li>
                <a data-option-value=".implantacao" href="#implantacao">Implantação ({{ $fotos->where('tipo', 'Implantação')->count() }})</a>
              </li>
              <li>
                <a data-option-value=".mapadevagas" href="#mapadevagas">Mapa de Vagas ({{ $fotos->where('tipo', 'Mapa de Vagas')->count() }})</a>
              </li>

            </ul>
          </li>
        </ul>
      </div>
      <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
        @if (count($fotos))
        @foreach ($fotos as $foto)
        <div class="isotope-item {{ strtolower(str_replace(['á', 'ã', 'ç'], ['a', 'a', 'c'], $foto->tipo)) }} col-sm-6 col-md-4 col-lg-3">
          <div class="thumbnail">
            <div class="thumb-preview">
              <a class="thumb-image" href="{{ $foto->getUrl() }}" data-lightbox="fotos" style="height: 200px;">
                <h5 class="mg-title text-semibold">{{ $foto->tipo }} </h5>
                <img src="{{ $foto->getUrl() }}" class="img-responsive" alt="{{ $foto->nome }}" style="max-height: 180px;">    
              </a>
              <div class="mg-thumb-options">
                <div class="mg-zoom"><i class="fa fa-search"></i></div>
                <div class="mg-toolbar">
                  <div class="mg-option checkbox-custom checkbox-inline">
                    <input type="checkbox" id="file_{{ $foto->id }}" value="{{ $foto->id }}">
                    <label for="file_{{ $foto->id }}">Escolher</label>
                  </div>
                  <div class="mg-group pull-right">
                    Destaque
                    <button class="dropdown-toggle mg-toggle" type="button" data-toggle="dropdown">
                      <i class="fa fa-caret-up"></i>
                    </button>
                    <ul class="dropdown-menu mg-menu" role="menu">
                      <li class="text-center">
                        <button type="button" class="btn btn-default btn-link destacar-foto" data-rota="{{ route('destacar-foto-principal') }}" data-id="{{ $foto->id }}">
                          <i class="fa fa-star" style="color: #FF7A4D;"></i> Destaque Principal
                        </button>
                      </li>
                      <li class="text-center">
                        <button type="button" class="btn btn-default btn-link destacar-foto" data-id="{{ $foto->id }}" data-rota="{{ route('destacar-foto-carrossel') }}">
                          <i class="fa fa-star" style="color: #FFD24D;"></i> Destaque Carrossel
                        </button>
                      </li>
                      <li class="text-center">
                        <button type="button" class="btn btn-default btn-link excluir-foto" data-id="{{ $foto->id }}" data-rota="{{ route('excluir-fotos') }}">
                          <i class="fa fa-trash" style="color: #FFD24D;"></i> Excluir foto
                        </button>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <h5 class="mg-title text-semibold">
              @if ($foto->destaque_carrossel == 'Sim')
              <button type="button" class="btn btn-default btn-link remover-destaque" data-id="{{ $foto->id }}" data-titulo="Tem certeza que deseja remover a foto dos destaques do carrossel?" data-rota="{{ route('remover-destaque-carrossel') }}" title="Destaque Carrossel">
                <i class="fa fa-star" style="color: #FFD24D; font-size:30px;" title="Destaque Carrossel"></i> 
              </button>
              @endif

              @if ($foto->destaque_principal == 'Sim')
              <button type="button" class="btn btn-default btn-link remover-destaque" data-id="{{ $foto->id }}" data-titulo="Tem certeza que deseja remover a foto do destaque principal?" data-rota="{{ route('remover-destaque-principal') }}" title="Destaque Principal">
                <i class="fa fa-star" style="color: #FF7A4D; font-size:30px;" title="Destaque Principal"></i> 
              </button>
              @endif
            </h5>    
            

            <div class="mg-description">
              <select name="tipo" class="form-control tipo-imagem" data-id="{{ $foto->id }}" data-empreendimento="{{ $entry->id }}">
                <option value="Geral" @if ($foto->tipo == 'Geral')selected="true"@endif>Geral</option>
                <option value="Interna" @if ($foto->tipo == 'Interna')selected="true"@endif>Interna</option>
                <option value="Externa" @if ($foto->tipo == 'Externa')selected="true"@endif>Externa</option>
                <option value="Decorado" @if ($foto->tipo == 'Decorado')selected="true"@endif>Decorado</option>
                <option value="Estágio de Obra" @if ($foto->tipo == 'Estágio de Obra')selected="true"@endif>Estágio de Obra</option>
                @if ($entry->tipo == 'Horizontal')
                <option value="Implantação" @if ($foto->tipo == 'Implantação')selected="true"@endif>Implantação</option>
                @endif
                <option value="Mapa de Vagas" @if ($foto->tipo == 'Mapa de Vagas')selected="true"@endif>Mapa de Vagas</option>

                @if ($entry->tipo == 'Vertical')
                <option value="Implantação Vertical - Frente" @if ($foto->tipo == 'Implantação Vertical - Frente')selected="true"@endif>Implantação Vertical - Frente</option>
                <option value="Implantação Vertical - Fundo" @if ($foto->tipo == 'Implantação Vertical - Fundo')selected="true"@endif>Implantação Vertical - Fundo</option>
                <option value="Implantação Vertical - Lateral" @if ($foto->tipo == 'Implantação Vertical - Lateral')selected="true"@endif>Implantação Vertical - Lateral</option>
                <option value="Implantação - Área de Lazer" @if ($foto->tipo == 'Implantação - Área de Lazer')selected="true"@endif>Implantação - Área de Lazer</option>
                @endif

              </select>

              @if($foto->tipo == 'Implantação')   
                <select name="descricao_implantacao" class="form-control descricao-implantacao" data-id="{{ $foto->id }}" data-empreendimento="{{ $entry->id }}">
                  <option value="Mapa das Casas" @if ($foto->nome == 'Mapa das Casas')selected="true"@endif>Mapa das Casas</option>
                  <option value="Mapa dos Lotes" @if ($foto->nome == 'Mapa dos Lotes')selected="true"@endif>Mapa dos Lotes</option>
                  <option value="Posição Solar e Unidades" @if ($foto->nome == 'Posição Solar e Unidades')selected="true"@endif>Posição Solar e Unidades</option>
                  <option value="Posição das Unidades" @if ($foto->nome == 'Posição das Unidades')selected="true"@endif>Posição das Unidades</option>
                  <option value="Posição Solar" @if ($foto->nome == 'Posição Solar')selected="true"@endif>Posição Solar</option>
                  <option value="Área de Lazer" @if ($foto->nome == 'Área de Lazer')selected="true"@endif>Área de Lazer</option>
                </select>
              @else
                  <input class="form-control nome-imagem" data-id="{{ $foto->id }}" type="text" value="{{ $foto->nome }}" placeholder="Descrição da Imagem">
              @endif

              @if($foto->tipo == 'Estágio de Obra')
                <br>
                <label>Data do estágio de obra</label>
                <input class="form-control data-implantacao" data-id="{{ $foto->id }}" value="@if ($foto->caracteristicas->where('nome', 'data_implantacao')->first()){{ $foto->caracteristicas->where('nome', 'data_implantacao')->first()->pivot->valor }}@endif" type="date" name="data_implantacao">
                <br>
              @endif

              <small class="pull-right text-muted">{{ \Carbon\Carbon::parse($foto->created_at)->format('d/m/Y') }}</small>
            </div>
          </div>
        </div>
        @endforeach
        @endif           
      </div>

    </section>
  </div>  
  <!-- end: page -->
</div>    
@endsection

@push('after_scripts')
  <script src="/assets/vendor/isotope/isotope.js"></script>
  <script src="/assets/vendor/dropzone/dropzone.js"></script>
  <script src="/assets/javascripts/pages/examples.mediagallery.js"></script>
  <script src="/global/js/ajax/index.js"></script>
  <script src="/assets/javascripts/foto/index.js"></script>
@endpush

@push('before_styles')
  <link rel="stylesheet" href="/assets/vendor/dropzone/basic.css" />
  <link rel="stylesheet" href="/assets/vendor/dropzone/dropzone.css" />
@endpush
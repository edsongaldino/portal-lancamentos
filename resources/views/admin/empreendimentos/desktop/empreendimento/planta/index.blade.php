@extends('admin.empreendimentos.desktop.empreendimento.layout')
@section('conteudo_empreendimento')
<div class="col-md-10 col-lg-9">
  @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
  <a href="{{ route('cadastrar-planta', $entry->id) }}"><button type="button" class="mb-xs mt-xs mr-xs btn btn-success incluir-planta"><i class="fa fa-plus"></i> Incluir Planta</button></a>

  <br>
  <br>
  <br>

  <div class="row">
    @foreach($plantas as $planta)
    <div class="col-md-4">
      <div class="panel-body box-planta">

        <div class="thumb-info mb-md">
          @if ($planta->getFotoDestaque())
          <a href="{{ $planta->getFotoDestaque()->getUrl('original') }}" data-lightbox="plantas" data-title="{{ $planta->nome }}">
            <img src="{{ $planta->getFotoDestaque()->getUrl('original') }}" class="rounded img-responsive">    
          </a>        

          @endif
          <div class="thumb-info-title">
            <span class="thumb-info-inner">{{ $planta->nome }}</span>
            @if(get_caracteristica('Planta', $planta->id, 'planta_tipo', 'valor'))
            <span class="thumb-info-type">{{ get_caracteristica('Planta', $planta->id, 'planta_tipo', 'valor') }}</span>
            @endif
          </div>
        </div>

        <div class="widget-content-expanded dados-planta">
          <ul class="simple-todo-list itens-planta">                            
            <li>                                
              <i class="fa fa-pencil"></i>
              {!! $planta->area_privativa !!} m<sup>2</sup>
            </li>

            @if($planta->caracteristicas->where('nome', 'qtd_dormitorio')->first())
              @php
                $quartos = $planta->caracteristicas->where('nome', 'qtd_dormitorio')->first()->pivot->valor;
              @endphp

              <li>                                        
                @if($planta->caracteristicas->where('nome', 'qtd_suite')->first())              
                  @php
                    $suites = $planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor;
                  @endphp

                  @if ($suites == $quartos)
                    <i class="fa fa-bed"></i>                                
                    &nbsp; {{  $suites }} Suítes
                  @else
                    @if ($suites)
                      <i class="fa fa-bed"></i>                                
                      &nbsp; {{  $quartos }} Quarto(s) sendo {{ $suites }} suíte(s)
                    @else
                      <i class="fa fa-bed"></i>                                
                      &nbsp; {{  $quartos }} Quarto(s)
                    @endif
                  @endif
                @else
                  <i class="fa fa-bed"></i>                                
                  &nbsp; {{  $quartos }} Quarto(s)
                @endif                            
              </li>
            @endif

            @if($planta->caracteristicas->where('nome', 'vagas_garagem')->first())
              @php
                $vagas = $planta->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor;
              @endphp

              <li>
                <i class="fa fa-car"></i>                                
                &nbsp; {{  $vagas }} Vagas de garagem
              </li>
            @endif                            
          </ul>
        </div>

        <div class="widget-toggle-expand mb-md box-caracteristicas-planta">
          <div class="widget-content-expanded">
            <ul class="simple-todo-list">
              @php
              $caracteristicas = caracteristicas_planta($planta->id);
              @endphp
              @foreach($caracteristicas as $caracteristica)
              <li>
                <i class="fa fa-check-square-o"></i>
                {{ $caracteristica['nome'] }}
              </li>
              @endforeach
            </ul>
          </div>

          <div class="botoes-acao">
            <a class="mb-xs mt-xs mr-xs btn btn-primary editar-planta" href="{{ route('alterar-planta', $planta->id) }}">
              <i class="fa fa-pencil"></i>
              Editar
            </a>
            <button data-id="{{ $planta->id }}" type="button" class="mb-xs mt-xs mr-xs btn btn-danger remover-planta"><i class="fa fa-close"></i></button>
          </div>
        </div>

      </div>

    </div>
    @endforeach

  </div>
</div>
<script src="/assets/javascripts/planta/index.js"></script>
@endsection
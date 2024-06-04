@extends('backpack::layout')

@section('header')
<header class="page-header">
  <h2>Leads</h2>
  
  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a>
      </li>
      
      <li>
        <a href="{{ route('leads') }}">Leads</a>
      </li>
    </ol>
    
    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
@endsection

@section('content')
<section class="panel">
  <a href="{{ route('exportar-leads') }}" target="_blank" class="btn btn-warning exportar-excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Leads</a>
  <div class="row">
    @foreach($leads as $lead)
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <section class="panel panel-transparent">
          <header class="panel-heading">
            <h2 class="panel-title">{{ (new \DateTime($lead->created_at))->format('d/m/Y') }}</h2>
          </header>
          <div class="panel-body">
            <section class="panel panel-group">
              <header class="panel-heading bg-primary topo-lead-card">                
                <div class="widget-profile-info">
                  <div class="profile-picture">                    
                    <img src="/assets/images/!logged-user.jpg">
                  </div>
                  <div class="profile-info">
                    <h4 class="name text-semibold">
                      {{ converte_utf8($lead->nome) }}
                    </h4>
                    <h5 class="role">
                      @if($lead->created_at < '2020-01-01')
                        {{ masc_telefone($lead->telefone) }}
                      @else
                        {{ $lead->telefone }}
                      @endif
                    </h5>
                    <div class="profile-footer">
                      <a href="mailto:{{ $lead->email }}">
                        {{ $lead->email }}
                      </a>
                    </div>
                  </div>
                </div>                
              </header>

              <div id="accordion">
                <div class="panel panel-accordion panel-accordion-first">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a 
                        class="accordion-toggle" 
                        data-toggle="collapse" 
                        data-parent="#accordion" 
                        href="{{ $_SERVER['REQUEST_URI'] }}#Atendimento{{ $lead->id }}">
                        <i class="fa fa-plus"></i> Mais informações
                      </a>
                    </h4>
                  </div>
                  <div id="Atendimento{{ $lead->id }}" class="accordion-body collapse in">
                    <section class="panel panel-featured-left panel-featured-secondary">
                      <div class="panel-body">
                        <div class="widget-summary widget-summary-sm">
                          <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                              <i class="fa fa-building"></i>
                            </div>
                          </div>
                          <div class="widget-summary-col">
                            <div class="summary">
                              <h4 class="title">
                                @if(isset($lead->empreendimento->nome))
                                {{ converte_utf8($lead->empreendimento->nome) }}
                                @endif
                              </h4>
                              <div class="info">
                                <strong class="amount">
                                @if(isset($lead->empreendimento->subtipo->nome))
                                  {{ $lead->empreendimento->subtipo->nome }}
                                @endif
                                </strong>
                                <br/>
                                <span class="text-secondary"></span>
                              </div>
                            </div>
                            <div class="summary-footer">
                              <a class="text-muted text-uppercase">(view all)</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                    
                    @if($lead->renda || $lead->previsao_compra)
                    <section class="panel panel-featured-left panel-featured-primary">
                      <div class="panel-body">
                        <div class="widget-summary widget-summary-sm">
                          <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary">
                              <i class="fa fa-dollar"></i>
                            </div>
                          </div>
                          <div class="widget-summary-col">
                            <div class="summary">
                              <h4 class="title">Renda / previsão de Compra</h4>
                              <div class="info">
                                <strong class="amount">
                                  {{ converte_utf8($lead->renda) }}                                  
                                </strong>
                                <span class="text-primary"> 
                                  ({{ converte_utf8($lead->previsao) }})                                  
                                </span>
                              </div>
                            </div>
                            <div class="summary-footer">
                              <a class="text-muted text-uppercase">(view all)</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                    @endif

                    @if($lead->origem || $lead->dispositivo)
                    <section class="panel panel-featured-left panel-featured-tertiary">
                      <div class="panel-body">
                        <div class="widget-summary widget-summary-sm">
                          <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-tertiary">
                              <i class="fa fa-life-ring"></i>
                            </div>
                          </div>
                          <div class="widget-summary-col">
                            <div class="summary">
                              <h4 class="title">Origem / Dispositivo</h4>
                              <div class="info">
                                <strong class="amount">
                                  {{ converte_utf8($lead->origem) }}                                  
                                </strong>
                                <span class="text-tertiary">({{ $lead->dispositivo }})</span>
                              </div>
                            </div>
                            <div class="summary-footer">
                              <a class="text-muted text-uppercase">(view all)</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                    @endif

                    @if($lead->tempo || $lead->interesse)
                    <section class="panel panel-featured-left panel-featured-quartenary">
                      <div class="panel-body">
                        <div class="widget-summary widget-summary-sm">
                          <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-quartenary">
                              <i class="fa fa-clock-o"></i>
                            </div>
                          </div>
                          <div class="widget-summary-col">
                            <div class="summary">
                              <h4 class="title">Tempo de Navegação / Interesse</h4>
                              <div class="info">
                                <strong class="amount">{{ $lead->tempo }}</strong>
                                <span class="text-quartenary">
                                  {{ converte_utf8($lead->interesse) }}                                  
                                </span>
                              </div>
                            </div>
                            <div class="summary-footer">
                              <a class="text-muted text-uppercase">(view all)</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                    @endif                    
                  </div>
                </div>
                <div class="panel panel-accordion">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="{{ $_SERVER['REQUEST_URI'] }}#Mensagem{{ $lead->id }}">
                        <i class="fa fa-comment"></i> Mensagem
                      </a>
                    </h4>
                  </div>
                <div id="Mensagem{{ $lead->id }}" class="accordion-body collapse">
                    <div class="panel-body">
                      <ul class="simple-user-list mb-xlg">
                        <li>
                          <figure class="image rounded">                            
                            <img src="/assets/images/!logged-user.jpg" class="img-circle foto">
                          </figure>
                          <span class="title">
                            {{ converte_utf8($lead->nome) }}                            
                            </span>
                          <span class="message">
                            {{ converte_utf8($lead->mensagem) }}
                          </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </section>                        
          </div>
        </section>
      </div>
    @endforeach
</section>
@endsection
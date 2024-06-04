@extends('backpack::base.layout')
@section('content')

<header class="page-header">
    <h2>Meu Perfil</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="/admin/dashboard">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Inicio</span></li>
            <li><span>Meu perfil</span></li>
        </ol>

        <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>

<!-- start: page -->

@php
$percentual = percentual_empreendimento($entry);
@endphp

<div class="row">
    <div class="col-md-4 col-lg-3">
        <section class="panel">
            <div class="panel-body">
                @if (isset($entry))
                <a href="{{ route('empreendimento.editar', ['id' => $entry->id]) }}">
                @endif
                <div class="thumb-info mb-md">
                    @if ($entry->fotoPrincipal() !== null)
                    <img src="{{ url($entry->fotoPrincipal()) }}" class="rounded img-responsive">
                    @else
                        <img src="{{ url('assets/images/sem-foto.jpg') }}" style="width: 200px; height: 150px">
                    @endif
                    <div class="thumb-info-title">
                        <span class="thumb-info-inner">@if(isset($entry)){{ $entry->nome }}@endif</span>
                        <span class="thumb-info-type">@if(isset($entry)){{ $entry->tipo }}@endif</span>
                    </div>
                </div>
                @if (isset($entry))
                </a>
                @endif

                <div class="widget-toggle-expand mb-md">
                    <div class="widget-header">
                        <h6>Informações do empreendimento</h6>
                        <div class="widget-toggle">+</div>
                    </div>
                    <div class="widget-content-collapsed">
                        <div class="progress progress-xs light">
                            <div class="progress-bar" role="progressbar" aria-valuenow="
                                @if(isset($percentual))
                                {{ $percentual }}
                                @else
                                0
                                @endif" aria-valuemin="0" aria-valuemax="100" 
                                @if(isset($entry))
                                    style="width: {{ $percentual }}%;"
                                @else
                                    0%
                                @endif>
                                @if(isset($entry))
                                    {{ $percentual }}%
                                @else
                                    0%    
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-expanded">
                        <div class="gauge-chart">
                            <canvas id="gaugeAlternative" class="qualidade-anuncio" width="180" height="110" data-plugin-options='{ "value": @if(isset($entry)){{ $percentual }}@else 0 @endif, "maxValue": 100 }'></canvas>
                            <strong>Qualidade do Anúncio</strong>
                            <label id="gaugeAlternativeTextfield"></label>
                        </div>
                    </div>
                </div>

                <hr class="dotted short">

                <div class="widget-content-expanded">
                    <ul class="simple-todo-list">
                        @php
                            $perfil = perfil_empreendimento($entry);
                        @endphp

                        @if($perfil)
                            @foreach ($perfil as $item)
                                <li @if ($item['completo'] == 'S')class="completed"@endif>{{ $item['nome'] }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>                    
            </div>
        </section>

    </div>
    
    @yield('conteudo_empreendimento')

</div>
<!-- end: page -->
@endsection
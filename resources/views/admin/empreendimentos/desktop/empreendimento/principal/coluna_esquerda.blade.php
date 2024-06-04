<section class="panel">
    <div class="panel-body">
        <div class="thumb-info mb-md">    
            @if (isset($entry) && $entry->fotoPrincipal() !== null)
            <img src="{{ url($entry->fotoPrincipal()) }}" class="rounded img-responsive">
            @else
                <img src="{{ url('assets/images/sem-foto.jpg') }}" class="rounded img-responsive">
            @endif

            <div class="thumb-info-title">
                <span class="thumb-info-inner">@if(isset($entry)){{ $entry->nome }}@endif</span>
                <span class="thumb-info-type">@if(isset($entry)){{ $entry->tipo }}@endif</span>
            </div>
        </div>

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
                @if(isset($perfil))
                    @foreach ($perfil as $item)
                        <li @if ($item['completo'] == 'S')class="completed"@endif>{{ $item['nome'] }}</li>
                    @endforeach
                @endif
            </ul>
        </div>                    
    </div>
</section>
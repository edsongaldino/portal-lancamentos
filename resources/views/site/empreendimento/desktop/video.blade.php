@if ($empreendimento->caracteristicas->where('nome', 'video')->first())
    @if($empreendimento->caracteristicas->where('nome', 'video')->first()->pivot->valor)
        <div class="row box-video-detalhes">

            <div class="col-xs-12 col-sm-9 margin-top-60">
                <h2 class="title-negative-margin title-color">
                    <i class="fa fa-video-camera" aria-hidden="true"></i> Vídeo
                </h2>
                <h5 class="subtitle-color">
                    Vídeo de apresentação do empreendimento
                </h5>
                <div class="col-xs-12">
                    <div class="title-separator-secondary"></div>
                </div>
            </div>

            <div class="container margin-top-80">
                <div class="row">
                    <iframe src="{{ $empreendimento->caracteristicas->where('nome', 'video')->first()->pivot->valor }}" class="video-empreendimento-detalhes"></iframe>
                </div>
            </div>

        </div>
    @endif
@endif

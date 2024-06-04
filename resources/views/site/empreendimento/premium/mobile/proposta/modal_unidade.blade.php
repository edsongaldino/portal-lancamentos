@if(isset($unidade->planta))
<!-- Modal -->
<div class="modal fade" id="ModalPlanta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $unidade->planta->nome }}</h5>
        <button type="button" class="close fechar-modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body detalhe-planta">


            @if($unidade->empreendimento->subtipo_id == 1)
            
            <div class="item-planta">
                <div class="icone"><i class="fa fa-object-group" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Área Privativa</span><br/>{{ $unidade->planta->area_privativa }}m²</div>
            </div>

            <div class="item-planta">
                <div class="icone"><i class="fas fa-bed" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Quartos</span><br/>{{ $unidade->planta->caracteristicas->where('nome', 'qtd_dormitorio')->first()->pivot->valor ?? '' }}</div>
            </div>
            
            @if(isset($unidade->planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor))
            <div class="item-planta">
                <div class="icone"><i class="fas fa-bath" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Suítes</span><br/>{{ $unidade->planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor ?? '' }}</div>
            </div>
            @endif
    
            <div class="item-planta">
                <div class="icone"><i class="fas fa-toilet" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Banheiros</span><br/>{{ $unidade->planta->caracteristicas->where('nome', 'qtd_banheiro')->first()->pivot->valor ?? '' }}</div>
            </div>

            @elseif($unidade->empreendimento->subtipo_id == 2)

            <div class="item-planta">
                <div class="icone"><i class="fa fa-object-group" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Área Privativa</span><br/>{{ $unidade->planta->area_privativa }}m²</div>
            </div>

            <div class="item-planta">
                <div class="icone"><i class="fas fa-border-style" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Laje Técnica</span><br/>{{ $unidade->planta->caracteristicas->where('nome', 'laje_tecnica')->first()->pivot->valor ?? '' }}m²</div>
            </div>

            <div class="item-planta">
                <div class="icone"><i class="fas fa-coffee" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Possui copa?</span><br/>{{ $unidade->planta->caracteristicas->where('nome', 'possui_copa')->first()->pivot->valor ?? '' }}</div>
            </div>

            <div class="item-planta">
                <div class="icone"><i class="fas fa-toilet" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Banheiros</span><br/>{{ $unidade->planta->caracteristicas->where('nome', 'qtd_banheiro')->first()->pivot->valor ?? '' }}</div>
            </div>

            @elseif($unidade->empreendimento->subtipo_id == 3)

            <div class="item-planta">
                <div class="icone"><i class="fa fa-object-group" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Área Privativa</span><br/>{{ $unidade->planta->area_privativa }}m²</div>
            </div>

            <div class="item-planta">
                <div class="icone"><i class="fas fa-bed" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Quartos</span><br/>{{ $unidade->planta->caracteristicas->where('nome', 'qtd_dormitorio')->first()->pivot->valor ?? '' }}</div>
            </div>
            
            @if(isset($unidade->planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor))
            <div class="item-planta">
                <div class="icone"><i class="fas fa-bath" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Suítes</span><br/>{{ $unidade->planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor ?? '' }}</div>
            </div>
            @endif
    
            <div class="item-planta">
                <div class="icone"><i class="fas fa-car" aria-hidden="true"></i></div>
                <div class="valor"><span class="titulo">Garagem</span><br/>{{ $unidade->planta->caracteristicas->where('nome', 'qtd_vaga')->first()->pivot->valor ?? '' }}</div>
            </div>

            @endif
            
            @php
            $foto_planta = $unidade->planta->getFotoDestaque();
            @endphp
            @if(isset($foto_planta))
            <div class="img-planta"><a href="{{ $foto_planta->getUrl('original') ?? '' }}" data-toggle="lightbox"><img src="{{ $foto_planta->getUrl('400x300') ?? '' }}" class="img-responsive" alt=""></a></div>
            @endif
            <div class="caracteristicas-planta">
                @php
                    $caracteristicas = $unidade->planta->caracteristicas->where('exibir', 'Sim');
                @endphp
                
                @foreach($caracteristicas as $caracteristica)  
                    <div class="item"><i class="far fa-check-circle" aria-hidden="true"></i> {{ $caracteristica->nome }}</div>
                @endforeach
            </div>
            
        </div>
        <div class="modal-footer">
        <a href="/unidade/{{ $unidade->id }}/formular-proposta"><button type="button" class="btn btn-primary formular-proposta"><i class="far fa-edit" aria-hidden="true"></i> Formular Proposta</button></a>
        </div>
    </div>
    </div>
</div>
@else

<div class="modal fade" id="ModalLote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dimensões do Lote</h5>
        <button type="button" class="close fechar-modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body detalhe-planta detalhe-lote">
            <div class="img-planta"><img src="/assets/premium/img/fundo-dimensoes.png" class="img-responsive" alt=""></div>
            <div class="metragem">{{ $unidade->getCaracteristica('metragem_total') ?? '' }}m²</div>
            <div class="dimensao-lote">
                <div class="item frente"><div class="titulo">Frente</div><div class="valor">{{ $unidade->getCaracteristica('lote_frente') ?? '' }}m</div></div>
                <div class="item fundo"><div class="titulo">Fundo</div><div class="valor">{{ $unidade->getCaracteristica('lote_fundo') ?? '' }}m</div></div>
                <div class="item lateral-dir"><div class="titulo">Lat. Dir</div><div class="valor">{{ $unidade->getCaracteristica('lote_lateral_dir') ?? '' }}m</div></div>
                <div class="item lateral-esq"><div class="titulo">Lat. Esq</div><div class="valor">{{ $unidade->getCaracteristica('lote_lateral_esq') ?? '' }}m</div></div>
            </div>
            
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <a href="/unidade/{{ $unidade->id }}/formular-proposta"><button type="button" class="btn btn-primary">Formular Proposta</button></a>
        </div>
    </div>
    </div>
</div>
@endif

<script src="{{ asset('/assets/premium/js/lightbox/ekko-lightbox.js') }}"></script>

<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
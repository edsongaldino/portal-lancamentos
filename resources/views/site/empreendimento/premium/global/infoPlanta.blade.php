<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $planta->nome }} - {{ $planta->area_privativa }}m²</h5>
    <button type="button" class="close fechar-modal" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body detalhe-planta">

        @if($planta->empreendimento->subtipo_id == 1)
        <div class="item-planta">
            <div class="icone"><i class="fa fa-object-group" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Área Privativa</span><br/>{{ $planta->area_privativa }}m²</div>
        </div>

        <div class="item-planta">
            <div class="icone"><i class="fas fa-bed" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Quartos</span><br/>{{ $planta->caracteristicas->where('nome', 'qtd_dormitorio')->first()->pivot->valor ?? '' }}</div>
        </div>

        <div class="item-planta">
            <div class="icone"><i class="fas fa-bed" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Suítes</span><br/>{{ $planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor ?? '' }}</div>
        </div>

        <div class="item-planta">
            <div class="icone"><i class="fas fa-toilet" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Banheiros</span><br/>{{ $planta->caracteristicas->where('nome', 'qtd_banheiro')->first()->pivot->valor ?? '' }}</div>
        </div>
        
        @elseif($planta->empreendimento->subtipo_id == 2)

        <div class="item-planta">
            <div class="icone"><i class="fa fa-object-group" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Área Privativa</span><br/>{{ $planta->area_privativa }}m²</div>
        </div>

        <div class="item-planta">
            <div class="icone"><i class="fas fa-border-style" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Laje Técnica</span><br/>{{ $planta->caracteristicas->where('nome', 'laje_tecnica')->first()->pivot->valor ?? '' }}m²</div>
        </div>

        <div class="item-planta">
            <div class="icone"><i class="fas fa-coffee" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Possui copa?</span><br/>{{ $planta->caracteristicas->where('nome', 'possui_copa')->first()->pivot->valor ?? '' }}</div>
        </div>

        <div class="item-planta">
            <div class="icone"><i class="fas fa-toilet" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Banheiro</span><br/>{{ $planta->caracteristicas->where('nome', 'qtd_banheiro')->first()->pivot->valor ?? '' }}</div>
        </div>

        @elseif($planta->empreendimento->subtipo_id == 3)

        <div class="item-planta">
            <div class="icone"><i class="fa fa-object-group" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Área Privativa</span><br/>{{ $planta->area_privativa }}m²</div>
        </div>

        <div class="item-planta">
            <div class="icone"><i class="fas fa-bed" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Quartos</span><br/>{{ $planta->caracteristicas->where('nome', 'qtd_dormitorio')->first()->pivot->valor ?? '' }}</div>
        </div>

        <div class="item-planta">
            <div class="icone"><i class="fas fa-bed" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Suítes</span><br/>{{ $planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor ?? '' }}</div>
        </div>

        <div class="item-planta">
            <div class="icone"><i class="fas fa-car" aria-hidden="true"></i></div>
            <div class="valor"><span class="titulo">Garagem</span><br/>{{ $planta->caracteristicas->where('nome', 'qtd_vaga')->first()->pivot->valor ?? '' }}</div>
        </div>

        @endif
        
        @php
        $foto_planta = $planta->getFotoDestaque();
        @endphp
        @if(isset($foto_planta))
        <img src="{{ $foto_planta->getUrl('400x300') ?? '' }}" class="img-responsive" alt=""></a>
        @endif
        <div class="caracteristicas-planta">
            @php
                $caracteristicas = $planta->caracteristicas->where('exibir', 'Sim');
            @endphp
            
            @foreach($caracteristicas as $caracteristica)  
                <div class="item"><i class="far fa-check-circle" aria-hidden="true"></i> {{ $caracteristica->nome }}</div>
            @endforeach
        </div>
        
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
    <a href="/empreendimento/planta/{{ $planta->id }}/unidades"><button type="button" class="btn btn-primary"><i class="far fa-eye" aria-hidden="true"></i> Unidades deste planta</button></a>
</div>
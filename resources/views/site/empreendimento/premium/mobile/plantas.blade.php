@extends('site/empreendimento/premium/layout_interno')

@push('meta')
<title>INICIO</title>
@endpush

@push('includes_head')

@endpush

@section('content')

<div class="conteudo">
    <div id="plantas">
        <div class="titulo-plantas"><i class="fa fa-object-ungroup" aria-hidden="true"></i> Plantas</div>

        @php
        $plantas_empreendimento = $empreendimento->plantasComFotos;
        @endphp
        @foreach($plantas_empreendimento as $planta_empreendimento)

            @php
                $metragem = $planta_empreendimento->area_privativa;
                $foto_planta = $planta_empreendimento->getFotoDestaque();
            @endphp

            <div class="plantas-empreendimento">
                <div class="titulo-planta"><i class="fa fa-object-group" aria-hidden="true"></i> {{ $planta_empreendimento->nome }}</div>
                <div class="foto-planta" data-idplanta="{{ $planta_empreendimento->id }}"><img src="{{ $foto_planta->getUrl('400x300') ?? '' }}" alt=""></div>
                <div class="btn-metragem"><i class="fas fa-ruler-combined" aria-hidden="true"></i> {{ $metragem }}m²</div>
                <div class="btn-detalhes" data-idplanta="{{ $planta_empreendimento->id }}"><i class="fa fa-plus" aria-hidden="true"></i> Detalhes</div>
            </div>


        @endforeach


        <div class="modal fade" id="plantaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" id="detalhe-planta-modal">

            </div>
            </div>
        </div>



    </div>
</div>

@include('site.empreendimento.premium.modal_contato')

@endsection

@push('rodape')
<div class="rodape">
    <div class="btn-voltar" onclick='history.go(-1)'><i class="fa fa-reply-all" aria-hidden="true"></i></div>

    @if($empreendimento->TabelaAtiva->count() > 0)
    <a href="/empreendimento/{{ $empreendimento->id }}/unidades"><div class="btn-condicoes-pagamento"><i class="fas fa-cart-plus" aria-hidden="true"></i> Negociar Unidade</div></div></a>
    @else
    <a data-toggle="modal" data-target="#ModalContatoConstrutora"><div class="btn-condicoes-pagamento fale-com-a-construtora"><i class="fas fa-envelope" aria-hidden="true"></i> Fale com a Construtora</div></a>
    @endif

</div>
@endpush

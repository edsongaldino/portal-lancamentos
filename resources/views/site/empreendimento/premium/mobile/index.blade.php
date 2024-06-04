@extends('site/empreendimento/premium/layout_mobile')

@push('meta')
<title>INICIO</title>
@endpush

@section('content')

    <div class="conteudo home">
        <a href="/proposta/empreendimento/240/unidades">
        <div class="botao botao-unidades">
            <div class="icone"><i class="fa fa-check-square-o" aria-hidden="true"></i></div>
            <div class="texto">
                <div class="titulo">Unidades Disponíveis</div>
                <div class="subtitulo">Listagem completa</div>
            </div>
        </div>
        </a>
        <div class="botao botao-plantas">
            <div class="icone"><i class="fa fa-building-o" aria-hidden="true"></i></div>
            <div class="texto">
                <div class="titulo">Disponibilidade Vertical</div>
                <div class="subtitulo">Implantação 3D</div>
            </div>
        </div>
        <div class="botao botao-disponibilidade">
            <div class="icone"><i class="fa fa-object-group" aria-hidden="true"></i></div>
            <div class="texto">
                <div class="titulo">Plantas / Planta Baixa (Pavimento)</div>
                <div class="subtitulo">Acesse as opções</div>
            </div>
        </div>
        <div class="botao botao-garagem">
            <div class="icone"><i class="fa fa-car" aria-hidden="true"></i></div>
            <div class="texto">
                <div class="titulo">Mapa Interativo de Vagas</div>
                <div class="subtitulo">Visualize as vagas de garagem</div>
            </div>
        </div>
    </div>

@endsection

@push('rodape')
<div class="rodape">
    <div class="btn-foto"><i class="fa fa-camera" aria-hidden="true"></i></div>
    <div class="btn-video"><i class="fa fa-youtube-play" aria-hidden="true"></i></div>
    <div class="btn-produto"><i class="fa fa-building-o" aria-hidden="true"></i></div>
</div>
@endpush
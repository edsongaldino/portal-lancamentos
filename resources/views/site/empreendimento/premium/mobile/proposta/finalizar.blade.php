@extends('site/empreendimento/premium/layout_interno')

@push('meta')
<title>INICIO</title>
@endpush

@section('content')

    <div class="conteudo">

        <div class="check">
            <h2 class="mensagem">
            {{ $proposta->cliente->nome }}<br/>
            <span class="msg">sua proposta foi enviada e será avaliada pela construtora/incorporadora.</span>
            </h2>

            <div class="tempo-resposta"><i class="far fa-clock" aria-hidden="true"></i><br/>Tempo de Resposta: <span class="tempo">24 à 48h</span></div>
            <div class="info"><i class="fas fa-info-circle" aria-hidden="true"></i><br/>A disponibilidade e os valores poderão sofrer alteração à qualquer momento sem aviso prévio</div>

        </div>
            
    </div>

@endsection

@push('rodape')
<div class="rodape">
    <a href="/empreendimento/{{ $proposta->empreendimento_id }}/premium"><div class="btn-nova-proposta"><i class="fa fa-home" aria-hidden="true"></i> Voltar para Home</div></a>
</div>
@endpush
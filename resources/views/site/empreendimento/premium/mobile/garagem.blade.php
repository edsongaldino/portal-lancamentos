@extends('site/empreendimento/premium/layout_interno')

@push('meta')
<title>INICIO</title>
@endpush

@push('includes_head')

@endpush

@section('content')

<div class="conteudo">
    <div id="garagem">
        <div class="titulo-garagem"><i class="fa fa-car" aria-hidden="true"></i> Vagas de Garagem</div>
    </div>
</div>

@endsection

@push('rodape')
<div class="rodape">
    <div class="btn-voltar" onclick='history.go(-1)'><i class="fa fa-reply-all" aria-hidden="true"></i></div>
    <a href="/empreendimento/{{ $empreendimento->id }}/premium"><div class="btn-condicoes-pagamento"><i class="fa fa-building" aria-hidden="true"></i> Empreendimento</div></a>
</div>
@endpush
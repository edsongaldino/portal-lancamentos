@extends('site/empreendimento/premium/layout_interno')

@push('meta')
<title>INICIO</title>
@endpush

@section('content')

    <div class="conteudo">

        <div class="dados-cliente">

            <h2><i class="fa fa-address-card" aria-hidden="true"></i> Primeiro precisamos saber um pouco mais sobre você</h2>
            
            <form action="/proposta/gravar-dados-cliente" name="FormCliente" id="FormCliente" method="POST">
                @csrf
                <label for="nome">Seu nome completo</label>
                <input type="text" class="form-control" name="nome" id="nome">
                <label for="nome">CPF</label>
                <input type="text" class="form-control cpf" name="cpf" id="cpf">
                <label for="nome">Telefone</label>
                <input type="text" class="form-control telefone" name="telefone" id="telefone">
                <label for="nome">E-mail</label>
                <input type="text" class="form-control" name="email" id="email">
                <label for="nome">Renda</label>
                <input type="text" class="form-control moeda" name="renda" id="renda">
                <input type="hidden" name="unidade_id" value="{{ $unidade->id }}">
            </form>

        </div>
        
    </div>

@endsection

@push('rodape')

<div class="rodape">
    <div class="btn-voltar" onclick='history.go(-1)'><i class="fa fa-reply-all" aria-hidden="true"></i></div>
    <div class="btn-gravar-dados" onclick="EnviarFormCliente();"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Próxima etapa</div>
</div>

@endpush
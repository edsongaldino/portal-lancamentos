@extends('corretor.layouts.app')
@section('conteudo')
<div class="conteudo">
    <h3 class="perfil"><i class="fa fa-user"></i> Minha conta</h3>
    <form action="{{ route('corretor.update') }}" method="POST" class="cadastro-usuario" enctype="multipart/form-data">
        @csrf
        <div id="profile-container" class="profile-container">
            @if($usuario->foto):
                <img id="profileImage" class="profileImage" src="/uploads/{{ $usuario->foto }}" />
            @else:
                <img id="profileImage" class="profileImage" src="{{ asset('corretor/app-assets/images/userFoto.png') }}" />
            @endif
        </div>
        <input id="imageUpload" type="file" name="imageUpload" placeholder="Photo" capture>
        <label for="cpf_usuario">CPF</label>
        <input type="text" class="form-control" name="cpf" id="cpf" placeholder="" value="{{ $usuario->cpf }}" onblur="$(this).mask('000.000.000-00')" onkeypress="$(this).mask('000.000.000-00')" disabled>
        <label for="nome_usuario">NOME COMPLETO</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="" value="{{ $usuario->nome }}" required>
        <label for="nome_usuario">DATA DE NASCIMENTO</label>
        <input type="text" class="form-control" name="data_nascimento" id="data_nascimento" placeholder="" onblur="$(this).mask('00/00/0000')" onkeypress="$(this).mask('00/00/0000')" value="{{ data_br($usuario->data_nascimento) }}" required>
        <label for="nome_usuario">TELEFONE</label>
        <input type="text" class="form-control" name="telefone" id="telefone" placeholder="" onblur="$(this).mask('(00) 00009-0000')" onkeypress="$(this).mask('(00) 00009-0000')" value="{{ $usuario->telefone }}" required>
        <label for="nome_usuario">EMAIL (LOGIN)</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="" value="{{ $usuario->email }}" required>
        <label for="nome_usuario">SENHA</label>
        <div class="alterar-senha"><input type="checkbox" name="alterar_senha" id="alterar_senha"> Alterar senha</div>

        <input type="password" class="form-control" name="senha_antiga" id="senha_antiga" placeholder="********" maxlength="8" disabled>
        <input type="password" class="form-control" name="senha" id="senha" placeholder="NOVA SENHA" maxlength="8" style="display: none;">
        <input type="password" class="form-control" name="confirmar_senha" id="confirmar_senha" placeholder="CONFIRME SUA SENHA" maxlength="8" style="display: none;">

        <button class="gravar-dados-usuario" type="submit"><i class="fa fa-save"></i> Gravar Informações</button>
    </form>
</div>

@include('corretor.layouts.includes.menu-rodape')

<script>
    $("#profileImage").click(function(e) {
        $("#imageUpload").click();
    });

    function fasterPreview( uploader ) {
        if ( uploader.files && uploader.files[0] ){
            $('#profileImage').attr('src',
                window.URL.createObjectURL(uploader.files[0]) );
        }
    }

    $("#imageUpload").change(function(){
        fasterPreview( this );
    });
</script>
@endsection

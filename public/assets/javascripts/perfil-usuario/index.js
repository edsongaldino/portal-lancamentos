$(function () {
  $("#salvar-dados-usuario").on('click', function (e) {

    var formData = new FormData($("#dados-usuario")[0]);

    e.preventDefault();

    if ($("#password").val() != $("#password_confirmation").val()) {
        Swal.fire('Desculpe', 'As senhas não conferem!', 'warning');
        return false;
    }

    ajaxRequestUpload({
      metodo: 'POST',
      url: '/admin/salvar-perfil-usuario',
      dados: formData,
      reload: true,
      feedback: true,
      mensagemSucesso: 'Dados atualizados com sucesso',
      mensagemErro: 'Erro ao atualizar dados, tente novamente mais tarde',
    });
  });
});

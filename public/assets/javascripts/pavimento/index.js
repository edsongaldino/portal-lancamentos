$(function () {
  $("#cadastrar-pavimento").on('click', function () {    
    var id = $(this).data('id');

    ajaxRequest({
      url: "/admin/cadastrar-pavimento",
      metodo: 'POST',
      dados: $("#cadastrar-dados-pavimento").serialize(),
      feedback: true,
      mensagemSucesso: 'Pavimento Cadastrada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      redirect: '/admin/empreendimento/' + id + '/pavimentos'
    });
  });

  $(".salvar-pavimento").on('click', function () {
    var form_id = $(this).data('form');
    ajaxRequest({
      url: "/admin/atualizar-pavimento",
      metodo: 'POST',
      dados: $(form_id).serialize(),
      feedback: true,
      mensagemSucesso: 'Pavimento atualizado com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: true
    });
  });  

  $(document).on('click', '.remover-pavimento', function (e) {
    confirmacao().then((result) => {
      if (result.value) {
        var id = $(this).data('id');
        ajaxRequest({
          url: "/admin/excluir-pavimento",
          metodo: 'POST',
          dados: {
            id: id
          },
          feedback: true,
          mensagemSucesso: 'Pavimento removido com sucesso',
          mensagemErro: 'Erro, tente novamente mais tarde',
          reload: true
        });      
      }
    });    
  });  
});
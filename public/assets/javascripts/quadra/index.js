$(function () {  
  $("#cadastrar-quadra").on('click', function () {
    var id = $(this).data('id');
    ajaxRequest({
      url: "/admin/cadastrar-quadra",
      metodo: 'POST',
      dados: $("#cadastrar-dados-quadra").serialize(),
      feedback: true,
      mensagemSucesso: 'Quadra cadastrada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      redirect: '/admin/empreendimento/' + id + '/quadras'
    });
  });

  $(".salvar-quadra").on('click', function () {
    var form_id = $(this).data('form');
    ajaxRequest({
      url: "/admin/atualizar-quadra",
      metodo: 'POST',
      dados: $(form_id).serialize(),
      feedback: true,
      mensagemSucesso: 'Quadra atualizada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: true
    });
  });

  $("#gerar-quadras-unidades").on('click', function () {
    ajaxRequest({
      url: "/admin/gerar-quadras-unidades",
      metodo: 'POST',
      dados: $("#dados-gerar-quadras-unidades").serialize(),
      feedback: true,
      mensagemSucesso: 'Quadra cadastrada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: true
    });
  });

  $(document).on('click', '.remover-quadra', function (e) {
    confirmacao().then((result) => {
      if (result.value) {
        var id = $(this).data('id');
        ajaxRequest({
          url: "/admin/excluir-quadra",
          metodo: 'POST',
          dados: {
            id: id
          },
          feedback: true,
          mensagemSucesso: 'Quadra excluída com sucesso',
          mensagemErro: 'Erro, tente novamente mais tarde',
          reload: true
        });  
      }
    });    
  });

  $(document).on('click', '#excluirQuadrasUnidades', function (e) {
    confirmacao().then((result) => {
      if (result.value) {
        var id = $(this).data('id');
        ajaxRequest({
          url: "/admin/excluir-quadras-unidades",
          metodo: 'POST',
          dados: {
            empreendimento_id: id
          },
          feedback: true,
          mensagemSucesso: 'Quadras e unidades excluídas com sucesso',
          mensagemErro: 'Erro, tente novamente mais tarde',
          reload: true
        });  
      }
    });    
  });
});
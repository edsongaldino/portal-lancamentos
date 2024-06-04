$(function () {
  $("#cadastrar-torre").on('click', function () {    
    var id = $(this).data('id');

    ajaxRequest({
      url: "/admin/cadastrar-torre",
      metodo: 'POST',
      dados: $("#cadastrar-dados-torre").serialize(),
      feedback: true,
      mensagemSucesso: 'Torre cadastrada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      redirect: '/admin/empreendimento/' + id + '/torres'
    });
  });

  $(".salvar-torre").on('click', function () {
    var form_id = $(this).data('form');
    ajaxRequest({
      url: "/admin/atualizar-torre",
      metodo: 'POST',
      dados: $(form_id).serialize(),
      feedback: true,
      mensagemSucesso: 'Torre atualizada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: true
    });
  });

  $("#gerar-torres-unidades").on('click', function () {
    ajaxRequest({
      url: "/admin/gerar-torres-unidades",
      metodo: 'POST',
      dados: $("#dados-gerar-torres-unidades").serialize(),
      feedback: true,
      reload: true,
      mensagemSucesso: 'Unidades geradas com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde'
    });
  });

  $(document).on('click', '.remover-torre', function (e) {
    confirmacao().then((result) => {
      if (result.value) {
        var id = $(this).data('id');
        ajaxRequest({
          url: "/admin/excluir-torre",
          metodo: 'POST',
          dados: {
            id: id
          },
          feedback: true,
          mensagemSucesso: 'Torre removida com sucesso',
          mensagemErro: 'Erro, tente novamente mais tarde',
          reload: true
        });      
      }
    });    
  });

  $(document).on('click', '#excluirTorresUnidades', function (e) {
    confirmacao().then((result) => {
      if (result.value) {
        var id = $(this).data('id');
        ajaxRequest({
          url: "/admin/excluir-torres-unidades",
          metodo: 'POST',
          dados: {
            empreendimento_id: id
          },
          feedback: true,
          mensagemSucesso: 'Torres e unidades excluídas com sucesso',
          mensagemErro: 'Erro, tente novamente mais tarde',
          reload: true
        });  
      }
    });    
  });

  $(document).on('change', '#unidades_terreo', function (e) {
    var valor = $(this).val();
    $("#qtde-terreo").hide();
    if (valor == 'Sim') {
      $("#qtde-terreo").show();      
    }
  });

  $(document).on('change', '#cobertura', function (e) {
    var valor = $(this).val();
    $("#qtde-cobertura").hide();
    if (valor == 'Sim') {
      $("#qtde-cobertura").show();      
    }
  });

  $(document).on('change', '#nomenclatura_unidades', function (e) {
    var valor = $(this).val();

    if (valor == 'DezenaT' || valor == 'CentenaT') {
      $("#andar_customizado").show();  
      $("#andar_padrao").hide();    
    }else{
      $("#andar_customizado").hide();  
      $("#andar_padrao").show();
    }

  });

});
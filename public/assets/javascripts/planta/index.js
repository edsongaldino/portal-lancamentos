$(function () {
  $("#cadastrar-planta").on('click', function () {
    var id = $(this).data('id');

    var formData = new FormData($("#cadastrar-dados-planta")[0]);

    ajaxRequestUpload({
      url: "/admin/cadastrar-planta",
      metodo: 'POST',
      dados: formData,
      feedback: true,
      mensagemSucesso: 'Planta cadastrada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      redirect: '/admin/empreendimento/' + id + '/plantas'
    });
  });

  $("#atualizar-planta").on('click', function () {
    var id = $(this).data('id');
    var formData = new FormData($("#atualizar-dados-planta")[0]);

    ajaxRequestUpload({
      url: "/admin/atualizar-planta",
      metodo: 'POST',
      dados: formData,
      feedback: true,
      mensagemSucesso: 'Planta atualizada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      redirect: '/admin/empreendimento/' + id + '/plantas'
    });
  });

  $(document).on('change', '.tipo-planta', function () {
    var tipo = $(this).val();
    $("#foto-planta").hide();
    $("#foto-planta-1").hide();
    $("#foto-planta-2").hide();
    $("#foto-planta-3").hide();

    if (tipo == 'Casa Térrea' || tipo == 'Sala Comercial') {
      $("#foto-planta").show();
    } else if (tipo == 'Duplex' || tipo == 'Sobrado') {
      $("#foto-planta-1").show();
      $("#foto-planta-2").show();
    } else if (tipo == 'Triplex') {
      $("#foto-planta-1").show();
      $("#foto-planta-2").show();
      $("#foto-planta-3").show();
    } else {
      $("#foto-planta").show();
    }
  });

  $('.tipo-planta').change();

  $(document).on('click', '.remover-planta', function (e) {
    confirmacao().then((result) => {
      if (result.value) {        
        var id = $(this).data('id');
        ajaxRequest({
          url: "/admin/excluir-planta",
          metodo: 'POST',
          dados: {
            id: id
          },
          feedback: true,
          mensagemSucesso: 'Planta excluída com sucesso',
          mensagemErro: 'Erro, tente novamente mais tarde',
          reload: true
        });
      }
    });    
  });



  $(document).on('change', '#possui_laje_tecnica', function () {
    var possui = $(this).val();

    if (possui == 'Sim') {
      $("#laje_tecnica").show();
    } else {
      $("#laje_tecnica").hide();
    }
  });

});
$(function () {
  $("#salvar-dados-empreendimento").on('click', function () {

    var formData = new FormData($("#dados-empreendimento")[0]);

    $.ajax({
      url: '/admin/salvar-dados-empreendimento',
      method: 'POST',
      data: formData,
      beforeSend: addLoading(),
      processData: false,
      contentType: false,
      success: function (response) {
        removeLoading();
        Swal.fire({
          title: "Sucesso",
          text: "Empreendimento cadastrado com sucesso",
          type: 'success'
        });

        if (response.id !== undefined) {
          window.location.replace('/admin/empreendimento/' + response.id + '/editar');
        }

      }, error: function (data) {
        removeLoading();
        var dados = $.parseJSON(data.responseText);
        if (data.status === 422) {
          var errors = dados.errors;
          $.each(errors, function(key, value) {
            new PNotify({
              text: value,
              type: 'error',
            });
          });
        }

        if (data.status == 500) {
          new PNotify({
            text: 'Erro, tente novamente mais tarde',
            type: 'error',
          });
        }
      }
    });
  });

  $("#salvar-endereco-empreendimento").on('click', function () {
    ajaxRequest({
      url: '/admin/salvar-endereco-empreendimento',
      metodo: 'POST',
      dados: $("#endereco-empreendimento").serialize(),
      feedback: true,
      mensagemSucesso: 'Endereço salvo com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: false
    });
  });

  $("#salvar-endereco-stand").on('click', function () {
    ajaxRequest({
      url: '/admin/salvar-endereco-stand',
      metodo: 'POST',
      dados: $("#endereco-stand").serialize(),
      feedback: true,
      mensagemSucesso: 'Endereço salvo com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: false
    });
  });

  $("#salvar-itens-lazer-empreendimento").on('click', function () {
    ajaxRequest({
      url: '/admin/salvar-itens-lazer-empreendimento',
      metodo: 'POST',
      dados: $("#itens-lazer-empreendimento").serialize(),
      feedback: true,
      mensagemSucesso: 'Itens de lazer salvos com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: false
    });
  });

  $("#salvar-caracteristicas-empreendimento").on('click', function () {
    ajaxRequest({
      url: '/admin/salvar-caracteristicas-empreendimento',
      metodo: 'POST',
      dados: $("#caracteristicas-empreendimento").serialize(),
      feedback: true,
      mensagemSucesso: 'Características do empreendimento salvas com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: false
    });
  });

  $("#salvar-midias-empreendimento").on('click', function () {
    ajaxRequest({
      url: '/admin/salvar-midias-empreendimento',
      metodo: 'POST',
      dados: $("#midias-empreendimento").serialize(),
      feedback: true,
      mensagemSucesso: 'Mídias do empreendimento salvas com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: false
    });
  });

  $("#salvar-canais-empreendimento").on('click', function () {
    ajaxRequest({
      url: '/admin/salvar-canais-empreendimento',
      metodo: 'POST',
      dados: $("#canais-empreendimento").serialize(),
      feedback: true,
      mensagemSucesso: 'Canais de Atendimento salvos com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: false
    });
  });

  $("#salvar-honorarios-intermediacao").on('click', function () {
    ajaxRequest({
      url: '/admin/salvar-honorarios-intermediacao',
      metodo: 'POST',
      dados: $("#honorarios-intermediacao").serialize(),
      feedback: true,
      mensagemSucesso: 'Honorários de intermediação salvos com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: false
    });
  });

  $("#salvar-seo-empreendimento").on('click', function () {
    ajaxRequest({
      url: '/admin/empreendimento/salvar-seo',
      metodo: 'POST',
      dados: $("#seo-empreendimento").serialize(),
      feedback: true,
      mensagemSucesso: 'SEO do empreendimento salvo com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: false
    });
  });

  $("#salvar-arquivos-empreendimento").on('click', function (e) {

    e.preventDefault();
    e.stopImmediatePropagation();
    var form = $("#arquivos-empreendimento").closest("form");
    var formData = new FormData(form[0]);
    $.ajax({
        url: '/admin/salvar-arquivos-empreendimento',
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data) {

          Swal.fire(
            'OK!',
            'Os arquivos foram salvos!',
            'success'
          ).then((result) => {
            // Reload the Page
            location.reload();
          });
        }
    });

  });


  $("#salvar-tour-empreendimento").on('click', function () {
    ajaxRequest({
      url: '/admin/empreendimento/salvar-tour',
      metodo: 'POST',
      dados: $("#tour-empreendimento").serialize(),
      feedback: true,
      mensagemSucesso: 'Tour do empreendimento salvo com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: false
    });
  });

  $(document).on('mascara-telefone', {}, function () {
    $('.celular').mask('(00) 00000-0000');
    $('.fixo').mask('(00) 0000-0000');
  });

  $('.adicionar-telefone').on('click', function() {
    var html = $("#bloco-telefone").clone();

    html.find('.input-telefone').val('');

    html.show();

    $('#telefones').append(html);

    $(document).trigger("mascara-telefone");
  });

  $(document).on('click', '.remover-telefone', function (e) {
   e.preventDefault();
   $(this).parent().parent('div').remove();
 });

  $(document).on('change', '.tipo-telefone', function () {
    var tipo = $(this).val();

    if (tipo == 'Celular' || tipo == 'WhatsApp' || tipo == 'CelularWhatsapp') {
      $(this).parent().siblings('.numero-telefone').find('.input-group').find('.input-telefone').unmask().mask('(00) 00000-0000');
    } else {
      $(this).parent().siblings('.numero-telefone').find('.input-group').find('.input-telefone').unmask().mask('(00) 0000-0000');
    }
  });

  $(document).on("change", "#estado", function () {
    var estado_id = $(this).val();
    ajaxRequest({
      url: '/admin/buscar-cidade',
      metodo: 'POST',
      dados: {
        estado_id: estado_id
      },
      feedback: false,
      resultado: "#cidade-wrapper"
    });
    $("#cidade-cep-wrapper").hide();
    $("#cidade-wrapper").show();
    $("#bairro-wrapper").html('');
    $("#bairro-comercial-wrapper").html('');
  });

  $(document).on("change", "#cidade_id", function () {
    var cidade_id = $(this).val();
    $("#bairro-wrapper").show();
    $("#bairro-comercial-wrapper").show();

    ajaxRequest({
      url: '/admin/buscar-bairro',
      metodo: 'POST',
      dados: {
        cidade_id: cidade_id
      },
      feedback: false,
      resultado: "#bairro-wrapper"
    });

    ajaxRequest({
      url: '/admin/buscar-bairro-comercial',
      metodo: 'POST',
      dados: {
        cidade_id: cidade_id
      },
      feedback: false,
      resultado: "#bairro-comercial-wrapper"
    });
  });

  $(document).on("change", "#estado_stand", function () {
    var estado_id = $(this).val();
    ajaxRequest({
      url: '/admin/buscar-cidade-stand',
      metodo: 'POST',
      dados: {
        estado_id: estado_id
      },
      feedback: false,
      resultado: "#cidade-wrapper-stand"
    });
    $("#cidade-cep-wrapper-stand").hide();
    $("#cidade-wrapper-stand").show();
    $("#bairro-wrapper-stand").html('');
    $("#bairro-comercial-wrapper-stand").html('');
  });

  $(document).on("change", "#cidadeStand", function () {
    var cidade_id = $(this).val();
    $("#bairro-wrapper-stand").show();
    $("#bairro-comercial-wrapper-stand").show();

    ajaxRequest({
      url: '/admin/buscar-bairro',
      metodo: 'POST',
      dados: {
        cidade_id: cidade_id
      },
      feedback: false,
      resultado: "#bairro-wrapper-stand"
    });

    ajaxRequest({
      url: '/admin/buscar-bairro-comercial',
      metodo: 'POST',
      dados: {
        cidade_id: cidade_id
      },
      feedback: false,
      resultado: "#bairro-comercial-wrapper-stand"
    });
  });

  $(document).on("change", "#tipo", function () {
    var tipo = $(this).val();
    ajaxRequest({
      url: '/admin/buscar-subtipo-empreendimento',
      metodo: 'POST',
      dados: {
        tipo: tipo
      },
      feedback: false,
      resultado: "#subtipo"
    });
  });

  $(document).on("change", "#subtipo", function () {
    var subtipo = $(this).val();

    ajaxRequest({
      url: '/admin/buscar-variacao-empreendimento',
      metodo: 'POST',
      dados: {
        subtipo: subtipo
      },
      feedback: false,
      resultado: "#variacao"
    });
  });

  $(document).on('click', '.remover-empreendimento', function (e) {
    confirmacao().then((result) => {
      if (result.value) {
        var id = $(this).data('id');
        ajaxRequest({
          url: '/admin/excluir-empreendimento',
          metodo: 'POST',
          dados: {
            id: id
          },
          feedback: true,
          reload: true,
          mensagemSucesso: "Empreendimento excluído com sucesso",
          mensagemErro: "Erro ao excluir, tente novamente mais tarde"
        });
      }
    });
  });



  $("#addTour").on('click', function () {
    $('.linha-tour').clone().appendTo($('#tour360'));
  });

  $(document).on('click', '.removeTour', function () {
    $(this.parentNode).remove();
  });

  $(document).on("change", "#estado", function () {
    var estado_id = $(this).val();
    ajaxRequest({
      url: '/admin/buscar-cidade',
      metodo: 'POST',
      dados: {
        estado_id: estado_id
      },
      feedback: false,
      resultado: "#cidade-wrapper"
    });
    $("#cidade-cep-wrapper").hide();
    $("#cidade-wrapper").show();
    $("#bairro-wrapper").html('');
    $("#bairro-comercial-wrapper").html('');
  });


});

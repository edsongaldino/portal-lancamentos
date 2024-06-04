$(function () {  
  $("#salvar-dados-construtora").on('click', function () {
    
    var formData = new FormData($("#dados-construtora")[0]);

    ajaxRequestUpload({
      metodo: 'POST',
      url: '/admin/salvar-construtora-perfil',
      dados: formData,
      reload: true,
      feedback: true,
      mensagemSucesso: 'Dados atualizados com sucesso',
      mensagemErro: 'Erro ao atualizar dados, tente novamente mais tarde',
    });
  });

  $("#salvar-dados-endereco-construtora").on('click', function () {
    ajaxRequest({
      metodo: 'POST',
      url: '/admin/salvar-endereco-construtora-perfil',
      dados: $("#dados-endereco-construtora").serialize(),
      reload: true,
      feedback: true,
      mensagemSucesso: 'Endereço atualizado com sucesso',
      mensagemErro: 'Erro ao atualizar endereço, tente novamente mais tarde',
    });
  });


  $("#salvar-dados-canais-atendimento").on('click', function () {
    ajaxRequest({
      metodo: 'POST',
      url: '/admin/salvar-canais-atendimento-perfil',
      dados: $("#dados-canais-atendimento").serialize(),
      reload: true,
      feedback: true,
      mensagemSucesso: 'Dados atualizados com sucesso',
      mensagemErro: 'Erro ao atualizar dados, tente novamente mais tarde',
    });
  });

  
  $("#salvar-dados-redes-sociais").on('click', function () {
    ajaxRequest({
      metodo: 'POST',
      url: '/admin/salvar-redes-sociais-perfil',
      dados: $("#dados-redes-sociais").serialize(),
      reload: true,
      feedback: true,
      mensagemSucesso: 'Dados atualizados com sucesso',
      mensagemErro: 'Erro ao atualizar dados, tente novamente mais tarde',
    });
  });

  $(document).on('mascara-telefone', {}, function () {
    $('.celular').mask('(00) 00000-0000');
    $('.fixo').mask('(00) 0000-0000');
    $('.fixo_sem_ddd').mask('0000-0000');
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
    } else if (tipo == 'FixoSemDDD') {
      $(this).parent().siblings('.numero-telefone').find('.input-group').find('.input-telefone').unmask().mask('0000-0000');
    } else {
      $(this).parent().siblings('.numero-telefone').find('.input-group').find('.input-telefone').unmask().mask('(00) 0000-0000');
    }    
  });

  $(document).on("change", "#estado", function () {
    var estado_id = $(this).val();
    $.ajax({
      method: 'post',
      url: "/admin/buscar-cidade-perfil",
      data: {
        estado_id: estado_id
      },
      success: function (response) {        
        $("#cidade-wrapper").html(response);
        $("#bairro-wrapper").html('');
      }
    });
  });

  $(document).on("change", "#cidade", function () {
    var cidade_id = $(this).val();
    $.ajax({
      method: 'post',
      url: "/admin/buscar-bairro-perfil",
      data: {
        cidade_id: cidade_id
      },
      success: function (response) {
        $("#bairro-wrapper").html(response);
      }
    });
  });

  $('#membro').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var titulo = button.data('titulo');
    var botao = button.data('botao');
    var method = button.data('method');
    var url = button.data('url');
    var modal = $(this);
  
    $.ajax({
        method: method,
        url: url,
        success: function (response) {
          modal.find('.modal-title').html(titulo);
          modal.find('.modal-body').html(response);
          modal.find('.submit-btn').val(botao);
        }
    });
  });

  

  $('.excluir-membro').on('click', function (e) {
    var url = $(this).data('url');
    
    if (confirm('Tem certeza que deseja excluir?')) {
      $.ajax({
          method: 'POST',
          url: url,
          success: function (response) {
              if (response.sucesso == 'true') {                        
                  new PNotify({
                    text: response.mensagem,
                    type: 'success',                    
                  });

                  setTimeout(function () {
                      window.location.reload();
                  }, 2000);
              } else {
                  new PNotify({
                    text: response.mensagem,
                    type: 'error',                    
                  });
              }
          }
      });
    } else {
      e.preventDefault();
    }  
  });

  
});
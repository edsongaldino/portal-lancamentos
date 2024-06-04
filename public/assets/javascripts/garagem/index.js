$(function () {
  localStorage.setItem('torre_id', 'Todas');
  localStorage.setItem('situacao', 'Todas');

  function ajaxFiltro(url) {
    $.ajax({
      method: 'post',
      url: url,
      data: {
        empreendimento_id: $("#empreendimento_id").val(),
        torre_id: localStorage.getItem('torre_id'),
        situacao: localStorage.getItem('situacao')
      },
      success: function (response) {
        new PNotify({
          text: 'Garagens filtradas com sucesso',
          type: 'success',                    
        });

        $('#garagens').html(response);
        $('.pavimentos-cores').removeAttr('style');
      }
    });
  }
  
  $("#torre").on('change', function () {
    var torre_id = $(this).val();
    localStorage.setItem('torre_id', torre_id);
    ajaxFiltro("/admin/empreendimento/filtrar-garagens");
  });

  $("#situacao").on('change', function () {
    var situacao = $(this).val();
    localStorage.setItem('situacao', situacao);
    ajaxFiltro("/admin/empreendimento/filtrar-garagens");
  });

  $(document).on('show.bs.modal', '#alterarVendaGaragem', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id');
    var situacao = button.data('situacao');
    var url = button.data('url');
    var modal = $(this);

    $.ajax({
      method: 'get',
      url: url,
      data: {
        id: id,
        situacao: situacao
      },
      success: function (response) {            
        modal.find('.modal-body').html(response);
        if (situacao == '') {
          modal.find('#btn-submit').val('Alterar Garagem');  
          modal.find('.modal-title').html('Alterar Garagem');
        } else {
          modal.find('.modal-title').html('Alterar situação para ' + situacao);
          modal.find('#btn-submit').val('Alterar situação para ' + situacao);  
        }
        modal.find('#situacao').val(situacao);
      }
    });
  });

  
  $(document).on('show.bs.modal', '#alterarInfoGaragem', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id');
    var url = button.data('url');
    var modal = $(this);
    
    $.ajax({
      method: 'get',
      url: url,
      data: {
        id: id
      },
      success: function (response) {            
        modal.find('.modal-body').html(response);
        modal.find('#btn-submit').val('Alterar Vaga');
        modal.find('.modal-title').html('Alterar Informações da Garagem');
      }
    });
  });

  $(document).on('click', '.alterar-situacao-garagem', function () {
    var id = $(this).data('id');
    var situacao = $(this).data('situacao');
    var url = $(this).data('url');

    ajaxRequest({
      url: url,
      metodo: 'POST',
      dados: {
        id: id,
        situacao: situacao
      },
      feedback: true,
      mensagemSucesso: 'Situação da garagem alterada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: true
    });    
  });
});
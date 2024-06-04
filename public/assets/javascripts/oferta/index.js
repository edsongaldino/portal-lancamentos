$(function () {
  $('#oferta').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var url = button.data('url');
    var modal = $(this);
    modal.find('.modal-body').html('');
  
    $.ajax({
        method: 'GET',
        url: url,
        success: function (response) {
          localStorage.clear();          
          modal.find('.modal-title').html('Nova oferta');
          modal.find('.modal-body').html(response);
        }
    });
  });

  $(document).on('change', '#empreendimento', function () {
    var empreendimento_id = $(this).val();
    ajaxRequest({
      metodo: 'POST',
      url: '/admin/buscar-torres-quadras-ofertas',
      dados: {
        empreendimento_id: empreendimento_id
      },
      feedback: false,
      resultado: "#buscar-unidade"
    })
  });


  $('.btn-remover').on('click', function (e) {
    var url = $(this).data('url');

    Swal.fire({
      title: 'Tem certeza que deseja excluir a oferta?',
      text: "Selecione as opções abaixo!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim tenho certeza!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        $.ajax({
            method: 'POST',
            url: url,
            success: function (response) {
                if (response.sucesso == 'true') {                        
                    Swal.fire(
                      'Sucesso!',
                      response.retorno,
                      'success'
                    );

                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                } else {
                    Swal.fire(
                      'Desculpe',
                      response.retorno,
                      'error'
                    );
                }
            }
        });
      }
    });      
  });

});
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function ajaxRequest(parameters) {
  $.ajax({
    url: parameters.url,
    method: parameters.metodo,
    data: parameters.dados,
    beforeSend: addLoading(),
    success: function (response) {
      removeLoading();
      if (parameters.feedback === true) {
        if (response.sucesso == 'true') {

          Swal.fire({
            title: "Sucesso",
            text: parameters.mensagemSucesso,
            type: 'success'
          });
          return;
        } else {
          Swal.fire({
            title: "Erro",
            text: parameters.mensagemErro,
            type: 'error'
          });
          return;
        }
      }

      if (parameters.resultado !== undefined) {
        $(parameters.resultado).html(response);
        return;
      }
    }, error: function (data) {
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
}
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(".erro-permissao").on('click', function () {
  Swal.fire(
      'Ooops :(',
      'Você não tem permissão para alterar informações!',
      'warning'
  )
});

$(".erro-permissao-menu").on('click', function () {
  Swal.fire(
      'Ooops :(',
      'Você não tem permissão para acessar esse módulo!',
      'info'
  )
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

          if (parameters.redirect !== undefined) {
            setTimeout(function () {
              window.location.replace(parameters.redirect);
            }, 2000);  
            return;
          }
          

          if (parameters.reload !== undefined) {
            var tempo = parameters.tempo !== undefined ? parameters.tempo : 2000;
            console.log('tempo', tempo);
            setTimeout(function () {
              window.location.reload();
            }, tempo);
            return;            
          }

          return;
        } else {
          Swal.fire({
            title: "Erro",
            text: response.retorno != undefined ? response.retorno : parameters.mensagemErro,
            type: 'error'
          });
          return;
        }
      }

      if (parameters.resultado !== undefined) {
        if (parameters.resultado instanceof Array) {          
          parameters.resultado.forEach(function (item) {
            $(item).html(response);  
          });
        } else {
          $(parameters.resultado).html(response);  
        }        
        return;
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
}

function ajaxRequestUpload(parameters) {
  console.log('parameters', parameters, parameters.reload !== undefined);
  $.ajax({
    url: parameters.url,
    method: parameters.metodo,
    data: parameters.dados,
    beforeSend: addLoading(),
    processData: false,  // tell jQuery not to process the data
    contentType: false, 
    success: function (response) {
      removeLoading();
      if (parameters.feedback === true) {
        if (response.sucesso == 'true') {

          Swal.fire({
            title: "Sucesso",
            text: parameters.mensagemSucesso,
            type: 'success'
          });

          if (parameters.redirect !== undefined) {
            setTimeout(function () {
              window.location.replace(parameters.redirect);
            }, 2000);  
            return;
          }
          

          if (parameters.reload !== undefined) {
            var tempo = parameters.tempo !== undefined ? parameters.tempo : 2000;
            console.log('tempo', tempo);
            setTimeout(function () {
              window.location.reload();
            }, tempo);
            return;            
          }

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
}
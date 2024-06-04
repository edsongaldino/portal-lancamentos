$(document).on('click', '.excluirConvencao', function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  var token = $(this).data('token');

      swal({
          title: "Confirma a exclusão desse registro?",
          type: "error",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não",
          showCancelButton: true,
      },
      function() {
        $.ajax({
          url: '/convencao/excluir',
          method: 'POST',
          data: {
            id: id,
            "_token": token
          },
        
        success: function() {   
          swal({title: "OK", text: "Registro removido!", type: "success"},
            function(){ 
                location.reload();
            }
          );
        },

        error: function() {   
          swal({title: "OPS", text: "Erro ao remover registro!", type: "warning"},
            function(){ 
                location.reload();
            }
          );
        }

        });
  });
});

$(document).on('click', '.excluirClausula', function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  var token = $(this).data('token');

      swal({
          title: "Confirma a exclusão desse registro?",
          type: "error",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não",
          showCancelButton: true,
      },
      function() {
        $.ajax({
          url: '/clausula/excluir',
          method: 'POST',
          data: {
            id: id,
            "_token": token
          },
        
        success: function() {   
          swal({title: "OK", text: "Registro removido!", type: "success"},
            function(){ 
                location.reload();
            }
          );
        },

        error: function() {   
          swal({title: "OPS", text: "Erro ao remover registro!", type: "warning"},
            function(){ 
                location.reload();
            }
          );
        }

        });
  });
});


$(document).on('click', '.excluirAvaliacao', function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  var token = $(this).data('token');

      swal({
          title: "Confirma a exclusão desse registro?",
          type: "error",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não",
          showCancelButton: true,
      },
      function() {
        $.ajax({
          url: '/avaliacao/excluir',
          method: 'POST',
          data: {
            id: id,
            "_token": token
          },
        
        success: function() {   
          swal({title: "OK", text: "Registro removido!", type: "success"},
            function(){ 
                location.reload();
            }
          );
        },

        error: function() {   
          swal({title: "OPS", text: "Erro ao remover registro!", type: "warning"},
            function(){ 
                location.reload();
            }
          );
        }

        });
  });
});

$(document).on('click', '.excluirTipo', function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  var token = $(this).data('token');

      swal({
          title: "Confirma a exclusão desse registro?",
          type: "error",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não",
          showCancelButton: true,
      },
      function() {
        $.ajax({
          url: '/tipo/excluir',
          method: 'POST',
          data: {
            id: id,
            "_token": token
          },
        
        success: function() {   
          swal({title: "OK", text: "Registro removido!", type: "success"},
            function(){ 
                location.reload();
            }
          );
        },

        error: function() {   
          swal({title: "OPS", text: "Erro ao remover registro!", type: "warning"},
            function(){ 
                location.reload();
            }
          );
        }

        });
  });
});


$(function () {
  
  $(document).on("click", "#alterar_senha", function () {

    if($("#alterar_senha").is(':checked')){
      $("#confirmar_senha").css("display", "block");
      $("#senha").css("display", "block");
      $("#senha_antiga").css("display", "none");
    } else {
      $("#confirmar_senha").css("display", "none");
      $("#senha").css("display", "none");
      $("#senha_antiga").css("display", "block");
    }

  });

});
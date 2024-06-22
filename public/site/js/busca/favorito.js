function addFavorito(id) {
  swal({
    title: "Gostaria de incluir aos favoritos?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Sim, Quero adicionar!",
    cancelButtonText: "Não!",
    closeOnConfirm: false,
    closeOnCancel: false
    },
    function(isConfirm) {
    if (isConfirm) {

      $.ajax({
            url:"empreendimentoFavorito.php",
            type:'get',
            data: {
        'acao':'incluir',
                'id':id
            }
      }).done(function(resp){
        swal("Adicionado!", "Empreendimento adicionado aos favoritos!", "success");
        location.reload();
      }).fail(function(){
        swal("Erro!", "A Requisição falhou! :(", "error");
      });

      
    } else {
      swal("Cancelado!", "O empreendimento não foi adicionado! :)", "error");
    }
  });
}

function removeFavorito(id) {
  swal({
    title: "Gostaria de remover dos favoritos?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Sim, Quero remover!",
    cancelButtonText: "Não!",
    closeOnConfirm: false,
    closeOnCancel: false
    },
    function(isConfirm) {
    if (isConfirm) {

      $.ajax({
            url:"empreendimentoFavorito.php",
            type:'get',
            data: {
        'acao':'remover',
                'id':id
            }
      }).done(function(resp){
        swal("Removido!", "Empreendimento removido dos favoritos!", "success");
        location.reload();
      }).fail(function(){
        swal("Erro!", "A Requisição falhou! :(", "error");
      });

      
    } else {
      swal("Cancelado!", "O empreendimento não foi removido! :)", "error");
    }
  });
}
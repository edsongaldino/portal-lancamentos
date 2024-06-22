$(function () {

  $(document).on('show.bs.modal', '#modal-oferta', function (event) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var button = $(event.relatedTarget)
    var id = button.data('id');
    var tipo = button.data('tipo');

    $(this).html('...carregando');
    
    ajaxRequest({
      url: '/carregar-oferta',
      metodo: 'POST',
      dados: {
        id: id,
        tipo: tipo
      },
      resultado: "#modal-oferta"
    });
  });
});
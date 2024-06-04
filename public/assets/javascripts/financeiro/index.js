$(function () {

  $.fn.modal.Constructor.prototype.enforceFocus = function() {};

  $('select[name=empreendimento_id]').on('change', function () {
    var empreendimento_id = $(this).val();
    var construtora_id = $(this).data('construtora');
    
    if (empreendimento_id == '' && construtora_id == '') {
      window.location.href = '/admin/construtora/1/financeiro/';
      return;
    }
    
    if (empreendimento_id == '') {      
      window.location.href = '/admin/construtora/' + construtora_id + '/financeiro/';
      return;      
    }

    if (construtora_id == '') {
      window.location.href = '/admin/construtora/1/financeiro/?empreendimento_id=' + empreendimento_id;
      return;
    } 

    window.location.href = '/admin/construtora/' + construtora_id + '/financeiro/?empreendimento_id=' + empreendimento_id;
  });

  $('#filtrar_compradores').on('submit', function () {
    var construtora_id = $(this).data('construtora');
    var empreendimento_id = $(this).data('empreendimento');
    
    if (empreendimento_id == '' && construtora_id == '') {
      window.location.href = '/admin/construtora/1/financeiro/';
      return;
    }
    
    if (empreendimento_id == '') {      
      window.location.href = '/admin/construtora/' + construtora_id + '/financeiro/';
      return;      
    }

    if (construtora_id == '') {
      window.location.href = '/admin/construtora/1/financeiro/?empreendimento_id=' + empreendimento_id;
      return;
    } 

    window.location.href = '/admin/construtora/' + construtora_id + '/financeiro/?empreendimento_id=' + empreendimento_id;
  });

  $('select[name=tipo_cobranca]').on('change', function () {
    var tipo = $(this).val();
    var $div_recorrencia = $("#dados-recorrencia");

    $div_recorrencia.hide();

    if (tipo == 'Recorrente') {
      $div_recorrencia.show();
    }
  });

  $('input[type=radio][name=tipo_fim_cobranca]').on('change', function () {
    var tipo = $(this).val();
    console.log('tipo fim', tipo);
    var $especificar_recorrencia = $("#especificar-recorrencias");

    $especificar_recorrencia.hide();

    if (tipo == 'Especifico') {
      $especificar_recorrencia.show();
    }
  });

  $(document).on('show.bs.modal', '#lancamento-financeiro', function (event) {
    $("#form-lancamento-financeiro")[0].reset();
    $('.construtoras').select2();
  });

  $(document).on('show.bs.modal', '#modal-pagamento', function (event) {
    var button = $(event.relatedTarget) 
    var url = button.data('url');
    var ifrm = document.createElement("iframe");
    var modal = $(this);
    ifrm.setAttribute("src", url);
    ifrm.style.width = "850px";
    ifrm.style.height = "600px";    
    ifrm.style.border = 'none';
    modal.find('.modal-body').html(ifrm);
  });

  $("#criar-lancamento-financeiro").on('click', function () {
    var dados = $("#form-lancamento-financeiro").serialize();
    ajaxRequest({
      url: '/admin/construtora/financeiro/criar-lancamento-financeiro',
      metodo: 'POST',
      dados: dados,
      feedback: true,
      mensagemSucesso: 'Lançamento Financeiro Criado Com Sucesso',
      reload: true
    });    
  });

  $(".cancelar-lancamento-financeiro").on('click', function (e) {    
    e.preventDefault();

    confirmacao('Tem certeza que deseja cancelar o lançamento financeiro?').then((result) => {
      if (result.value) {
       var url = $(this).data('url');

       ajaxRequest({
         url: url,
         metodo: 'POST',
         feedback: true,
         mensagemSucesso: 'Lançamento Financeiro Cancelado com Sucesso',
         reload: true
       });    
     }
   });
  });

  $(".reenviar-lancamento-email").on('click', function (e) {    
    e.preventDefault();

    confirmacao('Tem certeza que deseja reenviar por e-mail?').then((result) => {
      if (result.value) {
       var url = $(this).data('url');

       ajaxRequest({
         url: url,
         metodo: 'POST',
         feedback: true,
         mensagemSucesso: 'Lançamento Financeiro Reenviado por e-mail com Sucesso',
         reload: true
       });    
     }
   });
  });

  $(document).on('change', '#torre_filtro', function () {
    var torre_id = $(this).val();

    ajaxRequest({
      metodo: 'POST',
      url: '/admin/buscar-unidades-torre-vendidas',
      dados: {
        torre_id: torre_id
      },
      resultado: '#box-unidades' 
    });

    $("#box-unidades").css("display","block"); 
  });

  $(document).on('change', '#quadra_filtro', function () {
    var quadra_id = $(this).val();

    console.log('quadra', quadra_id);

    ajaxRequest({
      metodo: 'POST',
      url: '/admin/buscar-unidades-quadra-vendidas',
      dados: {
        quadra_id: quadra_id
      },
      resultado: '#box-unidades' 
    });

    $("#box-unidades").css("display","block"); 
  });

});
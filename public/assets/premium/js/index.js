$("#tipo_proposta").on('change', function () {
    var valor = $(this).val();
    if (valor == 'Pagamento à Vista') {
        $("#pagamento-avista").css("display", "block");
        $("#entrada").css("display", "none");
        $("#tipo_negociacao").css("display", "none");
        $("#box-baloes").css("display", "none");
        $("#mensais").css("display", "none");
        $("#saldo-remanescente").css("display", "none");
    }
    if (valor == 'Personalizada') {
        $("#tipo_negociacao").css("display", "block");
        $("#entrada").css("display", "block");
        $("#box-baloes").css("display", "block");
        $("#mensais").css("display", "block");
        $("#saldo-remanescente").css("display", "block");
        $("#pagamento-avista").css("display", "none");
    }
});

$("#tipo_negociacao_saldo").on('change', function () {

    var tipo_negociacao = $(this).val();

    if (tipo_negociacao == 'Mediante Financiamento') {
        $("#financiamento").css("display", "block");
        $("#bens").css("display", "none");
    }
    if (tipo_negociacao == 'Bens Negociáveis') {
        $("#financiamento").css("display", "none");
        $("#bens").css("display", "block");
    }
    if (tipo_negociacao == 'Recursos Próprios') {
        $("#financiamento").css("display", "none");
        $("#bens").css("display", "none");
    }
});

$("#vaga_extra").on('change', function () {

  var vaga_extra = $(this).val();

  alert(vaga_extra);

  if (vaga_extra != 'Não') {

      $("#boxVagasExtras").css("display", "block");

      if (vaga_extra == 'Padrão') {
        $("#ExtraPadrao").css("display", "block");
        $("#ExtraDupla").css("display", "none");
      }

      if (vaga_extra == 'Gaveta Dupla') {
        $("#ExtraPadrao").css("display", "none");
        $("#ExtraDupla").css("display", "block");
      }

  }else{
      $("#boxVagasExtras").css("display", "none");
  }

});

$(".mostrar").on('click', function () {
    $('#dadosUnidade').slideToggle('slow');
    $('.mostrar').hide();
    $('.ocultar').show();
});


$(".proposta-block").on('click', function () {
    Swal.fire('Ops','Não existe nenhuma tabela de preço vigente!','error');
});


$(".ocultar").on('click', function () {
    $('#dadosUnidade').slideToggle('slow');
    $('.mostrar').show();
    $('.ocultar').hide();
});

$(".mostrarC").on('click', function () {
  $('#PropostaConstrutora').slideToggle('slow');
  $('.mostrarC').hide();
  $('.ocultarC').show();
});

$(".ocultarC").on('click', function () {
  $('#PropostaConstrutora').slideToggle('slow');
  $('.mostrarC').show();
  $('.ocultarC').hide();
});


$(".mostrarProposta").on('click', function () {
    $('#minhaProposta').slideToggle('slow');
    $('.mostrarProposta').hide();
    $('.ocultarProposta').show();
});

$(".ocultarProposta").on('click', function () {
    $('#minhaProposta').slideToggle('slow');
    $('.mostrarProposta').show();
    $('.ocultarProposta').hide();
});


$(".btn-detalhes, .foto-planta").on('click', function () {

    ajaxRequest({
      url: '/planta/detalhe',
      metodo: 'POST',
      dados: {
        planta: $(this).attr("data-idplanta"),
        ocultar: 'N'
      },
      feedback: false,
      resultado: '#detalhe-planta-modal'
    });

    $("#plantaModal").modal("show");
});


function inicializar() {
    var coordenadas = {lat: parseFloat($('#latitude').val()), lng: parseFloat($('#longitude').val()) };

    var mapa = new google.maps.Map(document.getElementById('mapa-google'), {
     zoom: 15,
     center: coordenadas
   });

    var marker = new google.maps.Marker({
     position: coordenadas,
     map: mapa,
     title: 'Meu marcador'
   });

}

function EnviarFormCliente() {

    var nome = FormCliente.nome.value;
    var cpf = FormCliente.cpf.value;
    var email = FormCliente.email.value;
    var telefone = FormCliente.telefone.value;
    var renda = FormCliente.renda.value;

    if (nome == "") {
        Swal.fire('Ops','O campo nome deve ser preenchico','error');
        FormCliente.nome.focus();
        return false;
    }

    if (cpf == "") {
        Swal.fire('Ops','O campo cpf deve ser preenchido!','error');
        FormCliente.cpf.focus();
        return false;
    }

    if (email == "") {
        Swal.fire('Ops','O campo email não pode ser vazio!','error');
        FormCliente.email.focus();
        return false;
    }

    if (telefone == "") {
        Swal.fire('Ops','O campo telefone deve ser preenchido!','error');
        FormCliente.telefone.focus();
        return false;
    }

    if (renda == "") {
        Swal.fire('Ops','A renda é obrigatória!','error');
        FormCliente.renda.focus();
        return false;
    }

    document.getElementById('FormCliente').submit();
}


function EnviarContatoConstrutora() {

  var nome = FormContatoConstrutora.nome.value;
  var email = FormContatoConstrutora.email.value;
  var telefone = FormContatoConstrutora.telefone.value;
  var previsao = FormContatoConstrutora.previsao.value;
  var interesse = FormContatoConstrutora.interesse.value;
  var renda = FormContatoConstrutora.renda.value;
  var mensagem = FormContatoConstrutora.mensagem.value;

  if (nome == "") {
      Swal.fire('Ops','O campo nome deve ser preenchico','error');
      FormContatoConstrutora.nome.focus();
      return false;
  }

  if (email == "") {
      Swal.fire('Ops','O campo email não pode ser vazio!','error');
      FormContatoConstrutora.email.focus();
      return false;
  }

  if (telefone == "") {
      Swal.fire('Ops','O campo telefone deve ser preenchido!','error');
      FormContatoConstrutora.telefone.focus();
      return false;
  }

  if (previsao == "") {
      Swal.fire('Ops','A previsao é obrigatória!','error');
      FormContatoConstrutora.previsao.focus();
      return false;
  }

  if (interesse == "") {
    Swal.fire('Ops','O campo interesse é obrigatório!','error');
    FormContatoConstrutora.interesse.focus();
    return false;
  }

  if (renda == "") {
    Swal.fire('Ops','A renda é obrigatória!','error');
    FormContatoConstrutora.renda.focus();
    return false;
  }

  var formData = {
    nome : FormContatoConstrutora.nome.value,
    email : FormContatoConstrutora.email.value,
    telefone : FormContatoConstrutora.telefone.value,
    previsao : FormContatoConstrutora.previsao.value,
    interesse : FormContatoConstrutora.interesse.value,
    renda : FormContatoConstrutora.renda.value,
    mensagem : FormContatoConstrutora.mensagem.value,
    empreendimento_id : $('#empreendimento_id').val(),
    "_token": $('#token').val()
  };

  $.ajax({
    type: "POST",
    url: "/empreendimento/enviar-contato-cliente",
    data: formData,
    dataType: "json",
    encode: true,
  }).done(function (data) {

    if (data.sucesso == 'true') {
        Swal.fire('OK',data.retorno,'success');
    } else {
        Swal.fire('Ops','Houve algum erro no envio','error');
        console.log(data);
    }

  });

}

function ConferirProposta() {

    document.getElementById('FormGravarVagaExtra').submit();

}

$("#add-balao").on('click', function () {
    $('#box-baloes').append('<div class="linha-balao del"><input type="text" class="form-control valor-balao money" name="valor_parcela_balao[]" onblur="calcula_saldo()"><input type="text" class="form-control data-balao date" name="data_parcela_balao[]">');
});

$(".delBalao").on('click', function () {
    $("#box-baloes").find("div.del:last").remove();
    calcula_saldo();
});

$(".sair").on('click', function () {

    Swal.fire({
        title: "Deseja realmente sair desta proposta?",
        text: "Saindo agora você perderá todos os dados já preenchidos.",
        type: "error",
        confirmButtonText: "OK",
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          window.location.href = "//stackoverflow.com";
        }
    });

});

$(".vaga").on('click', function () {

    var id = $(this).attr("data-idvaga");
    var tipo = $(this).attr("data-tipovaga");
    var nome = $(this).attr("data-nomevaga");
    $("input[name=idVaga]").attr("value",id);
    $("input[name=tipoVaga]").attr("value",tipo);
    $("#ModalVaga").find("h5").html('<i class="fas fa-car" aria-hidden="true"></i> ' + nome);

    $("#ModalVaga").modal("show");

});

$(".excluirVaga").on('click', function () {

    var id = $(this).attr("data-id-vaga");
    var nome = $(this).attr("data-nome-vaga");
    $("input[name=vaga_id]").attr("value",id);
    $("#ModalRemoverVaga").find("h5").html('<i class="fas fa-car" aria-hidden="true"></i> ' + nome);

    $("#ModalRemoverVaga").modal("show");

});


function EnviarFormProposta() {

    var tipo_proposta = FormProposta.tipo_proposta.value;
    var valor_unidade = FormProposta.valor_unidade.value;

    if (tipo_proposta == "Pagamento à Vista") {

        var valor_avista = FormProposta.valor_avista.value.replace(".", "").replace(",", ".");
        var minimo_avista = valor_unidade - ((valor_unidade/100)*10);

        if (valor_avista < minimo_avista) {
            Swal.fire('Ops','O valor à vista precisa ser maior!','error');
            FormProposta.valor_avista.focus();
            return false;
        }

    }

    if (tipo_proposta == "Personalizada") {

        var valor_entrada = FormProposta.valor_entrada.value;
        var qtd_mensal = FormProposta.qtd_mensal.value;
        var saldo_remanescente = FormProposta.saldo_remanescente.value;
        var banco_preferencial = FormProposta.banco_preferencial.value;
        var data_nascimento = FormProposta.data_nascimento.value;
        var tipo_negociacao = FormProposta.tipo_negociacao_saldo.value;

        var minimo_entrada = valor_unidade - ((valor_unidade/100)*20);

        if (valor_entrada < minimo_entrada) {
            Swal.fire('Ops','O valor de entrada deve ser (NO MÍNIMO) 20% do valor da unidade!','error');
            FormProposta.valor_entrada.focus();
            return false;
        }

        if (tipo_negociacao == 'Mediante Financiamento') {
            if (data_nascimento == "") {
                Swal.fire('Ops','A data de nascimento não pode ser vazia!','error');
                FormProposta.valor_entrada.focus();
                return false;
            }
        }

    }

    document.getElementById('FormProposta').submit();
  }

  function EnviarProposta() {

    var preferencia_contato = FormPreferencias.preferencia_contato.value;
    var preferencia_horario = FormPreferencias.preferencia_horario.value;

    if (preferencia_contato == '' || preferencia_horario == '') {

        Swal.fire('Ops','As opções de contato precisam ser selecionadas!','error');
        FormPreferencias.preferencia_contato.focus();
        return false;

    }

    document.getElementById('FormPreferencias').submit();
  }


  $("#valor_entrada, #valor_mensal, #qtd_mensal, .valor-balao").on('blur',function(){

     calcula_saldo();

  });

  function calcula_saldo(){

    percentual_remanescente = '';

    valor_entrada = $("#valor_entrada").val().replace(".", "").replace(",", ".");
    valor_mensais = $("#valor_mensal").val().replace(".", "").replace(",", ".");
    qtd_mensal = $("#qtd_mensal").val();
    valor_unidade = $("#valor_unidade").val();

    total_baloes = 0;

    $('.valor-balao').each(function (index, element) {
      var valor = element.value.replace(".", "").replace(",", ".");
      if (valor !== undefined) {
        total_baloes = parseFloat(total_baloes) + parseFloat(valor);
      }
    });

    total_mensal = parseFloat(qtd_mensal || 0) * parseFloat(valor_mensais || 0);

    total_proposta = parseFloat(total_mensal || 0) + parseFloat(valor_entrada || 0);

    saldo_remanescente = valor_unidade - total_proposta - (total_baloes || 0);

    $("#saldo_remanescente").val(saldo_remanescente.toLocaleString('pt-br', { minimumFractionDigits: 2 }));

  }

  /*
* This is the plugin
*/
(function(a){a.createModal=function(b){defaults={title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false};var b=a.extend({},defaults,b);var c=(b.scrollable===true)?'style="max-height: 420px;overflow-y: auto;"':"";html='<div class="modal fade" id="myModal">';html+='<div class="modal-dialog">';html+='<div class="modal-content">';html+='<div class="modal-header">';html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';if(b.title.length>0){html+='<h4 class="modal-title">'+b.title+"</h4>"}html+="</div>";html+='<div class="modal-body" '+c+">";html+=b.message;html+="</div>";html+='<div class="modal-footer">';if(b.closeButton===true){html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>'}html+="</div>";html+="</div>";html+="</div>";html+="</div>";a("body").prepend(html);a("#myModal").modal().on("hidden.bs.modal",function(){a(this).remove()})}})(jQuery);

/*
* Here is how you use it
*/
$(function(){
    $('.view-pdf').on('click',function(){
        var pdf_link = $(this).attr('href');
        var iframe = '<div class="iframe-container"><iframe src="'+pdf_link+'"></iframe></div>'
        $.createModal({
        title:'My Title',
        message: iframe,
        closeButton:true,
        scrollable:false
        });
        return false;
    });
})

function habilitaEnvio(){
    $('.btn-enviar-mobile').css('display','block');
    $('.loadingImg_Mobile').css('display','none');
  }

  function DesabilitaEnvioChat(){
    $('.loadingImg_Chat').css('display','block');
    $('.ChatMobileEnviar').css('display','none');
  }

  function HabilitaEnvioChat(){
    $('.loadingImg_Chat').css('display','none');
    $('.ChatMobileEnviar').css('display','block');
  }

  $(document).on('click', '.chat-mobile', function (e) {

    e.preventDefault();

    DesabilitaEnvioChat();

    let nome = $('#nome').val();
    let whatsapp = $('#whatsapp').val();
    let tipo_clique = $('#tipo_clique').val();
    let empreendimento_id = $('#empreendimento_id').val();


    if (nome == '') {
      Swal.fire('Desculpe', 'Por favor, nos informe seu nome', 'error');
      HabilitaEnvioChat();
      return false;
    }

    if (whatsapp == '') {
      Swal.fire('Desculpe', 'Por favor, nos informe seu telefone', 'error');
      HabilitaEnvioChat();
      return false;
    }

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: "/chat-empreendimento",
      type:"POST",
      data:{
        nome:nome,
        whatsapp:whatsapp,
        tipo_clique:tipo_clique,
        empreendimento_id:empreendimento_id
      },
      success:function(response){
        $('.loadingImg_Chat').css('display','none');
        $('.link-whatsapp-mobile').css('display','block');
        $('.link-telefone-mobile').css('display','none');
        $('.continuar').css('display','none');
        $('.texto-chat-modal').css('display','none');
        $('.nome-modal').css('display','none');
        $('.whatsapp-modal').css('display','none');
        $('.icone-chat-modal').addClass('chat-center');
      },
      error: function(response) {
        $('#erro_envio').text(response.responseJSON.errors);
        HabilitaEnvioChat();
      },
    });

  });

  $(document).on('click', '.ligar-mobile', function (e) {

    e.preventDefault();

    let nome = $('#nome').val();
    let whatsapp = $('#whatsapp').val();
    let tipo_clique = 'Telefone';
    let empreendimento_id = $('#empreendimento_id').val();


    if (nome == '') {
      Swal.fire('Desculpe', 'Por favor, nos informe seu nome', 'error');
      return false;
    }

    if (whatsapp == '') {
      Swal.fire('Desculpe', 'Por favor, nos informe seu telefone', 'error');
      return false;
    }

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: "/chat-empreendimento",
      type:"POST",
      data:{
        nome:nome,
        whatsapp:whatsapp,
        tipo_clique:tipo_clique,
        empreendimento_id:empreendimento_id
      },
      success:function(response){
        $('.link-telefone-mobile').css('display','block');
        $('.link-whatsapp-mobile').css('display','none');
        $('.continuar').css('display','none');
        $('.texto-chat-modal').css('display','none');
        $('.nome-modal').css('display','none');
        $('.whatsapp-modal').css('display','none');
        $('.icone-chat-modal').addClass('chat-center');
      },
      error: function(response) {
        $('#erro_envio').text(response.responseJSON.errors);
      },
    });

  });

  $(document).on('click', '#ModalLigar', function (e) {
    $('#botaoContinuar').addClass('ligar-mobile');
    $('#botaoContinuar').removeClass('chat-mobile');
  });

  $(document).on('click', '#ModalChat', function (e) {
    $('#botaoContinuar').removeClass('ligar-mobile');
    $('#botaoContinuar').addClass('chat-mobile');
  });

  $(document).on('click', '.enviar-novo-topo', function (e) {
    $('.form-submit-cont-topo').css('display','none');
    $('.loadingImg').css('display','block');
  });

  $(document).on('click', '.enviar-novo', function (e) {
    $('.form-submit-bottom').css('display','none');
    $('.loadingImg_Botton').css('display','block');
  });

  $(document).on('click', '.botao-enviar', function (e) {
    $('.btn-enviar-mobile').css('display','none');
    $('.loadingImg_Mobile').css('display','block');
  });

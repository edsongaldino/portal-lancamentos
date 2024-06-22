function abreFecha(sel) {
  $(sel).slideToggle();
}

function buscar_cidades() {
  var estado = $('#estado').val();
  if(estado){
    var url = 'site_mod_buscar_cidades.php?estado='+estado;
    $.get(url, function(dataReturn) {
      $('#cidade').html(dataReturn);
    });
  }
}

$(document).ready(function() {
  var url = $("#cartoonVideo").attr('src');
  $("#cartoonVideo").attr('src', '');
  $("#myModal").on('shown.bs.modal', function(){
    $("#cartoonVideo").attr('src', url);
  });
  $("#myModal").on('hide.bs.modal', function(){
    $("#cartoonVideo").attr('src', '');
  });

  $('a.mapa-vendas').on('click', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $(".modal-body-mapa").html('<iframe width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'+url+'"></iframe>');
  });

  $('a.btn-negociar-unidade').on('click', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $(".modal-negociar-unidade").html('<iframe width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'+url+'"></iframe>');
  });
});

// Indentifica o User Agent do navegador cliente
// AAA - Out 09

var ua = navigator.userAgent.toLowerCase();

var uMobile = '';


// === REDIRECIONAMENTO PARA iPhone, Windows Phone, Android, etc. ===

// Lista de substrings a procurar para ser identificado como mobile WAP
uMobile = '';
uMobile += 'iphone;ipod;windows phone;android;iemobile 8';

// Sapara os itens individualmente em um array
v_uMobile = uMobile.split(';');

// percorre todos os itens verificando se eh mobile
var boolMovel = false;
for (i=0;i<=v_uMobile.length;i++)
{
  if (ua.indexOf(v_uMobile[i]) != -1)
  {
    boolMovel = true;
  }
}

if (boolMovel == true)
{
  //location.href='https://m.lancamentosonline.com.br' + window.location.pathname;
}

function abrirChat(URL) {

  var width = 800;
  var height = 600;

  var left = 99;
  var top = 99;

  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');

}

function abrirMapa(URL) {

  var width = 1024;
  var height = 768;

  var left = 99;
  var top = 99;

  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');

}

$(function() {
  $("#mapa-vendas").mouseenter(function() {
  // For Chrome
  window.addEventListener('mousewheel', mouseWheelEvent);
  // For Firefox
  window.addEventListener('DOMMouseScroll', mouseWheelEvent);

  function mouseWheelEvent(e) {
    var delta = e.wheelDelta ? e.wheelDelta : -e.detail;
  }
});
});

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
          'id_empreendimento':id
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
          'id_empreendimento':id
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

$(document).on('click', '.botao-enviar', function (e) {
  
  e.preventDefault();
  var form = $($(this).data('form'));

  var formulario = new Formulario(
    $(this).data('form'),
    form.find("input[name='nome']").val(),
    form.find("input[name='telefone']").val(),
    form.find("input[name='email']").val(),
    form.find("select[name='previsao'] option:selected").val(),
    form.find("select[name='interesse'] option:selected").val(),
    form.find("select[name='renda'] option:selected").val(),
    form.find("textarea[name='mensagem']").val(),
    form.find("input[name='empreendimento_id']").val(),
  );

  if (formulario.validar()) {
    formulario.enviar();    
  }
});

var behavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
options = {
  onKeyPress: function (val, e, field, options) {
    field.mask(behavior.apply({}, arguments), options);
  }
};

$('.telefone').mask(behavior, options);
$('.whatsapp').mask(behavior, options);


$(document).on('click', '.modal-continuar', function (e) {
  
    e.preventDefault();

    let nome = $('#nome').val();
    let whatsapp = $('#whatsapp').val();
    let tipo_clique = $('#tipo_clique').val();
    let empreendimento_id = $('#empreendimento_id').val();
    let csrf_token = $('#csrf_token').val();


    if (nome == '') {
      Swal.fire('Desculpe', 'Por favor, nos informe seu nome', 'error');
      return false;
    }

    if (whatsapp == '') {
      Swal.fire('Desculpe', 'Por favor, nos informe seu telefone', 'error');
      return false;
    }
    
    $.ajax({
      url: "/chat-empreendimento",
      type:"POST",
      data:{
        "_token": csrf_token,
        nome:nome,
        whatsapp:whatsapp,
        tipo_clique:tipo_clique,
        empreendimento_id:empreendimento_id
      },
      success:function(response){
        $('.falar-com-corretor').css('display','block');
        $('.continuar').css('display','none');
        $('.texto-chat').css('display','none');
        $('.nome-modal').css('display','none');
        $('.whatsapp-modal').css('display','none');
        $('.icone-chat').addClass('chat-center');
      },
      error: function(response) {
        $('#erro_envio').text(response.responseJSON.errors);
      },
    });

});
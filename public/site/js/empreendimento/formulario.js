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

var Formulario = function (
  form_id, 
  nome, 
  telefone, 
  email, 
  previsao, 
  interesse, 
  renda, 
  mensagem, 
  empreendimento_id) 
{
  this.nome = nome;
  this.telefone = telefone;
  this.email = email;
  this.previsao = previsao;
  this.interesse = interesse;
  this.renda = renda;
  this.mensagem = mensagem;
  this.empreendimento_id = empreendimento_id;
  this.form_id = form_id;
  this.botao = $(form_id).find(".enviar-formulario");
  this.loader = $(form_id).find(".loadingImg");
};

Formulario.prototype.validar = function () {
  if (this.nome == '') {
    Swal.fire('Desculpe', 'Preencha seu nome', 'error');
    habilitaEnvio();
    return false;
  }

  if (this.telefone == '') {
    Swal.fire('Desculpe', 'Preencha seu telefone', 'error');
    habilitaEnvio();
    return false;
  }

  if (this.email == '') {
    Swal.fire('Desculpe', 'Preencha seu e-mail', 'error');
    habilitaEnvio();
    return false;
  }

  if (!this.emailValido()) {
    Swal.fire('Desculpe', 'Por favor, preencha um endereço de e-mail válido', 'error');
    habilitaEnvio();
    return false;
  }

  if (this.previsao == '') {
    Swal.fire('Desculpe', 'Por favor, nos informe sua previsão de compra', 'error');
    habilitaEnvio();
    return false;
  }

  if (this.interesse == '') {
    Swal.fire('Desculpe', 'Por favor, nos informe o que mais te agradou', 'error');
    habilitaEnvio();
    return false;
  }

  if (this.renda == '') {
    Swal.fire('Desculpe', 'Por favor, nos informe sua renda', 'error');
    habilitaEnvio();
    return false;
  }

  if (this.mensagem == '') {
    Swal.fire('Desculpe', 'Por favor, digite sua mensagem', 'error');
    habilitaEnvio();
    return false;
  }

  return true;
};

Formulario.prototype.emailValido = function () {
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(this.email) ? true : false;
};

Formulario.prototype.enviar = function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var botao = this.botao;
  var loader = this.loader;
  var form_id = this.form_id;

  //botao.hide();
  loader.show();

  $.ajax({
    url: '/contato-construtora',
    method: 'POST',
    data: {
      nome: this.nome,
      telefone: this.telefone,
      email: this.email,
      previsao: this.previsao,
      interesse: this.interesse,
      renda: this.renda,
      mensagem: this.mensagem,
      empreendimento_id: this.empreendimento_id
    },
    success: function (response) {
      botao.show();
      loader.hide();
            
      if (response.sucesso == 'true') {

        $(form_id).find("input[name='nome']").val('');
        $(form_id).find("input[name='telefone']").val('');
        $(form_id).find("input[name='email']").val('');

        Swal.fire('Sucesso', response.retorno, 'success');
        habilitaEnvio();
        return;
      }

      Swal.fire('Desculpe', response.retorno, 'error');
    },
    error: function (data) {
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
};


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

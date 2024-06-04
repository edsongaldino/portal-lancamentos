(function() {
    "use strict";

    // custom scrollbar

    $("html").niceScroll({styler:"fb",cursorcolor:"#EA6153", cursorwidth: '4', cursorborderradius: '10px', background: '#FFFFFF', spacebarenabled:false, cursorborder: '0',  zindex: '1000'});

    $(".scrollbar1").niceScroll({styler:"fb",cursorcolor:"#FF9554", cursorwidth: '4', cursorborderradius: '0',autohidemode: 'false', background: '#FFFFFF', spacebarenabled:false, cursorborder: '0'});

	
	
    $(".scrollbar1").getNiceScroll();
    if ($('body').hasClass('scrollbar1-collapsed')) {
        $(".scrollbar1").getNiceScroll().hide();
    }

})(jQuery);

$(document).on('click', '.cadastroCorretor', function (e) {
  
	e.preventDefault();
  
	let cpf = $('#cpf').val();
	let nome = $('#nome').val();
    let creci = $('#creci').val();
    let data_nascimento = $('#data_nascimento').val();
    let telefone = $('#telefone').val();
    let email = $('#email').val();
    let senha = $('#senha').val();
    let confirmar_senha = $('#confirmar_senha').val();
 
  
	if (cpf == '') {
	  swal('Desculpe', 'O CPF é um dado obrigatório', "info");
	  return false;
	}

    if (email == '') {
        swal('Desculpe', 'Por favor, nos informe o email', "info");
        return false;
      }
  
	if (senha != '') {
        if (senha != confirmar_senha) {
            swal('Ops', 'As senhas precisam ser iguais', "info");
            return false;
        }
	}else{
        swal('Ops', 'Por favor, é obrigatório informar a senha', "info");
	    return false;
    }
  
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	
	$.ajax({
	  url: "/corretor/salvar",
	  type:"POST",
	  data:{
		"_token": $('#token').val(),
		cpf:cpf,
		nome:nome,
        data_nascimento:data_nascimento,
        telefone:telefone,
        email:email,
        senha:senha,
        confirmar_senha: confirmar_senha,
        creci:creci
	  },
	  success:function(response){
		if(response.success){
			swal('OK', 'Seu cadastro foi efetuado. Faça seu login', "success");
			window.location.href = "/login";
		}else{
			swal('Ops', 'Houve um problema com seu cadastro! Verifique.', "warning");
	  		return false;
		}
	  },
	  error: function(response) {
		swal('Ops', 'Houve um problema com seu cadastro! Verifique.', "warning");
	  	return false;
	  },
	});
  
  });

                     
     
  
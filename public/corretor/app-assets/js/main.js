jQuery(document).ready(function(){
	if( $('.cd-stretchy-nav').length > 0 ) {
		var stretchyNavs = $('.cd-stretchy-nav');
		
		stretchyNavs.each(function(){
			var stretchyNav = $(this),
				stretchyNavTrigger = stretchyNav.find('.cd-nav-trigger');
			
			stretchyNavTrigger.on('click', function(event){
				event.preventDefault();
				stretchyNav.toggleClass('nav-is-visible');
			});
		});

		$(document).on('click', function(event){
			( !$(event.target).is('.cd-nav-trigger') && !$(event.target).is('.cd-nav-trigger span') ) && stretchyNavs.removeClass('nav-is-visible');
		});
	}
});

$(document).on('click', '.loginCorretor', function (e) {
  
	e.preventDefault();
  
	let email = $('#emailLogin').val();
	let password = $('#senhaLogin').val();
 
  
	if (email == '') {
	  swal('Desculpe', 'Por favor, nos informe o email de login', "info");
	  return false;
	}
  
	if (password == '') {
	  swal('Ops', 'Por favor, é obrigatório informar a senha', "info");
	  return false;
	}
  
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	
	$.ajax({
	  url: "/corretor/login",
	  type:"POST",
	  data:{
		"_token": $('#token').val(),
		email:email,
		password:password
	  },
	  success:function(response){
	
		if(response.success){
			swal('OK', 'Dados Verificados! Aguarde redirecionamento.', "success");
			window.location.href = "/home-corretor";
		}else{
			swal('Ops', 'Os dados de acesso estão incorretos! Verifique.', "warning");
	  		return false;
		}
		
		
	  },
	  error: function(response) {
		swal('Ops', 'Os dados de acesso estão incorretos! Verifique.', "warning");
	  	return false;
	  },
	});
  
  });

  $(document).on('click', '.reenviarSenhaCorretor', function (e) {
  
	e.preventDefault();
  
	let email = $('#emailCorretor').val();
 
  
	if (email == '') {
	  swal('Ops', 'Por favor, nos informe o email', "info");
	  return false;
	}
    
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	
	$.ajax({
	  url: "/corretor/reenviar-senha",
	  type:"POST",
	  data:{
		"_token": $('#token').val(),
		email:email,
	  },
	  success:function(response){
	
		if(response.success){
			swal('OK', response.message, "success");
		}else{
			swal('Ops', response.message, "warning");
	  		return false;
		}
		
	  },
	  error: function(response) {
		swal('Ops', 'Algo deu errado!', "warning");
	  	return false;
	  },
	});
  
  });

  $(document).on('click', '.AlterarSenha', function (e) {
  
	e.preventDefault();
  
	let email = $('#email').val();
	let senha = $('#senha').val();
	let confirmar_senha = $('#confirmar_senha').val();
 
  
	if (email == '') {
	  swal('Desculpe', 'Por favor, nos informe o email', "info");
	  return false;
	}
  
	if (senha != confirmar_senha) {
	  swal('Ops', 'As duas senhas devem ser idênticas!', "info");
	  return false;
	}
  
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	
	$.ajax({
	  url: "/corretor/alterar-senha",
	  type:"POST",
	  data:{
		"_token": $('#token').val(),
		email:email,
		senha:senha,
		confirmar_senha:confirmar_senha,
	  },
	  success:function(response){
	
		if(response.success){
			swal('OK', response.message, "success");
			window.location.href = "/login";
		}else{
			swal('Ops', response.message, "warning");
	  		return false;
		}
		
	  },
	  error: function(response) {
		swal('Ops', 'Erro interno do servidor!', "warning");
	  	return false;
	  },
	});
  
  });
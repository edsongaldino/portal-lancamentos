function confirmacao(title) {

	if (title == undefined) {
		title = 'Tem certeza que deseja excluir?'; 
	}

	return Swal.fire({
	  title: title,
	  text: "Selecione as opções abaixo!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Sim tenho certeza!',
	  cancelButtonText: 'Cancelar'
	});
}

function confirmacaoRemoverIntegracao(title) {

	if (title == undefined) {
		title = 'Tem certeza que deseja remover esta integração?'; 
	}

	return Swal.fire({
	  title: title,
	  text: "Selecione as opções abaixo!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Sim tenho certeza!',
	  cancelButtonText: 'Cancelar'
	});
}

function confirmacaoAtivarIntegracaoU(title) {

	if (title == undefined) {
		title = 'Deseja alterar o perfil deste usuário na Rede Domus?'; 
	}

	return Swal.fire({
	  title: title,
	  text: "Selecione as opções abaixo!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Sim, quero alterar!',
	  cancelButtonText: 'Cancelar'
	});
}
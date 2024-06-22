$(document).on('click', '[data-role=ordenar]', function () {
	var ordenacao = $(this).data('valor');
	localStorage.setItem('ordenacao', ordenacao);
	localStorage.setItem('possui_filtro', 'Sim');
	buscaAjax();
});
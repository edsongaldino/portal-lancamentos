$(function () {
	var itens = $("[data-role=contar-caracteres]");

	itens.each(function (index, item) {
		var campo = $("#" + item.dataset.target);
		$(this).html(campo.val().length);
	});

	$("[data-item=alterar-caracteres]").on('keyup', function () {		
		var campo = $("#" + $(this).data('target'));
		$(campo).html($(this).val().length);
	});
});
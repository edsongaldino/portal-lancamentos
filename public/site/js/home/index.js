$(function () {
	$("#estado_busca").on("change", function () {
		var parameters = {
			url: $(this).data('url'),
			metodo: 'POST',
			dados: {
				estado_id: $(this).val()
			},
			feedback: false,
			resultado: "#cidade_busca" 
		};
		ajaxRequest(parameters);
	});
});
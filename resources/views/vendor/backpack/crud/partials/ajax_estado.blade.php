<script type="text/javascript">
	$(function () {
		$(document).on("change", "#estado", function () {
			var estado_id = $(this).val();
			$.ajax({
				method: 'post',
				url: "/admin/buscar-cidade",
				data: {
					estado_id: estado_id
				},
				success: function (response) {					
					$("#cidade-wrapper").html(response);
					$("#bairro-wrapper").find('select').html('');
				}
			});
		});
	});
</script>
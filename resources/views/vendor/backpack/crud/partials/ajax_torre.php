<script type="text/javascript">
	$(function () {
		$(document).on("change", "#empreendimento", function () {
			var empreendimento_id = $(this).val();
			$.ajax({
				method: 'post',
				url: "/admin/buscar-torre",
				data: {
					empreendimento_id: empreendimento_id
				},
				success: function (response) {
					$("#torre-wrapper").html(response);
				}
			});
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		$(document).on("change", "#cidade_id", function () {
			var cidade_id = $(this).val();
			$.ajax({
				method: 'post',
				url: "/admin/buscar-bairro",
				data: {
					cidade_id: cidade_id
				},
				success: function (response) {
					$("#bairro-wrapper").html(response);
				}
			});
		});
	});
</script>
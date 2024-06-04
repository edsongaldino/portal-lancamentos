<form id="formAlterarFoto">
	<div class="form-group text-center">
		<img src="{{ url($entry->caminho) }}" alt="{{ $entry->nome }}" width="200" height="200">
	</div>
	<div class="form-group">
		<label class="">Título</label>
		<input type="text" name="nome" class="form-control" value="{{ $entry->nome }}">
	</div>
	<div class="form-group">
		<label class="">Descrição</label>
		<textarea class="form-control" name="descricao">{{ $entry->descricao }}</textarea>
	</div>
	<div class="form-group">
		<label class="">Tipo de foto</label>
		<select name="tipo" class="form-control">
			<option value="Geral" @if ($entry->tipo == 'Geral')selected="true"@endif>Geral</option>
			<option value="Interna" @if ($entry->tipo == 'Interna')selected="true"@endif>Interna</option>
			<option value="Externa" @if ($entry->tipo == 'Externa')selected="true"@endif>Externa</option>
			<option value="Decorado" @if ($entry->tipo == 'Decorado')selected="true"@endif>Decorado</option>
			<option value="Estágio de Obra" @if ($entry->tipo == 'Estágio de Obra')selected="true"@endif>Estágio de Obra</option>
			@if ($empreendimento->tipo == 'Vertical')
			<option value="Implantação Vertical - Frente" @if ($entry->tipo == 'Implantação Vertical - Frente')selected="true"@endif>Implantação Vertical - Frente</option>
			<option value="Implantação Vertical - Fundo" @if ($entry->tipo == 'Implantação Vertical - Fundo')selected="true"@endif>Implantação Vertical - Fundo</option>
			<option value="Implantação - Área de Lazer" @if ($entry->tipo == 'Implantação - Área de Lazer')selected="true"@endif>Implantação - Área de Lazer</option>
			@endif
		</select>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-success" value="Alterar foto">
	</div>
</form>

<script type="text/javascript">
	$(function () {
		$('#formAlterarFoto').on('submit', function (e) {
			e.preventDefault();
			var dados = $(this).serialize();

			$.ajax({
				method: 'post',
				url: "{{ route('atualizar-foto', $entry->id) }}",
				data: dados,
				success: function (response) {
					if (response.sucesso == 'true') {
					    $('#alterarFoto').modal('toggle');
					    new PNotify({
					      text: response.mensagem,
					      type: 'success',
					    });

					    setTimeout(function () {
					    	window.location.reload();
					    }, 3000);
					} else {
					    new PNotify({
					      text: response.mensagem,
					      type: 'error',
					    });
					}
				}
			});
		});
	});
</script>

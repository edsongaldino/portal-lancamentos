<form id="formMembro">
	@if (isset($entry))
	<input type="hidden" name="user_id" value="{{ $entry->id }}">
	<input type="hidden" name="construtora_id" value="{{ $entry->construtora_id }}">
	@endif
	<div class="form-group">
		<label class="">Nome</label>
		<input type="text" name="nome" class="form-control" @if (isset($entry)) value="{{ $entry->name }}" @endif>
	</div>
	<div class="form-group">
		<label class="">E-mail</label>
		<input type="email" name="email" class="form-control" @if (isset($entry)) value="{{ $entry->email }}" @endif>
	</div>
	<div class="form-group">
		<label class="">Data de nascimento</label>
		<input type="text" name="data_nascimento" class="form-control date" @if (isset($entry)) value="{{ $entry->data_nascimento }}" @endif>
	</div>
	<div class="form-group">
		<label class="">Senhaa</label>
		<input type="password" name="password" class="form-control">
	</div>
	<div class="form-group">
		<label class="">Confirmar Senha</label>
		<input type="password" name="password_confirmation" class="form-control">
	</div>
	<div class="form-group">
		<label class="">Grupo de usuário</label>
		<br>
		<select name="grupo[]" class="form-control">
			@foreach ($grupos as $grupo)
				@if ($grupo->name != 'Administrador')
					<option value="{{ $grupo->id }}" @if (isset($entry) && $entry->hasRole($grupo->name)) selected="true" @endif> {{ $grupo->name }} </option>
				@endif
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-success submit-btn">
	</div>
</form>

<div class="modal fade" id="membro" tabindex="-1" role="dialog" aria-labelledby="label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="label"></h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(function () {

		$('.date').mask('00/00/0000');

		$('#formMembro').on('submit', function (e) {
			e.preventDefault();
			var dados = $(this).serialize();

			$.ajax({
				method: 'post',
				url: "{{ $rota }}",
				data: dados,
				success: function (response) {
					if (response.sucesso == 'true') {
					    $('#membro').modal('toggle');
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
				},
				error: function (data) {
			        var dados = $.parseJSON(data.responseText);
			        if (data.status === 422) {
			          var errors = dados.errors;
			          $.each(errors, function(key, value) {
			            new PNotify({
			              text: value,
			              type: 'error',
			            });
			          });
			        }

			        if (data.status == 500) {
			          new PNotify({
			            text: 'Erro, tente novamente mais tarde',
			            type: 'error',
			          });
			        }
      			}
			});
		});
	});
</script>

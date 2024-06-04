<form id="formAlterarVendaGaragem">
	<input type="hidden" name="situacao" id="situacao" value="{{ $situacao }}">
	<div class="form-group">
		@if ($entry->empreendimento->tipo == 'Vertical')
			<label class=""> <strong> {{ $entry->torre->nome }} </strong></label>
		@endif
		@if ($entry->empreendimento->tipo == 'Horizontal')
			<label class=""> <strong> {{ $entry->quadra->nome }} </strong></label>
		@endif
	</div>
	<div class="form-group">
		<label class=""> <strong> Unidade {{ $entry->nome }} </strong> </label>
	</div>

	<div class="form-group">
		<label class="">Nome do Comprador (Opcional)</label>
		<input type="text" name="nome_comprador" class="form-control" @if (isset($entry->comprador->nome))value="{{ $entry->comprador->nome }}"@endif>		
	</div>

	<div class="form-group linha-50 left">
		<label class="">Data da Venda</label>
		<input type="date" name="data_venda" class="form-control" @if (isset($entry->comprador->data))value="{{ $entry->comprador->data }}"@endif>		
	</div>

	<div class="form-group linha-50">
		<label class="">Valor da Venda</label>
		<input type="text" name="valor_venda" class="form-control moeda" @if (isset($entry->comprador->valor))value="{{ $entry->comprador->valor }}"@endif>		
	</div>	

	<div class="form-group">
		<input type="submit" class="btn btn-success" id="btn-submit" value="Alterar unidade">
	</div>
</form>

<script type="text/javascript">
	$(function () {		
	  	$('.date').mask('00/00/0000');
	  	$('.moeda').maskMoney({thousands: '.', decimal: ','});
	  	
		$('#formAlterarVendaGaragem').on('submit', function (e) {
			e.preventDefault();

			ajaxRequest({
			  url: "{{ route('atualizar-venda-garagem', $entry->id) }}",
			  metodo: 'POST',
			  dados: $(this).serialize(),
			  feedback: true,
			  mensagemSucesso: 'Dados do comprador alterados com sucesso',
			  mensagemErro: 'Erro, tente novamente mais tarde',
			  reload: true
			});

			var modal = $("#alterarVendaGaragem");
			modal.hide();
		});
	});
</script>

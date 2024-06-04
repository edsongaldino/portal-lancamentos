@if ($entry->formato_vaga <> 'Extra')
<script type="text/javascript">
	$(function () {	
		$("#valor_vaga").hide();
		document.getElementById("unidade").disabled = false;
		document.getElementById("unidade").required = false;
	});
</script>
@endif
<form id="formAlterarSituacaoGaragem">

	<div class="titulo-topo">
		<div class="nome-torre">
			@if ($entry->empreendimento->tipo == 'Vertical')
				<i class="fa fa-building" aria-hidden="true"></i> {{ $entry->torre->nome }}
			@endif
			@if ($entry->empreendimento->tipo == 'Horizontal')
				<i class="fa fa-building-o" aria-hidden="true"></i> {{ $entry->quadra->nome }}
			@endif
		</div>
		<div class="nome-unidade">
			<i class="fa fa-car" aria-hidden="true"></i> {{ $entry->nome }}
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="">Número da Vaga</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-car" aria-hidden="true"></i>
					</span>
					<input type="text" name="nome" class="form-control" @if (isset($entry))value="{{ $entry->nome }}"@endif>	
				</div>	
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="">Formato</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-check" aria-hidden="true"></i>
					</span>
					<select name="formato_vaga" id="formato_vaga" class="form-control" required>
						<option value="">Selecione</option>
						<option @if ($entry->formato_vaga == 'Padrão') selected="true" @endif value="Padrão">Padrão</option>
						<option @if ($entry->formato_vaga == 'Extra') selected="true" @endif value="Extra">Extra</option>
						<option @if ($entry->formato_vaga == 'Visitante') selected="true" @endif value="Visitante">Visitante</option>
					</select>	
				</div>	
			</div>
		</div>

		<div class="col-md-5">
			<div class="form-group">
				<label class="">Tipo da vaga</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-asterisk" aria-hidden="true"></i>
					</span>
					<select name="tipo_vaga" class="form-control" required>
						<option value="">Selecione</option>
						<option @if ($entry->tipo_vaga == 'Gaveta Coberta') selected="true" @endif value="Gaveta Coberta">Gaveta Coberta</option>
						<option @if ($entry->tipo_vaga == 'Individual Coberta') selected="true" @endif value="Individual Coberta">Individual Coberta</option>
						<option @if ($entry->tipo_vaga == 'Gaveta Descoberta') selected="true" @endif value="Gaveta Descoberta">Gaveta Descoberta</option>
						<option @if ($entry->tipo_vaga == 'Individual Descoberta') selected="true" @endif value="Individual Descoberta">Individual Descoberta</option>
					</select>	
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="">Selecione a unidade desta vaga:</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-building" aria-hidden="true"></i>
					</span>
					<select name="unidade" id="unidade" class="form-control" disabled required>
						<option value="">Selecione a unidade</option>
						@foreach ($entry->torre->unidades as $unidade)
						<option @if ($entry->unidade_id == $unidade->id) selected="true" @endif value="{{ $unidade->id }}">{{ $unidade->andar->numero }}º Andar ({{ $unidade->nome }})</option>
						@endforeach
					</select>	
				</div>
			</div>
		</div>

		

		<div class="col-md-3" id="situacao">
			<div class="form-group">
				<label class="">Situação</label>
				<div class="input-group btn-group">
					<select name="situacao" class="form-control">
						<option @if ($entry->situacao == 'Disponível') selected="true" @endif value="Disponível">Disponível</option>
						<option @if ($entry->situacao == 'Vendida') selected="true" @endif value="Vendida">Vendida</option>
						<option @if ($entry->situacao == 'Reservada') selected="true" @endif value="Reservada">Reservada</option>
						<option @if ($entry->situacao == 'Bloqueada') selected="true" @endif value="Bloqueada">Bloqueada</option>
					</select>	
				</div>
			</div>
		</div>

		<div class="col-md-3" id="vaga_pne">
			<div class="form-group">
				<label class="">PNE</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-wheelchair" aria-hidden="true"></i>
					</span>
					<select name="vaga_pne" class="form-control">
						<option @if ($entry->vaga_pne == 'Não') selected="true" @endif value="Não">Não</option>
						<option @if ($entry->vaga_pne == 'Sim') selected="true" @endif value="Sim">Sim</option>
					</select>	
				</div>
			</div>
		</div>

	</div>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group" id="valor_vaga">
				<label class="">Valor da Vaga</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-dollar" aria-hidden="true"></i>
					</span>
					<input type="text" name="valor_vaga" class="form-control moeda valor-vaga" value="{{  $entry->caracteristicas->where('nome', 'valor_vaga')->first()->pivot->valor ?? '' }}">	
				</div>	
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<button type="submit" class="btn btn-success btn-alterar-garagem" id="btn-submit"><i class="fa fa-save" aria-hidden="true"></i> Alterar Garagem</button>
			</div>
		</div>
	</div>
	
</form>

<script type="text/javascript">
	$(function () {		
	  	$('.date').mask('00/00/0000');
	  	$('.moeda').maskMoney({thousands: '.', decimal: ','});
	  	
		$('#formAlterarSituacaoGaragem').on('submit', function (e) {
			e.preventDefault();

			ajaxRequest({
			  url: "{{ route('atualizar-garagem', $entry->id) }}",
			  metodo: 'POST',
			  dados: $(this).serialize(),
			  feedback: true,
			  mensagemSucesso: 'Garagem alterada com sucesso',
			  mensagemErro: 'Erro, tente novamente mais tarde',
			  reload: true
			});

			var modal = $("#alterarInfoGaragem");
			modal.hide();
		});


		$('select[name=formato_vaga]').on('change', function () {
			var formato_vaga = $(this).val();
			var $valor_vaga = $("#valor_vaga");

			$valor_vaga.hide();

			if (formato_vaga == 'Extra') {
				$valor_vaga.show();
				document.getElementById("unidade").disabled = false;
				document.getElementById("unidade").required = false;
			}

			if (formato_vaga == 'Padrão') {
				$valor_vaga.hide();
				document.getElementById("unidade").disabled = false;
				document.getElementById("unidade").required = true;
			}

			if (formato_vaga == 'Visitante') {
				document.getElementById("unidade").disabled = true;
				document.getElementById("unidade").required = false;
			}

		});

	});
</script>
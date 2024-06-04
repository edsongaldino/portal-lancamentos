<form id="formAlterarSituacao">

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
			Unidade {{ $entry->nome }}
		</div>
	</div>

	@if ($entry->empreendimento->tipo == 'Horizontal')
		<div class="form-group">
			<div class="row">
				<div class="col-md-3">
					<label class="">Nome da Unidade</label>
					<div class="input-group btn-group">
						<span class="input-group-addon">
							<i class="fa fa-building-o" aria-hidden="true"></i>
						</span>
						<input type="text" name="nome" class="form-control" @if (isset($entry))value="{{ $entry->nome }}"@endif readonly>
					</div>
				</div>
				<div class="col-md-5" style="margin-left: -16px">
					<label class="">Área do lote (m<sup>2</sup>)</label>
					<div class="input-group btn-group">
						<span class="input-group-addon valor">
							<i class="fa fa-map" aria-hidden="true"></i>
						</span>
						<input type="text" name="metragem_total" id="metragem_total" class="form-control moeda2" @if (isset($entry) && $entry->caracteristicas->where('nome', 'metragem_total')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor) }}"@endif readonly>
					</div>
				</div>
				<div class="col-md-4" style="margin-left: -16px">
					<label class="">Valor (m<sup>2</sup>)</label>
					<div class="input-group btn-group">
						<span class="input-group-addon valor">
							<i class="fa fa-dollar" aria-hidden="true"></i>
						</span>
						<input type="text" name="valor_m2" id="valor_m2" class="form-control moeda2" @if (isset($entry) && $entry->caracteristicas->where('nome', 'valor_m2')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'valor_m2')->first()->pivot->valor) }}"@endif readonly>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="">Valor da Unidade</label>
						<div class="input-group btn-group">
							<span class="input-group-addon valor">
								<i class="fa fa-dollar" aria-hidden="true"></i>
							</span>
							<input type="text" name="valor_unidade" id="valor_unidade" class="form-control moeda valor-unidade"
							@if ($entry->caracteristicas->where('nome', 'valor_unidade')->first() && $entry->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '' && $entry->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '0')
								value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor) }}"
							@else
								@if($entry->caracteristicas->where('nome', 'valor_m2')->first() && $entry->caracteristicas->where('nome', 'metragem_total')->first())
								@php
									$valor_m2 = $entry->caracteristicas->where('nome', 'valor_m2')->first()->pivot->valor;
									$metragem = $entry->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor;
								@endphp
								value="{{ converte_valor_real(floatval($valor_m2) * floatval($metragem)) }}"
								@else
								value="0,00"
								@endif
							@endif readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
	@else
	<div class="row">
		<div class="col-md-6">
		<div class="form-group">
			<label class="">Nome da Unidade</label>
			<div class="input-group btn-group">
				<span class="input-group-addon">
					<i class="fa fa-building-o" aria-hidden="true"></i>
				</span>
				<input type="text" name="nome" class="form-control" @if (isset($entry))value="{{ $entry->nome }}"@endif readonly>
			</div>
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
			<label class="">Valor da Unidade</label>
			<div class="input-group btn-group">
				<span class="input-group-addon valor">
					<i class="fa fa-dollar" aria-hidden="true"></i>
				</span>
				<input type="text" name="valor_unidade" class="form-control moeda valor-unidade" @if (isset($entry) && $entry->caracteristicas->where('nome', 'valor_unidade')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor) }}"@endif readonly>
			</div>
		</div>
		</div>
	</div>
	@endif

	@if ($entry->empreendimento->tipo == 'Vertical')

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label class="">Vagas de Garagem</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-car" aria-hidden="true"></i>
					</span>
					<input type="number" min="1" name="vagas_garagem" class="form-control" @if (isset($entry) && $entry->caracteristicas->where('nome', 'vagas_garagem')->first())value="{{ $entry->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor }}"@endif readonly>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label class="">Posição da Unidade</label>

				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-building-o" aria-hidden="true" rel="tooltip" data-original-title="Posicionamento da Unidade na Torre"></i>
					</span>
					<select name="posicao_unidade_torre" class="form-control" disabled>
						<option value="">Selecione</option>
						<option
							@if($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first())
								@if ($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor == 'Frente') 	selected="true"
								@endif
							@endif
							value="Frente">Frente
						</option>
						<option
							@if($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first())
								@if ($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor == 'Fundo') 	selected="true"
								@endif
							@endif
							value="Fundo">Fundo
						</option>
						<option
							@if($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first())
								@if ($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor == 'Lateral') 	selected="true"
								@endif
							@endif
							value="Lateral">Lateral
						</option>
					</select>
				</div>

			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label class="">Tipo Sol</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-sun-o" aria-hidden="true"></i>
					</span>
					<select name="tipo_sol" class="form-control" disabled>
						<option value="">Selecione</option>
						<option
							@if($entry->caracteristicas->where('nome', 'tipo_sol')->first())
								@if ($entry->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor == 'Manhã') 	selected="true"
								@endif
							@endif
							value="Manhã">Manhã
						</option>
                        <option
							@if($entry->caracteristicas->where('nome', 'tipo_sol')->first())
								@if ($entry->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor == 'Parcial da Manhã') 	selected="true"
								@endif
							@endif
							value="Parcial da Manhã">Parcial da Manhã
						</option>
						<option
							@if($entry->caracteristicas->where('nome', 'tipo_sol')->first())
								@if ($entry->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor == 'Tarde') 	selected="true"
								@endif
							@endif
							value="Tarde">Tarde
						</option>
                        <option
							@if($entry->caracteristicas->where('nome', 'tipo_sol')->first())
								@if ($entry->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor == 'Parcial da Tarde') 	selected="true"
								@endif
							@endif
							value="Parcial da Tarde">Parcial da Tarde
						</option>
					</select>
				</div>
			</div>
		</div>
	</div>

	@endif

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="">Planta (Opcional)</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-cube" aria-hidden="true"></i>
					</span>
					<select name="planta_id" class="form-control" disabled>
						<option value="">Selecione uma planta</option>
						@foreach($plantas as $planta)
							<option @if ($entry->planta_id == $planta->id) selected="true" @endif value="{{ $planta->id }}">{{ $planta->nome }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="">Situação</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-check-square-o" aria-hidden="true"></i>
					</span>
					<select name="situacao" class="form-control" disabled>
						<option @if ($entry->situacao == 'Disponível') selected="true" @endif value="Disponível">Disponível</option>
						<option @if ($entry->situacao == 'Vendida') selected="true" @endif value="Vendida">Vendida</option>
						<option @if ($entry->situacao == 'Reservada') selected="true" @endif value="Reservada">Reservada</option>
						<option @if ($entry->situacao == 'Bloqueada') selected="true" @endif value="Bloqueada">Bloqueada</option>
						<option @if ($entry->situacao == 'Outros') selected="true" @endif value="Outros">Outros</option>
					</select>
				</div>
			</div>
		</div>

	</div>

</form>

<script type="text/javascript">
	$(function () {
	  	$('.date').mask('00/00/0000');
	  	$('.moeda').maskMoney({thousands: '.', decimal: ','});
	  	$('.moeda2').maskMoney({thousands: '', decimal: '.'});

		$('#formAlterarSituacao').on('submit', function (e) {
			e.preventDefault();

			ajaxRequest({
			  url: "{{ route('atualizar-unidade', $entry->id) }}",
			  metodo: 'POST',
			  dados: $(this).serialize(),
			  feedback: true,
			  mensagemSucesso: 'Unidade alterada com sucesso',
			  mensagemErro: 'Erro, tente novamente mais tarde',
			  reload: true
			});
		});

		$('input[name=valor_unidade]').on('blur', function () {

	  		var valor_unidade = remove_mascara_valor($(this).val());
	  		var metragem_total = parseFloat($('input[name=metragem_total]').val());

	  		if (valor_unidade != '' && metragem_total != '') {
	  			$('input[name=valor_m2]').val(formata_valor_real(calcularValorM2(valor_unidade, metragem_total)));
	  		}
	  	});

		$('input[name=valor_m2]').on('blur', function () {

			var valor_m2 = $(this).val();
			var metragem_total = parseFloat($('input[name=metragem_total]').val());

			if (valor_m2 != '' && metragem_total != '') {
				$('input[name=valor_unidade]').val(formata_valor_real(calcularValorUnidade(valor_m2, metragem_total)));
			}

		});


		/*$('input[name=metragem_total]').on('blur', function () {

			var metragem_total = $(this).val();
			var valor_m2 = parseFloat(remove_mascara_valor($('input[name=valor_m2]').val()));

			if (valor_m2 != '' && metragem_total != '') {
				$('input[name=valor_unidade]').val(formata_valor_real(calcularValorUnidade(valor_m2, metragem_total)));
			}

		});*/

		function calcularValorM2(valor_unidade, metragem_total) {
			return (valor_unidade / metragem_total);
	  	}

		function calcularValorUnidade(valor_m2, metragem_total) {
			return (valor_m2 * metragem_total);
	  	}

		function remove_mascara_valor(valor)
		{
		  if (valor) {
		      valor = valor.replace("R$ ", "");
		      valor = valor.replace(/\./gi, "");
		      valor = valor.replace(",", ".");

		      return parseFloat(valor);
		  }
		}

		function formata_valor_real(valor) {
		  var result = 0;
		  $.ajax({
		      method: 'GET',
		      url: '/formatar-valor-reais/' + valor,
		      async: false,
		      success: function(response) {
		        result = response.retorno;
		      },
		  });

		  return result;
		}

	});
</script>

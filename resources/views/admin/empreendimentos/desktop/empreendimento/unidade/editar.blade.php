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
						<input type="text" name="nome" class="form-control" @if (isset($entry))value="{{ $entry->nome }}"@endif>
					</div>
				</div>
				<div class="col-md-5">
					<label class="">Área do lote (m<sup>2</sup>)</label>
					<div class="input-group btn-group">
						<span class="input-group-addon valor">
							<i class="fa fa-map" aria-hidden="true"></i>
						</span>
						<input type="text" name="metragem_total" id="metragem_total" class="form-control moeda2" @if (isset($entry) && $entry->caracteristicas->where('nome', 'metragem_total')->first())value="{{ $entry->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor }}"@endif>
					</div>
				</div>
				<div class="col-md-4">
					<label class="">Valor (m<sup>2</sup>)</label>
					<div class="input-group btn-group">
						<span class="input-group-addon valor">
							<i class="fa fa-dollar" aria-hidden="true"></i>
						</span>

						@if (isset($entry))
							@if ($entry->caracteristicas->where('nome', 'valor_unidade')->first() && $entry->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '' && $entry->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '0' && $entry->caracteristicas->where('nome', 'metragem_total')->first() && $entry->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor <> '' && $entry->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor <> '0')
								@php
									$metragem = (double) $entry->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor;
									$valor_unidade = (double) $entry->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor;
									$valor_m2 = $valor_unidade/$metragem;
								@endphp

							@else
								@php
								$valor_m2 = '';
								@endphp
							@endif
						@endif

						<input type="text" name="valor_m2" id="valor_m2" class="form-control moeda2" @if (isset($entry)) value="{{ converte_valor_real($valor_m2) }}"@endif readonly>
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
							@endif>
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
							<select name="situacao" class="form-control">
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

			<div class="titulo-row"><i class="fa fa-map" aria-hidden="true"></i> Dimensão do Lote</div>
			<div class="row">
				<div class="col-md-3">
					<label class="">Frente</label>
					<div class="input-group btn-group">
						<span class="input-group-addon">
							<i class="fa fa-map-o" aria-hidden="true"></i>
						</span>
						<input type="text" name="lote_frente" class="form-control moeda" value="{{ $entry->caracteristicas->where('nome', 'lote_frente')->first()->pivot->valor ?? '' }}">
					</div>
				</div>
				<div class="col-md-3">
					<label class="">Fundo</label>
					<div class="input-group btn-group">
						<span class="input-group-addon">
							<i class="fa fa-map-o" aria-hidden="true"></i>
						</span>
						<input type="text" name="lote_fundo" class="form-control moeda" value="{{ $entry->caracteristicas->where('nome', 'lote_fundo')->first()->pivot->valor ?? '' }}">
					</div>
				</div>
				<div class="col-md-3">
					<label class="">Lateral (Dir)</label>
					<div class="input-group btn-group">
						<span class="input-group-addon">
							<i class="fa fa-map-o" aria-hidden="true"></i>
						</span>
						<input type="text" name="lote_lateral_dir" class="form-control moeda" value="{{ $entry->caracteristicas->where('nome', 'lote_lateral_dir')->first()->pivot->valor ?? '' }}">
					</div>
				</div>
				<div class="col-md-3">
					<label class="">Lateral (Esq)</label>
					<div class="input-group btn-group">
						<span class="input-group-addon">
							<i class="fa fa-map-o" aria-hidden="true"></i>
						</span>
						<input type="text" name="lote_lateral_esq" class="form-control moeda" value="{{ $entry->caracteristicas->where('nome', 'lote_lateral_esq')->first()->pivot->valor ?? '' }}">
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
				<input type="text" name="nome" class="form-control" @if (isset($entry))value="{{ $entry->nome }}"@endif>
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
					<input type="text" name="valor_unidade" class="form-control moeda valor-unidade" @if (isset($entry) && $entry->caracteristicas->where('nome', 'valor_unidade')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor) }}"@endif>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label class="">Vagas de Garagem</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-car" aria-hidden="true"></i>
					</span>
					<input type="number" min="1" name="vagas_garagem" class="form-control" @if (isset($entry) && $entry->caracteristicas->where('nome', 'vagas_garagem')->first())value="{{ $entry->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor }}"@endif>
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
					<select name="posicao_unidade_torre" class="form-control">
						<option value="">Selecione</option>
						<option
							@if($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first())
								@if ($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor == 'frente') 	selected="true"
								@endif
							@endif
							value="frente">Frente
						</option>
						<option
							@if($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first())
								@if ($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor == 'fundo') 	selected="true"
								@endif
							@endif
							value="fundo">Fundo
						</option>
						<option
							@if($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first())
								@if ($entry->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor == 'lateral') 	selected="true"
								@endif
							@endif
							value="lateral">Lateral
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
					<select name="tipo_sol" class="form-control">
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
								@if ($entry->caracteristicas->where('nome', 'tipo_sol')->first()->pivot->valor == 'Parcial da tarde') 	selected="true"
								@endif
							@endif
							value="Parcial da tarde">Parcial da tarde
						</option>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		@if ($entry->empreendimento->variacao->nome <> 'Lote')
		<div class="col-md-6">
			<div class="form-group">
				<label class="">Planta (Opcional)</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-cube" aria-hidden="true"></i>
					</span>
					<select name="planta_id" class="form-control">
						<option value="">Selecione uma planta</option>
						@foreach($plantas as $planta)
							<option @if ($entry->planta_id == $planta->id) selected="true" @endif value="{{ $planta->id }}">{{ $planta->nome }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		@endif
		<div class="col-md-6">
			<div class="form-group">
				<label class="">Situação</label>
				<div class="input-group btn-group">
					<span class="input-group-addon">
						<i class="fa fa-check-square-o" aria-hidden="true"></i>
					</span>
					<select name="situacao" class="form-control">
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

	<div class="row">

		<div class="col-md-4">
			<div class="form-group">
				<label class="">Unidade em Oferta?</label>
				<div class="input-group btn-group">
					<span class="input-group-addon oferta">
						<i class="fa fa-check-square-o" aria-hidden="true"></i>
					</span>
					<select name="oferta_online" id="oferta_online" class="form-control">
						<option @if ($entry->oferta_online == 'Não') selected="true" @endif value="Não">Não</option>
						<option @if ($entry->oferta_online == 'Sim') selected="true" @endif value="Sim">Sim</option>
					</select>
				</div>
			</div>
		</div>

		<div class="col-md-8 proposta-unidade" style="display: block">
			<div class="form-group">
				<label class="">Unidade disponível para Proposta Online?</label>
				<div class="input-group btn-group">
					<span class="input-group-addon proposta-online">
						<i class="fa fa-briefcase" aria-hidden="true"></i>
					</span>
					<select name="proposta_online" id="proposta_online" class="form-control">
						<option @if ($entry->proposta_online == 'Não') selected="true" @endif value="Não">Não</option>
						<option @if ($entry->proposta_online == 'Sim') selected="true" @endif value="Sim">Sim</option>
					</select>
				</div>
			</div>
		</div>

		<div class="col-md-3 oferta-unidade" style="display: none">
			<div class="form-group">
				<label class="">Desconto %</label>
				<div class="input-group btn-group">
					<span class="input-group-addon desconto">
						%
					</span>
					<input type="text" name="oferta_desconto_percentual" class="form-control moeda valor-unidade" @if (isset($entry) && $entry->caracteristicas->where('nome', 'oferta_desconto_percentual')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'oferta_desconto_percentual')->first()->pivot->valor) }}"@endif>
				</div>
			</div>
		</div>

		<div class="col-md-5 oferta-unidade" style="display: none">
			<div class="form-group">
				<label class="">Valor Final</label>
				<div class="input-group btn-group">
					<span class="input-group-addon valor-final">
						<i class="fa fa-dollar" aria-hidden="true"></i>
					</span>
					<input type="text" name="oferta_valor_final" class="form-control moeda valor-unidade" @if (isset($entry) && $entry->caracteristicas->where('nome', 'oferta_valor_final')->first())value="{{ converte_valor_real($entry->caracteristicas->where('nome', 'oferta_valor_final')->first()->pivot->valor) }}"@endif>
				</div>
			</div>
		</div>

	</div>

	@endif

	<div class="clearfix"></div>

	<div class="form-group">
		<input type="hidden" name="tipo_alteracao" value="Individual">
		<button type="submit" class="btn btn-success btn-salvar-alteracoes" id="btn-submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Alterar unidade</button>
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

		$('input[name=oferta_desconto_percentual]').on('blur', function () {

	  		var oferta_desconto_percentual = remove_mascara_valor($(this).val());
	  		var valor_unidade = remove_mascara_valor($('input[name=valor_unidade]').val());

	  		if (valor_unidade != '' && oferta_desconto_percentual != '') {
				var valor_final = formata_valor_real(calcularDesconto(valor_unidade, oferta_desconto_percentual));
	  			$('input[name=oferta_valor_final]').val(valor_final);
	  		}
	  	});

		$('input[name=valor_unidade]').on('blur', function () {

			var valor_unidade = remove_mascara_valor($(this).val());
			var metragem_total = $('input[name=metragem_total]').val();

			if (valor_unidade != '' && metragem_total != '') {
			var valor_m2 = formata_valor_real(calcularValorM2(valor_unidade, metragem_total));
				$('input[name=valor_m2]').val(valor_m2);
			}
		});

	    /*
		$('input[name=valor_m2]').on('blur', function () {

			var valor_m2 = $(this).val();
			var metragem_total = parseFloat($('input[name=metragem_total]').val());

			if (valor_m2 != '' && metragem_total != '') {
				$('input[name=valor_unidade]').val(formata_valor_real(calcularValorUnidade(valor_m2, metragem_total)));
			}

		});*/


		/*$('input[name=metragem_total]').on('blur', function () {

			var metragem_total = $(this).val();
			var valor_m2 = parseFloat($('input[name=valor_m2]').val());

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

		function calcularDesconto(valor_unidade, valor_desconto) {
			var valor_final = valor_unidade - (valor_unidade / 100 * valor_desconto);
			return valor_final;
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

		$('#oferta_online').change(function (){
			var oferta_online = ($(this).val());

			if(oferta_online == "Sim"){
				$(".oferta-unidade").css("display", "block");
				$(".proposta-unidade").css("display", "none");
			}else{
				$(".oferta-unidade").css("display", "none");
				$(".proposta-unidade").css("display", "block");
			}
		});

	});
</script>

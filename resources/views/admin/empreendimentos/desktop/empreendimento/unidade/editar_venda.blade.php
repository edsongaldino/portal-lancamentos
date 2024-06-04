<form id="formAlterarVendaUnidade">
	<input type="hidden" name="situacao" id="situacao" value="{{ $situacao }}">
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

	<div class="form-group linha-50 left">
		<label class="">Data da Venda</label>
		<input type="date" name="data_venda" id="data_venda" class="form-control" @if (isset($entry->comprador->data))value="{{ $entry->comprador->data }}"@endif required>		
	</div>

	<div class="form-group linha-50">
		<label class="">Valor da Venda</label>
		<input type="text" name="valor_venda" id="valor_venda" class="form-control moeda" @if (isset($entry->comprador->valor))value="{{ $entry->comprador->valor }}"@endif required>		
	</div>	



	<div class="tabs lista-vendas">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#quem_comprou" data-toggle="tab"><i class="fa fa-star"></i> Quem comprou?</a>
                </li>
                <li>
                    <a href="#quem_vendeu" data-toggle="tab"><i class="fa fa-usd"></i> Quem vendeu?</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="quem_comprou" class="tab-pane active">
                    <div class="panel-body">
					<div class="form-group">
					<label class="">Nome do Comprador (Opcional)</label>
					<input type="text" name="nome_comprador" class="form-control" @if (isset($entry->comprador->nome))value="{{ $entry->comprador->nome }}"@endif>		
				</div>

				<div class="form-group">
					<label class="">CPF (Opcional)</label>
					<input type="text" name="cpf" class="form-control cpf" @if (isset($entry->comprador->cpf))value="{{ $entry->comprador->cpf }}"@endif>		
				</div>

				<div class="form-group">
					<label class="">E-mail (Opcional)</label>
					<input type="text" name="email" class="form-control" @if (isset($entry->comprador->email))value="{{ $entry->comprador->email }}"@endif>		
				</div>

				<div class="form-group">
					<label class="">Celular (Opcional)</label>
					<input type="text" name="celular" class="form-control celular" @if (isset($entry->comprador->celular))value="{{ $entry->comprador->celular }}"@endif>		
				</div>

				<div class="form-group">
					<label class="">Estado Cívil (Opcional)</label>
					<select name="estado_civil" class="form-control">
						<option>Selecione o estado cívil</option>
						<option value="Solteiro" 
							@if (isset($entry->comprador->estado_civil))
								@if($entry->comprador->estado_civil == 'Solteiro')
									selected="true"
								@endif
							@endif>Solteiro</option>
						<option value="Casado"
							@if (isset($entry->comprador->estado_civil))
								@if($entry->comprador->estado_civil == 'Casado')
									selected="true"
								@endif
							@endif>Casado</option>
						<option value="Divorciado"
							@if (isset($entry->comprador->estado_civil))
								@if($entry->comprador->estado_civil == 'Divorciado')
									selected="true"
								@endif
							@endif>Divorciado</option>
						<option value="UniaoEstavel"
							@if (isset($entry->comprador->estado_civil))
								@if($entry->comprador->estado_civil == 'UniaoEstavel')
									selected="true"
								@endif
							@endif>União Estável</option>
						<option value="Viuvo"
							@if (isset($entry->comprador->estado_civil))
								@if($entry->comprador->estado_civil == 'Viuvo')
									selected="true"
								@endif
							@endif>Viúvo</option>
					</select>
				</div>
				
				<div class="form-group linha-50 left esposa" 
					@if (isset($entry->comprador->nome_esposa))
						@if($entry->comprador->estado_civil == 'Casado' || $entry->comprador->estado_civil == 'UniaoEstavel')
						style="display: block;"
						@else
						style="display: none"
						@endif
					@endif
				>
					<label class="">Nome do cônjuge</label>
					<input type="text" name="nome_esposa" class="form-control" @if (isset($entry->comprador->nome_esposa))value="{{ $entry->comprador->nome_esposa }}"@endif>		
				</div>

                    </div>
                </div>
                <div id="quem_vendeu" class="tab-pane">
                    <div class="panel-body">

					<div class="form-group linha-50 left">
						<label class="">Quem Vendeu</label>
						<select name="origem_venda" class="form-control">
							<option>Selecione</option>
							<option value="Parceiro"
							@if (isset($entry->comprador->origem_venda))
								@if($entry->comprador->origem_venda == 'Parceiro')
									selected="true" 
								@endif
							@endif
							>Parceiro</option>
							<option value="Equipe House"
							@if (isset($entry->comprador->origem_venda))
								@if($entry->comprador->origem_venda == 'Equipe House')
									selected="true" 
								@endif
							@endif
							>Equipe House</option>
						</select>
					</div>

					<div class="form-group linha-50 left">
						<label class="">Corretor</label>
						<input type="text" name="nome_corretor" class="form-control" @if (isset($entry->comprador->nome_corretor))value="{{ $entry->comprador->nome_corretor }}"@endif>		
					</div>

					<div class="form-group linha-50 left">
						<label class="">Creci</label>
						<input type="text" name="creci_corretor" class="form-control" @if (isset($entry->comprador->creci_corretor))value="{{ $entry->comprador->creci_corretor }}"@endif>		
					</div>

					<div class="form-group linha-50 left">
						<label class="">Telefone</label>
						<input type="text" name="telefone_corretor" class="form-control telefone" @if (isset($entry->comprador->telefone_corretor))value="{{ $entry->comprador->telefone_corretor }}"@endif>		
					</div>

					<div class="form-group linha-50 left">
						<label class="">Percentual Honorário (%)</label>
						<input type="text" maxlength="5" name="percentual_honorario" class="form-control percentual" @if (isset($entry->comprador->percentual_honorario))value="{{ $entry->comprador->getOriginal('percentual_honorario') }}"@endif>		
					</div>

					<div class="form-group linha-50 left">
						<label class="">Valor Honorário (R$)</label>
						<input type="text" name="valor_honorario" class="form-control moeda" @if (isset($entry->comprador->valor_honorario))value="{{ $entry->comprador->valor_honorario }}"@endif>		
					</div>

                    </div>
                </div>
            </div>
        </div>	

	<div style="clear: both;"></div>

	<div class="form-group">
		<input type="submit" class="btn btn-success" id="btn-submit" value="Alterar unidade">
	</div>
</form>

<script type="text/javascript">
	$(function () {		
	  	$('.telefone').mask('(00) 0000-0000');
	  	$('.celular').mask('(00) 00000-0000');
	  	$('.date').mask('00/00/0000');
	  	$('.cpf').mask('000.000.000-00');
	  	$('.moeda').maskMoney({thousands: '.', decimal: ','});
	  	$('.percentual').maskMoney({thousands: '.', decimal: '.'});

	  	$('input[name=percentual_honorario]').on('blur', function () {
	  		var percentual = parseFloat($(this).val());
	  		var valor_venda = remove_mascara_valor($('input[name=valor_venda]').val());
	  		var $valor_honorario = $('input[name=valor_honorario]');

	  		if (valor_venda != '' && valor_venda > 0) {
	  			var valor_calculado = calcularValor(percentual, valor_venda);
	  			$valor_honorario.val(formata_valor_real(valor_calculado));
	  		}
	  	});

	  	$('input[name=valor_honorario]').on('blur', function () {
	  		var valor_honorario = remove_mascara_valor($(this).val());
	  		var valor_venda = remove_mascara_valor($('input[name=valor_venda]').val());
	  		var $percentual = $('input[name=percentual_honorario]');

	  		if (valor_venda != '' && valor_venda > 0) {
	  			var valor_calculado = calcularPercentual(valor_honorario, valor_venda);
	  			$percentual.val(formata_valor_real(valor_calculado));
	  		}
	  	});

	  	$('input[name=valor_venda]').on('blur', function () {
	  		var valor_venda = remove_mascara_valor($(this).val());
	  		var percentual = parseFloat($('input[name=percentual_honorario]').val());

	  		if (percentual != '') {
	  			$('input[name=valor_honorario]').val(formata_valor_real(calcularValor(percentual, valor_venda)));
	  		}
	  	});

	  	function calcularPercentual(valor_honorario, valor_venda) {
	  		return (valor_honorario / valor_venda) * 100;	
	  	}

	  	function calcularValor(percentual, valor_venda) {
	  		return (percentual * valor_venda) / 100
	  	}

	  	$("select[name=estado_civil]").on('change', function () {
	  		var valor = $(this).val();
	  		var $esposa = $('.esposa');
	  		$esposa.hide();

	  		if (valor == 'Casado' || valor == 'UniaoEstavel') {
	  			$esposa.show();
	  		}	
	  	});
	  	
		$('#formAlterarVendaUnidade').on('submit', function (e) {
			
			e.preventDefault();

			if ($("#data_venda").val() === '') {
				Swal.fire(
				'Desculpe',
				'Informe a data da venda',
				'error'
				);

				return false;
			}

			if ($("#valor_venda").val() === '' || $("#valor_venda").val() === '0.00') {
				Swal.fire(
				'Desculpe',
				'Informe o valor da venda',
				'error'
				);

				return false;
			}

			ajaxRequest({
			  url: "{{ route('atualizar-venda-unidade', $entry->id) }}",
			  metodo: 'POST',
			  dados: $(this).serialize(),
			  feedback: true,
			  mensagemSucesso: 'Dados do comprador alterados com sucesso',
			  mensagemErro: 'Erro, tente novamente mais tarde',
			  reload: false
			});
		});

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

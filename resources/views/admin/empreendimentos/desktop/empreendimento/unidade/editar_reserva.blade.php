<form id="formAlterarReservaUnidade">
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

	<div class="form-group linha-100 left">
		<label class="">Reservado até:</label>
		<input type="date" name="data_final_reserva" class="form-control data-final-reserva" @if (isset($entry->reserva->data_final_reserva))value="{{ $entry->reserva->data_final_reserva }}"@endif>		
	</div>

	<div class="tabs lista-vendas">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#quem_comprou" data-toggle="tab"><i class="fa fa-star"></i> Está reservando esta unidade para quem?</a>
                </li>
            </ul>
            <div class="tab-content">

            <div id="quem_comprou" class="tab-pane active">
                <div class="panel-body">

                        <div class="form-group">
                            <label class="">Selecione</label>
                            <select name="tipo_reserva" class="form-control input-reserva">
                                <option>Selecione para quem é a reserva</option>
                                <option value="" 
                                    @if(($entry->reserva->tipo_reserva ?? '') == '')
                                        selected="true"
                                    @endif>
                                Reserva Interna
                                </option>
                                <option value="Cliente" 
                                    @if(($entry->reserva->tipo_reserva ?? '') == 'Cliente')
                                        selected="true"
                                    @endif>
                                Cliente
                                </option>
                                <option value="Parceiro" 
                                    @if(($entry->reserva->tipo_reserva ?? '') == 'Parceiro')
                                        selected="true"
                                    @endif>
                                Parceiro (Imobiliária/Corretor)
                                </option>
                            </select>
                        </div>
                        <div id="dados_cliente" @if(($entry->reserva->tipo_reserva ?? '') == 'Cliente') style="display: block;" @else  style="display: none;" @endif>
                            <div class="form-group">
                                <label class="">Nome do Cliente</label>
                                <input type="text" name="nome_cliente" class="form-control" @if (isset($entry->reserva->nome_cliente))value="{{ $entry->reserva->nome_cliente }}"@endif>		
                            </div>

                            <div class="form-group">
                                <label class="">CPF</label>
                                <input type="text" name="cpf_cliente" class="form-control cpf" @if (isset($entry->reserva->cpf_cliente))value="{{ $entry->reserva->cpf_cliente }}"@endif>		
                            </div>

                            <div class="form-group">
                                <label class="">E-mail</label>
                                <input type="text" name="email_cliente" class="form-control" @if (isset($entry->reserva->email_cliente))value="{{ $entry->reserva->email_cliente }}"@endif>		
                            </div>

                            <div class="form-group">
                                <label class="">Celular</label>
                                <input type="text" name="telefone_cliente" class="form-control celular" @if (isset($entry->reserva->telefone_cliente))value="{{ $entry->reserva->telefone_cliente }}"@endif>		
                            </div>
                        </div>

                        <div id="dados_parceiro" @if(($entry->reserva->tipo_reserva ?? '') == 'Parceiro') style="display: block;" @else  style="display: none;" @endif>
                            <div class="form-group">
                                <label class="">Nome do Parceiro</label>
                                <input type="text" name="nome_parceiro" class="form-control" @if (isset($entry->reserva->nome_parceiro))value="{{ $entry->reserva->nome_parceiro }}"@endif>		
                            </div>

                            <div class="form-group">
                                <label class="">Creci</label>
                                <input type="text" name="creci_parceiro" class="form-control creci" @if (isset($entry->reserva->creci_parceiro))value="{{ $entry->reserva->creci_parceiro }}"@endif>		
                            </div>

                            <div class="form-group">
                                <label class="">E-mail</label>
                                <input type="text" name="email_parceiro" class="form-control" @if (isset($entry->reserva->email_parceiro))value="{{ $entry->reserva->email_parceiro }}"@endif>		
                            </div>

                            <div class="form-group">
                                <label class="">Telefone</label>
                                <input type="text" name="telefone_parceiro" class="form-control celular" @if (isset($entry->reserva->telefone_parceiro))value="{{ $entry->reserva->telefone_parceiro }}"@endif>		
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>	

	<div style="clear: both;"></div>

	<div class="form-group">
		<input type="submit" class="btn btn-success alterar-reserva-btn" id="btn-submit" value="Alterar reserva da unidade">
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

	  	$("select[name=tipo_reserva]").on('change', function () {
	  		var valor = $(this).val();
	  		var $dados_cliente = $('#dados_cliente');
            var $dados_parceiro = $('#dados_parceiro');
	  		$dados_cliente.hide();
            $dados_parceiro.hide();

	  		if (valor == 'Cliente') {
	  			$dados_cliente.show();
	  		}	

            if (valor == 'Parceiro') {
	  			$dados_parceiro.show();
	  		}

	  	});
	  	
		$('#formAlterarReservaUnidade').on('submit', function (e) {
			e.preventDefault();

			ajaxRequest({
			  url: "{{ route('atualizar-reserva-unidade', $entry->id) }}",
			  metodo: 'POST',
			  dados: $(this).serialize(),
			  feedback: true,
			  mensagemSucesso: 'Dados da reserva alterados com sucesso',
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

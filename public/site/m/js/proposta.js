	var Proposta = function (valor_proposta, entrada_proposta, saldo, total_mensais) 
	{
	this.valor_proposta = valor_proposta;
	this.entrada_proposta = entrada_proposta ?? 0;
	this.saldo = saldo;
	this.total_balao = 0;  
	this.valor_bens_negociaveis = 0;
	this.total_mensais = total_mensais;

	$("#saldo_remanescente").val(this.saldo_formatado(this.saldo));

	this.onValorProposta();
	this.onValorEntrada();
	this.onCpf();
	this.onAtualizarSaldo();
	//this.atualizar();
	//this.onTipoNegociacao();
	this.onBensNegociaveis();
	this.onParcelaBalao();
	this.onParcelasMensais();
	this.setValorTotalBaloes();
	this.setValorTotalMensais();
	};

	Proposta.prototype.saldo_formatado = function (valor) {
	return this.formatar_reais(valor);
	};

	Proposta.prototype.formatar_reais = function (valor) {
	var resultado = 0;

	$.ajax({
		method: 'GET',
		url: '/formatar-valor-reais/' + valor,
		async: false,
		success: function(response) {
		resultado = response.retorno;
		},
	});

	return resultado;
	};

	Proposta.prototype.remover_mascara = function (valor) {
	if (valor) {
		valor = valor.replace("R$ ", "");
		valor = valor.replace(/\./gi, "");
		valor = valor.replace(",", ".");

		return parseFloat(valor);
	}
	};

	Proposta.prototype.onValorProposta = function() {
	var valor = 0;
	var $this = this;
	$(document).on('blur', '#valor_proposta', function () {
		valor = $this.remover_mascara($(this).val());
		
		if ($this.validacoes(valor)) {
		$this.valor_proposta = valor;
		$this.atualizar(); 
		}    
	});
	};

	Proposta.prototype.onValorEntrada = function() {
	var valor = 0;
	var $this = this;
	$(document).on('blur', '#valor_entrada', function () {
		valor = $this.remover_mascara($(this).val());    

		console.log('novo valor de entrada -> ' + valor);
		
		if ($this.validacoes(valor)) {
		$this.entrada_proposta = valor ?? 0;
		$this.atualizar(); 
		}    
	});
	};

	Proposta.prototype.onParcelasMensais = function() {  
	var $this = this;
	$(document).on('blur', '#qtd_parcela_mensal, #valor_parcela_mensal', function () {    
		$this.setValorTotalMensais();      
		$this.atualizar();
	});
	};

	Proposta.prototype.setValorTotalMensais = function () {
		var total_mensais = 0;
		var valor = $("#valor_parcela_mensal").val() == "" 
		? 0
		: this.remover_mascara($("#valor_parcela_mensal").val());

		var qtde = $("#qtd_parcela_mensal").val() == "" 
		? 0
		: this.remover_mascara($("#qtd_parcela_mensal").val());

		console.log('valor mensal -> ' + valor);
		console.log('qtde mensal -> ' + qtde);

		var x = parseFloat(valor) * parseFloat(qtde);

		console.log('valor x mensal -> ' + total_mensais);

		if(x){
			this.total_mensais = x;
		}
	
	};

	Proposta.prototype.onParcelaBalao = function() {
	var $this = this;
	$(document).on('blur', '#valor_parcela_balao', function () {
		$this.setValorTotalBaloes();        
	});
	};

	Proposta.prototype.setValorTotalBaloes = function () {
	var baloes = document.getElementsByName("valor_parcela_balao[]");
	var valor = 0;
	var valor_balao = 0;
		
	for (var i = 0; i < baloes.length; i++){

		if(baloes[i].value != 0){
		valor_balao = this.remover_mascara(baloes[i].value); 
		console.log('balao: ' + i + ' -> ' + valor_balao);  
		valor = valor_balao + valor;
		}
	}

	console.log('valor total balao -> ' + valor);

	if (this.validacoes(valor)) {
		this.total_balao = valor;
		this.atualizar(); 
	}    
	};

	Proposta.prototype.onBensNegociaveis = function() {
	var valor = 0;
	var $this = this;
	$(document).on('blur', '#valor_bens', function () {
		valor = $this.remover_mascara($(this).val());    
		
		console.log('valor bens negociaveis -> ' + valor);

		if ($this.validacoes(valor)) {
		$this.valor_bens_negociaveis = valor;      
		$this.atualizar(); 
		}    
	});
	};

	Proposta.prototype.onAtualizarSaldo = function() {  
		var $this = this;
		$(document).on('click', '.atualizar_saldo', function () {    
			$this.atualizar(); 
		});
	};

		Proposta.prototype.validacoes = function (valor) {
		if (valor > this.valor_proposta) {
		  Swal.fire(
			'Desculpe', 
			'O valor da proposta não pode ser maior que o valor total', 
			'error'
		  );
		  return false;
		}
	  
		if (valor < 0) {
		  Swal.fire(
			'Desculpe', 
			'O valor da proposta não pode ser menor que zero', 
			'error'
		  );
		  return false;
		}
	  
		return true;
	  };
	  
	  Proposta.prototype.onTipoNegociacao = function () {
		$(document).on('change', '#tipo_negociacao_saldo', function () {    
		  var tipo_negociacao_saldo = $(this).val();  
		  if(tipo_negociacao_saldo == 'Mediante Financiamento') {
			$("#dados_financiamento").css("display","block");
			$("#dados_bens_negociaveis").css("display","none");      
		  } else {
			$("#dados_bens_negociaveis").css("display","block");
			$("#dados_financiamento").css("display","none");      
		  }
		});
	  }
	  
	  Proposta.prototype.atualizar = function () { 
		var saldo_proposta = this.getSaldoProposta();
	  
		console.log('saldo_proposta ->' + saldo_proposta);
	  
		$("#saldo_remanescente").val(this.saldo_formatado(saldo_proposta));
		/*$(".resumo_saldo_remanescente").html(this.formatar_reais(saldo_proposta));
		$(".resumo_valor_proposta").html(this.formatar_reais(this.valor_proposta));
		$(".resumo_valor_entrada").html(this.formatar_reais(this.entrada_proposta));
		$(".resumo_bens_negociaveis").html(this.formatar_reais(this.valor_bens_negociaveis)); 
		$(".resumo_balao").html(this.formatar_reais(this.total_balao));
		$(".resumo_mensais").html(this.formatar_reais(this.total_mensais));*/
	  };
	  
	  
	  Proposta.prototype.getSaldoProposta = function () {
		// console.log('valor da proposta -> ' + this.valor_proposta);
		// console.log('valor da entrada -> ' + this.entrada_proposta);
		// console.log('valor bens -> ' + this.valor_bens_negociaveis);
		// console.log('valor total balao -> ' + this.total_balao);
		// console.log('valor total mensal -> ' + this.total_mensais);
		return parseFloat(this.valor_proposta) - (
		  parseFloat(this.entrada_proposta) + 
		  parseFloat(this.valor_bens_negociaveis) + 
		  parseFloat(this.total_balao) + 
		  parseFloat(this.total_mensais)
		); 
	  };


	  Proposta.prototype.onCpf = function() {    
		$(document).on('blur', '.cpf', function () {   
	  
		  $.ajaxSetup({
			headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		  });
	  
		  var cpf = $(this).val();
		  $.ajax({
			url: '/buscar-cliente',
			method: 'POST',
			data: {
			  cpf: cpf
			},
			success: function (response) {
			  $("#nome_cliente").val(response.nome);
			  $("#email_cliente").val(response.email);
			  $("#telefone_cliente").val(response.telefone);
			  $("#data_nascimento_cliente").val(response.data_nascimento);
			  $("#renda_cliente").val(response.renda);
			  $("#estado_civil").val(response.estado_civil);
			}
		  });
		});
	  };
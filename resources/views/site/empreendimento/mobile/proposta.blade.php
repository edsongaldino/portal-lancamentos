@extends('site/layout_mobile')

@section('title')
{{ strtoupper($oferta->empreendimento->nome) }}
@endsection

@push('css')
<link rel="stylesheet" href="/site/m/css/proposta.css" />
<!-- Web Fonts  -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="/assets/vendor/magnific-popup/magnific-popup.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="/assets/vendor/pnotify/pnotify.custom.css" />

<!-- Theme CSS -->
<link rel="stylesheet" href="/assets/stylesheets/theme.css" />

<!-- Skin CSS -->
<link rel="stylesheet" href="/assets/stylesheets/skins/default.css" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="/assets/stylesheets/theme-custom.css">
<link rel="stylesheet" href="/global/css/loader/index.css">
<link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">
<script src="/assets/vendor/pnotify/pnotify.custom.js"></script>
@endpush

@push('js_header')  
  <script src="/assets/vendor/modernizr/modernizr.js"></script>
  <script src="/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
  <script src="/assets/javascripts/sweetalert2.8.js"></script>
  <script src="/site/js/empreendimento/proposta.js"></script>
  <script src="/site/m/js/proposta.js"></script>
  <script src="/global/js/loader/index.js"></script>
  <script type="text/javascript">
  	var proposta = new Proposta(
  	  {{ $oferta->getOriginal('preco_oferta') ?? 0 }}, 
  	  {{ $oferta->getOriginal('valor_entrada') ?? 0 }},
  	  {{ $oferta->quantidade_parcela ?? 0 }},
  	  {{ $oferta->getOriginal('valor_parcela') ?? 0 }},
  	  {{ $oferta->baloes->count() ?? 0 }}
  	);
  </script>
@endpush

@section('content')
<!-- Main Content -->
<div class="content-container-interna animated fadeInUp">
	<div class="box-aba-proposta">
		<div class="aba-proposta active" id="mostrar-proposta-cliente"><i class="fa fa-usd" aria-hidden="true"></i> Minha Proposta</div>
		<div class="aba-proposta" id="mostrar-proposta-construtora"><i class="fa fa-usd" aria-hidden="true"></i> Construtora</div>
	</div>

	<div class="conteudo-proposta-cliente" id="conteudo-proposta-cliente" style="display:block;">
		<form class="form-horizontal proposta-cliente" id="form_proposta_unidade">
			  <input type="hidden" name="oferta_id" value="{{ $oferta->id }}">
			  <input type="hidden" name="empreendimento_tipo" id="empreendimento_tipo" value="{{ $oferta->empreendimento->tipo }}">
			<div class="row">
				<label class="col-sm-3 control-label" for="w4-first-name">Valor da Proposta</label>
				<div class="col-sm-3">
					<div class="input-group mb-md">
						<span class="input-group-addon btn-warning">R$</span>
						<input type="text" name="valor_proposta" id="valor_proposta" value="{{ $oferta->preco_oferta }}" class="form-control valor valor_proposta valor-proposta">
					</div>
				</div>

				@if($oferta->tipo_negociacao != 'Avista')
					<label class="col-sm-2 control-label" for="w4-first-name">Valor de Entrada</label>
					<div class="col-sm-4">
						<div class="input-group mb-md">
							<span class="input-group-addon box-valor-entrada">R$</span>
							<input type="text" id="valor_entrada" name="entrada_proposta" value="{{ $oferta->valor_entrada }}" class="form-control valor valor_entrada valor-entrada">
						</div>
					</div>
				@endif

			</div>


			@if($oferta->tipo_negociacao == 'EntradaComMensaisFinanciamento' || $oferta->tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento' || $oferta->tipo_negociacao == 'EntradaParcelamentoDireto')
				<div class="row">
					<label class="col-md-3 control-label">Nº Parcelas Mensais</label>
					<div class="col-md-3">
						<div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 30 }'>
							<div class="input-group" style="width:200px;">
								<input type="text" id="qtd_parcela_mensal" name="quantidade_parcela" value="{{ $oferta->quantidade_parcela }}" class="spinner-input form-control qtd_parcela_mensal" maxlength="2">
								<div class="spinner-buttons input-group-btn">
									<button type="button" class="btn btn-default spinner-up">
										<i class="fa fa-angle-up"></i>
									</button>
									<button type="button" class="btn btn-default spinner-down">
										<i class="fa fa-angle-down"></i>
									</button>
								</div>
							</div>
						</div>
					</div>

					<label class="col-sm-2 control-label" for="w4-first-name">Valor (Mensais)</label>
					<div class="col-sm-4">
						<div class="input-group mb-md">
							<span class="input-group-addon">R$</span>
							<input type="text" name="valor_parcela" id="valor_parcela_mensal" value="{{ $oferta->valor_parcela }}" class="form-control valor valor_parcela_mensal valor-mensal">
						</div>
					</div>
				</div>
			@endif

			@if(($oferta->baloes->count() > 0) && ($oferta->tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento' || $oferta->tipo_negociacao == 'EntradaComBaloesFinanciamento' || $oferta->tipo_negociacao == 'EntradaParcelamentoDireto'))
  			<div class="parcelas">
  				<div class="col-sm-8 box-parcelas-balao cliente">
  					<div class="titulo-box-balao"><i class="fa fa-list-ol" aria-hidden="true"></i> Parcelas Balão</div>
  					<div id="parcelas">
  						@foreach($oferta->baloes as $balao)
    						<div class="row baloes" id="remove{{ $loop->iteration }}">
    							<div class="balao-valor">
    								<div class="input-group mb-md">
    									<input type="text" name="valor_parcela_balao[]" id="valor_parcela_balao" value="{{ $balao->getOriginal('valor') }}" class="form-control valor valor_parcela_balao_{{ $loop->iteration }} valor-balao" id="money">
    								</div>
    							</div>
    							<div class="balao-data">
    								<div class="input-group mb-md">
    									<input type="text" name="data_parcela_balao[]" id="data_parcela_balao" value="{{ $balao->data }}" class="form-control data">
    								</div>
    							</div>
    							<div class="botoes-balao">
    								@if($loop->iteration == 1)
										<a class="simple-ajax-modal btn btn-lg btn-success btn-add-parcela" href="javascript:void(0)" id="add_parcela">
											<i class="fa fa-plus-square"></i>
										</a>
    								@else
										<a class="simple-ajax-modal btn btn-lg btn-danger btn-remove-parcela remove_campo" href="javascript:void(0)" id="{{ $loop->iteration }}">
											<i class="fa fa-minus-square"></i>
										</a>
    								@endif
    							</div>
    						</div>
  						@endforeach
  					</div>							
  				</div>

  				<div class="col-sm-4 saldo cliente">
  					<div class="titulo-box-saldo">
              <i class="fa fa-usd" aria-hidden="true"></i> 
              Saldo remanescente 
              <div class="btn-info btn-atualizar atualizar_saldo">
                <i class="fa fa-refresh" aria-hidden="true"></i> 
                Atualizar
              </div>
            </div>
  					<label class="control-label" for="w4-first-name">
              @if($oferta["codigo_tipo_negociacao"] == 'Avista')
                Pagamento à Vista
              @else
                À Negociar
              @endif
            </label>
  					<div class="input-group mb-md">
  						<span class="input-group-addon btn-warning">R$</span>
  						<input type="text" name="saldo_remanescente" id="saldo_remanescente" 
              value="@if($oferta->tipo_negociacao == ''){{ $oferta->preco_oferta }}@else{{ $oferta->saldo_remanescente }}@endif" 
              class="form-control valor saldo_remanescente" readonly>
  					</div>
  				</div>

  			</div>
			@else
  			<div class="parcelas">
  				<div class="col-sm-4 saldo cliente">
  					<div class="titulo-box-saldo"><i class="fa fa-usd" aria-hidden="true"></i> Saldo remanescente <div class="btn-info btn-atualizar atualizar_saldo"><i class="fa fa-refresh" aria-hidden="true"></i> Atualizar</div></div>
  					<label class="control-label" for="w4-first-name">
  						@if($oferta->tipo_negociacao == 'Avista')
  							Pagamento à Vista
  						@else
                À Negociar
              @endif
            </label>
  					<div class="input-group mb-md">
  						<span class="input-group-addon btn-warning">R$</span>
  						<input style="text-align:right; padding: 0" type="text" name="saldo_remanescente" id="saldo_remanescente" value="@if($oferta->tipo_negociacao == 'Avista')
					{{ $oferta->preco_oferta }}                
                @else
                  {{ $oferta->saldo_remanescente }}                  
                @endif" 
                class="form-control valor saldo_remanescente" readonly>
  					</div>
  				</div>
  			</div>
			@endif

			@if($oferta->aceita_bens == 'Sim')
				<div class="complementar-proposta">
					<div class="col-sm-5">
						<label class="control-label" for="tipo_negociacao_saldo">
              Negociar Saldo Remanescente Através de:
            </label>
						<select id="tipo_negociacao_saldo" name="tipo_negociacao_saldo" class="form-control">
							<option value="">Selecione</option>
							<option value="Mediante Financiamento">Financiamento Imobiliário</option>
							<option value="Bens Negociáveis">Financiamento + Bens Negociáveis (Carro, Imóveis, etc)</option>
						</select>
					</div>
					<div id="dados_bens_negociaveis" style="display:none;">
  					<div class="col-sm-3">
  						<label class="control-label">Valor total dos bens negociáveis</label>
  						<div class="input-group mb-md">
  							<span class="input-group-addon btn-info">R$</span>
  							<input type="text" name="valor_bens" id="valor_bens" value="" class="form-control valor valor_bens_negociaveis">
  						</div>
  					</div>
  					<div class="col-sm-4">
  						<textarea name="descricao_bens" id="descricao_bens_negociaveis" class="descricao-valores" placeholder="Descrição dos bens negociáveis" maxlength="100"></textarea>
  					</div>
					</div>
					<div id="dados_financiamento" style="display:none;">
						<div class="col-sm-7 negociar-financiamento">
							O saldo remanescente deverá ser negociado diretamente com seu banco de preferência.
						</div>
					</div>
				</div>
			@endif

			<div class="topo-dados-cliente">
        <i class="fa fa-user" aria-hidden="true"></i> 
        Seus dados pessoais
      </div>
			<div class="dados-cliente">
				<div class="row">
          <label class="col-sm-2 control-label" for="w4-first-name">Seu CPF</label>
          <div class="col-sm-4">
            <div class="input-group mb-md">
              <span class="input-group-addon btn-warning">CPF</span>
              <input type="text" name="cpf" id="cpf_cliente" value="" class="form-control cpf" required>
            </div>
          </div>

					<label class="col-sm-2 control-label" for="w4-first-name">Nome completo</label>
					<div class="col-sm-6">
						<div class="input-group mb-md">
							<span class="input-group-addon">
                <i class="fa fa-user" aria-hidden="true"></i>
              </span>
							<input type="text" name="nome" id="nome_cliente" value="" class="form-control" required>
						</div>
					</div>					
					
					<label class="col-sm-2 control-label" for="w4-first-name">Data de Nascimento</label>
					<div class="col-sm-3">
						<div class="input-group mb-md">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input type="text" name="data_nascimento" id="data_nascimento_cliente" value="" class="form-control data" required>
						</div>
					</div>
					<label class="col-sm-2 control-label" for="w4-first-name">E-mail</label>
					<div class="col-sm-5">
						<div class="input-group mb-md">
							<span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
							<input type="email" name="email" id="email_cliente" value="" class="form-control" required>
						</div>
					</div>

					<label class="col-sm-2 control-label" for="w4-first-name">Telefone</label>
					<div class="col-sm-3">
						<div class="input-group mb-md">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<input type="text" name="telefone" id="telefone_cliente" value="" class="form-control phone" required>
						</div>
					</div>
					<label class="col-sm-2 control-label" for="w4-first-name">Estado civil</label>
					<div class="col-sm-3 select">
						<select id="estado_civil" name="estado_civil" class="form-control" required>
              <option value="">Selecione</option>                            
              <option value="Solteiro">Solteiro</option>                            
              <option value="Casado">Casado</option>                            
              <option value="Viúvo">Viúvo</option>                            
              <option value="Separado">Separado</option>                            
              <option value="Divorciado">Divorciado</option>                            
              <option value="União Estável">União Estável</option>
              <option value="Não informado">Não informado</option>							
						</select>
					</div>

					<div id="dados_conjuge" style="display:none;">
						<label class="col-sm-2 control-label" for="w4-first-name">Nome Cônjuge</label>
						<div class="col-sm-6">
							<div class="input-group mb-md">
								<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
								<input type="text" name="conjuge_nome" id="nome_conjuge" value="" class="form-control">
							</div>
						</div>
						<label class="col-sm-2 control-label" for="w4-first-name">CPf Cônjuge</label>
						<div class="col-sm-4">
							<div class="input-group mb-md">
								<span class="input-group-addon btn-warning">CPF</span>
								<input type="text" name="conjuge_cpf" id="cpf_conjuge" value="" class="form-control cpf">
							</div>
						</div>
					</div>

					<div class="renda">
						<label class="col-sm-2 control-label" for="w4-first-name">Renda</label>
						<div class="col-sm-3">
							<div class="input-group mb-md">
								<span class="input-group-addon btn-renda"><i class="fa fa-usd" aria-hidden="true"></i></span>
								<input type="text" name="renda" id="renda_cliente" value="" class="form-control renda valor" required>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="resumo-proposta">

				<div class="informacoes-proposta">
					<p><strong>Correção Parcela Mensal:</strong> {{ $oferta->correcao_parcela }} </p>
					<p><strong>Correção Parcela Balão / Intermediária:</strong> {{ $oferta->correcao_parcela_balao }}</p>
					<p>Informamos que sua proposta será enviada para a construtora para análise, no período máximo de <strong>24 horas</strong> você será informado se a mesmo foi aprovada ou não. A proposta não garante a reserva da unidade e também não gera nenhum vínculo com a construtora e/ou incorporadora.</p>
					<textarea name="comentarios" id="outros_comentarios" class="outros-comentarios" placeholder="Gostaria de incluir algum comentário?" maxlength="100"></textarea>
				</div>

				<div class="checkbox-custom checkbox-terms">
					<input type="checkbox" name="terms" id="w4-terms" required>
					<label for="w4-terms">Concordo em disponibilizar meus dados para análise da construtora</label>
				</div>

			</div>
			
      		<input type="submit" class="btn-enviar-proposta" id="enviar_proposta" value="Enviar Proposta">

			<input type="hidden" name="codigo_unidade_oferta" id="codigo_unidade_oferta" class="form-control" value="{{ $oferta->id }}">
		</form>
	</div>	

	<div class="conteudo-proposta-construtora" id="conteudo-proposta-construtora" style="display:none;">
		<div class="row">
			<label class="col-sm-2 control-label" for="w4-first-name">Preço de Tabela</label>
			<div class="col-sm-3">
				<div class="input-group mb-md">
					<span class="input-group-addon">R$</span>
					<input type="text" value="{{ $oferta->preco_tabela }}" class="form-control valor preco_tabela campo-bloqueado" readonly>
				</div>
			</div>
			<label class="col-sm-1 control-label" for="w4-first-name">Oferta</label>
			<div class="col-sm-3">
				<div class="input-group mb-md">
					<span class="input-group-addon btn-warning">R$</span>
					<input type="text" value="{{ $oferta->preco_oferta }}" class="form-control valor campo-bloqueado preco-oferta" readonly>
				</div>
			</div>

			<label class="col-sm-1 control-label" for="w4-first-name">Desconto</label>
			<div class="col-sm-2">
				<div class="input-group mb-md">
					<span class="input-group-addon btn-danger"><i class="fa fa-arrow-down" aria-hidden="true"></i><i class="fa fa-usd" aria-hidden="true"></i></span>
					<input type="text" value="{{ $oferta->valor_desconto }}" class="form-control campo-bloqueado" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			@if($oferta->tipo_negociacao <> 'Avista')
			 <label class="col-sm-2 control-label" for="w4-first-name">Valor de Entrada</label>
  			<div class="col-sm-3">
  				<div class="input-group mb-md">
  					<span class="input-group-addon">R$</span>
  					<input type="text" value="{{ $oferta->valor_entrada }}" class="form-control valor campo-bloqueado" readonly>
  				</div>
  			</div>
			@endif
			
      @if($oferta->tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento' || $oferta->tipo_negociacao == 'EntradaComMensaisFinanciamento')
			 <label class="col-md-1 control-label">Mensais</label>
  			<div class="col-sm-3">
  				<div class="input-group mb-md">
  					<span class="input-group-addon">
              <strong>
                {{ $oferta->quantidade_parcela }}X
              </strong>
            </span>
  					<input type="text" value="{{ $oferta->valor_parcela }}" class="form-control valor campo-bloqueado" readonly>
  				</div>
  			</div>
			@endif
		</div>

		<div class="row">
      @if(($oferta->baloes->count() > 0) && ($oferta->tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento' || $oferta->tipo_negociacao == 'EntradaComBaloesFinanciamento' || $oferta->tipo_negociacao == 'EntradaParcelamentoDireto'))
        <div class="parcelas">
          <div class="col-sm-8 box-parcelas-balao cliente">
            <div class="titulo-box-balao"><i class="fa fa-list-ol" aria-hidden="true"></i> Parcelas Balão</div>
            <div id="parcelas_construtora">
              @foreach($oferta->baloes as $balao)
                <div class="row baloes" id="remove{{ $loop->iteration }}">
                  <div class="balao-valor">
                    <div class="input-group mb-md">
                      <input type="text" name="valor_parcela_balao_construtora[]" id="valor_parcela_balao_construtora" value="{{ $balao->valor }}" class="form-control valor" id="money">
                    </div>
                  </div>
                  <div class="balao-data">
                    <div class="input-group mb-md">
                      <input type="text" name="data_parcela_balao_construtora[]" id="data_parcela_balao_construtora" value="{{ $balao->data }}" class="form-control data">
                    </div>
                  </div>
                  <div class="botoes-balao">
                   
                  </div>
                </div>
              @endforeach
            </div>              
          </div>
        </div>
      @endif
        
      <div class="col-sm-4 saldo">
        <div class="titulo-box-saldo">
          <i class="fa fa-usd" aria-hidden="true"></i> 
          Saldo remanescente 
          
        </div>
        <label class="control-label" for="w4-first-name">
          @if($oferta["codigo_tipo_negociacao"] == 'Avista')
            Pagamento à Vista
          @else
            À Negociar
          @endif
        </label>
        <div class="input-group mb-md">
          <span class="input-group-addon btn-warning">R$</span>
          <input type="text" name="saldo_remanescente_construtora" id="saldo_remanescente_construtora" 
          value="
          @if($oferta->tipo_negociacao == '')
            {{ $oferta->preco_oferta }}
          @else
            {{ $oferta->saldo_remanescente }}
          @endif" 
          class="form-control valor saldo_remanescente_construtora" readonly>
        </div>
      </div>    		
		</div>
	</div>

	<script>
		$("#mostrar-proposta-construtora").click(function() {
			$("#conteudo-proposta-construtora").toggle("slow");
			$("#conteudo-proposta-cliente").hide();
			$("#mostrar-proposta-construtora").addClass("active");
			$("#mostrar-proposta-cliente").removeClass("active");
		});
		$( "#mostrar-proposta-cliente" ).click(function() {
			$("#conteudo-proposta-cliente").toggle("slow");
			$("#conteudo-proposta-construtora").hide();
			$("#mostrar-proposta-cliente").addClass("active");
			$("#mostrar-proposta-construtora").removeClass("active");
		});


		$(function () {
			$('.cpf').mask("000.000.000-00");
			$('.phone').mask("(00) 00000-0000");
			$('.data').mask('00/00/0000');
			$('.valor').mask("#.##0,00" , { reverse:true});

			$("#estado_civil").on('change', function () {
			var valor = $(this).val();

			$("#dados_conjuge").hide();

			if (valor == 'Casado' || valor == 'União Estável') {
				$("#dados_conjuge").show();
				return;
			}
			});
		});

		$('#add_parcela').click (function(e) {
			var x = $('.baloes').length;
			x = x + 1;
			
			e.preventDefault();	
			$('#parcelas').append('\
				<div class="row baloes" id="remove' + x + '">\
					<div class="balao-valor">\
						<div class="input-group mb-md">\
							<input type="text" name="valor_parcela_balao[]" id="valor_parcela_balao_' + x +'" class="form-control mascara_valor valor_parcela_balao_' + x +'" id="money" required>\
						</div>\
					</div>\
					<div class="balao-data">\
						<div class="input-group mb-md">\
							<input type="text" name="data_parcela_balao[]" id="data_parcela_balao_' + x +'"  class="form-control mascara_data" required>\
						</div>\
					</div>\
					<div class="botoes-balao">\
						<a class="simple-ajax-modal btn btn-lg btn-danger btn-remove-parcela remove_campo" href="javascript:void(0)" id="' + x +'"><i class="fa fa-minus-square"></i></a>\
					</div>\
				</div>\
			');
		});

		$('#parcelas').on("click",".remove_campo",function(e) {
			e.preventDefault();
			var tr = $(this).attr('id');
			$('#parcelas #remove'+ tr).remove();
		});

		$('#w4').on("click",".campo-bloqueado",function(e) {
			alert ("Não é possível alterar as condições da construtora. Monte sua proposta na próxima tela.")
		});

		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$("#enviar_proposta").on('click', function () {
			ajaxRequest({
			url: '/enviar-proposta',
			metodo: 'POST',
			dados: $("#form_proposta_unidade").serialize(),
			feedback: true,
			mensagemSucesso: 'Proposta enviada com sucesso',
			mensagemErro: 'Erro ao enviar proposta, tente novamente mais tarde'
			});
		});

	</script>
	

</div>
<!-- End Main Content -->


@endsection
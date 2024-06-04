var Oferta = function (
  saldo_remanescente,
  preco_oferta,
  preco_tabela,
  valor_entrada,
  percentual_entrada,
  variacao,
  url,
  tipo_negociacao
  ) {
  this.saldo_remanescente = saldo_remanescente;
  this.preco_oferta = preco_oferta;
  this.preco_tabela = preco_tabela;
  this.valor_entrada = valor_entrada ?? '';
  this.percentual_entrada = percentual_entrada;
  this.variacao = variacao;
  this.percentual_desconto = '';
  this.desconto = '';
  this.tipo_negociacao = tipo_negociacao;
  this.url = url;
  this.valor_unidade = '';
  this.parcela_mensal = '';
  this.valor_parcela_mensal = '';

  this.listeners();
  this.modifiers();
};

Oferta.prototype.ajax_request = function (url, destino) {
  $.ajax({
    method: 'POST',
    url: url,
    success: function (response) {
      $(destino).html(response);
    }
  })
};

Oferta.prototype.calcular_saldo = function () {
    
  var $this = this;
  var saldo_remanescente = this.saldo_remanescente;
  var total_baloes = 0;

  if (this.tipo_negociacao == 'EntradaComFinanciamento') {    
    saldo_remanescente = this.calcular_saldo_entrada(saldo_remanescente);
  }

  if (this.tipo_negociacao == 'EntradaComBaloesFinanciamento') {
    saldo_remanescente = this.calcular_saldo_entrada(saldo_remanescente);
    total_baloes = this.calcular_total_baloes();
    saldo_remanescente = saldo_remanescente - total_baloes;
  }

  if (this.tipo_negociacao == 'EntradaComMensaisFinanciamento') {
    saldo_remanescente = this.calcular_saldo_entrada(saldo_remanescente);
    total_mensal = this.calcular_total_mensal();    
    saldo_remanescente = saldo_remanescente - total_mensal;   
  }

  if (this.tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento') {
    saldo_remanescente = this.calcular_saldo_entrada(saldo_remanescente);
    total_baloes = this.calcular_total_baloes();
    total_mensal = this.calcular_total_mensal();    
    saldo_remanescente = saldo_remanescente - total_baloes - total_mensal;   
  }

  if (this.tipo_negociacao == 'EntradaParcelamentoDireto') {
    saldo_remanescente = this.calcular_saldo_entrada(saldo_remanescente);
    total_baloes = this.calcular_total_baloes();
    total_mensal = this.calcular_total_mensal();    
    saldo_remanescente = saldo_remanescente - total_baloes - total_mensal;   
  }

  $("#saldo_remanescente").val(this.formata_valor_real(saldo_remanescente));
};

Oferta.prototype.calcular_saldo_entrada = function (saldo_remanescente) {
  return saldo_remanescente - this.valor_entrada;
};

Oferta.prototype.calcular_total_mensal = function (saldo_remanescente) {
  total_mensal = 0;

  if (this.valor_parcela_mensal != '' && this.parcela_mensal != '') {
    total_mensal = this.parcela_mensal * this.valor_parcela_mensal;    
  } 

  return total_mensal;
};

Oferta.prototype.calcular_total_baloes = function (saldo_remanescente) {
  total_baloes = 0;
  var $this = this;

  $('.valor_parcela_balao').each(function (index, element) {      
    var valor = $this.remove_mascara_valor(element.value);
    if (valor !== undefined) {
      total_baloes += valor;
    }      
  });

  return total_baloes;
};

Oferta.prototype.get_unidade = function (id) {
  var $this = this;

  $.ajax({
    method: 'POST',
    url: '/admin/ofertas/buscar-unidade/' + id,
    success: function (response) {
      if (response.valor_unidade) {
        $this.preco_tabela = response.valor_unidade;      
        $("#preco_tabela").val($this.formata_valor_real($this.preco_tabela));
      }      
    }
  });
};

Oferta.prototype.validar_campo = function (campo, mensagem) {
  if (campo == '') {
    Swal.fire(
      'Desculpe',
      mensagem,
      'error'
      );
    return false;
  }

  return true;
};

Oferta.prototype.set_desconto_por_percentual = function () {
  if (this.percentual_desconto != '' && this.preco_tabela != '') {
    this.desconto = ((this.preco_tabela * this.percentual_desconto) / 100);
    this.preco_oferta = this.preco_tabela - this.desconto;
    $("#valor_desconto").val(this.formata_valor_real(this.desconto));
    $("#preco_oferta").val(this.formata_valor_real(this.preco_oferta));
  }
}

Oferta.prototype.set_desconto_por_valor = function () {
  if (this.preco_oferta != '' && this.preco_tabela != '') {
    this.percentual_desconto = 100 - (this.preco_oferta / this.preco_tabela) * 100;    
    this.desconto = ((this.preco_tabela * this.percentual_desconto) / 100);
    $("#valor_desconto").val(this.formata_valor_real(this.desconto));
    $("#percentual_desconto").val(this.percentual_desconto.toFixed(2));
  }
}

Oferta.prototype.set_preco_oferta = function () {
  if (this.preco_tabela != '' && this.desconto != '') {
    this.preco_oferta = this.preco_tabela - this.desconto;
    $("#preco_oferta").val(this.formata_valor_real(this.preco_oferta));
  }
}

Oferta.prototype.set_saldo_apos_aba_valor = function () {  
  this.saldo_remanescente = this.preco_oferta;
  $("#saldo_remanescente").val(this.formata_valor_real(this.preco_oferta));
};

Oferta.prototype.set_saldo_aba_negociacao = function () {
  $("#saldo_remanescente").val(this.formata_valor_real(this.saldo_remanescente));
};

Oferta.prototype.alterado_valor_entrada = function () {
  
  this.percentual_entrada = ((this.valor_entrada * 100) / this.saldo_remanescente);

  $('#valor_entrada').val(this.formata_valor_real(this.valor_entrada));     

  $('#percentual_entrada').val(this.percentual_entrada.toFixed(6));

  this.calcular_saldo();
}

Oferta.prototype.round = function (number, precision) {
  var factor = Math.pow(10, precision);
  var tempNumber = number * factor;
  var roundedTempNumber = Math.round(tempNumber);
  return roundedTempNumber / factor;
};

Oferta.prototype.alterado_percentual_entrada = function () {
  this.valor_entrada = this.round(((this.preco_oferta * this.percentual_entrada) / 100), 2);

  if ($('#valor_entrada').val() == '0.00' || $('#valor_entrada').val() == '0' || $('#valor_entrada').val() == '') {
    $('#valor_entrada').val(this.formata_valor_real(this.valor_entrada));    
  }

  this.calcular_saldo();
}

Oferta.prototype.ajustar_tela_tipo_negociacao = function () {
  if (this.tipo_negociacao == 'Avista') {
    $("#grupo_entrada").css("display","none");   
    $("#grupo_parcelas_mensais").css("display","none");  
    $("#parcelas").css("display","none");  

  } else if (this.tipo_negociacao == 'EntradaComMensaisBaloesFinanciamento') {
    $("#grupo_entrada").css("display","block");   
    $("#grupo_parcelas_mensais").css("display","block");  
    $("#parcelas").css("display","block");  

  } else if (this.tipo_negociacao == 'EntradaComMensaisFinanciamento') {
    $("#grupo_entrada").css("display","block");   
    $("#grupo_parcelas_mensais").css("display","block");  
    $("#parcelas").css("display","none");  

  } else if (this.tipo_negociacao == 'EntradaComBaloesFinanciamento') {
    $("#grupo_entrada").css("display","block");   
    $("#grupo_parcelas_mensais").css("display","none");  
    $("#parcelas").css("display","block");  

  } else if (this.tipo_negociacao == 'EntradaComFinanciamento') {
    $("#grupo_entrada").css("display","block");   
    $("#grupo_parcelas_mensais").css("display","none");  
    $("#parcelas").css("display","none");  
  } else if (this.tipo_negociacao == 'EntradaParcelamentoDireto') {
    $("#grupo_entrada").css("display","block");   
    $("#grupo_parcelas_mensais").css("display","block");  
    $("#parcelas").css("display","block");  
  }
}

Oferta.prototype.modifiers = function () {
  Number.prototype.round = function(places) {
    return Math.trunc(this);
  }

  Number.prototype.percentual = function(places) {
    return +(Math.round(this + "e+" + places)  + "e-" + places);
  }
};

Oferta.prototype.listeners = function () {
  var $this = this;

  $(document).on('change', '#torre', function () {
    var torre_id = $(this).val();    
    $this.ajax_request('/admin/buscar-andares/' + torre_id, "#andares");
  });

  $(document).on('change', '#andar', function () {
    var andar_id = $(this).val();
    $this.ajax_request('/admin/buscar-unidades/' + andar_id, "#unidades");
  });

  $(document).on('change', '#unidade', function () {
    var unidade_id = $(this).val();
    $this.get_unidade(unidade_id);
    $this.ajax_request('/admin/buscar-plantas/' + unidade_id, "#plantas");
  });

  $(document).on('change', '#quadra', function () {
    var quadra_id = $(this).val();
    $this.ajax_request('/admin/buscar-unidades-horizontais/' + quadra_id, "#unidades");
  });

  $(document).on('blur', '#preco_tabela', function () {
    var valor = $(this).val();
    $this.preco_tabela = $this.remove_mascara_valor(valor);
  });

  $(document).on('blur', '#parcela_mensal', function () {
    var valor = $(this).val();
    $this.parcela_mensal = $this.remove_mascara_valor(valor);
    $this.calcular_saldo();
  });

  $(document).on('blur', '#valor_parcela_mensal', function () {
    var valor = $(this).val();
    $this.valor_parcela_mensal = $this.remove_mascara_valor(valor);
    $this.calcular_saldo();
  });

  $(document).on('blur', '#percentual_desconto', function () {
    if ($this.validar_campo($this.preco_tabela, 'Informe o preço de tabela primeiro') === false) {
      return false;
    }

    $this.percentual_desconto = $(this).val();
    $this.set_desconto_por_percentual();
  });

  $(document).on('blur', '#preco_oferta', function () {
    if ($this.validar_campo($this.preco_tabela, 'Informe o preço de tabela primeiro') === false) {
      return false;
    }

    $this.preco_oferta = $this.remove_mascara_valor($(this).val());
    $this.set_desconto_por_valor();
  });

  $(document).on('blur', '.valor_entrada', function () {
    if ($this.validar_campo($this.preco_oferta, 'Informe o preço de tabela primeiro') === false) {
      return false;
    }

    $this.valor_entrada = $this.remove_mascara_valor($(this).val());
    $this.alterado_valor_entrada();      
  });

  $(document).on('keyup', '.percentual_entrada', function () {
    if ($(this).val() == '') {
      $('#valor_entrada').val('');  
    }
  });

  $(document).on('blur', '.percentual_entrada', function () {
    if ($this.validar_campo($this.preco_oferta, 'Informe o preço de tabela primeiro') === false) {
      return false;
    }
    
    $this.percentual_entrada = parseFloat($(this).val());
    $this.alterado_percentual_entrada();    
  });

  $(document).on('change', '#tipo_negociacao', function () {    
    $this.tipo_negociacao = $(this).val();    
    $this.ajustar_tela_tipo_negociacao();
  });

  $(document).on('blur', '.valor_parcela_balao', function () {    
    var valor = $this.remove_mascara_valor($(this).val());
    if (valor > 0) {      
      $this.calcular_saldo();
    }
  });

  $(document).on('click', '.btn-add-parcela', function () {
    $this.adicionar_parcela();
  });

  $(document).on('click', '.btn-remover-parcela', function (e) {
    e.preventDefault();    
    $(this).parent().parent('div').remove();    
    $this.calcular_saldo();
  });

  $(document).on('mascaras', {}, function () {
    $('.moeda').maskMoney({thousands: '.', decimal: ','});
    $('.data').mask('00/00/0000');
  });

  $('.anunciar-oferta').on('click', function (event) {
    $this.publicar_oferta(event);
  });

};

Oferta.prototype.publicar_oferta = function (event) {

  event.preventDefault();

  var validacao = this.validacoes_aba_confirmacao();

  if (validacao != '') {
    Swal.fire(
      'Desculpe',
      validacao,
      'error'
      );
    return false;
  }
  
  var dados = $("#formOferta").serialize();

  $.ajax({
    method: 'post',
    url: this.url,
    data: dados,
    success: function (response) {
      if (response.sucesso == 'true') {
        $('#oferta').modal('toggle');

        Swal.fire(
          'Sucesso!',
          response.mensagem,
          'success'
          );

        setTimeout(function () {
          window.location.reload();
        }, 3000);
      } else {
        Swal.fire(
          'Desculpe',
          response.mensagem,
          'error'
          );
      }
    }
  });
};

Oferta.prototype.adicionar_parcela = function () {
  var html = $("#bloco-parcela").clone();
  html.find('.input-valor').val('');
  html.show();
  $('#novas-parcelas').append(html);
  var index = ($('#novas-parcelas').find('.row').length) + 1;
  html.find('.row').find('.nome-parcela').html('Parcela Balão ' + index);
  html.find('.valor_parcela_balao').val('');
  html.find('.data_parcela_balao').val('');    
  $(document).trigger("mascaras");
};

Oferta.prototype.remove_mascara_valor = function (valor) {
  if (valor) {
    valor = valor.replace("R$ ", "");
    valor = valor.replace(/\./gi, "");
    valor = valor.replace(",", ".");
    return parseFloat(valor);
  }
};

Oferta.prototype.formata_valor_real = function (valor) {
  var result = 0;
  var valor_converter = 0;

  if(valor === undefined){
    valor_converter = '0.00';
  }else{
    valor_converter = valor;
  }
  $.ajax({
    method: 'GET',
    url: '/formatar-valor-reais/' + valor,
    async: false,
    success: function(response) {
      result = response.retorno;
    },
  });

  return result;
};

Oferta.prototype.validacoes_aba_unidade = function () {
  if (this.validar_campo($("#torre").val(), 'Informe a torre') == false) {
    return false;
  }

  if ($("#andar").val() === '') {
    Swal.fire(
      'Desculpe',
      'Informe o andar',
      'error'
      );

    return false;
  }

  if ($("#unidade").val() === '') {
    Swal.fire(
      'Desculpe',
      'Informe a unidade',
      'error'
      );

    return false;
  }

  // if ($("#planta").val() === '') {
  //   if (this.variacao != 6 && this.variacao != 10) {
  //     Swal.fire(
  //       'Desculpe',
  //       'Informe a planta',
  //       'error'
  //       );

  //     return false;  
  //   }        
  // }

  return true;
};

Oferta.prototype.validacoes_aba_valor = function () {
  if ($("#preco_tabela").val() === '') {
    Swal.fire(
      'Desculpe',
      'Informe o preço de tabela',
      'error'
      );

    return false;
  }

  if ($("#percentual_desconto").val() === '') {
    Swal.fire(
      'Desculpe',
      'Informe o percentual de desconto',
      'error'
      );

    return false;
  }

  if ($("#preco_oferta").val() === '') {
    Swal.fire(
      'Desculpe',
      'Informe o preço de oferta',
      'error'
      );

    return false;
  }

  this.set_saldo_apos_aba_valor();

  return true;
};

Oferta.prototype.validacoes_aba_negociacao = function () {
  if (this.tipo_negociacao === '') {
    Swal.fire(
      'Desculpe',
      'Informe o tipo de negociação',
      'error'
      );

    return false;
  }

  switch (this.tipo_negociacao) {
    case 'EntradaComFinanciamento':
    if ($('#valor_entrada').val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe o valor ou percentual de entrada',
        'error'
        );

      return false;
    }

    if ($('#percentual_entrada').val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe o valor ou percentual de entrada',
        'error'
        );

      return false;
    }
    break;

    case 'EntradaParcelamentoDireto':
      if ($('#valor_entrada').val() == '') {
        Swal.fire(
          'Desculpe',
          'Informe o valor ou percentual de entrada',
          'error'
          );
  
        return false;
      }
  
      if ($('#percentual_entrada').val() == '') {
        Swal.fire(
          'Desculpe',
          'Informe o valor ou percentual de entrada',
          'error'
          );
  
        return false;
      }
  
      if ($("#parcela_mensal").val() == '') {
        Swal.fire(
          'Desculpe',
          'Informe a quantidade de parcelas mensais',
          'error'
          );
  
        return false;
      }
  
      if ($("#valor_parcela_mensal").val() == '') {
        Swal.fire(
          'Desculpe',
          'Informe o valor das parcelas mensais',
          'error'
          );
  
        return false;
      }
      break;
  
      case 'EntradaComMensaisBaloesFinanciamento':
      if ($('#valor_entrada').val() == '') {
        Swal.fire(
          'Desculpe',
          'Informe o valor ou percentual de entrada',
          'error'
          );
  
        return false;
      }
  
      if ($('#percentual_entrada').val() == '') {
        Swal.fire(
          'Desculpe',
          'Informe o valor ou percentual de entrada',
          'error'
          );
  
        return false;
      }
  
      if ($("#parcela_mensal").val() == '') {
        Swal.fire(
          'Desculpe',
          'Informe a quantidade de parcelas mensais',
          'error'
          );
  
        return false;
      }
  
      if ($("#valor_parcela_mensal").val() == '') {
        Swal.fire(
          'Desculpe',
          'Informe o valor das parcelas mensais',
          'error'
          );
  
        return false;
      }
    break;

    case 'EntradaComBaloesFinanciamento':
    if ($('#valor_entrada').val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe o valor ou percentual de entrada',
        'error'
        );

      return false;
    }

    if ($('#percentual_entrada').val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe o valor ou percentual de entrada',
        'error'
        );

      return false;
    }
    break;

    case 'EntradaComMensaisFinanciamento':

    if ($('#valor_entrada').val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe o valor ou percentual de entrada',
        'error'
        );

      return false;
    }

    if ($('#percentual_entrada').val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe o valor ou percentual de entrada',
        'error'
        );

      return false;
    }

    if ($("#parcela_mensal").val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe a quantidade de parcelas mensais',
        'error'
        );

      return false;
    }

    if ($("#valor_parcela_mensal").val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe o valor das parcelas mensais',
        'error'
        );

      return false;
    }
    break;

    case 'EntradaComMensaisBaloesFinanciamento':
    if ($('#valor_entrada').val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe o valor ou percentual de entrada',
        'error'
        );

      return false;
    }

    if ($('#percentual_entrada').val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe o valor ou percentual de entrada',
        'error'
        );

      return false;
    }

    if ($("#parcela_mensal").val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe a quantidade de parcelas mensais',
        'error'
        );

      return false;
    }

    if ($("#valor_parcela_mensal").val() == '') {
      Swal.fire(
        'Desculpe',
        'Informe o valor das parcelas mensais',
        'error'
        );

      return false;
    }
    break;

    case 'Avista':
    return true;
    break;
  }

  return true;
};

Oferta.prototype.validacoes_aba_confirmacao = function () {
  if ($("#validade_oferta").val() === '') {
    return 'Informe a data de validade da oferta';
  }

  if (document.getElementById("termos").checked === false) {
    return 'Aceite os termos da oferta';
  }

  return '';
};

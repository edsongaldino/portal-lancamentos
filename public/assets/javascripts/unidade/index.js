$(function () {
  localStorage.setItem('torre_id', 'Todas');
  localStorage.setItem('andar_id', 'Todas');
  localStorage.setItem('planta_id', 'Todas');
  localStorage.setItem('situacao', 'Todas');
  localStorage.setItem('quadra_id', 'Todas');

  function ajaxFiltro(url) {
    $.ajax({
      method: 'post',
      url: url,
      data: {
        empreendimento_id: $("#empreendimento_id").val(),
        torre_id: localStorage.getItem('torre_id'),
        andar_id: localStorage.getItem('andar_id'),
        planta_id: localStorage.getItem('planta_id'),
        quadra_id: localStorage.getItem('quadra_id'),
        situacao: localStorage.getItem('situacao')
      },
      success: function (response) {
        new PNotify({
          text: 'Unidades filtradas com sucesso',
          type: 'success',                    
        });

        $('#unidades').html(response);
        $('.btn-cores').removeAttr('style');
      }
    });
  }


  $("#torre").on('change', function () {
    var torre_id = $(this).val();
    localStorage.setItem('torre_id', torre_id);
    ajaxFiltro("/admin/empreendimento/filtrar-unidades");
  });

  $("#andar").on('change', function () {
    var andar_id = $(this).val();
    localStorage.setItem('andar_id', andar_id);
    ajaxFiltro("/admin/empreendimento/filtrar-unidades");
  });

  $("#planta").on('change', function () {
    var planta_id = $(this).val();
    localStorage.setItem('planta_id', planta_id);
    ajaxFiltro("/admin/empreendimento/filtrar-unidades");
  });

  $("#situacao").on('change', function () {
    var situacao = $(this).val();
    localStorage.setItem('situacao', situacao);
    ajaxFiltro("/admin/empreendimento/filtrar-unidades");
  });

  $("#quadra").on('change', function () {
    var quadra_id = $(this).val();
    localStorage.setItem('quadra_id', quadra_id);
    ajaxFiltro("/admin/empreendimento/filtrar-unidades");
  });
  
  $("#situacao2").on('change', function () {
    var situacao = $(this).val();
    localStorage.setItem('situacao', situacao);
    ajaxFiltro("/admin/empreendimento/filtrar-unidades-horizontais");
  });

  $("#gerar-torres-unidades").on('click', function () {
    ajaxRequest({
      url: "/admin/gerar-torres-unidades",
      metodo: 'POST',
      dados: $("#dados-gerar-torres-unidades").serialize(),
      feedback: true,
      mensagemSucesso: 'Unidades geradas com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: true
    });
  });

  $("#gerar-quadras-unidades").on('click', function () {
    ajaxRequest({
      url: "/admin/gerar-quadras-unidades",
      metodo: 'POST',
      dados: $("#dados-gerar-quadras-unidades").serialize(),
      feedback: true,
      mensagemSucesso: 'Unidades geradas com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: true
    });
  });

  $(document).on('show.bs.modal', '#alterarVendaUnidade', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id');
    var situacao = button.data('situacao');
    var url = button.data('url');
    var titulo = button.data('titulo') != undefined 
      ? button.data('titulo')
      : 'Alterar Venda';
    var visualizar = button.data('visualizar');

    var modal = $(this);    

    $.ajax({
      method: 'get',
      url: url,
      data: {
        id: id,
        situacao: situacao
      },
      success: function (response) {            
        modal.find('.modal-body').html(response);
        if (situacao == '') {
          modal.find('#btn-submit').val('Alterar');  
          modal.find('.modal-title').html(titulo);
        } else {
          modal.find('.modal-title').html(titulo);
          modal.find('#btn-submit').val('Alterar');  
        }
        modal.find('#situacao').val(situacao);
        
        if (visualizar != undefined && visualizar == 'sim') {
          $("#formAlterarVendaUnidade :input").prop("disabled", true);
        }
      }
    });
  });

  
  $(document).on('show.bs.modal', '#alterarInfoUnidade', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id');
    var url = button.data('url');
    var modal = $(this);
    
    $.ajax({
      method: 'get',
      url: url,
      data: {
        id: id
      },
      success: function (response) {            
        modal.find('.modal-body').html(response);
        modal.find('#btn-submit').val('Alterar');  
        modal.find('.modal-title').html('<i class="fa fa-pencil-square" aria-hidden="true"></i> Alterar Informações da Unidade');
      }
    });
  });

  $(document).on('show.bs.modal', '#InfoUnidade', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id');
    var url = button.data('url');
    var modal = $(this);
    
    $.ajax({
      method: 'get',
      url: url,
      data: {
        id: id
      },
      success: function (response) {            
        modal.find('.modal-body').html(response);
        modal.find('#btn-submit').val('Alterar');  
        modal.find('.modal-title').html('<i class="fa fa-eye" aria-hidden="true"></i> Informações da Unidade');
      }
    });
  });

  $(document).on('click', '.alterar-situacao-unidade', function () {
    var id = $(this).data('id');
    var situacao = $(this).data('situacao');
    var url = $(this).data('url');    

    ajaxRequest({
      url: url,
      metodo: 'POST',
      dados: {
        id: id,
        situacao: situacao
      },
      feedback: true,
      mensagemSucesso: 'Situação da unidade alterada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde',
      reload: true
    });    
  });

  $(document).on('change', 'select[name=alteracao_torre_id]', function () {
    var torre_id = $(this).val();
    var empreendimento_id = $(this).data('empreendimento');

    ajaxRequest({
      url: '/buscar-andares-2/' + torre_id,
      dados: {
        empreendimento_id: empreendimento_id
      },
      metodo: 'POST',        
      feedback: true,
      resultado: '#'      
    });
  });

  $(document).on('show.bs.modal', '#alterarReservaUnidade', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id');
    var situacao = button.data('situacao');
    var url = button.data('url');
    var titulo = button.data('titulo') != undefined 
      ? button.data('titulo')
      : 'Alterar Reserva';
    var visualizar = button.data('visualizar');

    var modal = $(this);    

    $.ajax({
      method: 'get',
      url: url,
      data: {
        id: id,
        situacao: situacao
      },
      success: function (response) {            
        modal.find('.modal-body').html(response);
        if (situacao == '') {
          modal.find('#btn-submit').val('Alterar');  
          modal.find('.modal-title').html(titulo);
        } else {
          modal.find('.modal-title').html(titulo);
          modal.find('#btn-submit').val('Alterar');  
        }
        modal.find('#situacao').val(situacao);
        
        if (visualizar != undefined && visualizar == 'sim') {
          $("#formAlterarReservaUnidade :input").prop("disabled", true);
        }
      }
    });
  });

  function getValorAlteracao() {
    var valor_alteracao_real = $('input[name=valor_alteracao_real]').val();
    var valor_alteracao_m2 = $('input[name=valor_alteracao_m2]').val();
    var valor_alteracao_metragem = $('input[name=valor_alteracao_metragem]').val();
    var valor_alteracao_percentual_down = $('input[name=valor_alteracao_percentual_down]').val();
    var valor_alteracao_percentual_up = $('input[name=valor_alteracao_percentual_up]').val();
    var valor_situacao = $('select[name=situacao_alteracao]').val();
    var valor_planta = $('select[name=planta_alteracao]').val();
    var valor_sol = $('select[name=tipo_sol_alteracao]').val();
    var valor_posicao = $('select[name=posicao_unidade_alteracao]').val();

    var lote_fundo = $('input[name=lote_fundo]').val();
    var lote_frente = $('input[name=lote_frente]').val();
    var lote_lateral_dir = $('input[name=lote_lateral_dir]').val();
    var lote_lateral_esq = $('input[name=lote_lateral_esq]').val();

    var valor_alteracao = 0;
    var item_alteracao = $('select[name=item_alteracao]').val();
    
    if ((item_alteracao == 'valor_fixo' || item_alteracao == 'acrescimo_real' || item_alteracao == 'decrescimo_real') && valor_alteracao_real != '') {
      valor_alteracao = valor_alteracao_real;
    }

    if (item_alteracao == 'valor_m2' && valor_alteracao_m2 != '') {
      valor_alteracao = valor_alteracao_m2;
    }

    if (item_alteracao == 'acrescimo_percentual' && valor_alteracao_percentual_up != '') {
      valor_alteracao = valor_alteracao_percentual_up;
    }

    if (item_alteracao == 'decrescimo_percentual' && valor_alteracao_percentual_down != '') {
      valor_alteracao = valor_alteracao_percentual_down;
    }
    
    if (item_alteracao ==  'metragem_valor_fixo' && valor_alteracao_metragem != '') {
      valor_alteracao = valor_alteracao_metragem;
    }

    if (item_alteracao ==  'dimensoes_lote' && lote_fundo != '' && lote_frente != '' && lote_lateral_dir != '' && lote_lateral_esq != '') {
      valor_alteracao = lote_fundo+'|'+lote_frente+'|'+lote_lateral_dir+'|'+lote_lateral_esq;
    }

    if (item_alteracao == 'definir_situacao' && valor_situacao != '') {
      valor_alteracao = valor_situacao;
    }

    if (item_alteracao == 'incidencia_sol' && valor_sol != '') {
      valor_alteracao = valor_sol;
    }

    if (item_alteracao == 'posicao_unidade' && valor_posicao != '') {
      valor_alteracao = valor_posicao;
    }

    if (item_alteracao == 'definir_planta' && valor_planta != '') {
      valor_alteracao = valor_planta;
    }

    return valor_alteracao;
  }

  function limparCampos() {

    var alvo_alteracao = $('select[name=alvo_alteracao]').val();
    var item_alteracao = $('select[name=item_alteracao]').val();

    if (item_alteracao == null) {
      Swal.fire({
        title: "Erro",
        text: 'Selecione o tipo de alteração',
        type: 'error'
      });
      return false;
    }

    var valor_alteracao = getValorAlteracao();

    if (valor_alteracao == 0) {
      Swal.fire({
        title: "Erro",
        text: 'Defina o valor da alteração a ser aplicada',
        type: 'error'
      });
      return false;
    }

    if (alvo_alteracao == null) {
      Swal.fire({
        title: "Erro",
        text: 'Selecione onde serão aplicadas as alterações',
        type: 'error'
      });
      return false;
    } 

    var planta_alteracao = $('select[name=planta_alteracao]').val();
    var situacao_alteracao = $('select[name=situacao_alteracao]').val();
    var tipo_sol_alteracao = $('select[name=tipo_sol_alteracao]').val();
    var dimensoes_lote_alteracao = $('input[name=lote_frente]').val()+'|'+$('input[name=lote_fundo]').val()+'|'+$('input[name=lote_lateral_dir]').val()+'|'+$('input[name=lote_lateral_esq]').val();
    var posicao_unidade_alteracao = $('select[name=posicao_unidade_alteracao]').val();
    var plantas = [];
    var planta_origem = $('select[name=planta_origem]').val();    
    if (planta_origem != null) {
      plantas.push(planta_origem);  
    } 

    var torres = [];
    var quadras = [];
    var andares = [];
    var unidades = []; 
    var torre_id = null;
    var unidades_multiplas = [];        

    if (alvo_alteracao == 'todas_unidades' || alvo_alteracao == 'todas_unidades_disponiveis' || alvo_alteracao == 'plantas_disponiveis') {
      torres = [];
      quadras = [];
      andares = [];
      unidades = [];                
    }

    if (alvo_alteracao == 'unidades_especificas') {
      torres = [];
      andares = [];          
      unidades = [];
      
      torre_id = $('select[name=torre_unidades]').val();
      torres.push(torre_id);      
            
      unidades_multiplas = $('.unidades_multiplas').val();      
      if (unidades_multiplas != undefined) {
        unidades = unidades_multiplas;
      }

      quadras = [];
      quadra_id = $('select[name=quadra_unidades]').val();
      quadras.push(quadra_id);
      
    }

    if (alvo_alteracao == 'torres_andares_disponiveis') {
      torres = $('.torres_multiplas').val();      
      andares = $('.andares_multiplos').val();      
      unidades = [];      
      quadras = [];      
    }

    if (alvo_alteracao == 'unidades_quadra') {
      torres = [];      
      andares = [];      
      unidades = [];      
      quadras = $('.quadras_multiplas').val();            
    }

    return {
      torres: torres,
      quadras: quadras,
      andares: andares,
      unidades: unidades,
      plantas: plantas,
      planta_origem: planta_origem,
      planta_alteracao: planta_alteracao,
      situacao_alteracao: situacao_alteracao,
      tipo_sol_alteracao: tipo_sol_alteracao,
      posicao_unidade_alteracao: posicao_unidade_alteracao,
      dimensoes_lote_alteracao: dimensoes_lote_alteracao,
    };
  }

  function validacoes(campos) {
    if ((campos.alvo_alteracao == 'quadras_plantas_disponiveis' 
      || campos.alvo_alteracao == 'quadras_plantas_bloqueadas') 
      && (campos.quadras.length == 0 
      || campos.plantas.length == 0)) {
      Swal.fire({
        title: "Erro",
        text: 'Selecione as quadras ou plantas onde serão aplicadas as alterações',
        type: 'error'
      });
      return false;
    } 

    if ((campos.alvo_alteracao == 'torres_andares_disponiveis' || campos.alvo_alteracao == 'torres_andares_bloqueadas') 
      && (campos.torres.length == 0 || campos.andares.length == 0)) {
      Swal.fire({
        title: "Erro",
        text: 'Selecione as torres, andares onde serão aplicadas as alterações',
        type: 'error'
      });
      return false;
    }

    if (campos.alvo_alteracao == "unidades_especificas" 
      && campos.unidades.length == 0) {
      Swal.fire({
        title: "Erro",
        text: 'Selecione a torre e as unidades onde serão aplicadas as alterações',
        type: 'error'
      });
      return false;
    }

    if (campos.alvo_alteracao == "plantas_disponiveis" && campos.planta_origem == null) {
      Swal.fire({
        title: "Erro",
        text: 'Selecione a planta onde serão aplicadas as alterações',
        type: 'error'
      });
      return false;
    }


    return true;
  }

  function getValorAlteracaoMensagem(item_alteracao, valor_alteracao)
  {
    valor_alteracao_mensagem = '';

    if (item_alteracao == 'definir_situacao') {
      valor_alteracao_mensagem = 'Situação das unidades: ' + $('select[name=situacao_alteracao] option:selected').text();
    }

    if (item_alteracao == 'incidencia_sol') {
      valor_alteracao_mensagem = 'Incidência Solar: ' + $('select[name=tipo_sol_alteracao] option:selected').text();
    }

    if (item_alteracao == 'posicao_unidade') {
      valor_alteracao_mensagem = 'Posição na Torre: ' + $('select[name=posicao_unidade_alteracao] option:selected').text();
    }

    if (item_alteracao == 'definir_planta') {
      valor_alteracao_mensagem = 'Planta das unidades: ' + $('select[name=planta_alteracao] option:selected').text();
    }

    if (item_alteracao == 'metragem_valor_fixo') {
      valor_alteracao_mensagem = 'Metragem: ' + valor_alteracao + 'm<sup>2</sup>';
    }

    if (item_alteracao == 'valor_fixo' || item_alteracao == 'acrescimo_real' || item_alteracao == 'decrescimo_real') {
      valor_alteracao_mensagem = 'Valor: R$ ' + valor_alteracao;
    }

    if (item_alteracao == 'acrescimo_percentual' || item_alteracao == 'decrescimo_percentual') {
      valor_alteracao_mensagem = 'Percentual do Valor: ' + valor_alteracao + '%';
    }

    if (item_alteracao == 'valor_m2') {
      valor_alteracao_mensagem = 'Valor do M²: ' + valor_alteracao;
    }

    if (item_alteracao == 'dimensoes_lote') {
      valor_alteracao_mensagem = 'Dimensões: ' + valor_alteracao;
    }

    return valor_alteracao_mensagem;
  }

  function getHtmlMensagem(campos)
  {
    var quadras_mensagem = 'Nenhuma quadra específica foi escolhida';

    if (campos.quadras.length > 0) {
      var quadras_mensagem = campos.quadras.join(',');
    }

    var torres_mensagem = 'Nenhuma torre específica foi escolhida';

    if (campos.torres.length > 0) {
      var torres_mensagem = campos.torres.join(',');
    }

    var unidades_mensagem = 'Nenhuma unidade específica foi escolhida';

    if (campos.unidades.length > 0) {
      var unidades_mensagem = campos.unidades.join(',');
    }

    var andares_mensagem = 'Nenhum andar específico foi escolhido';

    if (campos.andares.length > 0) {
      var andares_mensagem = campos.andares.join(',');
    }

    var html = '';

    if (campos.tipo_empreendimento == 'Vertical') {
      html = 'Tipo de Alteração: <strong>' + $("select[name=item_alteracao] option:selected").text() + '</strong><br/>' +
          'Alteração: <strong>' + campos.valor_alteracao_mensagem + '</strong>' + '<br/>' +
          'Alvo das alterações: <strong>' + $('select[name=alvo_alteracao] option:selected').text() + '</strong><br/>' +
          'Torres: <strong>' + torres_mensagem + '</strong><br/>' +
          'Andares: <strong>' + andares_mensagem + '</strong><br/>' +
          'Unidades: <strong>' + unidades_mensagem + '</strong><br/>';
    }

    if (campos.tipo_empreendimento == 'Horizontal') {
      html = 'Tipo de Alteração: <strong>' + $("select[name=item_alteracao] option:selected").text() + '</strong><br/>' +
          'Alteração: <strong>' + campos.valor_alteracao_mensagem + '</strong>' + '<br/>' +
          'Alvo das alterações: <strong>' + $('select[name=alvo_alteracao] option:selected').text() + '</strong><br/>' +
          'Quadras: <strong>' + quadras_mensagem + '</strong><br/>' +          
          'Unidades: <strong>' + unidades_mensagem + '</strong><br/>';
    }

    return html;
  }

  $(document).on('click', '.alterar-lote', function () {    

    var empreendimento_id = $(this).data('empreendimento');
    var tipo_empreendimento = $(this).data('tipo');
    var item_alteracao = $('select[name=item_alteracao]').val();
    var alvo_alteracao = $('select[name=alvo_alteracao]').val();
    var torre_id = $('select[name=torre_unidades]').val();
    var valor_alteracao = getValorAlteracao();
    var campos = limparCampos();
    var valor_alteracao_mensagem = getValorAlteracaoMensagem(item_alteracao, valor_alteracao);
    var tipo_alteracao = $('input[name=tipo_alteracao]').val();
    
    if (!campos) {
      return false;
    }

    var camposValidacao = {
      item_alteracao: item_alteracao,
      alvo_alteracao: alvo_alteracao,
      quadras: campos.quadras,
      plantas: campos.plantas,
      torres: campos.torres,
      andares: campos.andares,
      unidades: campos.unidades,
      torre_id: torre_id,
      planta_origem: campos.planta_origem
    };

    if (!validacoes(camposValidacao)) {
      return false;
    }
    
    var html = getHtmlMensagem({
      valor_alteracao_mensagem: valor_alteracao_mensagem,
      quadras: campos.quadras,
      torres: campos.torres,
      unidades: campos.unidades,
      andares: campos.andares,
      tipo_empreendimento: tipo_empreendimento
    });

    Swal.fire({
      title: 'Atenção',
      html: html,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, eu confirmo essas alterações',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {

        var dados = {
            item_alteracao: item_alteracao,
            alvo_alteracao: alvo_alteracao,
            torres: campos.torres,
            quadras: campos.quadras,
            andares: campos.andares,
            unidades_especificas: campos.unidades,
            plantas: campos.plantas,
            planta_alteracao: campos.planta_alteracao,
            situacao_alteracao: campos.situacao_alteracao,
            tipo_sol_alteracao: campos.tipo_sol_alteracao,
            posicao_unidade_alteracao: campos.posicao_unidade_alteracao,
            dimensoes_lote_alteracao: campos.dimensoes_lote_alteracao,
            empreendimento_id: empreendimento_id,
            tipo_alteracao: tipo_alteracao,
            valor_alteracao: valor_alteracao,
            valor_alteracao: valor_alteracao
        };

        ajaxRequest({
          url: '/admin/empreendimento/alteracoes-em-lote',
          metodo: 'POST',
          dados: dados,
          feedback: true,
          mensagemSucesso: 'Alterações realizadas com sucesso',
          mensagemErro: 'Erro, tente novamente mais tarde',
          reload: true
        });    

        Swal.fire(
          'Sucesso',
          'As alterações foram aplicadas',
          'success'
        )
      }
    })
  });

  $('.torres_multiplas').select2();
  $('.quadras_multiplas').select2();
  $('.andares_multiplos').select2();
  $('.unidades_multiplas').select2();

  $("#alteracoes-lote").hide();

  $("#btn-alterar-valor").click(function(){
    $("#alteracoes-lote").toggle("slow");
  });

  $(document).on('change', '#torre_unidades', function () {
    var torre_id = $(this).val();

    ajaxRequest({
      metodo: 'POST',
      url: '/admin/buscar-unidades-torre',
      dados: {
        torre_id: torre_id
      },
      resultado: '#box-unidades' 
    });

    $("#box-unidades").css("display","block"); 
  });

  $(document).on('change', '#quadra_unidades', function () {
    var quadra_id = $(this).val();

    console.log('quadra', quadra_id);

    ajaxRequest({
      metodo: 'POST',
      url: '/admin/buscar-unidades-quadra',
      dados: {
        quadra_id: quadra_id
      },
      resultado: '#box-unidades' 
    });

    $("#box-unidades").css("display","block"); 
  });
});

function carregaCampos() { 
  var tipo_alteracao = $('#item_alteracao').val();

  if (tipo_alteracao == 'valor_m2') {
    $('#alvo_alteracao option[value="todas_unidades"]').removeAttr('hidden', 'true'); 
    $('#alvo_alteracao option[value="todas_unidades_disponiveis"]').removeAttr('hidden', 'true'); 
    $('#alvo_alteracao option[value="unidades_especificas"]').removeAttr('hidden', 'true'); 
    $("#linha-alteracao").css("display","none");
    $("#aplicar-alteracao2").css("display","block");
    $("#aplicar-alteracao").css("display","none");
    $("#dimensoes_lote").css("display","none");
    $("#valor_m2").css("display","block");
    $("#valor_real").css("display","none");
    $("#percentual-down").css("display","none");
    $("#percentual-up").css("display","none");
    $("#metragem_terreno").css("display","none");  

  } else {    
    $('#alvo_alteracao option[value="todas_unidades"]').removeAttr('hidden', 'true'); 
    $('#alvo_alteracao option[value="todas_unidades_disponiveis"]').removeAttr('hidden', 'true'); 
    $('#alvo_alteracao option[value="plantas_disponiveis"]').removeAttr('hidden', 'true'); 
    $('#alvo_alteracao option[value="unidades_especificas"]').removeAttr('hidden', 'true'); 
    $('#alvo_alteracao').removeAttr('disabled');  
    $("#linha-alteracao").css("display","block");  
    $("#aplicar-alteracao2").css("display","none");
    $("#dimensoes_lote").css("display","none");
    $("#aplicar-alteracao").css("display","block");

    if(tipo_alteracao == 'valor_fixo' || tipo_alteracao == 'acrescimo_real' || tipo_alteracao == 'decrescimo_real'){   
      $("#valor_m2").css("display","none");
      $("#valor_real").css("display","block");
      $("#percentual-down").css("display","none");  
      $("#percentual-up").css("display","none");
      $("#metragem_terreno").css("display","none"); 
      $("#box_planta_unidade").css("display","none");
      $("#box_situacao_unidade").css("display","none"); 
      $("#incidencia_sol").css("display","none");
      $("#dimensoes_lote").css("display","none");
      $("#posicao_unidade").css("display","none");   

    } else if (tipo_alteracao == 'acrescimo_percentual') {  
      $("#valor_m2").css("display","none");
      $("#valor_real").css("display","none");
      $("#percentual-down").css("display","none");
      $("#percentual-up").css("display","block");
      $("#metragem_terreno").css("display","none"); 
      $("#box_planta_unidade").css("display","none"); 
      $("#box_situacao_unidade").css("display","none");
      $("#incidencia_sol").css("display","none");
      $("#dimensoes_lote").css("display","none");
      $("#posicao_unidade").css("display","none");
    } else if(tipo_alteracao == 'decrescimo_percentual') {  
      $("#valor_m2").css("display","none");
      $("#valor_real").css("display","none");
      $("#percentual-down").css("display","block");
      $("#percentual-up").css("display","none");
      $("#metragem_terreno").css("display","none"); 
      $("#box_planta_unidade").css("display","none"); 
      $("#box_situacao_unidade").css("display","none");
      $("#incidencia_sol").css("display","none");
      $("#dimensoes_lote").css("display","none");
      $("#posicao_unidade").css("display","none");
    } else if(tipo_alteracao == 'valor_m2') {  
      $("#valor_m2").css("display","block");
      $("#valor_real").css("display","none");
      $("#percentual-down").css("display","none");  
      $("#percentual-up").css("display","none");
      $("#metragem_terreno").css("display","none");
      $("#box_planta_unidade").css("display","none");  
      $("#box_situacao_unidade").css("display","none");
      $("#incidencia_sol").css("display","none");
      $("#dimensoes_lote").css("display","none");
      $("#posicao_unidade").css("display","none");
    } else if(tipo_alteracao == 'metragem_valor_fixo') {  
      $("#valor_m2").css("display","none");
      $("#valor_real").css("display","none");
      $("#percentual-down").css("display","none");  
      $("#percentual-up").css("display","none"); 
      $("#metragem_terreno").css("display","block"); 
      $("#box_planta_unidade").css("display","none");
      $("#box_situacao_unidade").css("display","none");
      $("#incidencia_sol").css("display","none");
      $("#dimensoes_lote").css("display","none");
      $("#posicao_unidade").css("display","none");
    } else if(tipo_alteracao == 'definir_planta') {  
      $('#alvo_alteracao option[value="plantas_disponiveis"]').attr('hidden', 'true'); 
      $("#valor_m2").css("display","none");
      $("#valor_real").css("display","none");
      $("#percentual-down").css("display","none");  
      $("#percentual-up").css("display","none"); 
      $("#metragem_terreno").css("display","none"); 
      $("#box_planta_unidade").css("display","block");
      $("#box_situacao_unidade").css("display","none"); 
      $("#incidencia_sol").css("display","none");
      $("#dimensoes_lote").css("display","none");
      $("#posicao_unidade").css("display","none");
    } else if(tipo_alteracao == 'definir_situacao') {  
      $("#valor_m2").css("display","none");
      $("#valor_real").css("display","none");
      $("#percentual-down").css("display","none");  
      $("#percentual-up").css("display","none"); 
      $("#metragem_terreno").css("display","none"); 
      $("#box_planta_unidade").css("display","none");
      $("#incidencia_sol").css("display","none");
      $("#posicao_unidade").css("display","none");
      $("#dimensoes_lote").css("display","none");
      $("#box_situacao_unidade").css("display","block");
    }else if(tipo_alteracao == 'incidencia_sol') {  
      $("#valor_m2").css("display","none");
      $("#valor_real").css("display","none");
      $("#percentual-down").css("display","none");  
      $("#percentual-up").css("display","none"); 
      $("#metragem_terreno").css("display","none"); 
      $("#box_planta_unidade").css("display","none");
      $("#box_situacao_unidade").css("display","none");
      $("#posicao_unidade").css("display","none");
      $("#dimensoes_lote").css("display","none");
      $("#incidencia_sol").css("display","block");
    }else if(tipo_alteracao == 'posicao_unidade') {  
      $("#valor_m2").css("display","none");
      $("#valor_real").css("display","none");
      $("#percentual-down").css("display","none");  
      $("#percentual-up").css("display","none"); 
      $("#metragem_terreno").css("display","none"); 
      $("#box_planta_unidade").css("display","none");
      $("#box_situacao_unidade").css("display","none");
      $("#incidencia_sol").css("display","none");
      $("#dimensoes_lote").css("display","none");
      $("#posicao_unidade").css("display","block");
    }else if(tipo_alteracao == 'dimensoes_lote') {  
      $("#valor_m2").css("display","none");
      $("#valor_real").css("display","none");
      $("#percentual-down").css("display","none");  
      $("#percentual-up").css("display","none"); 
      $("#metragem_terreno").css("display","none"); 
      $("#box_planta_unidade").css("display","none");
      $("#box_situacao_unidade").css("display","none");
      $("#incidencia_sol").css("display","none");
      $("#posicao_unidade").css("display","none");
      $("#dimensoes_lote").css("display","block");
    }
  }
}

function carregaCampos2() { 
  var alvo_alteracao = $('#alvo_alteracao').val();
  
  if(alvo_alteracao == 'todas_unidades' || alvo_alteracao == 'todas_unidades_disponiveis') {
    $("#linha-alteracao").css("display","none"); 
    $("#aplicar-alteracao2").css("display","block");
    $("#aplicar-alteracao").css("display","none");
  } else if (alvo_alteracao == 'unidades_especificas') {
    $("#linha-alteracao").css("display","block"); 
    $("#aplicar-alteracao2").css("display","none");
    $("#aplicar-alteracao").css("display","block");
    $("#box-quadras").css("display","none");
    $("#box-torres").css("display","none");
    $("#box-quadras-torres").css("display","block");
    $("#box-unidades").css("display","block");
    $("#box-plantas").css("display","none");
    $("#box-andares").css("display","none");
  } else if (alvo_alteracao == 'torres_andares_disponiveis') {
    $("#linha-alteracao").css("display","block"); 
    $("#aplicar-alteracao2").css("display","none");
    $("#aplicar-alteracao").css("display","block");
    $("#box-quadras").css("display","none");
    $("#box-torres").css("display","block");
    $("#box-quadras-torres").css("display","none");
    $("#box-unidades").css("display","none");
    $("#box-plantas").css("display","none");
    $("#box-andares").css("display","block");
  } else {
    $("#linha-alteracao").css("display","block"); 
    $("#aplicar-alteracao2").css("display","none");
    $("#aplicar-alteracao").css("display","block");
    $("#box-quadras-torres").css("display","none");
    $("#box-unidades").css("display","none");
    $("#box-plantas").css("display","none");
    $("#box-andares").css("display","block");
    if (alvo_alteracao == 'plantas_disponiveis') {
      $("#box-quadras").css("display","none");  
      $("#box-plantas").css("display","block"); 
      $("#box-torres").css("display","none"); 
      $("#box-andares").css("display","none");
    } else if (alvo_alteracao == 'unidades_quadra') {
      $("#box-quadras").css("display","block");
      $("#box-plantas").css("display","none");
    }
  }
}
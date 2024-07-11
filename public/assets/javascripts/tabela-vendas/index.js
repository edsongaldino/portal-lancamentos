$(function(){

      function formatReal(numero) {
        var tmp = numero + '';
        var neg = false;

        if (tmp - (Math.round(numero)) == 0) {
            tmp = tmp + '00';
        }

        if (tmp.indexOf(".")) {
            tmp = tmp.replace(".", "");
        }

        if (tmp.indexOf("-") == 0) {
            neg = true;
            tmp = tmp.replace("-", "");
        }

        if (tmp.length == 1) tmp = "0" + tmp

        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");

        if (tmp.length > 6)
            tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

        if (tmp.length > 9)
            tmp = tmp.replace(/([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g, ".$1.$2,$3");

        if (tmp.length = 12)
            tmp = tmp.replace(/([0-9]{3}).([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g, ".$1.$2.$3,$4");

        if (tmp.length > 12)
            tmp = tmp.replace(/([0-9]{3}).([0-9]{3}).([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g, ".$1.$2.$3.$4,$5");

        if (tmp.indexOf(".") == 0) tmp = tmp.replace(".", "");
        if (tmp.indexOf(",") == 0) tmp = tmp.replace(",", "0,");

        return (neg ? '-' + tmp : tmp);
    }

    $('select[name=buscaEmpreendimento_id]').on('change', function () {

      var empreendimento_id = $(this).val();
      var construtora_id = $(this).data('construtora');

      if (empreendimento_id == '' && construtora_id == '') {
        window.location.href = '/admin/construtora/1/tabela-vendas/';
        return;
      }

      if (empreendimento_id == '') {
        window.location.href = '/admin/construtora/' + construtora_id + '/tabela-vendas/';
        return;
      }

      if (construtora_id == '') {
        window.location.href = '/admin/construtora/1/tabela-vendas/?empreendimento_id=' + empreendimento_id;
        return;
      }

      window.location.href = '/admin/construtora/' + construtora_id + '/tabela-vendas/?empreendimento_id=' + empreendimento_id;
    });

    $("#salvar-tipo-tabela").on('click', function () {

      ajaxRequest({
        url: '/admin/gravar-tipo-tabela',
        metodo: 'POST',
        dados: $("#form-tipoTabela").serialize(),
        feedback: true,
        mensagemSucesso: 'Tipo de Tabela Salvo',
        mensagemErro: 'Erro, tente novamente mais tarde',
        reload: true
      });
    });


    $("#salvar-tabela").on('click', function () {

      if ($("#empreendimento_id").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe o empreendimento',
          'error'
          );

        return false;
      }

      if ($("#tipo_tabela_id").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe o tipo da tabela',
          'error'
          );

        return false;
      }

      if ($("#nome_tabela").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe o nome da tabela',
          'error'
          );

        return false;
      }

      if ($("#desconto_avista").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe o desconto',
          'error'
          );

        return false;
      }

      if ($("#renda_minima").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe a renda minima para financiamento',
          'error'
          );

        return false;
      }

      if ($("#programaHabitacional").val() != 'Não') {
        if ($("#subsidio_maximo").val() === '') {
          Swal.fire(
            'Desculpe',
            'Informe o subsídio máximo',
            'error'
            );

          return false;
        }
      }

      if ($("#validade_tabela").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe a data de validade da tabela',
          'error'
          );

        return false;
      }

      ajaxRequest({
        url: '/admin/gravar-tabela',
        metodo: 'POST',
        dados: $("#formTabelaVendas").serialize(),
        feedback: true,
        mensagemSucesso: 'Tabela de vendas salva',
        //mensagemErro: 'Erro, tente novamente mais tarde',
        redirect: '/admin/construtora/'+$("#construtora_id").val()+'/tabela-vendas'
      });

    });

    $("#atualizar-tabela").on('click', function () {

      if ($("#empreendimento_id").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe o empreendimento',
          'error'
          );

        return false;
      }

      if ($("#tipo_tabela_id").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe o tipo da tabela',
          'error'
          );

        return false;
      }

      if ($("#nome_tabela").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe o nome da tabela',
          'error'
          );

        return false;
      }

      if ($("#desconto_avista").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe o desconto',
          'error'
          );

        return false;
      }

      if ($("#renda_minima").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe a renda minima para financiamento',
          'error'
          );

        return false;
      }

      if ($("#programaHabitacional").val() != 'Não') {
        if ($("#subsidio_maximo").val() === '') {
          Swal.fire(
            'Desculpe',
            'Informe o subsídio máximo',
            'error'
            );

          return false;
        }
      }

      if ($("#validade_tabela").val() === '') {
        Swal.fire(
          'Desculpe',
          'Informe a data de validade da tabela',
          'error'
          );

        return false;
      }

      ajaxRequest({
        url: '/admin/atualizar-tabela/'+$("#tabela_id").val(),
        metodo: 'POST',
        dados: $("#formAtualizarTabelaVendas").serialize(),
        feedback: true,
        mensagemSucesso: 'Tabela de vendas atualizada',
        //mensagemErro: 'Erro, tente novamente mais tarde',
        redirect: '/admin/construtora/'+$("#construtora_id").val()+'/tabela-vendas'
      });

    });


    $(".btn-excluirTabela").on('click', function () {

      var url = $(this).data('url');

      Swal.fire({
        title: 'Tem certeza que deseja excluir a tabela?',
        text: "Selecione as opções abaixo!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim tenho certeza!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.value) {
          $.ajax({
              method: 'POST',
              url: url,
              success: function (response) {
                  if (response.sucesso == 'true') {
                      Swal.fire(
                        'OK!',
                        'A tabela foi removida!',
                        'success'
                      )

                      setTimeout(function () {
                          window.location.reload();
                      }, 2000);
                  } else {
                      Swal.fire(
                        'Desculpe',
                        response.retorno,
                        'error'
                      );
                  }
              }
          });
        }
      });

    });

    $("#programaHabitacional").on('change', function () {
        var valor = $(this).val();
        if (valor != 'Não') {$("#subsidio_maximo").removeAttr('disabled');}
        if (valor == 'Não') {$("#subsidio_maximo").attr('disabled','disabled');}
    });

    $("#possuiEntrada").on('change', function () {
      var valor = $(this).val();
      if (valor == 'Sim') {
        $("#percentualEntrada").css("display", "block");
        $("#parcelamentoEntrada").css("display", "block");
      }
      if (valor == 'Não') {
        $("#percentualEntrada").css("display", "none");
        $("#parcelamentoEntrada").css("display", "none");
      }
    });

    $("#entradaParcelada").on('change', function () {
        var valor = $(this).val();
        if (valor == 'Sim') {
          $("#QtdeParcelaEntrada").css("display", "block");
        }
        if (valor == 'Não') {
          $("#QtdeParcelaEntrada").css("display", "none");
        }
    });

    $("#possuiMensais").on('change', function () {
        var valor = $(this).val();
        if (valor == 'Sim') {$("#mensaisTabela").css("display", "block");}
        if (valor == 'Não') {$("#mensaisTabela").css("display", "none");}
    });

    $("#parceriaBanco").on('change', function () {
        var valor = $(this).val();
        if (valor == 'Sim') {$("#bancos").css("display", "block");}
        if (valor == 'Não') {$("#bancos").css("display", "none");}
    });

    $("#possuiBaloes").on('change', function () {
        var valor = $(this).val();
        if (valor == 'Sim') {
            $("#baloesTabela").css("display", "block");
            $("#baloes").css("display", "block");
        }
        if (valor == 'Não') {
            $("#baloesTabela").css("display", "none");
            $("#baloes").css("display", "none");
        }
    });

    $("#possuiParcelaUnica").on('change', function () {
      var valor = $(this).val();
      if (valor == 'Sim') {
        $("#percentualParcelaUnica").css("display", "block");
        $("#dataParcelaUnica").css("display", "block");
      }
      if (valor == 'Não') {
        $("#percentualParcelaUnica").css("display", "none");
        $("#dataParcelaUnica").css("display", "none");
      }
    });

    $("#possuiVagaExtra").on('change', function () {
      var valor = $(this).val();
      if (valor == 'Sim_PG') {
        $("#valorVagaExtraPadrao").css("display", "block");
        $("#valorVagaExtraGaveta").css("display", "block");
      };
      if (valor == 'Sim_SG') {
        $("#valorVagaExtraPadrao").css("display", "none");
        $("#valorVagaExtraGaveta").css("display", "block");
      };
      if (valor == 'Sim_SP') {
        $("#valorVagaExtraPadrao").css("display", "block");
        $("#valorVagaExtraGaveta").css("display", "none");
      };
      if (valor == 'Não') {
        $("#valorVagaExtraPadrao").css("display", "none");
        $("#valorVagaExtraGaveta").css("display", "none");
      };
    });

    $("#qtd_baloes").on('blur', function () {

        var valor = $(this).val();
        var i;
        var linhas = $("#TabelaBaloes #linhaBalao").length;

        if(valor < linhas){
            var remover = linhas - valor;
            for (i = 0; i < remover; i++) {
                $('#linhaBalao').remove();
            }
        }
        for (i = linhas; i < valor; i++) {
            $('#linhaBalao').clone().appendTo($('#TabelaBaloes'));
        }

    });


    $('.percentual').mask('Z#9V##', {
        translation: {
            'Z': {
              pattern: /[\-\+]/,
              optional: true
            },
            'V': {
              pattern: /[\,]/
            },
            '#': {
              pattern: /[0-9]/,
              optional: true
            }
        }
    });

    $(".percentual").on('blur',function(){
        if($(this).val().length > 0)
           $(this).val( $(this).val() + '%' );
    }).on('focus',function(){
          $(this).val( $(this).val().replace('%','') );
    });


    $("#percentual_entrada, #percentual_mensais, #percentual_baloes, #percentual_parcela_unica").on('blur',function(){

      percentual_remanescente = '';

      percentual_entrada = $("#percentual_entrada").val().replace('%','').replace(".", "").replace(",", ".");
      percentual_mensais = $("#percentual_mensais").val().replace('%','').replace(".", "").replace(",", ".");
      percentual_baloes = $("#percentual_baloes").val().replace('%','').replace(".", "").replace(",", ".");
      percentual_parcela_unica = $("#percentual_parcela_unica").val().replace('%','').replace(".", "").replace(",", ".");

      total_tabela = parseFloat(percentual_entrada || 0) + parseFloat(percentual_mensais || 0) + parseFloat(percentual_baloes || 0) + parseFloat(percentual_parcela_unica || 0);
      percentual_remanescente = parseFloat(100) - parseFloat(total_tabela);
      $("#percentual_remanescente").val(percentual_remanescente);

    });

    $(document).on('change', '#empreendimento', function () {
      var empreendimento_id = $(this).val();
      ajaxRequest({
        metodo: 'POST',
        url: '/admin/buscar-torres-quadras-tabelas',
        dados: {
          empreendimento_id: empreendimento_id
        },
        feedback: false,
        resultado: "#selectTorresQuadras"
      })

    });

    $(document).on('change', '#quadra_id', function () {
      var quadra_id = $(this).val();
      ajaxRequest({
        metodo: 'POST',
        url: '/admin/buscar-previsao-entrega',
        dados: {
          quadra_id: quadra_id
        },
        feedback: false,
        resultado: "#previsaoEntrega"
      })

    });

    $(document).on('change', '#torre_id', function () {
      var torre_id = $(this).val();
      ajaxRequest({
        metodo: 'POST',
        url: '/admin/buscar-previsao-entrega',
        dados: {
          torre_id: torre_id
        },
        feedback: false,
        resultado: "#previsaoEntrega"
      })

    });

});


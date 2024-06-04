  $(function () {

    var $w10finish = $('#w4').find('ul.pager li.finish'),
      $w10validator = $("#w4 form").validate({
      highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
      },
      success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).remove();
      },
      errorPlacement: function( error, element ) {
        element.parent().append( error );
      }
    });

    $w10finish.on('click', function( ev ) {
      ev.preventDefault();
      var validated = $('#w4 form').valid();
      if ( validated ) {
        // new PNotify({
        //   title: 'Congratulations',
        //   text: 'You completed the wizard form.',
        //   type: 'custom',
        //   addclass: 'notification-success',
        //   icon: 'fa fa-check'
        // });
      }
    });

    $('#w10').bootstrapWizard({
      tabClass: 'wizard-steps',
      nextSelector: 'ul.pager li.next',
      previousSelector: 'ul.pager li.previous',
      firstSelector: null,
      lastSelector: null,
      onNext: function( tab, navigation, index, newindex ) {
        return validarPlanos();
      },
      onTabClick: function( tab, navigation, index, newindex ) {
        if ( newindex == index + 1 ) {
          return this.onNext( tab, navigation, index, newindex);
        } else if ( newindex > index + 1 ) {
          return false;
        } else {
          return true;
        }
      },
      onTabChange: function( tab, navigation, index, newindex ) {
        var $total = navigation.find('li').length - 1;
        $w10finish[ newindex != $total ? 'addClass' : 'removeClass' ]( 'hidden' );
        $('#w10').find(this.nextSelector)[ newindex == $total ? 'addClass' : 'removeClass' ]( 'hidden' );
      },
      onTabShow: function( tab, navigation, index ) {
        var $total = navigation.find('li').length - 1;
        var $current = index;
        var $percent = Math.floor(( $current / $total ) * 100);
        $('#w10').find('.progress-indicator').css({ 'width': $percent + '%' });
        tab.prevAll().addClass('completed');
        tab.nextAll().removeClass('completed');
      }
    });

    function validarPlanos() {
        var radios = document.getElementsByName("plano");
        var formValid = false;

        var i = 0;
        while (!formValid && i < radios.length) {
            if (radios[i].checked) formValid = true;
            i++;        
        }

        if (!formValid) {
          new PNotify({
            text: 'Selecione o plano',
            type: 'error',                    
          });
        }

        return formValid;
    }

    // Alterar plano

    $('.mes_ano').mask('00/00');
    $('.cartao-credito').mask('0000 0000 0000 0000');

    Iugu.setAccountID("7A4674133C174B8D9F596B24E6CEEA6F");
    Iugu.setTestMode(true);
    Iugu.setup();

    $(document).on('submit', '#alterar-plano', function (e) {
      
      e.preventDefault();

      if ($("#numero-cartao").val() == '') {
        Swal.fire('Desculpe', 'Informe o número do cartão', 'error');
        return false;
      }

      if ($("#titular").val() == '') {
        Swal.fire('Desculpe', 'Informe o nome do titular', 'error');
        return false;
      }

      var mes_ano = $("#mes_ano").val();

      if ($("#mes_ano").val() == '') {
        Swal.fire('Desculpe', 'Informe o mês/ano do cartão', 'error');
        return false;
      }

      if (mes_ano.length < 5) {
        Swal.fire('Desculpe', 'Preencha o mês/ano corretamente', 'error');
        return false;
      }

      if ($("#cvv").val() == '') {
        Swal.fire('Desculpe', 'Informe o cvv do cartão', 'error');
        return false;
      }
      
      var form = $(this);

      var tokenResponseHandler = function(data) {
          if (data.errors) {
              return data.errors;            
          } else {
              $("#token").val(data.id);              
          }        
      }
      
      var retorno = Iugu.createPaymentToken(this, tokenResponseHandler);

      if (retorno !== undefined) {
        if (retorno.number !== undefined && retorno.number == 'is_invalid') {
          Swal.fire('Desculpe', 'Número do cartão é inválido');
          return false;
        }

        if (retorno.first_name !== undefined && retorno.first_name == 'is_invalid') {
          Swal.fire('Desculpe', 'Nome do titular é inválido');
          return false;
        }

        if (retorno.last_name !== undefined && retorno.last_name == 'is_invalid') {
          Swal.fire('Desculpe', 'Nome do titular é inválido');
          return false;
        }

        if (retorno.expiration !== undefined && retorno.expiration == 'is_invalid') {
          Swal.fire('Desculpe', 'Mês/ano do cartão é inválido');
          return false;
        }

        if (retorno.verification_value !== undefined && retorno.verification_value == 'is_invalid') {
          Swal.fire('Desculpe', 'CVV (Código de segurança) é inválido');
          return false;
        }
      }

      var id = $("#ct_id").val();
      var dados = form.serialize();

      $("#efetuar-pagamento").attr('disabled', true);

      $.ajax({
        method: 'POST',
        url: '/admin/construtora/' + id + '/alterar-plano',
        data: dados,
        success: function (response) {
          $("#efetuar-pagamento").attr('disabled', false);
          if (response.sucesso == 'true') {
              Swal.fire('Sucesso', 'Plano Alterado com sucesso!', 'success');

              setTimeout(function () {
                window.location.reload();
              }, 2000);
          } else {
            Swal.fire('Desculpe', 'Ocorreu algum problema, tente novamente mais tarde!', 'error');
          }          
        },
        error: function (data) {              
          var dados = $.parseJSON(data.responseText);

          var errors = dados.errors;
          $.each(errors, function(key, value) {
            new PNotify({
              text: value,
              type: 'error',                    
            });
          });

        }
      })
    });

    $(document).on('blur', '#numero-cartao', function () {
      var numero = $(this).val();    

      if (numero == '') {
        $("#validacao-cartao").html('');
      } else {
        
        if (!Iugu.utils.validateCreditCardNumber(numero)) {
          $("#validacao-cartao").html('Número do cartão de crédito inválido');
          return false;
        }

        var bandeira = Iugu.utils.getBrandByCreditCardNumber(numero);

        if (!bandeira) {
          $("#validacao-cartao").html('Número do cartão de crédito inválido');
        } else {
          $("#validacao-cartao").html('');        
          $("#bandeira-cartao").html("Cartão de crédito ");
          $("#bandeira-cartao").append("<img src='/assets/images/"+ bandeira + ".jpg'>");
          $("#bandeira-input").val(bandeira);
        }        
      }    
    });

    $(document).on('blur', '#cvv', function () {
      var cvv = $(this).val();
      var bandeira = $("#bandeira-input").val();

      if (cvv == '') {
        $("#validacao-cvv").html('');
      } else {
        if (!Iugu.utils.validateCVV(cvv, bandeira)) {
          $("#validacao-cvv").html('Número do cvv inválido');
        } else {
          $("#validacao-cvv").html('');
        }
      }
    })

    $(document).on('blur', '#mes_ano', function () {
      var mes_ano = $(this).val();

      if (mes_ano == '') {
        $("#validacao-mes-ano").html('');
      } else {
        if (!Iugu.utils.validateExpirationString(mes_ano)) {
          $("#validacao-mes-ano").html('Mes/ano inválido');
        } else {
          $("#validacao-mes-ano").html('');          
        }
      }
    })

});
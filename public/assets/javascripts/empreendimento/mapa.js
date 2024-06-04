

  // inicio - controles do mouse
  var ponto = true;
  var clique = false;
  var clique_inicialX;
  var clique_inicialY;
  var fator = 150;
  
  // inicio - ponto unidade
  $(".ponto_unidade").click(function (e) {
      ponto = false;
      $("#info_marcacao").html("Unidade " + $(this).attr("data-unidade"));
      $("#form2 #unidade_id").val($(this).attr("data-idunidade"));
      $("#form2 #tam_implantacao").val($(this).attr("data-tamponto"));
      $("#px2").val($("#tela").scrollLeft());
      $("#py2").val($("#tela").scrollTop());
      $("#modal_excluir").modal("show");
  });
  // fim - ponto unidade
 
  // inicio - ponto foto
  $(".ponto_foto").click(function (e) {
    ponto = false;
    $("#info_marcacao").html("Imagem " + $(this).attr("data-foto"));
    $("#form3 #foto_id").val($(this).attr("data-idfoto"));
    $("#px2").val($("#tela").scrollLeft());
    $("#py2").val($("#tela").scrollTop());
    $("#modal_excluir_foto").modal("show");
  });
  // fim - ponto foto
  

  // inicio - controles do mouse
  
  // inicio - marcacao
  $("#tela").click(function (e) {
      e.preventDefault();
      if(ponto) {
          $("#modal_janela").modal("show");
          $("#tipo_ponto").val("U");
          $("#vinculo_unidade").show();
          $("#tamPonto").show();
          $("#vinculo_imagem").hide();
          $("#coord_x").val($(this).scrollLeft() + e.clientX);
          $("#coord_y").val($(this).scrollTop() + e.clientY);
          $("#px").val($(this).scrollLeft());
          $("#py").val($(this).scrollTop());
          $("#tipo_ponto").focus();
      }
  });
  
  $("#tipo_ponto").on("change", function () {
      $("#vinculo_unidade").hide();
      $("#vinculo_imagem").hide();
      $("#vinculo_unidade").find("input, select").removeAttr("required");
      $("#vinculo_imagem").find("input, select").removeAttr("required");
      
      if($("#tipo_ponto").val() == "U") {
          $("#vinculo_unidade").show();
          $("#tamPonto").show();
          $("#vinculo_unidade").find("input, select").attr("required", "required");
          $("#ponto_unidade").focus();
          
          
      } else if($("#tipo_ponto").val() == "I") {
          $("#vinculo_imagem").show();
          $("#vinculo_imagem").find("input, select").attr("required", "required");
          $("#ponto_imagem").focus();
          $("#tamPonto").hide();
      } else if($("#tipo_ponto").val() == "M") {
          $("#vinculo_imagem").show();
          $("#vinculo_imagem").find("input, select").attr("required", "required");
          $("#ponto_imagem").focus();
          $("#tamPonto").hide();
      }
  });
  // fim - marcacao

  $("#tela").mousedown(function (e) {
      e.preventDefault();
      $("#tela").css( 'cursor', 'move' );        
      clique_inicialX = e.clientX;
      clique_inicialY = e.clientY;
      clique = true;                
  });

  $(document).mouseup(function (e) {
      e.preventDefault();
      $("#tela").css( 'cursor', 'default' ); 
      clique = false;
  });
  
  $("#tela").mouseleave(function (e) {
      e.preventDefault();
      $("#tela").css( 'cursor', 'default' );
      clique = false;
  });

  $("#tela").mousemove(function (e) {
      if (clique) {
          if((clique_inicialX - e.clientX != 0) && (clique_inicialY - e.clientY != 0))  {
              e.preventDefault();
              $("#tela").scrollLeft($("#tela").scrollLeft() + (clique_inicialX - e.clientX));
              $("#tela").scrollTop($("#tela").scrollTop() + (clique_inicialY - e.clientY));
              clique_inicialX = e.clientX;
              clique_inicialY = e.clientY;
              ponto = false;
          }
      } else {
          ponto = true;    
      }
  });
  // fim - controles do mouse
  
  // inicio - controles do teclado
  $(document).keydown(function(e) {
      /*
        * 37 - esquerda
        * 38 - cima
        * 39 - direita
        * 40 - baixo
        */
      
      if(e.keyCode == 37) {
          $("#tela").animate({ 'scrollLeft': '+=-'+ fator +'px' }, 300);
      } else if(e.keyCode == 38) {
          $("#tela").animate({ 'scrollTop': '+=-'+ fator +'px' }, 300);
      } else if(e.keyCode == 39) {
          $("#tela").animate({ 'scrollLeft': '-=-'+ fator +'px' }, 300);
      } else if(e.keyCode == 40) {
          $("#tela").animate({ 'scrollTop': '-=-'+ fator +'px' }, 300);
      }
  });
  // fim - controles do teclado
  
  // inicio - controles do icone
  $("#bt_mapa_e").click(function() {
      $("#tela").animate({ 'scrollLeft': '+=-'+ fator +'px' }, 300);
  });
  
  $("#bt_mapa_c").click(function() {
      $("#tela").animate({ 'scrollTop': '+=-'+ fator +'px' }, 300);
  });
  
  $("#bt_mapa_d").click(function() {
      $("#tela").animate({ 'scrollLeft': '-=-'+ fator +'px' }, 300);
  });
  
  $("#bt_mapa_b").click(function() {
      $("#tela").animate({ 'scrollTop': '-=-'+ fator +'px' }, 300);
  });


  $("#bt_modal_atualizar_foto").on('click', function (e) {
    e.preventDefault();

    var url = '/admin/empreendimento/foto/atualizar-coordenadas';

    if ($("#tipo_ponto").val() == 'I' || $("#tipo_ponto").val() == 'M') {

        var foto_id = $("select[name=foto_id]").val();

        if (foto_id == '') {
          Swal.fire({
            title: "Erro",
            text: 'Selecione uma foto',
            type: 'error'
          });
          return;
        }
    }


    var promise = new Promise(function (resolve, reject) {
      ajaxRequest({
        url: url,
        metodo: 'POST',
        dados: $("#form1").serialize(),
        feedback: true,
        mensagemSucesso: 'Coordenadas atualizadas com sucesso'
      });
      resolve(true);
    });

    promise.then(function () {
      $("#modal_janela").modal("hide");
      var px = $("#px").val();
      var py = $("#py").val();
      var id = $("#empreendimento_id").val();

      setTimeout(function () {
        window.open("/admin/empreendimento/" + id + "/mapa-lazer/?x=" + px + "&y=" + py + "", "_self");
      }, 2000);      
    });    
  });

  $("#bt_modal_atualizar").on('click', function (e) {
    e.preventDefault();

    var url = '/admin/empreendimento/foto/atualizar-coordenadas';

    if ($("#tipo_ponto").val() == 'U') {
        var url = '/admin/empreendimento/unidade/atualizar-coordenadas';
    }
    
    if ($("#tipo_ponto").val() == 'U') {

        var unidade_id = $("select[name=unidade_id]").val();

        if (unidade_id == '') {
          Swal.fire({
            title: "Erro",
            text: 'Selecione uma unidade',
            type: 'error'
          });
          return;
        }

        var url = '/admin/empreendimento/unidade/atualizar-coordenadas';
    }

    if ($("#tipo_ponto").val() == 'I' || $("#tipo_ponto").val() == 'M') {

        var foto_id = $("select[name=foto_id]").val();

        if (foto_id == '') {
          Swal.fire({
            title: "Erro",
            text: 'Selecione uma foto',
            type: 'error'
          });
          return;
        }
    }


    var promise = new Promise(function (resolve, reject) {
      ajaxRequest({
        url: url,
        metodo: 'POST',
        dados: $("#form1").serialize(),
        feedback: true,
        mensagemSucesso: 'Coordenadas atualizadas com sucesso'
      });
      resolve(true);
    });

    promise.then(function () {
      $("#modal_janela").modal("hide");
      var px = $("#px").val();
      var py = $("#py").val();
      var id = $("#empreendimento_id").val();

      setTimeout(function () {
        window.open("/admin/empreendimento/" + id + "/mapa/?x=" + px + "&y=" + py + "", "_self");
      }, 2000);      
    });    
  });

  
  $("#bt_modal_excluir").on('click', function (e) {
    e.preventDefault();
    var promise = new Promise(function (resolve, reject) {
      ajaxRequest({
        url: '/admin/empreendimento/unidade/atualizar-coordenadas',
        metodo: 'POST',
        dados: $("#form2").serialize(),
        feedback: true,
        mensagemSucesso: 'Coordenadas removidas com sucesso'
      });    
      resolve(true);
    });
    
    promise.then(function () {
      $("#modal_excluir").modal("hide");
      var px = $("#px2").val();
      var py = $("#py2").val();
      var id = $("#empreendimento_id").val();
      window.open("/admin/empreendimento/" + id + "/mapa/?x=" + px + "&y=" + py + "", "_self");
    });
  });

  $("#bt_modal_excluir_foto").on('click', function (e) {
    e.preventDefault();
    var promise = new Promise(function (resolve, reject) {
      ajaxRequest({
        url: '/admin/empreendimento/foto/atualizar-coordenadas',
        metodo: 'POST',
        dados: $("#form3").serialize(),
        feedback: true,
        mensagemSucesso: 'Coordenadas removidas com sucesso'
      });    
      resolve(true);
    });
    
    promise.then(function () {
      $("#modal_excluir_foto").modal("hide");
      var px = $("#px2").val();
      var py = $("#py2").val();
      var id = $("#empreendimento_id").val();
      window.open("/admin/empreendimento/" + id + "/mapa/?x=" + px + "&y=" + py + "", "_self");
    });
  });

  $("#bt_modal_excluir_foto2").on('click', function (e) {
    e.preventDefault();
    var promise = new Promise(function (resolve, reject) {
      ajaxRequest({
        url: '/admin/empreendimento/foto/atualizar-coordenadas',
        metodo: 'POST',
        dados: $("#form3").serialize(),
        feedback: true,
        mensagemSucesso: 'Coordenadas removidas com sucesso'
      });    
      resolve(true);
    });
    
    promise.then(function () {
      $("#modal_excluir_foto").modal("hide");
      var px = $("#px2").val();
      var py = $("#py2").val();
      var id = $("#empreendimento_id").val();
      window.open("/admin/empreendimento/" + id + "/mapa-lazer/?x=" + px + "&y=" + py + "", "_self");
    });
  });
  // fim - controles do icone

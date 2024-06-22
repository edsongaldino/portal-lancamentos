$(document).ready(function () {
  
  $(window).load(function() {    
    var $container = $("#tela");

    var $img = $("#mapa_fundo");

    var cHeight = $container.height();

    var cWidth = $container.width();

    var iHeight = $img.height();

    var iWidth = $img.width();
    
    var top = (iHeight - cHeight) / 2;

    var left = (iWidth - cWidth) / 2;
    
    $container.scrollLeft(left);

    $container.scrollTop(top);
    
    // remove preloader
    $(".carregando").remove();
    
    // ajuda
    $("#bt_ajuda").trigger("click");
  });
  
  // inicio - controles do mouse
  var ponto = true;
  var clique = false;
  var clique_inicialX;
  var clique_inicialY;
  var fator = 150;

  // mobile

  // end mobile
  
  // inicio - ponto unidade
  $(".ponto_unidade").click(function (e) {
    ponto = false;
    
    if($(this).attr("data-stunidade") == "r") {
      $("#modal_detalhes").find(".modal-header").addClass("modal-header-situacao-r");

      $("#modal_detalhes").find("h4").html("Reservado");      
    } else if($(this).attr("data-stunidade") == "d") {
      $("#modal_detalhes").find(".modal-header").addClass("modal-header-situacao-d");

      $("#modal_detalhes").find("h4").html("Disponível");
      
    } else if($(this).attr("data-stunidade") == "v") {
      $("#modal_detalhes").find(".modal-header").addClass("modal-header-situacao-v");

      $("#modal_detalhes").find("h4").html("Vendido");      
    } else if($(this).attr("data-stunidade") == "o") {
      $("#modal_detalhes").find(".modal-header").addClass("modal-header-situacao-o");

      $("#modal_detalhes").find("h4").html("Bloqueada");
    }else if($(this).attr("data-stunidade") == "b") {
        $("#modal_detalhes").find(".modal-header").addClass("modal-header-situacao-b");
  
        $("#modal_detalhes").find("h4").html("Disponibilidade Bloqueada"); 
    } else {
      $("#modal_detalhes").find(".modal-header").addClass("modal-header-situacao-p");

      $("#modal_detalhes").find("h4").html("Situação");
    }
    
    ajaxRequest({
      url: '/unidade/mapa',
      metodo: 'POST',
      dados: {
        unidade: $(this).attr("data-idunidade"),
        ocultar: 'N'
      },
      feedback: false,
      resultado: '#box_detalhes_unidade'
    });
    
    $("#modal_detalhes").modal("show");
  });

  $("#modal_detalhes").on("hide.bs.modal", function () {
    $("#modal_detalhes").find(".modal-header").removeClass("modal-header-situacao-r");

    $("#modal_detalhes").find(".modal-header").removeClass("modal-header-situacao-d");

    $("#modal_detalhes").find(".modal-header").removeClass("modal-header-situacao-v");

    $("#modal_detalhes").find(".modal-header").removeClass("modal-header-situacao-p");

    $("#modal_detalhes").find(".modal-header").removeClass("modal-header-situacao-o");
  });
  
  // fim - ponto unidade
  
  // inicio - controles do mouse
  
  // inicio - marcacao
  $("#tela").click(function (e) {
    e.preventDefault();
    if(ponto) {
      $("#modal_janela").modal("show");
      $("#tipo_ponto").val("");
      $("#vinculo_unidade").hide();
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
      $("#vinculo_unidade").find("input, select").attr("required", "required");
      $("#ponto_unidade").focus();
      
    } else if($("#tipo_ponto").val() == "I") {
      $("#vinculo_imagem").show();
      $("#vinculo_imagem").find("input, select").attr("required", "required");
      $("#ponto_imagem").focus();
      
    } else if($("#tipo_ponto").val() == "M") {
      $("#vinculo_imagem").show();
      $("#vinculo_imagem").find("input, select").attr("required", "required");
      $("#ponto_mapa").focus();
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
  // fim - controles do icone
  
  
});

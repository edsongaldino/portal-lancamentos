
$(document).on('click', '#btn-resultado-lista', function () { 
  $("#resultado-lista").fadeIn( "slow" );
  $("#resultado-grid").hide();
  $("#btn-resultado-lista").hide();
  $("#btn-resultado-lista-inativo").show();
  $("#btn-resultado-grid").show();
  $("#btn-resultado-grid-inativo").hide();
  $("#ocultar-dados").show();
  $("#btn-resultado-lista-inativo").addClass("view-box-active");
  $("#btn-resultado-grid-inativo").removeClass("view-box-active");
});

$(document).on('click', '#btn-resultado-grid', function () { 
  $("#resultado-grid").fadeIn( "slow" );
  $("#resultado-lista").hide();
  $("#btn-resultado-grid").hide();
  $("#btn-resultado-grid-inativo").show();
  $("#btn-resultado-lista").show();
  $("#btn-resultado-lista-inativo").hide();
  $("#mostrar-dados").show();
  $("#btn-resultado-grid-inativo").addClass("view-box-active");
  $("#btn-resultado-lista-inativo").removeClass("view-box-active");
});
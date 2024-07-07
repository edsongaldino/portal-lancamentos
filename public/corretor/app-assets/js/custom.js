$(document).on("change", ".BuscaAjax", function () {
    var cidade_id = $('#BuscaCidade').val();;
    var subtipo_id = $('#BuscaTipo').val();;
    location.href = "/corretor/empreendimentos/"+ cidade_id +"/"+ subtipo_id +"/buscar";
});
$(function () {

  function isFunctionDefined(functionName) {
      if(eval("typeof(" + functionName + ") == typeof(Function)")) {
          return true;
      }
  }

  $(document).on('blur', '.cep', function () {  
		var cep_input = $(this).val();
		var cep = cep_input.replace(/-/, '');
    var form = $(this).data('form');
    var mapa_id = $(this).data('mapa');

    if (cep == '') {
      return;
    }

    addLoading();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.post('/admin/buscar-cep', { cep: cep }, function (response) {

      removeLoading();

      if (response.sucesso == 'false') {
        new PNotify({
          text: 'Cep não encontrado',
          type: 'error',                    
        });
        return;
      }    

      console.log('dados', response); 

      $(form).find("input[name=logradouro]").val(response.logradouro);
      $(form).find("input[name=complemento]").val(response.complemento);
      
      $(form).find("#estado-wrapper").html(response.estados_html);      
      $(form).find("select[name=estado_id]").val(response.estado_id);  

      $(form).find("#cidade-wrapper").html(response.cidades_html);      
      $(form).find("select[name=cidade_id]").val(response.cidade_id);  

      $(form).find("#bairro-wrapper").html(response.bairros_html);
      $(form).find("select[name=bairro_id]").val(response.bairro_id);  

      $(form).find("#bairro-comercial-wrapper").html(response.bairros_comerciais_html);
      $(form).find("select[name=bairro_comercial]").val(response.bairro_id);  

      $(form).find("input[name=estado_nome_cep]").val(response.json.uf);
      $(form).find("input[name=cidade_nome_cep]").val(response.json.localidade);
      $(form).find("input[name=bairro_nome_cep]").val(response.json.bairro);
      $(form).find('input[name=latitude]').val(response.latitude);
      $(form).find('input[name=longitude]').val(response.longitude);
      
      if (response.latitude != null && response.longitude != null) {
        if (isFunctionDefined('mapa')) {
          mapa(response.latitude, response.longitude, mapa_id);  
        }        
      }      
    });		
	});	
});
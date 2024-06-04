$(function () {

  $('.tipo-imagem').on('change', function () {
    var tipo = $(this).val();
    var id = $(this).data('id');
    var empreendimento_id = $(this).data('empreendimento');
    ajaxRequest({
      url: '/admin/empreendimento/' + id + '/atualizar-foto',
      metodo: 'POST',
      dados: {
        tipo: tipo,
        empreendimento_id: empreendimento_id
      },
      //feedback: true,
      //reload: false,
      //mensagemSucesso: 'Tipo atualizado com sucesso',
      //mensagemErro: 'Erro, tente novamente mais tarde'
    }); 
  });

  $('.descricao-implantacao').on('change', function () {
    var nome = $(this).val();
    var id = $(this).data('id');
    var empreendimento_id = $(this).data('empreendimento');
    ajaxRequest({
      url: '/admin/empreendimento/' + id + '/atualizar-foto',
      metodo: 'POST',
      dados: {
        nome: nome,
        empreendimento_id: empreendimento_id
      },
      //feedback: false,
      //reload: false,
      //mensagemSucesso: 'Foto atualizada com sucesso',
      //mensagemErro: 'Erro, tente novamente mais tarde'
    }); 
  });

  $('.nome-imagem').on('blur', function () {
    var nome = $(this).val();
    var id = $(this).data('id');      
    ajaxRequest({
      url: '/admin/empreendimento/' + id + '/atualizar-foto',
      metodo: 'POST',
      dados: {
        nome: nome
      },
      //feedback: false,
      //mensagemSucesso: 'Nome atualizado com sucesso',
      //mensagemErro: 'Erro, tente novamente mais tarde'
    });
  });

  $('.data-implantacao').on('blur', function () {
    var data_implantacao = $(this).val();
    var id = $(this).data('id');      
    ajaxRequest({
      url: '/admin/empreendimento/' + id + '/atualizar-foto',
      metodo: 'POST',
      dados: {
        data_implantacao: data_implantacao
      },
      feedback: true,
      mensagemSucesso: 'Data de implantação atualizada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde'
    });
  });

  $('#excluir-fotos').on('click', function (e) {
    confirmacao().then((result) => {
      if (result.value) {        
        var ids = [];
        
        $('.thumbnail-selected').each(function () {
          var checkbox = $(this).find('input[type="checkbox"]');
          ids.push(checkbox.val());
        });

        var rota = $(this).data('rota');

        ajaxRequest({
          url: rota,
          metodo: 'POST',
          dados: {
            ids: ids
          },
          feedback: true,
          mensagemSucesso: 'Foto(s) excluídas com sucesso',
          mensagemErro: 'Erro, tente novamente mais tarde',
          reload: true
        });        
      }      
    });    
  });

  $('.excluir-foto').on('click', function (e) {
    confirmacao().then((result) => {
      if (result.value) {
        var ids = [];
        var id = $(this).data('id');
        ids.push(id);
        var rota = $(this).data('rota');

        ajaxRequest({
          url: rota,
          metodo: 'POST',
          dados: {
            ids: ids
          },
          feedback: true,
          mensagemSucesso: 'Foto excluída com sucesso',
          mensagemErro: 'Erro, tente novamente mais tarde',
          reload: true
        });        
      }
    });    
  });

  $('.destacar-foto').on('click', function (e) {
    var ids = [];
    var id = $(this).data('id');    
    ids.push(id);
    var rota = $(this).data('rota');

    ajaxRequest({
      url: rota,
      metodo: 'POST',
      dados: {
        ids: ids
      },
      feedback: true,
      reload: true,
      mensagemSucesso: 'Foto destacada com sucesso',
      mensagemErro: 'Erro, tente novamente mais tarde'
    });
  });

  $('.remover-destaque').on('click', function (e) {

    var titulo = $(this).data('titulo');

    confirmacao(titulo).then((result) => {
      if (result.value) {
        var ids = [];
        var id = $(this).data('id');
        ids.push(id);
        var rota = $(this).data('rota');
          
        ajaxRequest({
          url: rota,
          metodo: 'POST',
          dados: {
            ids: ids
          },
          feedback: true,
          reload: true,
          mensagemSucesso: 'Destaque removido com sucesso',
          mensagemErro: 'Erro, tente novamente mais tarde'
        });
      }
    });    
  });
});
$(function () {
  
    $(document).on('click', '.remover-integracao-domus', function (e) {
        confirmacaoRemoverIntegracao().then((result) => {
            if (result.value) {
                var id = $(this).data('id');
                var status = $(this).data('status');
                ajaxRequest({
                url: '/admin/integracao/atualizar-integracao-domus',
                metodo: 'POST',
                dados: {
                    id: id,
                    status: status
                },
                feedback: true,
                reload: true,
                mensagemSucesso: "Integração desativada com sucesso!",
                mensagemErro: "Erro ao desativar a integração, tente novamente mais tarde"
                });        
            }
            });    
    });


    $(document).on('click', '.ativar-integracao-domus', function (e) {
        confirmacaoAtivarIntegracao().then((result) => {
            if (result.value) {
                var id = $(this).data('id');
                var status = $(this).data('status');
                ajaxRequest({
                url: '/admin/integracao/atualizar-integracao-domus',
                metodo: 'POST',
                dados: {
                    id: id,
                    status: status
                },
                feedback: true,
                reload: true,
                mensagemSucesso: "A integração foi ativada. Em breve seus produtos já estarão disponíveis na rede!",
                mensagemErro: "Erro, tente novamente mais tarde"
                });        
            }
            });    
    });

    $(document).on('click', '.integrar-usuario-domus', function (e) {
        confirmacaoAtivarIntegracaoU().then((result) => {
            if (result.value) {
                var id = $(this).data('id');
                var perfil_domus = $(this).data('perfil');
                ajaxRequest({
                url: '/admin/integracao/integrar-usuario-domus',
                metodo: 'POST',
                dados: {
                    id: id,
                    perfil_domus: perfil_domus
                },
                feedback: true,
                reload: true,
                mensagemSucesso: "A integração deste usuario foi alterada para ("+perfil_domus+")!",
                mensagemErro: "Erro, tente novamente mais tarde"
                });        
            }
            });    
    });

});
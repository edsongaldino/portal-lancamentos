$(function () {

    $("#salvar-publicacao").on('click', function () {
        

        var form = $('#incluir-publicacao')[0];
        var formData = new FormData(form);
        event.preventDefault();
        $.ajax({
            url: "/admin/publicacao/salvar", // the endpoint
            type: "POST", // http method
            processData: false,
            contentType: false,
            data: formData,

            success: function(data) {
                Swal.fire(
                'OK!',
                'Publicação Incluída!',
                'success'
                )
                window.location.href = '/admin/publicacoes/';            
            },
            error: function(data){
                Swal.fire(
                'Ops!',
                'Algo errado aconteceu na inclusão!',
                'error'
                )
                window.location.href = '/admin/publicacoes/';
             } 
            
        });


    });
  

    $("#editar-publicacao").on('click', function () {

        var form = $('#FormEditar')[0];
        var formData = new FormData(form);
        event.preventDefault();
        $.ajax({
            url: "/admin/publicacao/update", // the endpoint
            type: "POST", // http method
            processData: false,
            contentType: false,
            data: formData,

            success: function(data) {
                Swal.fire(
                'OK!',
                'Publicação atualizada!',
                'success'
                )
                window.location.href = '/admin/publicacoes/';            
            },
            error: function(data){
                Swal.fire(
                'Ops!',
                'Algo errado aconteceu!',
                'error'
                )
                window.location.href = '/admin/publicacoes/';
             } 
            
        });

    });

    $("#excluir-publicacao").on('click', function () {
        
        var url = $(this).data('url');

        Swal.fire({
        title: 'Tem certeza que deseja excluir a publicação?',
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
                method: 'GET',
                url: url,
                success: function (response) {
                    if (response.sucesso == 'true') {                        
                        Swal.fire(
                        'Sucesso!',
                        response.retorno,
                        'success'
                        );

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

});

function ExcluirPublicacao(id) {

    Swal.fire({
        title: 'Tem certeza que deseja excluir a publicação?',
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
                method: 'GET',
                url: 'publicacao/'+id+'/excluir',
                success: function (response) {
                    if (response.sucesso == 'true') {                        
                        Swal.fire(
                        'Sucesso!',
                        response.retorno,
                        'success'
                        );

                        setTimeout(function () {
                            window.location.reload();
                        }, 0);
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
    
}
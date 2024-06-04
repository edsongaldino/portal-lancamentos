$(document).on('change', '#select_construtora_id', function () {
    var construtora_id = $(this).val();
    var promise = new Promise(function (resolve, reject) {
        ajaxRequest({
            url: '/admin/trocar-construtora',
            metodo: 'POST',
            dados: {
                construtora_id: construtora_id
            },
            feedback: false
        });
        resolve(true);
    });

    promise.then(function () {
        window.location.reload();
    });

});
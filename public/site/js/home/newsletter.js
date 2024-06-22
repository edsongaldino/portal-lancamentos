var Newsletter = function () {
    this.form = "#form-newsletter";
    this.onSubmit();
};

Newsletter.prototype.onSubmit = function () {
    $(this.form).on('submit', function (e) {
        e.preventDefault();

        if ($("#exampleInputEmail2").val() == '') {
            Swal.fire('Desculpe', 'Informe seu e-mail', 'error');
        }

        var dados = $(this).serialize();

        console.log('dados', dados);

        ajaxRequest({
            url: '/newsletter',
            metodo: 'POST',
            dados: dados,
            feedback: true,
            mensagemSucesso: "Registrado com sucesso",
            mensagemErro: "Erro ao registrar seu e-mail, tente novamente mais tarde"
        });
    });
};

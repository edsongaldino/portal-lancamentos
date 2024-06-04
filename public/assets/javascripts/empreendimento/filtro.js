var FiltroEmpreendimento = function () {
  this.subtipo_id = 'Todas';
  this.cidade_id = 'Todas';
  this.status = 'Todas';
  this.nome = '';
  this.onNome();
  this.onSubtipoId();
  this.onCidadeId();
  this.onStatus();
};

FiltroEmpreendimento.prototype.onNome = function () {
  var nome = document.getElementById("nome-empreendimento");
  var $this = this;
  nome.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {              
        $this.nome = e.target.value;
        $this.ajax();
    }
  });  
};

FiltroEmpreendimento.prototype.onSubtipoId = function () {
  var $this = this;
  $(document).on('change', '.subtipo_id', function () {
    var subtipo_id = $(this).val();
    $this.subtipo_id = subtipo_id;
    $this.ajax();
  });
};

FiltroEmpreendimento.prototype.onCidadeId = function () {
  var $this = this;
  $(document).on('change', '.cidade_id', function () {
    var cidade_id = $(this).val();
    $this.cidade_id = cidade_id;
    $this.ajax();
  });
};

FiltroEmpreendimento.prototype.onStatus = function () {
  var $this = this;
  $(document).on('change', '.status', function () {
    var status = $(this).val();
    $this.status = status;
    $this.ajax();
  });
};

FiltroEmpreendimento.prototype.ajax = function () {
  ajaxRequest({
    url: '/admin/filtrar-empreendimento',
    metodo: 'POST',
    dados: {
      nome: this.nome,
      subtipo_id: this.subtipo_id,
      cidade_id: this.cidade_id,
      status: this.status
    },
    feedback: false,
    resultado: "#lista_empreendimentos"
  });
};

new FiltroEmpreendimento();
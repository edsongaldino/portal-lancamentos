$(function () {
  localStorage.setItem('possui_filtro', 'Não');
  $(document).trigger('exibirParametros');  
  $(document).trigger('setarSelecionadosMultiplos');
})

$(document).on('click', '.remover-parametro', function () {
  var id = $(this).data('id');
  var complemento = $(this).data('complemento');
  localStorage.removeItem(id);
  localStorage.removeItem(complemento);
  $(this).parent().hide();
  buscaAjax();
});

function formatarReais(int) {
  var tmp = int+'';
  tmp = tmp.replace(/([0-9]{2})$/g, ",$1");  
  if( tmp.length > 6 ) {
    tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
  }
  return tmp;
}


$(document).on('exibirParametros', {}, function () {
  var parametros = [
    'sessao_busca_construtoras',
    'sessao_busca_subtipos',    
    'sessao_busca_modalidades',
    'sessao_busca_cidades',
    'sessao_busca_bairros',
    'valor',
    'area', 
    'quarto'
  ];  

  parametros.forEach(function (item) {
    if (localStorage.getItem(item) != undefined) {
      localStorage.setItem('possui_filtro', 'Sim');
      var valorItem = localStorage.getItem(item);
      var $campo = $('#' + item);
      
      if (item == 'valor') {
        var range = valorItem.split(' - ');
        var minimo = parseFloat(range[0]).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
        var maximo = parseFloat(range[1]).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

        var valorItem = minimo + ' á ' + maximo;
        var $campo = $('#sessao_busca_' + item);
      }

      if (item == 'area') {
        var range = valorItem.split(' - ');
        var minimo = range[0] + ' m<sup>2</sup>';
        var maximo = range[1] + ' m<sup>2</sup>';

        var valorItem = minimo + ' á ' + maximo;
        var $campo = $('#sessao_busca_' + item);
      }

      if (item == 'quarto') {
        var range = valorItem.split(' - ');
        var minimo = range[0];
        var maximo = range[1];

        var valorItem = minimo + ' á ' + maximo;
        var $campo = $('#sessao_busca_' + item);
      }

      
      $campo.append(valorItem);
      $campo.show();
    }
  });
});

$(document).on('setarSelecionadosMultiplos', {}, function () {
  var parametros = [
    'construtora_id_multiplo',
    'subtipo_id_multiplo',
    'modalidade_id_multiplo',
    'cidade_id_multiplo',
    'bairro_id_multiplo',
  ];

  parametros.forEach(function (item) {
    if (localStorage.getItem(item) != undefined) {
      var valores = localStorage.getItem(item).split(',');      
      var $campo = $('#' + item + ' > option');
      $campo.each(function (item, index) {
        if (valores.includes(this.value)) {
          this.selected = true;  
        }
      });
    }
  });
});

function organizarParametros(parametros) {
  localStorage.removeItem(parametros.campo);
  localStorage.removeItem(parametros.complemento);

  var resultados = [];
  var valores = parametros.valores;
  
  if (valores != null) {
    if (parametros.resultados == true) {
      valores.forEach(function (item, index) {
        var texto = $('#' + parametros.campo + ' option[value='+ item +']').text();
        resultados.push(texto); 
      });
    } else {
      resultados = parametros.valores;
    }

    localStorage.setItem(parametros.complemento, resultados);
    localStorage.setItem(parametros.campo, valores);
    localStorage.setItem('possui_filtro', 'Sim');
  }

  buscaAjax();
}

$("#construtora_id_multiplo").on("change", function () {
  organizarParametros({
    campo: 'construtora_id_multiplo',
    complemento: 'sessao_busca_construtoras',
    valores: $(this).val(),
    resultados: true
  });
})

$("#subtipo_id_multiplo").on("change", function () {
  organizarParametros({
    campo: 'subtipo_id_multiplo',
    complemento: 'sessao_busca_subtipos',
    valores: $(this).val(),
    resultados: true
  });
});

$("#modalidade_id_multiplo").on("change", function () {
  organizarParametros({
    campo: 'modalidade_id_multiplo',
    complemento: 'sessao_busca_modalidades', 
    valores: $(this).val(),
    resultados: false
  });
});

$("#cidade_id_multiplo").on("change", function () {
  organizarParametros({
    campo: 'cidade_id_multiplo',
    complemento: 'sessao_busca_cidades',
    valores: $(this).val(),
    resultados: true
  });
});

$("#bairro_id_multiplo").on("change", function () {
  organizarParametros({
    campo: 'bairro_id_multiplo',
    complemento: 'sessao_busca_bairros', 
    valores: $(this).val(),
    resultados: true
  });
});

$('#slider-range-price-sidebar').click(function() {
  var valor = $("#slider-range-price-sidebar-value").val();
  localStorage.setItem('valor', valor);
  localStorage.setItem('possui_filtro', 'Sim');
  buscaAjax();
});

$('#slider-range-bedrooms-sidebar').click(function() {
  var quarto = $("#slider-range-bedrooms-sidebar-value").val();
  localStorage.setItem('quarto', quarto);
  localStorage.setItem('possui_filtro', 'Sim');
  buscaAjax();
});

$('#slider-range-area-sidebar').click(function() {
  var area = $("#slider-range-area-sidebar-value").val();
  localStorage.setItem('area', area);
  localStorage.setItem('possui_filtro', 'Sim');
  buscaAjax();
});

function buscaAjax() {  
  if (localStorage.getItem('possui_filtro') == 'Sim') {
    var parametros = {
      busca_rapida: localStorage.getItem('busca_rapida') != undefined ? localStorage.getItem('busca_rapida') : null,
      construtora_id_multiplo: localStorage.getItem('construtora_id_multiplo') != undefined ? localStorage.getItem('construtora_id_multiplo').split(',') : null,
      subtipo_id_multiplo: localStorage.getItem('subtipo_id_multiplo') != undefined ? localStorage.getItem('subtipo_id_multiplo').split(',') : null,
      modalidade_id_multiplo: localStorage.getItem('modalidade_id_multiplo') != undefined ? localStorage.getItem('modalidade_id_multiplo').split(',') : null,
      cidade_id_multiplo: localStorage.getItem('cidade_id_multiplo') != undefined ? localStorage.getItem('cidade_id_multiplo').split(',') : null,
      bairro_id_multiplo: localStorage.getItem('bairro_id_multiplo') != undefined ? localStorage.getItem('bairro_id_multiplo').split(',') : null,
      valor: localStorage.getItem('valor') != undefined ? localStorage.getItem('valor') : null,
      area: localStorage.getItem('area') != undefined ? localStorage.getItem('area') : null,
      quarto: localStorage.getItem('quarto') != undefined ? localStorage.getItem('quarto') : null,
      ordenacao: localStorage.getItem('ordenacao') != undefined ? localStorage.getItem('ordenacao') : null
    };

    localStorage.removeItem('busca_rapida');

    $.ajax({
      type: "POST",
      url: "/resultado-busca",
      data: parametros,
      beforeSend: function() {
        $('#resultados').empty().append('Carregando...');
      },        
      success: function(response) {  
        $('#resultados').empty().append(response);
        $(document).trigger('exibirParametros');
      }
    });
  }
}

function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
    var a, b, i, val = this.value;
    closeAllLists();
    if (!val) { return false;}
    currentFocus = -1;
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    this.parentNode.appendChild(a);
    for (i = 0; i < arr.length; i++) {
      if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
      b = document.createElement("DIV");
      b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
      b.innerHTML += arr[i].substr(val.length);
      b.innerHTML += "<input type='hidden' id='empreendimento_busca' name='empreendimento_busca' value='" + arr[i] + "'>";
      b.addEventListener("click", function(e) {
        inp.value = this.getElementsByTagName("input")[0].value;
        var busca_rapida = this.getElementsByTagName("input")[0].value;
        localStorage.setItem('busca_rapida', busca_rapida);
        localStorage.setItem('possui_filtro', 'Sim');
        buscaAjax();
        closeAllLists();
      });
      a.appendChild(b);
      }
    }
  });

  inp.addEventListener("keydown", function(e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");
    if (e.keyCode == 40) {
      currentFocus++;
      addActive(x);
    } else if (e.keyCode == 38) {
      currentFocus--;
      addActive(x);
    } else if (e.keyCode == 13) {
      e.preventDefault();
      if (currentFocus > -1) {
        if (x) x[currentFocus].click();
      }
    }
  });

  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
    x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
    if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
    }
  }
  document.addEventListener("click", function (e) {
    closeAllLists(e.target);
  });
}

autocomplete(document.getElementById("nome_empreendimento"), empreendimentos);  
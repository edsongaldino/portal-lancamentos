<script type="text/javascript">
  $(document).ready(function(){
    $("#content div:nth-child(1)").show();

    $(".abas li:first div").addClass("selected");       

    $(".aba").click(function() {
      $(".aba").removeClass("selected");
      $(this).addClass("selected");
      var indice = $(this).parent().index();
      indice++;
      $("#content div").hide();
      $("#content div:nth-child("+indice+")").show();
    });

    $(".aba").hover(
      function(){ 
        $(this).addClass("ativa")
      },
      function(){ 
        $(this).removeClass("ativa")
      }
      );              
  });
</script>

<section id="conteudo-fichatecnica">
  <div class="TabControl">
    <div id="header">
      <ul class="abas">
        <li>
          <div class="aba">
            <span>Itens de lazer</span>
          </div>
        </li>
        <li>
          <div class="aba">
            <span>Ficha técnica</span>
          </div>
        </li>
      </ul>
    </div>
    <div id="content">
      <div class="conteudo">
        <ul class="details-ticks">
          @foreach ($empreendimento->itensLazer as $item)                        
          <li class="itens">
            <i class="fa fa-check-circle"></i> 
            {{ $item->nome }}
          </li> 
          @endforeach
        </ul>
      </div>
      <div class="conteudo">
        <ul class="details-ticks">
          @foreach($empreendimento->caracteristicasEmpreendimento AS $item)
          <li class="itens">
            <i class="fa fa-check-circle"></i> 
            {{ $item->nome }}            
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
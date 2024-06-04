@if ($empreendimento->ofertasAtivas->count())
  <div class="selo-oferta-detalhe">
    <img src="https://www.lancamentosonline.com.br/imagens/selos/{{ $empreendimento->selo_oferta }}" alt="">
  </div>
@elseif($empreendimento->selo_oferta)
  <div class="selo-oferta-detalhe">
    <img src="/site/images/selos/{{ $empreendimento->selo_oferta }}" alt="">
  </div>
@endif
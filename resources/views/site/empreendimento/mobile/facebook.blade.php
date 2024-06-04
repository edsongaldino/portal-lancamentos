<div class="icones">
  <a href="https://facebook.com/sharer.php?u={{ $empreendimento->getUrlCompleta() }}" target="_blank" class="facebook">
    <div class="icone-compartilhar">
      <i class="fa fa-share-alt"></i>
    </div>
  </a>
  
  @if(false)
    @if(in_array($empreendimento->id, $array_empreendimentos_favoritos))
      <div class="icone-favoritar active" onclick="removeFavorito('{{ $empreendimento->id }}');">
        <i class="fa fa-heart"></i>
      </div>
    @else
      <div class="icone-favoritar" onclick="addFavorito('{{ $empreendimento->id }}');">
        <i class="fa fa-heart"></i>
      </div>
    @endif
  @else
    <a href="#">
      <div class="icone-favoritar">
        <i class="fa fa-heart"></i></div>
    </a>
  @endif
</div>
<div class="row">
  <div class="col-xs-12 col-lg-6">
    <h5 class="subtitle-margin">Sua busca retornou</h5>
    <h1><span class="special-color">{{ $total }}</span> empreendimentos</h1>
  </div>
  <div class="col-xs-12 col-lg-6">
    <div class="view-icons-container">
      <div class="view-box btn-resultado" id="btn-resultado-lista" style="display:none;"><img src="/site/images/list-icon.png" alt=""></div>
      <div class="view-box btn-resultado view-box-active" id="btn-resultado-lista-inativo"><img src="/site/images/list-icon.png" alt=""></div>
      <div class="view-box btn-resultado" id="btn-resultado-grid">
        <img src="/site/images/grid-icon.png" alt="">
      </div>
      <div class="view-box btn-resultado" id="btn-resultado-grid-inativo" style="display:none;"><img src="/site/images/grid-icon.png" alt=""></div>
    </div>
    <div class="order-by-container">
      <div class="btn-group bootstrap-select">
        <button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" title="Ordenar por:"><span class="filter-option pull-left">Ordenar por:</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
        <div class="dropdown-menu open">
          <ul class="dropdown-menu inner" role="menu">
            <li data-role="ordenar" data-valor="menor_valor" data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Valor menor</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
            <li data-role="ordenar" data-valor="maior_valor" data-original-index="2"><a tabindex="1" class="" style="" data-tokens="null"><span class="text">Valor maior</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
            <li data-role="ordenar" data-valor="maior_area" data-original-index="3"><a tabindex="2" class="" style="" data-tokens="null"><span class="text">Maior área</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
            <li data-role="ordenar" data-valor="menor_area" data-original-index="4"><a tabindex="3" class="" style="" data-tokens="null"><span class="text">Menor área</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="title-separator-primary"></div>
  </div>
</div>
<div id="resultado-lista" style="display:block;">
  <div class="row list-offer-row">
    @include('site/busca/desktop/lista')
  </div>
  <div class="offer-pagination margin-top-30">
    @include('site/busca/desktop/paginacao')
    <div class="clearfix"></div>
  </div>
</div>

<div id="resultado-grid" style="display:none;">
  <div class="row list-offer-row">
    @include('site/busca/desktop/grid')
  </div>
  <div class="offer-pagination margin-top-30">
      @include('site/busca/desktop/paginacao')
    <div class="clearfix"></div>
  </div>
</div>
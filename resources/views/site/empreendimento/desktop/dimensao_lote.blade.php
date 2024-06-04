<div id="dados-dimensao-lote" class="detalhe-lote">

    <div class="img-planta"><img src="/assets/premium/img/fundo-dimensoes.png" class="img-responsive" alt=""></div>
    <div class="metragem">{{ $unidade->getCaracteristica('metragem_total') ?? '' }}m²</div>
    <div class="dimensao-lote">
        <div class="item frente"><div class="titulo">Frente</div><div class="valor">{{ $unidade->getCaracteristica('lote_frente') ?? '' }}m</div></div>
        <div class="item fundo"><div class="titulo">Fundo</div><div class="valor">{{ $unidade->getCaracteristica('lote_fundo') ?? '' }}m</div></div>
        <div class="item lateral-dir"><div class="titulo">Lat. Dir</div><div class="valor">{{ $unidade->getCaracteristica('lote_lateral_dir') ?? '' }}m</div></div>
        <div class="item lateral-esq"><div class="titulo">Lat. Esq</div><div class="valor">{{ $unidade->getCaracteristica('lote_lateral_esq') ?? '' }}m</div></div>
    </div>

</div>

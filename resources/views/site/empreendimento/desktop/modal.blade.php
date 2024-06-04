@if ($empreendimento->caracteristicas->where('nome', 'video')->first())
<div id="myModal" class="modal fade">
  <div class="modal-dialog video">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">{{ $empreendimento->nome }}</h4>
      </div>
      <div class="modal-body">
        <iframe id="cartoonVideo" width="800" height="451" src="{{ $empreendimento->caracteristicas->where('nome', 'video')->first()->pivot->valor }}?rel=0&amp;arp;autoplay=1" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>
@endif

<div class="modal fade modal-fullscreen-md-down" id="ModalMapa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>MAPA DE VENDAS</h3>
    </div>
    <div class="modal-content">
      <div class="modal-body-mapa"></div>
    </div>
  </div>
</div>

<!--
<div id="popupModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog popup">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

    <div class="modal-content">
        <div class="modal-body banner-popup">
            <a href="https://www.lancamentosonline.com.br/construtora/gms-9.html" target="_blank">
                <img src="/site/images/slides/popup-gms.jpg" class="img-responsive">
            </a>
        </div>
    </div>
  </div>
</div>
-->

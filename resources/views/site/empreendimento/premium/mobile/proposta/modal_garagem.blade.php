<!-- Modal -->
<div class="modal fade" id="ModalGaragem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <i class="fas fa-car" aria-hidden="true"></i> Mapa das vagas
          <button type="button" class="close fechar-modal" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            <iframe class="conteudo-mapa" zooming="true" id="iframe" src="{{ env('APP_URL') }}/empreendimento/{{ $empreendimento->id }}/{{ $empreendimento->id*37 }}/visualizar-garagens/mobile" title="Mapa"></iframe>
            <!-- Trigger -->
            <ul id="zoom_triggers">
                <li><a id="zoom_in"><i class="fas fa-plus-square" aria-hidden="true"></i></a></li>
                <li><a id="zoom_out"><i class="fas fa-minus-square" aria-hidden="true"></i></a></li>
                <li><a id="zoom_reset"><i class="fas fa-sync-alt" aria-hidden="true"></i></a></li>
            </ul>
        </div>
      </div>
    </div>
</div>
<!-- inicio janela incluir -->
<div class="modal fade" id="modal_janela" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Marcação do ponto</h4>
      </div>
      <div class="modal-body">
        <!--inicio conteudo-->
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            <form id="form1" method="post">              
              <div class="panel panel-default">
                <div class="panel-heading">Informações gerais</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-4 col-xs-4 selectContainer">
                      <label>Tipo</label>
                      <select class="form-control" name="tipo_ponto" id="tipo_ponto" required="required">                                                      
                        <option value="U" selected>Unidade</option>
                        <option value="I">Imagem</option>
                        <option value="M">Mapa da Quadra</option>
                      </select>
                    </div>                  
                    
                    <div class="col-sm-4 col-xs-4 apenas_pf">
                      <label>Coord. X</label>
                      <input type="text" class="form-control" name="coord_x" id="coord_x" readonly="readonly" required="required">
                    </div>
                    
                    <div class="col-sm-4 col-xs-4 apenas_pj">
                      <label>Coord. Y</label>
                      <input type="text" class="form-control" name="coord_y" id="coord_y" readonly="readonly" required="required">
                    </div>

                  </div>
                </div>
              </div>
              
              <div class="panel panel-default">
                <div class="panel-heading">Vínculo</div>
                <div class="panel-body">
                  <div class="row">

                    <div class="col-sm-4 col-xs-4 selectContainer" id="tamPonto">
                      <label title="Tamanho do Ponto">Tam. Ponto</label>
                      <select class="form-control" name="tam_implantacao" id="tam_implantacao" required="required">                                                      
                        <option value="pq" @php if ($empreendimento->getCaracteristica('tam_implantacao') == "pq") {echo "selected";} @endphp>Pequeno</option>
                        <option value="md" @php if ($empreendimento->getCaracteristica('tam_implantacao') == "md") {echo "selected";} @endphp>Médio</option>
                        <option value="gd" @php if ($empreendimento->getCaracteristica('tam_implantacao') == "gd") {echo "selected";} @endphp>Grande</option>
                      </select>
                    </div>

                    <div id="vinculo_unidade" class="col-sm-8 col-xs-8 selectContainer">
                      <label>Unidade</label>
                      <select class="form-control" name="unidade_id" id="ponto_unidade">
                        <option value="">&nbsp;</option>                        
                        @php
                          $unidades = $empreendimento
                            ->unidades
                            ->where('situacao', '<>', 'Bloqueada')
                            ->where('coord_x', null)
                            ->where('coord_y', null);
                            
                        @endphp

                        @foreach ($unidades as $unidade)
                          <option value="{{ $unidade->id }}">
                            {{ $unidade->quadra->nome }} 
                            - Unidade {{ $unidade->nome }} 
                            (Sol {{ $unidade->getCaracteristica('tipo_sol') }})
                          </option>
                        @endforeach
                        </select>
                      </div>
                      
                      <div id="vinculo_imagem" class="col-sm-12 col-xs-12 selectContainer">
                        <label>Imagem</label>
                        <select class="form-control" name="foto_id" id="ponto_imagem">
                          <option value="">&nbsp;</option>                                                                                  
                          @foreach ($unidade->empreendimento->fotos as $foto)
                            <option value="{{ $foto->id }}">
                              {{ $foto->tipo }} - {{ $foto->nome }}
                            </option>
                          @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <input type="hidden" id="empreendimento_id" name="empreendimento_id" value="{{ $empreendimento->id }}">
                  <input type="hidden" name="px" id="px" />
                  <input type="hidden" name="py" id="py" />
                </form>
                
              </div>
            </div>
            <!--fim conteudo-->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success btn-sm" id="bt_modal_atualizar">
              <i class="fa fa-check-circle"></i> Salvar
            </button>
            <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">
              <i class="fa fa-times-circle"></i> Fechar
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- fim janela incluir -->
    
    <!-- inicio confirmar_exclusao -->
    <div class="modal fade" id="modal_excluir" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button tipo="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Atenção</h4>
          </div>
          <div class="modal-body">
            <form id="form2">
              <input type="hidden" name="unidade_id" id="unidade_id"/>
              <input type="hidden" name="px" id="px2"/>
              <input type="hidden" name="py" id="py2"/>
              <input type="hidden" name="tam_implantacao" id="tam_implantacao">            
              <div class="panel panel-default sem_margin_bottom">
                <div class="panel-body">
                  Você está prestes a excluir a marcação da <strong><span id="info_marcacao"></span></strong>, este procedimento é irreversível. <strong>Deseja continuar?</strong>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <a class="btn btn-danger btn-ok" id="bt_modal_excluir">Sim</a>
            <button tipo="button" class="btn btn-success" data-dismiss="modal">Não</button>
          </div>
          </form>
        </div>
      </div>
    </div>

     <!-- inicio confirmar_exclusao -->
     <div class="modal fade" id="modal_excluir_foto" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button tipo="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Atenção</h4>
          </div>
          <div class="modal-body">
            <form id="form3">
              <input type="hidden" name="foto_id" id="foto_id"/>
              <input type="hidden" name="px" id="px2"/>
              <input type="hidden" name="py" id="py2"/>            
              <div class="panel panel-default sem_margin_bottom">
                <div class="panel-body">
                  Você está prestes a excluir a marcação da <strong><span id="info_marcacao"></span></strong>, este procedimento é irreversível. <strong>Deseja continuar?</strong>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <a class="btn btn-danger btn-ok" id="bt_modal_excluir_foto">Sim</a>
            <button tipo="button" class="btn btn-success" data-dismiss="modal">Não</button>
          </div>
          </form>
        </div>
      </div>
    </div>
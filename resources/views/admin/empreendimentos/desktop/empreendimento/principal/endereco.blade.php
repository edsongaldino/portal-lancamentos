<div class="panel panel-accordion panel-accordion-orange">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Three">
        <i class="fa fa-map-marker"></i> Endereço do Empreendimento
      </a>
    </h4>
  </div>
  <div id="collapse2Three" class="accordion-body collapse">
    <div class="panel-body">
      <form id="endereco-empreendimento" class="form-horizontal form-bordered">
        <input type="hidden" id="lat" name="latitude" value="@if(isset($entry) && isset($entry->endereco)){{ $entry->endereco->latitude }}@else{{'-15.614363'}}@endif" />
        <input type="hidden" id="long" name="longitude" value="@if(isset($entry) && isset($entry->endereco)){{ $entry->endereco->longitude }}@else{{'-56.1818934'}}@endif" />
        @if(isset($entry))
        <input type="hidden" name="id" value="{{ $entry->id }}">
        @endif

        <div class="form-group">
          <label class="col-md-2 control-label">CEP</label>
          <div class="col-md-5">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-asterisk"></i>
              </span>
              <input name="cep" data-mapa="map_canvas" data-form="#endereco-empreendimento" value="@if(isset($endereco)){{ $endereco->cep }}@endif" type="text" id="fc_inputmask_1" data-plugin-masked-input data-input-mask="00000-000" class="form-control cep">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Logradouro</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
              </span>
              <input name="logradouro" value="@if (isset($endereco)) {{ $endereco->logradouro }} @endif" type="text" placeholder="Rua, Avenida, Travessa, etc" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Nº</label>
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
              </span>
              <input name="numero" value="@if (isset($endereco)) {{ $endereco->numero }} @endif" type="text" placeholder="" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Complemento</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-bookmark"></i>
              </span>
              <input name="complemento" value="@if (isset($endereco)) {{ $endereco->complemento }} @endif" type="text" placeholder="" class="form-control">
            </div>
          </div>
        </div>

        <input type="hidden" name="estado_nome_cep">              
        <input type="hidden" name="cidade_nome_cep">              
        <input type="hidden" name="bairro_nome_cep">              
        
        @if (isset($endereco) && $endereco->cidade_id)
          <div class="form-group">
            <label class="col-md-2 control-label">UF</label>
            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-map-marker"></i>
                </span>
                <select id="estado" name="estado_id" class="form-control">
                  @if (isset($estados))
                    @foreach($estados as $estado)
                      <option value="{{ $estado['id'] }}" @if ($estado['id'] == $endereco->estado_id) selected="true" @endif>{{ $estado['nome'] }}</option>
                    @endforeach
                  @else
                    <option>Selecione o estado</option>
                    @foreach($estados as $estado)
                      <option value="{{ $estado['id'] }}">{{ $estado['nome'] }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>                          
          </div>
        @else
          <div class="form-group">
            <label class="col-md-2 control-label">UF</label>
            <div class="col-md-5">
              <div class="input-group">              
                <span class="input-group-addon">
                  <i class="fa fa-map-marker"></i>
                </span>
                <div id="estado-wrapper">
                  <select id="estado" name="estado_id" class="form-control">                
                    <option>Selecione o estado</option>
                    @foreach(get_estados() as $estado)
                      <option value="{{ $estado->id }}">{{ $estado->nome }}</option>
                    @endforeach
                  </select>
                </div>                
              </div>
            </div>
          </div>
        @endif

        @if (isset($endereco) && $endereco->cidade_id)
          <div class="form-group">
            <label class="col-md-2 control-label">Cidade</label>
            <div class="col-md-5">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-map-marker"></i>
                </span>
                <div id="cidade-wrapper">
                  <select id="cidade" name="cidade_id" class="form-control">
                    @if (isset($cidades))
                    @foreach($cidades as $cidade)
                    <option value="{{ $cidade->id }}"
                    @if ($cidade->id == $endereco->cidade_id)
                    selected="true" 
                    @endif
                    >{{ $cidade->nome }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
            </div>
          </div>
        @else
          <div class="form-group">
            <label class="col-md-2 control-label">Cidade</label>
            <div class="col-md-5">
              <div class="input-group">              
                <span class="input-group-addon">
                  <i class="fa fa-map-marker"></i>
                </span>
                <div id="cidade-wrapper"></div>
              </div>
            </div>
          </div>
        @endif            

        @if (isset($endereco) && $endereco->bairro_id)
          <div class="form-group">
            <label class="col-md-2 control-label">Bairro</label>
            <div class="col-md-5">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-map-marker"></i>
                </span>
                <div id="bairro-wrapper">
                  <select name="bairro_id" class="form-control">
                    @if ($bairros)
                      @foreach($bairros as $bairro)
                        <option value="{{ $bairro->id }}" @if ($bairro->id == $endereco->bairro_id)
                          selected="true" @endif>
                          {{ $bairro->nome }}
                        </option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div>
            </div>
          </div>
        @else
          <div class="form-group">
            <label class="col-md-2 control-label">Bairro</label>
            <div class="col-md-5">
              <div class="input-group">              
                <span class="input-group-addon">
                  <i class="fa fa-map-marker"></i>
                </span>
                <div id="bairro-wrapper"></div>
              </div>
            </div>
          </div>
        @endif

        <div class="form-group">
          <label class="col-md-2 control-label">Bairro Comercial</label>
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
              </span>
              <input name="bairro_comercial" id="bairro_comercial" value="@if (isset($endereco)) {{ $endereco->bairro_comercial }} @endif" type="text" placeholder="Nome do bairro que aparecerá em destaque" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label" for="inputSuccess">Por padrão o ponto no mapa é marcado automaticamente  </label>
          <div class="col-md-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="Sim" id="marcar_mapa" name="marcar_mapa" @if(isset($endereco) && $endereco->marcar_mapa == 'Sim') checked="true" @endif>
                Desejo marcar manualmente
              </label>
            </div>                    
          </div>
        </div>

        <div id="map_canvas" style="width: 100%; height: 400px; margin-bottom:20px;"></div>

        <div class="form-group">
          <div class="col-md-12">
            
            @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
            <button class="btn btn-success salvar-dados" type="button" id="salvar-endereco-empreendimento"><i class="fa fa-save"></i> Salvar dados</button>    
            @else 
            <button class="btn btn-success salvar-dados erro-permissao" type="button"><i class="fa fa-save"></i> Salvar dados</button> 
            @endif

          </div>
        </div>


      </form>
    </div>
  </div>
</div>
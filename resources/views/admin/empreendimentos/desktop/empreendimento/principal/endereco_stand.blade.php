<div class="panel panel-accordion panel-accordion-orange">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a style="background-color: #70309e" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Seven">
        <i class="fa fa-map-marker"></i> Endereço Stand de Vendas
      </a>
    </h4>
  </div>
  <div id="collapse2Seven" class="accordion-body collapse">
    <div class="panel-body">
      <form id="endereco-stand" class="form-horizontal form-bordered">
        <input type="hidden" id="lat" name="latitude" value="@if(isset($endereco_stand)){{ $endereco_stand->latitude }}@endif" />
        <input type="hidden" id="long" name="longitude" value="@if(isset($endereco_stand)){{ $endereco_stand->longitude }}@endif" />
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
              <input name="cep" data-mapa="map_stand_canvas" data-form="#endereco-stand" value="@if(isset($endereco_stand)){{ $endereco_stand->cep }}@endif" type="text" id="fc_inputmask_1" data-plugin-masked-input data-input-mask="00000-000" class="form-control cep">
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
              <input name="logradouro" value="@if (isset($endereco_stand)) {{ $endereco_stand->logradouro }} @endif" type="text" placeholder="Rua, Avenida, Travessa, etc" class="form-control">
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
              <input name="numero" value="@if (isset($endereco_stand)) {{ $endereco_stand->numero }} @endif" type="text" placeholder="" class="form-control">
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
              <input name="complemento" value="@if (isset($endereco_stand)) {{ $endereco_stand->complemento }} @endif" type="text" placeholder="" class="form-control">
            </div>
          </div>
        </div>

        <input type="hidden" name="estado_nome_cep">
        <input type="hidden" name="cidade_nome_cep">
        <input type="hidden" name="bairro_nome_cep">

        @if (isset($endereco_stand) && $endereco_stand->cidade_id)
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
                      <option value="{{ $estado['id'] }}" @if ($estado['id'] == $endereco_stand->estado_id) selected="true" @endif>{{ $estado['nome'] }}</option>
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
                <div id="estado-wrapper-stand">
                  <select id="estado_stand" name="estado_id" class="form-control">
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

        @if (isset($endereco_stand) && $endereco_stand->cidade_id)
          <div class="form-group">
            <label class="col-md-2 control-label">Cidade</label>
            <div class="col-md-5">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-map-marker"></i>
                </span>
                <div id="cidade-wrapper-stand">
                  <select id="cidade" name="cidadeStand" class="form-control">
                    @if (isset($cidades_stand))
                    @foreach($cidades_stand as $cidade)
                    <option value="{{ $cidade->id }}"
                    @if ($cidade->id == $endereco_stand->cidade_id)
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
                <div id="cidade-wrapper-stand"></div>
              </div>
            </div>
          </div>
        @endif

        @if (isset($endereco_stand) && $endereco_stand->bairro_id)
          <div class="form-group">
            <label class="col-md-2 control-label">Bairro</label>
            <div class="col-md-5">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-map-marker"></i>
                </span>
                <div id="bairro-wrapper">
                  <select name="bairro_id" class="form-control">
                    @if ($bairros_stand)
                      @foreach($bairros_stand as $bairro)
                        <option value="{{ $bairro->id }}" @if ($bairro->id == $endereco_stand->bairro_id)
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
                <div id="bairro-wrapper-stand"></div>
              </div>
            </div>
          </div>
        @endif

        <div class="form-group">
          <label class="col-md-3 control-label" for="inputSuccess">Por padrão o ponto no mapa é marcado automaticamente  </label>
          <div class="col-md-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="Sim" id="marcar_mapa" name="marcar_mapa" @if(isset($endereco_stand) && $endereco_stand->marcar_mapa == 'Sim') checked="true" @endif>
                Desejo marcar manualmente
              </label>
            </div>
          </div>
        </div>

        <div id="map_stand_canvas" style="width: 100%; height: 400px; margin-bottom:20px;"></div>

        <div class="form-group">
          <div class="col-md-12">

            @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
            <button class="btn btn-success salvar-dados" type="button" id="salvar-endereco-stand"><i class="fa fa-save"></i> Salvar dados</button>
            @else
            <button class="btn btn-success salvar-dados erro-permissao" type="button"><i class="fa fa-save"></i> Salvar dados</button>
            @endif

          </div>
        </div>

      </form>
    </div>
  </div>
</div>

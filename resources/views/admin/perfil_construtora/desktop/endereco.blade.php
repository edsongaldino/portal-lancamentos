  <div class="panel panel-accordion panel-accordion-orange">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Three">
          <i class="fa fa-map-marker"></i> Endereço da Empresa
        </a>
      </h4>
    </div>
    <div id="collapse2Three" class="accordion-body collapse">
      <div class="panel-body">
        <form id="dados-endereco-construtora" class="form-horizontal form-bordered">
          <div class="form-group">
            <label class="col-md-2 control-label">CEP</label>
            <div class="col-md-5">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-asterisk"></i>
                </span>                
                <input name="cep" data-mapa="map_canvas" data-form="#dados-endereco-construtora" value="@if(isset($endereco)){{ $endereco->cep }}@endif" type="text" id="fc_inputmask_1" data-plugin-masked-input data-input-mask="00000-000" class="form-control cep">
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
                <input name="logradouro" value="@if(isset($endereco)) {{ $endereco->logradouro }} @endif" type="text" placeholder="Rua, Avenida, Travessa, etc" class="form-control">
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
              <input name="numero" value="@if(isset($endereco)) {{ $endereco->numero }} @endif" type="text" placeholder="" class="form-control">
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
              <input name="complemento" value="@if(isset($endereco)) {{ $endereco->complemento }} @endif" type="text" placeholder="" class="form-control">
            </div>
          </div>
        </div>

        <input type="hidden" name="estado_nome_cep">              
        <input type="hidden" name="cidade_nome_cep">              
        <input type="hidden" name="bairro_nome_cep">              
        
        @if (isset($endereco))
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
        
        @if (isset($endereco))
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
              <div id="cidade-wrapper"></div>
            </div>
          </div>
        </div>
        @endif

        @if (isset($endereco))
        <div class="form-group">
          <label class="col-md-2 control-label">Bairro</label>
          <div class="col-md-5">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
              </span>
              <div id="bairro-wrapper">
                <select name="bairro_id" class="form-control">
                  @if (isset($bairros))
                    @foreach($bairros as $bairro)
                      <option value="{{ $bairro->id }}" @if ($bairro->id == $endereco->bairro_id)selected="true"
                        @endif
                      >{{ $bairro->nome }}</option>
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
              <div id="bairro-wrapper"></div>
            </div>
          </div>
        </div>
        @endif      

        <div class="form-group">
          <div class="col-md-12">
            <button class="btn btn-success" type="button" id="salvar-dados-endereco-construtora">Salvar dados</button>    
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
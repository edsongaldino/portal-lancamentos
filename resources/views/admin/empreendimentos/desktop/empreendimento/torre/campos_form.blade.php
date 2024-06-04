<div class="form-group">
  <label class="col-md-2 control-label">Nome da Torre*</label>
  <div class="col-md-4">
    <input class="form-control" data-plugin-maxlength maxlength="20" name="nome" value="@if(isset($torre)){{ $torre->nome }}@endif"/>
  </div>
  
  <label class="col-md-2 control-label">Etapa:</label>
  <div class="col-md-4">
    <select class="form-control" name="etapa">
      <option value="Única" @if (isset($torre) && $torre->etapa == 'Única') selected="true" @endif>Etapa Única</option>
      <option value="Primeira" @if (isset($torre) && $torre->etapa == 'Primeira') selected="true" @endif>1ª Etapa</option>
      <option value="Segunda" @if (isset($torre) && $torre->etapa == 'Segunda') selected="true" @endif>2ª Etapa</option>
      <option value="Terceira" @if (isset($torre) && $torre->etapa == 'Terceira') selected="true" @endif>3ª Etapa</option>                                     
    </select>
  </div>  

</div>

<div class="form-group">
  <label class="col-md-2 control-label">Mês Entrega* (Previsão):</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </span>
      <select class="form-control" name="previsao_entrega_mes">
        <option value="">Escolha o mês</option>
        <option value="01" @if(isset($torre) && $torre->previsao_entrega_mes == "01")selected="true"@endif>Janeiro</option>
        <option @if(isset($torre) && $torre->previsao_entrega_mes == "02")selected="true"@endif value="2">Fevereiro</option>
        <option @if(isset($torre) && $torre->previsao_entrega_mes == "03")selected="true"@endif value="3">Março</option>
        <option @if(isset($torre) && $torre->previsao_entrega_mes == "04")selected="true"@endif value="4">Abril</option>
        <option @if(isset($torre) && $torre->previsao_entrega_mes == "05")selected="true"@endif value="5">Maio</option>
        <option @if(isset($torre) && $torre->previsao_entrega_mes == "06")selected="true"@endif value="6">Junho</option>
        <option @if(isset($torre) && $torre->previsao_entrega_mes == "07")selected="true"@endif value="7">Julho</option>
        <option @if(isset($torre) && $torre->previsao_entrega_mes == "08")selected="true"@endif value="8">Agosto</option>
        <option @if(isset($torre) && $torre->previsao_entrega_mes == "09")selected="true"@endif value="9">Setembro</option>
        <option @if(isset($torre) && $torre->previsao_entrega_mes == "10")selected="true"@endif value="10">Outubro</option>
        <option @if(isset($torre) && $torre->previsao_entrega_mes == "11")selected="true"@endif value="11">Novembro</option>
        <option @if(isset($torre) && $torre->previsao_entrega_mes == "12")selected="true"@endif value="12">Dezembro</option>
      </select>              
    </div>        
  </div>

  <label class="col-md-2 control-label">Ano Entrega* (Previsão):</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </span>
      <select class="form-control" name="previsao_entrega_ano">
        <option value="">Escolha o ano</option>
        @php
          $year = date("Y")+10;
          $anos = '';
          for ($i = date("Y")-10; $i < $year ; $i++) {
            $selected = '';
            if (isset($torre)) {
              $selected = $torre->previsao_entrega_ano == $i ? "selected='true'" : '';  
            }            
            $anos .= "<option ". $selected ." value='". $i . "'>". $i ."</option>";
          }
        @endphp
        {!! $anos !!}
      </select>              
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Nomenclatura (Unidades):</label>
  <div class="col-md-10">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="fa fa-check"></i>
      </span>
      <select class="form-control" id="nomenclatura_unidades" name="nomenclatura_unidades" @if(isset($torre))disabled="true"@endif>

        <option value="DezenaT" 
        @if (isset($torre) && $torre->caracteristicas->where('nome', 'nomenclatura_unidades')->first()) 
          @if ($torre->caracteristicas->where('nome', 'nomenclatura_unidades')->first()->pivot->valor == 'DezenaT')
          selected="true" 
          @endif
        @endif>
        Dezena (11,12,13,14,15...) - À partir do Térro
        </option>

        <option value="CentenaT" 
        @if (isset($torre) && $torre->caracteristicas->where('nome', 'nomenclatura_unidades')->first()) 
          @if ($torre->caracteristicas->where('nome', 'nomenclatura_unidades')->first()->pivot->valor == 'CentenaT')
          selected="true" 
          @endif
        @endif>
        Centena (101,102,103,104,105...) - À partir do Térreo
        </option>
        
        <option value="Dezena" @if (isset($torre) && $torre->caracteristicas->where('nome', 'nomenclatura_unidades')->first()) 
            @if ($torre->caracteristicas->where('nome', 'nomenclatura_unidades')->first()->pivot->valor == 'Dezena')
            selected="true" 
            @endif
        @endif>Dezena (11,12,13,14,15...) - À partir do 1º Andar</option>
        <option value="Centena" @if (isset($torre) && $torre->caracteristicas->where('nome', 'nomenclatura_unidades')->first()) 
            @if ($torre->caracteristicas->where('nome', 'nomenclatura_unidades')->first()->pivot->valor == 'Centena')
            selected="true" 
            @endif
        @endif>Centena (101,102,103,104,105...) - À partir do 1º Andar</option>
        
        
      </select>
    </div>
  </div>
</div>

<div id="andar_padrao" style="display: none;">
  <div class="form-group">
    <label class="col-md-2 control-label">Unidades no Térreo?</label>
    <div class="col-md-4">
      <select class="form-control" id="unidades_terreo" name="unidades_terreo" @if(isset($torre))disabled="true"@endif>
        <option value="Não" @if (isset($torre) && $torre->caracteristicas->where('nome', 'unidades_terreo')->first()) 
            @if ($torre->caracteristicas->where('nome', 'unidades_terreo')->first()->pivot->valor == 'Não')
            selected="true" 
            @endif
        @endif>Não</option>                                    
        <option value="Sim" @if (isset($torre) && $torre->caracteristicas->where('nome', 'unidades_terreo')->first()) 
            @if ($torre->caracteristicas->where('nome', 'unidades_terreo')->first()->pivot->valor == 'Sim')
            selected="true" 
            @endif
        @endif>Sim</option>      
      </select>
    </div>
    
    <div id="qtde-terreo" 
        @if (isset($torre) && $torre->caracteristicas->where('nome', 'unidades_terreo')->first()) 
          @if ($torre->caracteristicas->where('nome', 'unidades_terreo')->first()->pivot->valor == 'Sim')
            style="display: block" 
          @else
            style="display: none" 
          @endif
        @else
          style="display: none" 
        @endif>
      <label class="col-md-2 control-label">Qtde unidades no Térreo</label>  
      <div class="col-md-4">
        <input class="form-control" type="number" min="1" name="qtde_unidades_terreo" @if (isset($torre) && $torre->caracteristicas->where('nome', 'qtde_unidades_terreo')->first()) value="{{ $torre->caracteristicas->where('nome', 'qtde_unidades_terreo')->first()->pivot->valor }}" @endif @if(isset($torre))disabled="true"@endif>
      </div>  
    </div>
    
  </div>

  <div class="form-group">
    <label class="col-md-2 control-label">Térreo + Andares (Total):</label>
    <div class="col-md-4">
      <input class="form-control" type="number" min="1" name="andares" @if (isset($torre) && $torre->caracteristicas->where('nome', 'andares')->first()) value="{{ $torre->caracteristicas->where('nome', 'andares')->first()->pivot->valor }}" @endif @if(isset($torre))disabled="true"@endif>
    </div>
      
    <label class="col-md-2 control-label">Unidades por Andar:</label>
    <div class="col-md-4">
      <input class="form-control" type="number" min="1" name="unidades_andar" @if (isset($torre) && $torre->caracteristicas->where('nome', 'unidades_andar')->first()) value="{{ $torre->caracteristicas->where('nome', 'unidades_andar')->first()->pivot->valor }}" @endif @if(isset($torre))disabled="true"@endif>
    </div>
  </div>
</div>

<div id="andar_customizado" style="display: block;">
  <div class="form-group">
    <label class="col-md-2 control-label">Andares (Total):</label>
    <div class="col-md-4">
      <input class="form-control" type="number" min="1" name="andares_custom" @if (isset($torre) && $torre->caracteristicas->where('nome', 'andares')->first()) value="{{ $torre->caracteristicas->where('nome', 'andares')->first()->pivot->valor }}" @endif @if(isset($torre))disabled="true"@endif>
    </div>
      
    <label class="col-md-2 control-label">Unidades por Andar:</label>
    <div class="col-md-4">
      <input class="form-control" type="number" min="1" name="unidades_andar_custom" @if (isset($torre) && $torre->caracteristicas->where('nome', 'unidades_andar')->first()) value="{{ $torre->caracteristicas->where('nome', 'unidades_andar')->first()->pivot->valor }}" @endif @if(isset($torre))disabled="true"@endif>
    </div>
  </div>
</div>

<br/>

<div class="form-group">
  <label class="col-md-2 control-label">Possui cobertura?</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="fa fa-question"></i>
      </span>
      <select class="form-control" id="cobertura" name="cobertura" @if(isset($torre))disabled="true"@endif>
        <option value="Não" @if (isset($torre) && $torre->caracteristicas->where('nome', 'cobertura')->first()) 
            @if ($torre->caracteristicas->where('nome', 'cobertura')->first()->pivot->valor == 'Não')
            selected="true" 
            @endif
        @endif>Não</option>  
        <option value="Sim" @if (isset($torre) && $torre->caracteristicas->where('nome', 'cobertura')->first()) 
            @if ($torre->caracteristicas->where('nome', 'cobertura')->first()->pivot->valor == 'Sim')
            selected="true" 
            @endif
        @endif>Sim</option>                                      
      </select>
    </div>
  </div>

  
  <div id="qtde-cobertura" 
      @if (isset($torre) && $torre->caracteristicas->where('nome', 'cobertura')->first()) 
        @if ($torre->caracteristicas->where('nome', 'cobertura')->first()->pivot->valor == 'Sim')
          style="display: block" 
        @else
        style="display: none" 
        @endif
      @else
        style="display: none" 
      @endif>
    <label class="col-md-2 control-label">Qtde unidades na Cobertura</label>  
    <div class="col-md-4">
      <input class="form-control" type="number" min="1" name="qtde_unidades_cobertura" @if (isset($torre) && $torre->caracteristicas->where('nome', 'qtde_unidades_cobertura')->first()) value="{{ $torre->caracteristicas->where('nome', 'qtde_unidades_cobertura')->first()->pivot->valor }}" @endif @if(isset($torre))disabled="true"@endif>
    </div>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Elevador Social:</label>
  <div class="col-md-4">
    <input class="form-control" type="number" min="1" name="elevador_social" @if (isset($torre) && $torre->caracteristicas->where('nome', 'elevador_social')->first()) value="{{ $torre->caracteristicas->where('nome', 'elevador_social')->first()->pivot->valor }}" @endif>
  </div>  
  <label class="col-md-2 control-label">Elevador de Serviço:</label>
  <div class="col-md-4">
    <input class="form-control" type="number" min="1" name="elevador_servico" @if (isset($torre) && $torre->caracteristicas->where('nome', 'elevador_servico')->first()) value="{{ $torre->caracteristicas->where('nome', 'elevador_servico')->first()->pivot->valor }}" @endif>
  </div>  
</div>

@if(!isset($torre))
  <div class="form-group">
    <label class="col-md-2 control-label">Pavimentos de garagem:</label>
    <div class="col-md-4">
      <input class="form-control" type="number" min="1" name="pavimentos_garagem" @if(isset($torre))disabled="true"@endif>
    </div>  
    <label class="col-md-2 control-label">Qtde garagens:</label>
    <div class="col-md-4">
      <input class="form-control" type="number" min="1" name="vagas_garagem" @if(isset($torre))disabled="true"@endif>
    </div>  
  </div>
@endif

<div class="form-group">
  <label class="col-md-2 control-label">Situação da Torre:</label>
  <div class="col-md-3">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="fa fa-check"></i>
      </span>
      <select class="form-control" name="status">
        <option value="Liberada">Liberada</option>
        <option value="Bloqueada" @if (isset($torre) && $torre->status == 'Bloqueada') selected="true" @endif>Bloqueada</option>
        <option value="Entregue" @if (isset($torre) && $torre->status == 'Entregue') selected="true" @endif>Entregue</option>
      </select>
    </div>
  </div>                                             
</div>
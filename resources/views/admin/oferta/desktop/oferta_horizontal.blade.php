<div class="form-group">
  @if(isset($unidade))
    <label class="col-sm-2 control-label" for="w10-username"><i class="fa fa-building" aria-hidden="true"></i>  Quadra</label>
    <div class="col-sm-4">
      <select id="quadra" name="quadra" class="form-control" required="true">
        <option value="">Selecione Quadra</option>
        @if (isset($empreendimento))
        @foreach($empreendimento->getQuadrasDisponiveis() as $quadra)
        <option value="{{ $quadra->id }}" @if(isset($unidade) && $unidade->quadra->id == $quadra->id) selected="true" @endif>{{ $quadra->nome }}</option>
        @endforeach
        @endif  
      </select>
    </div>
  @endif
</div>

<div class="form-group margin-top-20">
  <div id="unidades">
    @if (isset($unidade))
    <label class="col-sm-2 control-label" for="w4-password"><i class="fa fa-codepen" aria-hidden="true"></i> Unidade</label>
    <div class="col-sm-4">
      <select id="unidade" name="unidade_id" class="form-control" required="">
        <option value="">Selecione uma unidade</option>        
          @foreach ($unidade->quadra->unidades as $un)
            <option value="{{ $un->id }}" @if($un->id == $unidade->id) selected="true" @endif>{{ $un->nome }}</option>
          @endforeach        
      </select>
    </div>
    @endif
  </div>

  @if($unidade->empreendimento->variacao_id == 6 || $unidade->empreendimento->variacao_id == 10 || $unidade->empreendimento->variacao_id == 11)

    <div id="plantas">
      @if (isset($unidade))
        <label class="col-sm-2 control-label" for="w4-password">
          <i class="fa fa-arrows-alt" aria-hidden="true"></i> Tamanho do Lote
        </label>
        <div class="col-sm-4" id="box_planta_unidade">
          @if($unidade->caracteristicas->where('nome', 'metragem_total')->first())
            <input type="text" name="metragem_total" value="{{ $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor }}" readonly="true" class="form-control"> m²
          @else         
            <input type="text" name="metragem_total" value="" class="form-control"> m²
          @endif
        </div>
      @endif
    </div>

  @else

    @if (isset($unidade))
    <div id="plantas">
      
        <label class="col-sm-2 control-label" for="w4-password">
          <i class="fa fa-arrows-alt" aria-hidden="true"></i> Planta
        </label>
        <div class="col-sm-4" id="box_planta_unidade">
          @if (isset($unidade->planta))
            <input type="text" name="planta" value="{{ $unidade->planta->nome }}" readonly="true" class="form-control">
          @else         
            @if ($unidade->empreendimento->plantas)               
              <select id="planta" name="planta_id" class="form-control" required="">
                <option value="">Selecione uma planta</option>
                @foreach ($unidade->empreendimento->plantas as $planta)
                <option value="{{ $planta->id }}" @if($unidade->planta_id == $planta->id) selected="true" @endif>{{ $planta->nome }}</option>
                @endforeach
              </select>
            @endif
          @endif
        </div>
    </div>
    @endif

  @endif
</div>
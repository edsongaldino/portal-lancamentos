<div class="form-group">
  @if (isset($unidade))
    <label class="col-sm-2 control-label" for="w10-username"><i class="fa fa-building" aria-hidden="true"></i>  Torre</label>
    <div class="col-sm-4">
      <select id="torre" name="torre" class="form-control" required="true">
        <option value="">Selecione Torre</option>      
        @foreach($empreendimento->torres as $torre)
          <option value="{{ $torre->id }}" @if(isset($unidade) && $unidade->torre->id == $torre->id) selected="true" @endif>{{ $torre->nome }}</option>
        @endforeach
      </select>
    </div>
  @endif

  <div id="andares">
    @if (isset($unidade))
    <label class="col-sm-2 control-label" for="w4-username"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i> Andar</label>
    <div class="col-sm-4">
      <select id="andar" name="andar_id" class="form-control" required="">
        <option value="">Selecione o andar</option>
          @foreach ($unidade->torre->andares as $andar)
            <option value="{{ $andar->id }}" @if($unidade->andar->id == $andar->id) selected="true" @endif>{{ $andar->numero }}</option>
          @endforeach
      </select>
    </div>
    @endif
  </div>
</div>

<div class="form-group margin-top-20">
  <div id="unidades">
    @if (isset($unidade))
    <label class="col-sm-2 control-label" for="w4-password"><i class="fa fa-codepen" aria-hidden="true"></i> Unidade</label>
    <div class="col-sm-4">
      <select id="unidade" name="unidade_id" class="form-control" required="">
        <option value="">Selecione uma unidade</option>                
        @foreach ($unidade->andar->unidades as $un)
          <option value="{{ $un->id }}" @if($un->id == $unidade->id) selected="true" @endif>{{ $un->nome }}</option>
        @endforeach
      </select>
    </div>
    @endif
  </div>

  <div id="plantas">
    @if (isset($unidade))
    <label class="col-sm-2 control-label" for="w4-password"><i class="fa fa-arrows-alt" aria-hidden="true"></i> Planta</label>
    <div class="col-sm-4" id="box_planta_unidade">
      @if (isset($unidade->planta))
        <input type="text" name="planta" value="{{ $unidade->planta->nome }}" readonly="true" class="form-control">
      @else         
        @if ($unidade->empreendimento->plantas)               
          <select id="planta" name="planta_id" class="form-control" required="">
            <option value="">Selecione uma planta</option>
            @foreach ($unidade->empreendimento->plantas as $planta)
            <option value="{{ $planta->id }}" @if($unidade->planta_id == $planta->id)selected="true"@endif>{{ $planta->nome }}</option>
            @endforeach
          </select>
        @endif
      @endif
    </div>
    @endif
  </div>
</div>
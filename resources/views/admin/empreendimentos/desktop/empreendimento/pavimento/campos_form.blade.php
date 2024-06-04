<div class="form-group">
  <label class="col-md-2 control-label">Nome da pavimento*</label>
  <div class="col-md-4">
    <input class="form-control" name="nome" value="@if(isset($pavimento)){{ $pavimento->nome }}@endif"/>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Qtde Garagens*</label>
  <div class="col-md-4">
    <input class="form-control" name="vagas_garagem" value="@if(isset($pavimento)){{ count($pavimento->garagens) }}@endif"/>
  </div>

  <label class="col-md-2 control-label">Torre*</label>
  <div class="col-md-4">
    <select class="form-control" placeholder="Selecione" data-plugin-multiselect name="torre_id" id="torre">
        @foreach($entry->torres as $torre)
            <option 
            	@if(isset($pavimento)) 
            		@if ($pavimento->torre_id == $torre->id)
            			selected="true" 
            		@endif 
        		@endif value="{{ $torre->id }}">{{ $torre->nome }}</option>
        @endforeach
    </select>
  </div>
</div>
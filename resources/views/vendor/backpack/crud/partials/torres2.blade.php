<label class="col-sm-2 control-label" for="w10-username"><i class="fa fa-building" aria-hidden="true"></i>  Torre</label>
<div class="col-sm-4">
<select id="torre" name="torre" class="form-control" required="true">
  <option value="">Selecione Torre</option>      
  @foreach($torres as $torre)
    <option value="{{ $torre->id }}">{{ $torre->nome }}</option>
  @endforeach
</select>
</div>
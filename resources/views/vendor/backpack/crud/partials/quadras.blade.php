<label class="col-sm-2 control-label" for="w10-username"><i class="fa fa-building" aria-hidden="true"></i>  Quadra</label>
<div class="col-sm-4">
<select id="quadra" name="quadra" class="form-control" required="true">
  <option value="">Selecione a quadra</option>      
  @foreach($quadras as $quadra)
    <option value="{{ $quadra->id }}">{{ $quadra->nome }}</option>
  @endforeach
</select>
</div>
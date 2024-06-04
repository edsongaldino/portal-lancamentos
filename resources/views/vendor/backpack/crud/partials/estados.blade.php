<select name="estado_id" id="estado_id" class="form-control">	
	@foreach ($estados as $estado)
		<option value="{{ $estado->id }}">{{ $estado->nome }}</option>
	@endforeach
</select>
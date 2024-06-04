@if ($bairro_comercial)
	<select name="bairro_comercial" id="bairro_comercial" class="form-control">	
@else
	<select name="bairro_id" id="bairro_id" class="form-control">	
@endif
	@foreach ($bairros as $bairro)
		<option value="{{ $bairro->id }}">{{ $bairro->nome }}</option>
	@endforeach
</select>
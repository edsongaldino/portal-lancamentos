<select name="bairro_comercial" class="form-control">	
	@foreach ($bairros as $bairro)
		<option value="{{ $bairro['id'] }}">{{ $bairro['nome'] }}</option>
	@endforeach
</select>
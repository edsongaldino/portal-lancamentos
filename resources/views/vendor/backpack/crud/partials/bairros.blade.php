<select name="bairro_id" id="bairro_id" class="form-control">	
	@foreach ($bairros as $bairro)
		<option value="{{ $bairro['id'] }}">{{ $bairro['nome'] }}</option>
	@endforeach
</select>